<?php

namespace App\Http\Controllers\Backend\Payments\IMEPay;

use App\Http\Controllers\Backend\Payments\PaymentsController;
use App\Http\Controllers\Controller;
use App\Models\OrderGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class IMEPayController extends Controller
{
    # init payment
    public function initPayment()
    {
        $user = auth()->user();
        $payment_type = session('payment_type');

        switch ($payment_type) {
            case 'order_payment':
                $title = localize('Order Payment');
                // Try to get amount from session first (new flow), then from database (old flow)
                $amount = session('payment_amount');
                if (!$amount) {
                    $orderGroup = OrderGroup::where('order_code', session('order_code'))->first();
                    $amount = $orderGroup ? $orderGroup->grand_total_amount : 0;
                }
                break;
            default:
                $title = '';
                $amount = 0;
        }

        if ($amount <= 0) {
            return (new PaymentsController)->payment_failed();
        }

        // IMEPay/FonePay integration
        try {
            $merchantCode = env('IMEPAY_MERCHANT_CODE', 'MERCHANT_CODE');
            $username = env('IMEPAY_USERNAME', 'username');
            $password = env('IMEPAY_PASSWORD', 'password');
            $module = env('IMEPAY_MODULE', 'FONEPAY');

            // Convert amount to paisa (multiply by 100)
            $amountInPaisa = $amount * 100;

            // Generate unique reference ID
            $referenceId = 'ORDER_' . session('order_code') . '_' . time();

            // Prepare payment data
            $paymentData = [
                'merchantCode' => $merchantCode,
                'amount' => $amountInPaisa,
                'referenceId' => $referenceId,
                'particulars' => $title,
                'username' => $username,
                'password' => $password,
                'module' => $module,
                'successUrl' => route('imepay.success'),
                'failureUrl' => route('imepay.failed'),
            ];

            // Store reference ID in session for later verification
            session(['imepay_reference_id' => $referenceId]);

            return view('payments.imepay', compact('paymentData'));

        } catch (\Exception $e) {
            Log::error('IMEPay payment initialization failed: ' . $e->getMessage());
            return (new PaymentsController)->payment_failed();
        }
    }

    # success callback
    public function success(Request $request)
    {
        try {
            // Verify the payment response
            $referenceId = $request->input('referenceId');
            $transactionId = $request->input('transactionId');
            $amount = $request->input('amount');

            // Verify with stored reference ID
            if ($referenceId !== session('imepay_reference_id')) {
                Log::error('IMEPay reference ID mismatch');
                return (new PaymentsController)->payment_failed();
            }

            // Prepare payment details for storage
            $payment_details = [
                'transaction_id' => $transactionId,
                'reference_id' => $referenceId,
                'amount' => $amount,
                'payment_method' => 'IMEPay/FonePay',
                'status' => 'Success'
            ];

            // Clear session data
            session()->forget('imepay_reference_id');

            return (new PaymentsController)->payment_success(json_encode($payment_details));

        } catch (\Exception $e) {
            Log::error('IMEPay success callback failed: ' . $e->getMessage());
            return (new PaymentsController)->payment_failed();
        }
    }

    # failed callback
    public function failed(Request $request)
    {
        Log::info('IMEPay payment failed: ' . json_encode($request->all()));

        // Clear session data
        session()->forget('imepay_reference_id');

        return (new PaymentsController)->payment_failed();
    }
}
