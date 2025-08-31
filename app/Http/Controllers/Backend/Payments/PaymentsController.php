<?php

namespace App\Http\Controllers\Backend\Payments;

use App\Models\OrderGroup;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CheckoutController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Backend\Payments\IyZico\IyZicoController;
use App\Http\Controllers\Backend\Payments\Paypal\PaypalController;
use App\Http\Controllers\Backend\Payments\Razorpay\RazorpayController;
use App\Http\Controllers\Backend\Payments\Paytm\PaytmPaymentController;
use App\Http\Controllers\Backend\Payments\Stripe\StripePaymentController;
use App\Http\Controllers\Backend\Payments\IMEPay\IMEPayController;
use App\Http\Controllers\Backend\Payments\FonePay\FonePayController;

use Modules\PaymentGateway\Http\Controllers\Midtrans\MidtransController;
use Modules\PaymentGateway\Http\Controllers\Paystack\PaystackController;
use Modules\PaymentGateway\Http\Controllers\Duitku\DuitkuController;
use Modules\PaymentGateway\Http\Controllers\Molile\MolilePaymentController;
use Modules\PaymentGateway\Http\Controllers\Flutterwave\FlutterwaveController;
use Modules\PaymentGateway\Http\Controllers\Yookassa\YookassaPaymentController;
use Modules\PaymentGateway\Http\Controllers\Mercadopago\MercadopagoPaymentController;

class PaymentsController extends Controller
{
    # init payment gateway
    public function initPayment()
    {
        $payment_method = session('payment_method');

        if ($payment_method == 'paypal') {
            return (new PaypalController())->initPayment();
        } else if ($payment_method == 'stripe') {
            return (new StripePaymentController())->initPayment();
        } else if ($payment_method == 'paytm') {
            return (new PaytmPaymentController())->initPayment();
        } else if ($payment_method == 'razorpay') {
            return (new RazorpayController())->initPayment();
        } else if ($payment_method == 'iyzico') {
            return (new IyZicoController)->initPayment();
        }else if ($payment_method == 'paystack') {
            return (new PaystackController)->initPayment();
        } else if ($payment_method == 'flutterwave') {
            return (new FlutterwaveController)->initPayment();
        } else if ($payment_method == 'duitku') {
            return (new DuitkuController)->initPayment();
        } else if ($payment_method == 'yookassa') {
            return (new YookassaPaymentController)->initPayment();
        } else if ($payment_method == 'molile') {
            return (new MolilePaymentController)->initPayment();
        } else if ($payment_method == 'mercadopago') {
            return (new MercadopagoPaymentController)->initPayment();
        } else if ($payment_method == 'midtrans') {
            return (new MidtransController)->initPayment();
        } else if ($payment_method == 'imepay') {
            return (new IMEPayController)->initPayment();
        } else if ($payment_method == 'fonepay') {
            return (new FonePayController)->initPayment();
        }

        # todo::[update versions] more gateways
    }

    # payment successful
    public function payment_success($payment_details = null)
    {
        if (session('payment_type') == 'order_payment') {
            return (new CheckoutController())->updatePayments(json_encode($payment_details));
        }
        # else - other payments [update versions]
    }

    # payment failed
    public function payment_failed()
    {
        if (session('payment_type') == 'order_payment') {
            // Log the payment failure
            Log::error('Payment failed for order: ' . session('order_code'), [
                'payment_method' => session('payment_method'),
                'user_id' => auth()->id(),
                'has_pending_data' => session('pending_order_data') ? 'yes' : 'no'
            ]);

            // Check if we have pending order data (new flow)
            if (session('pending_order_data')) {
                Log::info('Payment failed - clearing pending order data from session');
                session()->forget('pending_order_data');
                session()->forget('payment_amount');
            } else {
                // Old flow - check for existing order in database
                $orderGroup = OrderGroup::where('order_code', session('order_code'))->first();

                if ($orderGroup && $orderGroup->payment_status === 'unpaid') {
                    Log::info('Deleting unpaid order due to payment failure: ' . $orderGroup->order_code);

                    try {
                        # delete related records first to avoid foreign key constraints
                        if ($orderGroup->order) {
                            # delete order updates
                            $orderGroup->order->orderUpdates()->delete();

                            # delete order items
                            $orderGroup->order->orderItems()->delete();

                            # delete order
                            $orderGroup->order()->delete();
                        }
                        # delete order group
                        $orderGroup->delete();

                        Log::info('Order deleted successfully: ' . session('order_code'));
                    } catch (\Exception $e) {
                        Log::error('Failed to delete order: ' . $e->getMessage());
                    }
                } else if ($orderGroup) {
                    Log::warning('Order not deleted - payment status: ' . $orderGroup->payment_status);
                }
            }

            # clear session data
            clearOrderSession();

            # redirect with error message
            flash(localize('Payment failed. Please try again or choose a different payment method.'))->error();
            return redirect()->route('checkout.proceed');
        }

        # fallback for other payment types
        flash(localize('Payment failed, please try again'))->error();
        return redirect()->route('home');
    }
}
