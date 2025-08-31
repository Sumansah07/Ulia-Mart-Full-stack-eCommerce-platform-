<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Currency;
use App\Models\OrderItem;
use App\Models\OrderGroup;
use App\Models\CouponUsage;
use App\Models\RewardPoint;
use App\Models\LogisticZone;
use Illuminate\Http\Request;
use App\Models\LogisticZoneCity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Models\ScheduledDeliveryTimeList;
use Illuminate\Support\Facades\Notification;

use App\Notifications\OrderPlacedNotification;
use App\Notifications\OrderPaymentStatusNotification;
use App\Http\Controllers\Backend\Payments\PaymentsController;
use Modules\PaymentGateway\Http\Services\PaymentGatewayService;

class CheckoutController extends Controller
{
    # checkout
    public function index()
    {
        $user = auth()->user();
        $carts = collect();
        $addresses = collect();

        if ($user) {
            $carts = Cart::where('user_id', $user->id)
                ->where('location_id', session('stock_location_id'))
                ->with(['product_variation.product.categories', 'product_variation.product_variation_stock'])
                ->get();
            $addresses = $user->addresses()->latest()->get();
        } else {
            // For guests, get cart from DB using guest_user_id cookie
            $guestId = isset($_COOKIE['guest_user_id']) ? (int)$_COOKIE['guest_user_id'] : null;
            $carts = $guestId ? Cart::where('guest_user_id', $guestId)
                ->where('location_id', session('stock_location_id'))
                ->with(['product_variation.product.categories', 'product_variation.product_variation_stock'])
                ->get() : collect();
        }

        if ($carts && count($carts) > 0) {
            checkCouponValidityForCheckout($carts);
        }

        $countries = Country::isActive()->get();
        $activeGateways = null;
        if(isModuleActive('PaymentGateway')) {
            $activeGateways = \Modules\PaymentGateway\Entities\PaymentGateway::where('is_active', 1)->where('gateway', '!=', 'Cash_on_Delivery')->isActive()->get();
        }
        return view('frontend.default.pages.checkout.checkout', [
            'carts'          => $carts,
            'user'           => $user,
            'addresses'      => $addresses,
            'countries'      => $countries,
            'activeGateways' => $activeGateways
        ]);
    }

    # checkout logistic
    public function getLogistic(Request $request)
    {
        $logisticZoneCities = LogisticZoneCity::where('city_id', $request->city_id)->distinct('logistic_id')->get();

        // Get carts for both authenticated and guest users
        $carts = collect();
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->where('location_id', session('stock_location_id'))->get();
        } else {
            $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
            $carts = Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->get();
        }

