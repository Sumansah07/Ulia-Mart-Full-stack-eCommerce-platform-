<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\OrderItem;
use App\Models\OrderUpdate;
use App\Models\User;
use App\Notifications\DeliverymanAssignNotification;
use App\Notifications\OrderPaymentStatusNotification;
use App\Notifications\OrderDeliveryStatusNotification;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrdersController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:orders'])->only('index');
        $this->middleware(['permission:manage_orders'])->only(['show', 'updatePaymentStatus', 'updateDeliveryStatus']);
    }

    # get all orders
    public function index(Request $request)
    {
        $searchKey = null;
        $searchCode = null;
        $deliveryStatus = null;
        $paymentStatus = null;
        $locationId = null;
        $posOrder = 0;

        $orders = Order::latest();

        # conditional
        if ($request->search != null) {
            $searchKey = $request->search;
            $orders = $orders->where(function ($q) use ($searchKey) {
                $customers = User::where('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('phone', 'like', '%' . $searchKey)
                    ->pluck('id');
                $q->orWhereIn('user_id', $customers);
            });
        }

        if ($request->code != null) {
            $searchCode = $request->code;
            $orders = $orders->where(function ($q) use ($searchCode) {
                $orderGroup = OrderGroup::where('order_code', $searchCode)->pluck('id');
                $q->orWhereIn('order_group_id', $orderGroup);
            });
        }

        if ($request->delivery_status != null) {
            $deliveryStatus = $request->delivery_status;
            $orders = $orders->where('delivery_status', $deliveryStatus);
        }

        if ($request->payment_status != null) {
            $paymentStatus = $request->payment_status;
            $orders = $orders->where('payment_status', $paymentStatus);
        }

        if ($request->location_id != null) {
            $locationId = $request->location_id;
            $orders = $orders->where('location_id', $locationId);
        }


        if ($request->is_pos_order != null) {
            $posOrder = $request->is_pos_order;
        }

        $orders = $orders->where(function ($q) use ($posOrder) {
            $orderGroup = OrderGroup::where('is_pos_order', $posOrder)->pluck('id');
            $q->orWhereIn('order_group_id', $orderGroup);
        });

        $orders = $orders->paginate(paginationNumber());
        $locations = Location::where('is_published', 1)->latest()->get();
        return view('backend.pages.orders.index', compact('orders', 'searchKey', 'locations', 'locationId', 'searchCode', 'deliveryStatus', 'paymentStatus', 'posOrder'));
    }

    # show order details
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $deliverymen = User::where('is_active', 1)->where('user_type', 'deliveryman')->where('location_id', $order->orderGroup->location_id)->latest()->get();
        return view('backend.pages.orders.show', compact('order', 'deliverymen'));
    }

    # assign deliveryman
    public function assignDeliveryman(Request $request)
    {
        $order = Order::findOrFail((int)$request->order_id);
        $order->deliveryman_id = $request->deliveryman_id ?? null;
        $order->save();

        $deliveryman = User::whereId($order->deliveryman_id)->first();

        OrderUpdate::create([
            'order_id' => $order->id,
            'user_id' => auth()->user()->id,
            'note' =>  $deliveryman != null ? $deliveryman->name . ' has been assigned for delivery.' : 'Deliveryman has been removed.',
        ]);

        $deliveryman->notify(new DeliverymanAssignNotification($order));

        return true;
    }
    # update payment status
    public function updatePaymentStatus(Request $request)
    {
        $order = Order::findOrFail((int)$request->order_id);
        $oldStatus = $order->payment_status;
        $newStatus = $request->status;

        $order->payment_status = $newStatus;
        $order->save();

        // IMPORTANT: Also update the OrderGroup payment_status to keep them synchronized
        // This ensures the frontend invoice shows the correct payment status
        $orderGroup = $order->orderGroup;
        if ($orderGroup) {
            $orderGroup->payment_status = $newStatus;
            $orderGroup->save();
        }

        OrderUpdate::create([
            'order_id' => $order->id,
            'user_id' => auth()->user()->id,
            'note' => 'Payment status updated to ' . ucwords(str_replace('_', ' ', $newStatus)) . '.',
        ]);

        // Send email notification to customer if status changed
        if ($oldStatus !== $newStatus) {
            $this->sendPaymentStatusEmail($order, $oldStatus, $newStatus);
        }

        return true;
    }

    # update delivery status
    public function updateDeliveryStatus(Request $request)
    {
        $order = Order::findOrFail((int)$request->order_id);
        $oldStatus = $order->delivery_status;
        $newStatus = $request->status;

        if ($oldStatus != orderCancelledStatus() && $newStatus == orderCancelledStatus()) {
            $this->addQtyToStock($order);
        }

        if ($oldStatus == orderCancelledStatus() && $newStatus != orderCancelledStatus()) {
            $this->removeQtyFromStock($order);
        }

        $order->delivery_status = $newStatus;
        $order->save();

        OrderUpdate::create([
            'order_id' => $order->id,
            'user_id' => auth()->user()->id,
            'note' => 'Delivery status updated to ' . ucwords(str_replace('_', ' ', $newStatus)) . '.',
        ]);

        // Send email notification to customer if status changed
        if ($oldStatus !== $newStatus) {
            $this->sendDeliveryStatusEmail($order, $oldStatus, $newStatus);
        }

        return true;
    }

    # add qty to stock
    private function addQtyToStock($order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItems as $orderItem) {
            $stock = $orderItem->product_variation->product_variation_stock;
            $stock->stock_qty += $orderItem->qty;
            $stock->save();

            $product = $orderItem->product_variation->product;
            $product->total_sale_count += $orderItem->qty;
            $product->save();

            if ($product->categories()->count() > 0) {
                foreach ($product->categories as $category) {
                    $category->total_sale_count += $orderItem->qty;
                    $category->save();
                }
            }
        }
    }

    # remove qty from stock
    private function removeQtyFromStock($order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItems as $orderItem) {
            $stock = $orderItem->product_variation->product_variation_stock;
            $stock->stock_qty -= $orderItem->qty;
            $stock->save();

            $product = $orderItem->product_variation->product;
            $product->total_sale_count -= $orderItem->qty;
            $product->save();

            if ($product->categories()->count() > 0) {
                foreach ($product->categories as $category) {
                    $category->total_sale_count -= $orderItem->qty;
                    $category->save();
                }
            }
        }
    }

    # download invoice
    public function downloadInvoice($id)
    {
        try {
            // Increase memory limit and execution time for PDF generation
            ini_set('memory_limit', '1024M');
            ini_set('max_execution_time', 120);

            // Set timeout for external requests (like images)
            ini_set('default_socket_timeout', 30);

            $data = $this->invoiceData($id);

            // Add error checking for required data
            if (!$data || !isset($data['order']) || !$data['order']) {
                throw new \Exception('Order data not found');
            }

            // Configure DomPDF options for better performance
            $pdf = DomPDF::loadView('backend.pages.orders.invoice-simple', $data);
            $pdf->setPaper('A4', 'portrait');

            // Set DomPDF options to handle images better
            $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);
            $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);

            $filename = getSetting('order_code_prefix') . $data['orderCode'] . '.pdf';

            return $pdf->download($filename);

        } catch (\Exception $e) {
            \Log::error('Invoice download failed: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile() . ' | Trace: ' . $e->getTraceAsString());
            flash(localize('Failed to generate invoice. Please try again.'))->error();
            return back();
        }
    }
    #print
    public function printInvoice($id)
    {
        try {
            // Increase memory limit and execution time for PDF generation
            ini_set('memory_limit', '1024M');
            ini_set('max_execution_time', 120);

            // Set timeout for external requests (like images)
            ini_set('default_socket_timeout', 30);

            $data = $this->invoiceData($id);

            // Add error checking for required data
            if (!$data || !isset($data['order']) || !$data['order']) {
                throw new \Exception('Order data not found');
            }

            // Configure DomPDF options for better performance
            $pdf = DomPDF::loadView('backend.pages.orders.invoice-simple', $data);
            $pdf->setPaper('A4', 'portrait');

            // Set DomPDF options to handle images better
            $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);
            $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);

            $filename = getSetting('order_code_prefix') . $data['orderCode'] . '.pdf';

            return $pdf->stream($filename);

        } catch (\Exception $e) {
            \Log::error('Invoice print failed: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile() . ' | Trace: ' . $e->getTraceAsString());
            flash(localize('Failed to generate invoice. Please try again.'))->error();
            return back();
        }
    }

    # generate delivery slip
    public function generateDeliverySlip($id)
    {
        $order = Order::with(['orderGroup.shippingAddress.country', 'orderGroup.shippingAddress.state', 'orderGroup.shippingAddress.city', 'orderGroup.billingAddress.country', 'orderGroup.billingAddress.state', 'orderGroup.billingAddress.city', 'orderItems.product_variation.product', 'user'])->findOrFail($id);
        $orderGroup = $order->orderGroup;
        $orderItems = $order->orderItems;

        $data = [
            'order' => $order,
            'orderGroup' => $orderGroup,
            'orderItems' => $orderItems,
            'orderCode' => $orderGroup->order_code,
            'shippingAddress' => $orderGroup->shippingAddress,
            'billingAddress' => $orderGroup->billingAddress,
        ];

        // Compact format for delivery slip (80mm x 90mm - ultra compact for 4 items)
        $pdf = PDF::loadView('backend.pages.orders.delivery-slip', $data, [], [
            'format' => [80, 90], // Ultra compact height for 4 items
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 2,
            'margin_bottom' => 2,
        ]);

        return $pdf->stream('delivery-slip-' . getSetting('order_code_prefix') . $orderGroup->order_code . '.pdf');
    }

    # download delivery slip
    public function downloadDeliverySlip($id)
    {
        $order = Order::with(['orderGroup.shippingAddress.country', 'orderGroup.shippingAddress.state', 'orderGroup.shippingAddress.city', 'orderGroup.billingAddress.country', 'orderGroup.billingAddress.state', 'orderGroup.billingAddress.city', 'orderItems.product_variation.product', 'user'])->findOrFail($id);
        $orderGroup = $order->orderGroup;
        $orderItems = $order->orderItems;

        $data = [
            'order' => $order,
            'orderGroup' => $orderGroup,
            'orderItems' => $orderItems,
            'orderCode' => $orderGroup->order_code,
            'shippingAddress' => $orderGroup->shippingAddress,
            'billingAddress' => $orderGroup->billingAddress,
        ];

        // Compact format for delivery slip (80mm x 90mm - ultra compact for 4 items)
        $pdf = PDF::loadView('backend.pages.orders.delivery-slip', $data, [], [
            'format' => [80, 90], // Ultra compact height for 4 items
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 2,
            'margin_bottom' => 2,
        ]);

        return $pdf->download('delivery-slip-' . getSetting('order_code_prefix') . $orderGroup->order_code . '.pdf');
    }

    #invoice data
    public function invoiceData($order_id):array
    {
        $data = [];
        if (session()->has('locale')) {
            $language_code = session()->get('locale', Config::get('app.locale'));
        } else {
            $language_code = env('DEFAULT_LANGUAGE');
        }

        if (session()->has('currency_code')) {
            $currency_code = session()->get('currency_code', Config::get('app.currency_code'));
        } else {
            $currency_code = env('DEFAULT_CURRENCY');
        }

        $language = Language::where('code', $language_code)->first();
        if ($language && $language->is_rtl == 1) {
            $data['direction'] = 'rtl';
            $data['default_text_align'] = 'right';
            $data['reverse_text_align'] = 'left';
        } else {
            $data['direction'] = 'ltr';
            $data['default_text_align'] = 'left';
            $data['reverse_text_align'] = 'right';
        }

        $currency_code = env('INVOICE_LANG');

        $data['font_family'] = env('INVOICE_FONT');

        $selected_language = Language::where('code', $language_code)->first();

        if($selected_language && $selected_language->font){
            $data['font_family'] = $selected_language->font;
        }else{
            $data['font_family'] = "THSarabunNew.ttf";
        }

        // if ($currency_code == 'BDT' || $currency_code == 'bdt' || $language_code == 'bd' || $language_code == 'bn') {
        //     # bengali font
        //     $data['font_family'] = "'Hind Siliguri','sans-serif'";
        // } elseif ($currency_code == 'KHR' || $language_code == 'kh') {
        //     # khmer font
        //     $data['font_family'] = "'Khmeros','sans-serif'";

        // } elseif ($language_code == 'ar-sa') {

        //     dd($language_code);
        //     # Armenia font
        //     $data['font_family'] = "'Janna LT Bold','sans-serif'";
        //     $data['font_name'] = "'Janna LT Bold','sans-serif'";

        // } elseif ($currency_code == 'AMD') {
        //     # Armenia font
        //     $data['font_family'] = "'Janna LT Bold.ttf','sans-serif'";
        // } elseif ($currency_code == 'AED' || $currency_code == 'EGP' || $language_code == 'sa' || $currency_code == 'IQD' || $language_code == 'ir') {
        //     # middle east/arabic font
        //     $data['font_family'] = "'XBRiyaz','sans-serif'";
        // } else {
        //     # general for all
        //     $data['font_family'] = "'Roboto','sans-serif'";
        // }

        $data['order'] = Order::with([
            'orderGroup',
            'orderItems.product_variation.productWithTrashed',
            'user'
        ])->findOrFail((int)$order_id);
        $data['orderCode'] =  $data['order']->orderGroup->order_code;


        return $data;
    }

    /**
     * Send payment status email notification to customer
     */
    private function sendPaymentStatusEmail($order, $oldStatus, $newStatus)
    {
        try {
            // Get customer info
            $customerInfo = $order->orderGroup->getCustomerInfo();

            // Skip if no customer email
            if (empty($customerInfo['email'])) {
                return;
            }

            // Create a temporary user object for notification
            $customer = new User();
            $customer->email = $customerInfo['email'];
            $customer->name = $customerInfo['name'] ?? 'Valued Customer';

            // Send notification
            $customer->notify(new OrderPaymentStatusNotification($order, $oldStatus, $newStatus));

        } catch (\Exception $e) {
            \Log::error('Failed to send payment status email: ' . $e->getMessage());
        }
    }

    /**
     * Send delivery status email notification to customer
     */
    private function sendDeliveryStatusEmail($order, $oldStatus, $newStatus)
    {
        try {
            // Get customer info
            $customerInfo = $order->orderGroup->getCustomerInfo();

            // Skip if no customer email
            if (empty($customerInfo['email'])) {
                return;
            }

            // Create a temporary user object for notification
            $customer = new User();
            $customer->email = $customerInfo['email'];
            $customer->name = $customerInfo['name'] ?? 'Valued Customer';

            // Send notification
            $customer->notify(new OrderDeliveryStatusNotification($order, $oldStatus, $newStatus));

        } catch (\Exception $e) {
            \Log::error('Failed to send delivery status email: ' . $e->getMessage());
        }
    }
}