        return [
            'logistics' => getRender('inc.logistics', ['logisticZoneCities' => $logisticZoneCities]),
            'summary'   => getRender('pages.partials.checkout.orderSummary', ['carts' => $carts])
        ];
    }

    # checkout shipping amount
    public function getShippingAmount(Request $request)
    {
        // Get carts for both authenticated and guest users
        $carts = collect();
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->where('location_id', session('stock_location_id'))->get();
        } else {
            $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
            $carts = Cart::where('guest_user_id', $guestUserId)->where('location_id', session('stock_location_id'))->get();
        }

        $logisticZone       = LogisticZone::find((int)$request->logistic_zone_id);
        $shippingAmount     = $logisticZone->standard_delivery_charge;
        return getRender('pages.partials.checkout.orderSummary', ['carts' => $carts, 'shippingAmount' => $shippingAmount]);
    }

    # complete checkout process
    public function complete(Request $request)
    {
        $user = auth()->user();
        $userId = $user ? $user->id : null;
        $carts = $userId
            ? Cart::where('user_id', $userId)->where('location_id', session('stock_location_id'))->get()
            : (isset($_COOKIE['guest_user_id']) ? Cart::where('guest_user_id', (int)$_COOKIE['guest_user_id'])->where('location_id', session('stock_location_id'))->get() : collect());
        $cartIds = [];

        try {
            DB::beginTransaction();
            if (count($carts) > 0) {
                // Validate for logged-in or guest
                if ($userId) {
                    // Handle billing same as shipping logic
                    if ($request->has('billing_same_as_shipping') || $request->get('billing_same_as_shipping') == '1') {
                        $shippingId = $request->get('shipping_address_id');
                        $request->merge(['billing_address_id' => $shippingId]);
                    }

                    // Fallback: If billing is still empty, use shipping
                    if (empty($request->billing_address_id)) {
                        $request->merge(['billing_address_id' => $request->shipping_address_id]);
                    }

                    // Validation
                    $request->validate([
                        'shipping_address_id' => 'required|integer|exists:user_addresses,id',
                        'phone' => 'required|string|max:20',
                    ]);
                } else {
                    // Guest validation - billing fields are always populated (either manually or auto-filled)
                    $request->validate([
                        'guest_shipping_name' => 'required|string|max:255',
                        'guest_shipping_phone' => 'required|string|max:20',
                        'guest_shipping_email' => 'required|email|max:255',
                        'guest_shipping_address' => 'required|string|max:500',
                        'guest_shipping_city' => 'required|string|max:100',
                        'guest_billing_name' => 'required|string|max:255',
                        'guest_billing_phone' => 'required|string|max:20',
                        'guest_billing_email' => 'required|email|max:255',
                        'guest_billing_address' => 'required|string|max:500',
                        'guest_billing_city' => 'required|string|max:100',
                        'guest_contact_phone' => 'nullable|string|max:20',
                        'guest_contact_alternative_phone' => 'nullable|string|max:20',
                    ]);

                    // Note: If "same as shipping" was checked, the frontend already populated
                    // the billing fields with shipping data, so no need to handle it here

                    // Unset shipping_address_id if present
                    unset($request['shipping_address_id']);
                }

                # check if coupon applied -> validate coupon
                $couponResponse = checkCouponValidityForCheckout($carts);
                if ($couponResponse['status'] == false) {
                    flash($couponResponse['message'])->error();
                    return back();
                }

                # check carts available stock -- todo::[update version] -> run this check while storing OrderItems
                foreach ($carts as $cart) {

                    $product = $cart->product_variation->product;

                    if ($product->max_purchase_qty >= $cart->qty && $cart->qty >= $product->min_purchase_qty) {
                        $productVariationStock = $cart->product_variation->product_variation_stock ? $cart->product_variation->product_variation_stock->stock_qty : 0;
                        if ($cart->qty > $productVariationStock) {
                            $message = $cart->product_variation->product->collectLocalization('name') . ' ' . localize('is out of stock');
                            flash($message)->error();
                            return back();
                        }
                    } else {
                        $message = localize('Minimum and maximum order quantity is ') . $product->min_purchase_qty . ' & ' . $product->max_purchase_qty . ' ' . localize('for this product: ') . $cart->product_variation->product->collectLocalization('name');

                        flash($message)->error();
                        return back();
                    }
                }

                $orderGroup = new OrderGroup;
                $orderGroup->user_id = $userId;
                if ($userId) {
                    $orderGroup->shipping_address_id = $request->shipping_address_id;
                    // If 'Same as Shipping' is selected, set billing_address_id = shipping_address_id
                    if ($request->has('billing_same_as_shipping')) {
                        $orderGroup->billing_address_id = $request->shipping_address_id;
                    } else {
                        $orderGroup->billing_address_id = $request->billing_address_id;
                    }
                    $orderGroup->phone_no = $request->phone;
                    $orderGroup->alternative_phone_no = $request->alternative_phone;
                } else {
                    $orderGroup->shipping_address_id = null;
                    $orderGroup->billing_address_id = null;
                    $orderGroup->guest_shipping_name = $request->guest_shipping_name;
                    $orderGroup->guest_shipping_phone = $request->guest_shipping_phone;
                    $orderGroup->guest_shipping_email = $request->guest_shipping_email;
                    $orderGroup->guest_shipping_address = $request->guest_shipping_address;
                    $orderGroup->guest_shipping_city = $request->guest_shipping_city;
                    $orderGroup->guest_billing_name = $request->guest_billing_name;
                    $orderGroup->guest_billing_phone = $request->guest_billing_phone;
                    $orderGroup->guest_billing_email = $request->guest_billing_email;
                    $orderGroup->guest_billing_address = $request->guest_billing_address;
                    $orderGroup->guest_billing_city = $request->guest_billing_city;

                    \Log::info('Saving guest email to database: ' . $request->guest_shipping_email);
                    $orderGroup->phone_no = $request->guest_contact_phone;
                    $orderGroup->alternative_phone_no = $request->guest_contact_alternative_phone;
                }
                $orderGroup->location_id = session('stock_location_id');
                $orderGroup->sub_total_amount = getSubTotal($carts, false, '', false);

                // CORRECTED TAX CALCULATION: Use new function that handles coupon discount properly
                $currentCoupon = getCoupon();
                $orderGroup->total_tax_amount = getTotalTaxWithCouponDiscount($carts, $currentCoupon);

                $orderGroup->total_coupon_discount_amount = 0;
                if (getCoupon() != '') {
                    # todo::[for eCommerce] handle coupon for multi vendor
                    $orderGroup->total_coupon_discount_amount = getCouponDiscountWithRestrictions($carts, getCoupon());
                    # [done->codes below] increase coupon usage counter after successful order
                }
                # Make logistics optional
                $orderGroup->total_shipping_cost = 0;
                if ($request->has('chosen_logistic_zone_id') && !empty($request->chosen_logistic_zone_id)) {
                    $logisticZone = LogisticZone::where('id', $request->chosen_logistic_zone_id)->first();
                    if ($logisticZone) {
                        # todo::[for eCommerce] handle exceptions for standard & express
                        $orderGroup->total_shipping_cost = $logisticZone->standard_delivery_charge;
                    }
                }

                // to convert input price to base price
                if (Session::has('currency_code')) {
                    $currency_code = Session::get('currency_code', Config::get('app.currency_code'));
                } else {
                    $currency_code = env('DEFAULT_CURRENCY');
                }
                $currentCurrency = getValidCurrency($currency_code);

                $orderGroup->total_tips_amount = $request->tips / $currentCurrency->rate; // convert to base price;

                $orderGroup->grand_total_amount = $orderGroup->sub_total_amount + $orderGroup->total_tax_amount + $orderGroup->total_shipping_cost + $orderGroup->total_tips_amount - $orderGroup->total_coupon_discount_amount;


                if ($request->payment_method == "wallet") {
                    $balance = (float) $user->user_balance;

                    if ($balance < $orderGroup->grand_total_amount) {
                        flash(localize("Your wallet balance is low"))->error();
                        return back();
                    }
                }
                $orderGroup->save();

                # order -> todo::[update version] make array for each vendor, create order in loop
                $order = new Order;
                $order->order_group_id  = $orderGroup->id;
                $order->shop_id         = $carts[0]['product_variation']['product']['shop_id'] ?? null;
                $order->user_id         = $userId;
                if (!$userId) {
                    // For guests, set guest_user_id
                    $order->guest_user_id = isset($_COOKIE['guest_user_id']) ? (int)$_COOKIE['guest_user_id'] : null;
                }
                $order->location_id     = session('stock_location_id');
                if (getCoupon() != '') {
                    $order->applied_coupon_code         = getCoupon();
                    $order->coupon_discount_amount      = $orderGroup->total_coupon_discount_amount; // todo::[update version] calculate for each vendors
                }
                $order->total_admin_earnings            = $orderGroup->grand_total_amount;

                // Initialize logistic variables
                $logisticZone = null;

                // Handle optional logistics
                if ($request->has('chosen_logistic_zone_id') && !empty($request->chosen_logistic_zone_id)) {
                    $logisticZone = LogisticZone::where('id', $request->chosen_logistic_zone_id)->first();
                    if ($logisticZone) {
                        $order->logistic_id = $logisticZone->logistic_id;
                        $order->logistic_name = optional($logisticZone->logistic)->name;
                    }
                }

                $order->shipping_delivery_type          = $request->shipping_delivery_type ?? 'standard';

                if ($request->shipping_delivery_type == getScheduledDeliveryType()) {
                    $timeSlot = ScheduledDeliveryTimeList::where('id', $request->timeslot)->first(['id', 'timeline']);
                    $timeSlot->scheduled_date = $request->scheduled_date;
                    $order->scheduled_delivery_info = json_encode($timeSlot);
                }

                $order->shipping_cost                   = $orderGroup->total_shipping_cost; // todo::[update version] calculate for each vendors
                $order->tips_amount                     = $orderGroup->total_tips_amount; // todo::[update version] calculate for each vendors

                $order->save();

                # order items
                $total_points = 0;
                foreach ($carts as $cart) {
                    $orderItem                       = new OrderItem;
                    $orderItem->order_id             = $order->id;
                    $orderItem->product_variation_id = $cart->product_variation_id;
                    $orderItem->qty                  = $cart->qty;
                    $orderItem->location_id          = session('stock_location_id');
                    $orderItem->unit_price           = variationDiscountedPrice($cart->product_variation->product, $cart->product_variation);
                    $orderItem->total_tax            = variationTaxAmount($cart->product_variation->product, $cart->product_variation);
                    $orderItem->total_price          = $orderItem->unit_price * $orderItem->qty;
                    $orderItem->save();

                    $product = $cart->product_variation->product;
                    $product->total_sale_count += $orderItem->qty;

                    # reward points
                    if (getSetting('enable_reward_points') == 1) {
                        $orderItem->reward_points = $product->reward_points * $orderItem->qty;
                        $total_points += $orderItem->reward_points;
                    }

                    // minus stock qty
                    try {
                        $productVariationStock = $cart->product_variation->product_variation_stock;
                        $productVariationStock->stock_qty -= $orderItem->qty;
                        $productVariationStock->save();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        flash(localize($th->getMessage()))->error();
                        return back();
                    }
                    $product->stock_qty -= $orderItem->qty;
                    $product->save();



                    # category sales count
                    if ($product->categories()->count() > 0) {
                        foreach ($product->categories as $category) {
                            $category->total_sale_count += $orderItem->qty;
                            $category->save();
                        }
                    }

                    $cartIds[] = $cart->id;

                }

                # reward points (only for logged-in users)
                if (getSetting('enable_reward_points') == 1 && $userId) {
                    $reward = new RewardPoint;
                    $reward->user_id = $userId;
                    $reward->order_group_id = $orderGroup->id;
                    $reward->total_points = $total_points;
                    $reward->status = "pending";
                    $reward->save();
                }

                $order->reward_points = $total_points;
                $order->save();

                # increase coupon usage - ONLY for non-online payments (COD, wallet, FonePay QR)
                # For online payments, this will be handled in createOrderFromSession after payment success
                $isOnlinePayment = ($request->payment_method != "cod" && $request->payment_method != "wallet" && $request->payment_method != "" && !($request->payment_method == "fonepay" && env('FONEPAY_USE_QR_MODE', false)));

                if (getCoupon() != '' && $orderGroup->total_coupon_discount_amount > 0 && !$isOnlinePayment) {
                    $coupon = Coupon::where('code', getCoupon())->first();
                    $coupon->total_usage_count += 1;
                    $coupon->save();

                    # coupon usage by user (only for logged-in users)
                    if ($userId) {
                        $couponUsageByUser = CouponUsage::where('user_id', $userId)->where('coupon_code', $coupon->code)->first();
                        if (!is_null($couponUsageByUser)) {
                            $couponUsageByUser->usage_count += 1;
                        } else {
                            $couponUsageByUser = new CouponUsage;
                            $couponUsageByUser->usage_count = 1;
                            $couponUsageByUser->coupon_code = getCoupon();
                            $couponUsageByUser->user_id = $userId;
                        }
                        $couponUsageByUser->save();
                    }
                    removeCoupon();
                }

                # payment gateway integration & redirection

                $orderGroup->payment_method = $request->payment_method;

                // Handle FonePay receipt upload in QR mode (OPTIONAL - no validation)
                if ($request->payment_method == "fonepay" && env('FONEPAY_USE_QR_MODE', false)) {
                    if ($request->hasFile('fonepay_receipt')) {
                        $receiptFile = $request->file('fonepay_receipt');

                        // Optional file validation - PDF ONLY for better clarity and security
                        $allowedMimes = ['application/pdf'];
                        if (in_array($receiptFile->getMimeType(), $allowedMimes) && $receiptFile->getSize() <= 5 * 1024 * 1024) {
                            // Store the receipt file only if valid
                            $receiptPath = $receiptFile->store('payment_receipts', 'public');
                            $orderGroup->payment_receipt = $receiptPath;
                            $orderGroup->payment_status = paidPaymentStatus(); // Set to paid since customer has paid and uploaded receipt
                            $orderGroup->payment_details = json_encode([
                                'payment_method' => 'FonePay QR',
                                'receipt_uploaded' => true,
                                'receipt_filename' => $receiptFile->getClientOriginalName(),
                                'upload_time' => now()->toDateTimeString()
                            ]);
                        }
                    }
                    // NO VALIDATION ERROR - Allow order to proceed without receipt
                }

                $orderGroup->save();

                if ($request->payment_method != "cod" && $request->payment_method != "wallet" && $request->payment_method != "" && !($request->payment_method == "fonepay" && env('FONEPAY_USE_QR_MODE', false))) {
                    // For online payments, DON'T save order to database yet
                    // Store order data in session for creation after payment success
                    $request->session()->put('payment_type', 'order_payment');
                    $request->session()->put('order_code', $orderGroup->order_code);
                    $request->session()->put('payment_method', $request->payment_method);

                    // Store all order data in session
                    $orderItems = [];
                    foreach ($carts as $cart) {
                        $orderItems[] = [
                            'product_variation_id' => $cart->product_variation_id,
                            'qty' => $cart->qty,
                            'unit_price' => variationDiscountedPrice($cart->product_variation->product, $cart->product_variation),
                            'total_tax' => variationTaxAmount($cart->product_variation->product, $cart->product_variation),
                            'total_price' => variationDiscountedPrice($cart->product_variation->product, $cart->product_variation) * $cart->qty,
                        ];
                    }

                    $request->session()->put('pending_order_data', [
                        'orderGroup' => $orderGroup->toArray(),
                        'order' => $order->toArray(),
                        'orderItems' => $orderItems,
                        'cartIds' => $cartIds ?? [],
                        'carts' => $carts->toArray(),
                        'coupon_code' => getCoupon(), // Store coupon code
                        'coupon_discount' => $orderGroup->total_coupon_discount_amount // Store coupon discount
                    ]);

                    // Store the amount separately for payment gateways
                    $request->session()->put('payment_amount', $orderGroup->grand_total_amount);



                    // ROLLBACK - don't save order until payment succeeds
                    DB::rollBack();

                    # init payment
                    $payment = new PaymentsController;
                    return $payment->initPayment();
                } else if ($request->payment_method == "wallet") {
                    $orderGroup->payment_status = paidPaymentStatus();
                    $orderGroup->order->update(['payment_status' => paidPaymentStatus()]); # for multi-vendor loop through each orders & update
                    $orderGroup->save();

                    $user->user_balance -= $orderGroup->grand_total_amount;
                    $user->save();
                } else if ($request->payment_method == "fonepay" && env('FONEPAY_USE_QR_MODE', false)) {
                    // FonePay QR mode - order is already saved with receipt, set to paid since customer has paid
                    $orderGroup->order->update(['payment_status' => paidPaymentStatus()]); # Set to paid since customer has paid and uploaded receipt
                }
                if(!empty($cartIds)) {
                    if ($userId) {
                        // For logged-in users
                        $carts = Cart::where('user_id', $userId)->whereIn('id', $cartIds)->delete();
                    } else {
                        // For guests
                        $guestId = isset($_COOKIE['guest_user_id']) ? (int)$_COOKIE['guest_user_id'] : null;
                        if ($guestId) {
                            $carts = Cart::where('guest_user_id', $guestId)->whereIn('id', $cartIds)->delete();
                        }
                    }
                }
                DB::commit();
                flash(localize('Your order has been placed successfully'))->success();
                return redirect()->route('checkout.success', $orderGroup->order_code);
            }
            DB::commit();
        } catch (\Throwable $th) {
            Log::info('checkout issue :' . $th->getMessage());
            DB::rollBack();
            flash($th->getMessage())->error();
            return back();
        }
        flash(localize('Your cart is empty'))->error();
        return back();
    }

    # order successful
    public function success($code)
    {
        $user = auth()->user();

        if ($user) {
            // For logged-in users
            $orderGroup = OrderGroup::where('user_id', $user->id)->where('order_code', $code)->first();
        } else {
            // For guests
            $orderGroup = OrderGroup::where('user_id', null)->where('order_code', $code)->first();
        }

        // Send notification for both logged-in users and guests
        if ($orderGroup) {
            try {
                if ($user) {
                    // For logged-in users
                    \Log::info('Sending email notification to logged-in user: ' . $user->email);
                    Notification::send($user, new OrderPlacedNotification($orderGroup->order));
                } else {
                    // For guests, create a temporary user object for notification
                    $customerInfo = $orderGroup->getCustomerInfo();
                    \Log::info('Guest customer info for email notification: ', $customerInfo);
                    \Log::info('OrderGroup guest fields - shipping_email: ' . ($orderGroup->guest_shipping_email ?? 'NULL') . ', billing_email: ' . ($orderGroup->guest_billing_email ?? 'NULL'));

                    if (!empty($customerInfo['email'])) {
                        $guestUser = new \App\Models\User();
                        $guestUser->email = $customerInfo['email'];
                        $guestUser->name = $customerInfo['name'] ?? 'Valued Customer';

                        \Log::info('Sending email notification to guest: ' . $customerInfo['email']);
                        Notification::send($guestUser, new OrderPlacedNotification($orderGroup->order));
                        \Log::info('Guest email notification sent successfully');
                    } else {
                        \Log::warning('No email found for guest customer notification. OrderGroup ID: ' . $orderGroup->id);
                        \Log::warning('Guest shipping email: ' . ($orderGroup->guest_shipping_email ?? 'NULL'));
                        \Log::warning('Guest billing email: ' . ($orderGroup->guest_billing_email ?? 'NULL'));
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send order placed notification: ' . $e->getMessage());
                \Log::error('Exception trace: ' . $e->getTraceAsString());
            }
        }

        return view('frontend.default.pages.checkout.order_success', ['orderGroup' => $orderGroup]);
    }


    # order invoice
    public function invoice($code)
    {
        $user = auth()->user();

        if ($user) {
            // For logged-in users
            $orderGroup = OrderGroup::where('user_id', $user->id)->where('order_code', $code)->first();
        } else {
            // For guests
            $orderGroup = OrderGroup::where('user_id', null)->where('order_code', $code)->first();
        }

        return view('frontend.default.pages.checkout.invoice', ['orderGroup' => $orderGroup]);
    }

    # handle checkout complete (for payment gateway redirects)
    public function handleCheckoutComplete(Request $request)
    {
        // Check if we have an order code in session
        if (session('order_code')) {
            $orderCode = session('order_code');

            // Clear the session data
            clearOrderSession();

            // Redirect to success page
            return redirect()->route('checkout.success', $orderCode);
        }

        // If no order code, redirect to home with error
        flash(localize('Order not found'))->error();
        return redirect()->route('home');
    }

    # update payment status
    public function updatePayments($payment_details)
    {
        // Check if we have pending order data in session (for online payments)
        if (session('pending_order_data')) {
            return $this->createOrderFromSession($payment_details);
        }

        // For existing orders (wallet, COD, etc.)
        $orderGroup = OrderGroup::where('order_code', session('order_code'))->first();
        $payment_method = session('payment_method');

        $oldPaymentStatus = $orderGroup->payment_status;
        $newPaymentStatus = paidPaymentStatus();

        $orderGroup->payment_status = $newPaymentStatus;
        $orderGroup->order->update(['payment_status' => $newPaymentStatus]); # for multi-vendor loop through each orders & update

        $orderGroup->payment_method = $payment_method;
        $orderGroup->payment_details = $payment_details;
        $orderGroup->save();

        // Send email notification if payment status changed
        if ($oldPaymentStatus !== $newPaymentStatus) {
            $this->sendPaymentStatusEmail($orderGroup->order, $oldPaymentStatus, $newPaymentStatus);
        }

        // cart empty
        if (auth()->check()) {
            Cart::where('user_id', auth()->user()->id)->delete();
        } else {
            $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
            Cart::where('guest_user_id', $guestUserId)->delete();
        }

        clearOrderSession();
        flash(localize('Your order has been placed successfully'))->success();
        return redirect()->route('checkout.success', $orderGroup->order_code);
    }

    # create order from session data after successful payment
    private function createOrderFromSession($payment_details)
    {
        $pendingData = session('pending_order_data');
        if (!$pendingData) {
            flash(localize('Order data not found'))->error();
            return redirect()->route('checkout.proceed');
        }

        try {
            DB::beginTransaction();

            // Create OrderGroup
            $orderGroup = new OrderGroup();
            $orderGroup->fill($pendingData['orderGroup']);
            $orderGroup->payment_status = paidPaymentStatus();
            $orderGroup->payment_method = session('payment_method');
            $orderGroup->payment_details = $payment_details;
            $orderGroup->save();

            // Create Order
            $order = new Order();
            $order->fill($pendingData['order']);
            $order->order_group_id = $orderGroup->id;
            $oldPaymentStatus = $pendingData['order']['payment_status'] ?? 'unpaid';
            $newPaymentStatus = paidPaymentStatus();
            $order->payment_status = $newPaymentStatus;
            $order->save();

            // Send email notification for payment status change
            if ($oldPaymentStatus !== $newPaymentStatus) {
                $this->sendPaymentStatusEmail($order, $oldPaymentStatus, $newPaymentStatus);
            }

            // Handle coupon usage if coupon was applied
            if (!empty($pendingData['coupon_code']) && $pendingData['coupon_discount'] > 0) {
                $coupon = Coupon::where('code', $pendingData['coupon_code'])->first();
                if ($coupon) {
                    // Increase coupon usage
                    $coupon->total_usage_count += 1;
                    $coupon->save();

                    // Coupon usage by user (only for authenticated users)
                    if (auth()->check()) {
                        $couponUsageByUser = CouponUsage::where('user_id', auth()->user()->id)->where('coupon_code', $coupon->code)->first();
                        if (!is_null($couponUsageByUser)) {
                            $couponUsageByUser->usage_count += 1;
                        } else {
                            $couponUsageByUser = new CouponUsage;
                            $couponUsageByUser->usage_count = 1;
                            $couponUsageByUser->coupon_code = $pendingData['coupon_code'];
                            $couponUsageByUser->user_id = auth()->user()->id;
                        }
                        $couponUsageByUser->save();
                    }

                    // Remove coupon from session after successful payment and usage tracking
                    removeCoupon();
                }
            }

            // Create OrderItems
            foreach ($pendingData['orderItems'] as $itemData) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_variation_id = $itemData['product_variation_id'];
                $orderItem->qty = $itemData['qty'];
                $orderItem->location_id = session('stock_location_id');
                $orderItem->unit_price = $itemData['unit_price'];
                $orderItem->total_tax = $itemData['total_tax'];
                $orderItem->total_price = $itemData['total_price'];
                $orderItem->save();

                // Update product sales count
                $product = $orderItem->product_variation->product;
                $product->total_sale_count += $orderItem->qty;
                $product->save();
            }

            // Clear cart
            if (auth()->check()) {
                if (!empty($pendingData['cartIds'])) {
                    Cart::where('user_id', auth()->user()->id)->whereIn('id', $pendingData['cartIds'])->delete();
                } else {
                    Cart::where('user_id', auth()->user()->id)->delete();
                }
            } else {
                $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
                if (!empty($pendingData['cartIds'])) {
                    Cart::where('guest_user_id', $guestUserId)->whereIn('id', $pendingData['cartIds'])->delete();
                } else {
                    Cart::where('guest_user_id', $guestUserId)->delete();
                }
            }

            DB::commit();

            // Clear session data
            session()->forget('pending_order_data');
            session()->forget('payment_amount');
            clearOrderSession();

            flash(localize('Your order has been placed successfully'))->success();
            return redirect()->route('checkout.success', $orderGroup->order_code);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create order from session: ' . $e->getMessage());
            flash(localize('Failed to create order. Please try again.'))->error();
            return redirect()->route('checkout.proceed');
        }
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
            $customer = new \App\Models\User();
            $customer->email = $customerInfo['email'];
            $customer->name = $customerInfo['name'] ?? 'Valued Customer';

            // Send notification
            $customer->notify(new OrderPaymentStatusNotification($order, $oldStatus, $newStatus));

        } catch (\Exception $e) {
            \Log::error('Failed to send payment status email: ' . $e->getMessage());
        }
    }
}
