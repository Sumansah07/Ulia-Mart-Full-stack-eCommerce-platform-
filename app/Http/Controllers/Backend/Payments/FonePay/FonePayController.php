<?php

namespace App\Http\Controllers\Backend\Payments\FonePay;

use App\Http\Controllers\Backend\Payments\PaymentsController;
use App\Http\Controllers\Controller;
use App\Models\OrderGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FonePayController extends Controller
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

        // FonePay integration
        try {
            $merchantCode = env('FONEPAY_MERCHANT_CODE', 'FONEPAY_MERCHANT_CODE');
            $username = env('FONEPAY_USERNAME', 'fonepay_username');
            $password = env('FONEPAY_PASSWORD', 'fonepay_password');
            $secretKey = env('FONEPAY_SECRET_KEY', 'fonepay_secret_key');
            $testMode = env('FONEPAY_TEST_MODE', true); // Test mode flag

            // Convert amount to paisa (multiply by 100)
            $amountInPaisa = $amount * 100;

            // Generate unique reference ID
            $referenceId = 'FONEPAY_' . session('order_code') . '_' . time();

            // TEST MODE: Simulate successful payment immediately
            if ($testMode) {
                Log::info('FonePay TEST MODE: Simulating successful payment', [
                    'order_code' => session('order_code'),
                    'amount' => $amount,
                    'reference_id' => $referenceId
                ]);

                // Simulate payment success after 3 seconds
                $payment_details = [
                    'transaction_id' => 'TEST_TXN_' . time(),
                    'reference_id' => $referenceId,
                    'amount' => $amountInPaisa,
                    'payment_method' => 'FonePay (Test Mode)',
                    'status' => 'Success',
                    'gateway_response' => json_encode([
                        'status' => 'SUCCESS',
                        'message' => 'Test payment completed successfully',
                        'test_mode' => true
                    ])
                ];

                return view('payments.fonepay-test', [
                    'paymentData' => [
                        'amount' => $amountInPaisa,
                        'referenceId' => $referenceId,
                        'particulars' => $title,
                        'merchantCode' => $merchantCode
                    ],
                    'payment_details' => $payment_details
                ]);
            }

            // REAL MODE: Prepare payment data for actual FonePay API
            $currentDate = date('m/d/Y');
            $r1 = $title; // Order description
            $r2 = 'N/A'; // Additional reference (optional)
            $returnUrl = route('fonepay.success');

            // Generate hash according to FonePay specification
            // Hash format: PID,MD,PRN,AMT,CRN,DT,R1,R2,RU
            $hashString = $merchantCode . ',P,' . $referenceId . ',' . $amountInPaisa . ',NPR,' . $currentDate . ',' . $r1 . ',' . $r2 . ',' . $returnUrl;
            $hash = hash_hmac('sha512', $hashString, $secretKey);

            $paymentData = [
                'merchantCode' => $merchantCode, // PID
                'amount' => $amountInPaisa, // AMT
                'referenceId' => $referenceId, // PRN
                'particulars' => $title, // R1
                'successUrl' => $returnUrl, // RU
                'hash' => $hash, // DV
            ];

            // Store reference ID in session for later verification
            session(['fonepay_reference_id' => $referenceId]);

            return view('payments.fonepay', compact('paymentData'));

        } catch (\Exception $e) {
            Log::error('FonePay payment initialization failed: ' . $e->getMessage());
            return (new PaymentsController)->payment_failed();
        }
    }

    # success callback
    public function success(Request $request)
    {
        try {
            $testMode = env('FONEPAY_TEST_MODE', true);

            // Handle test mode payments
            if ($testMode && $request->has('transaction_id') && str_contains($request->input('transaction_id'), 'TEST_TXN_')) {
                Log::info('FonePay TEST MODE: Processing successful test payment', $request->all());

                // Test mode - use the payment details directly from the request
                $payment_details = [
                    'transaction_id' => $request->input('transaction_id'),
                    'reference_id' => $request->input('reference_id'),
                    'amount' => $request->input('amount'),
                    'payment_method' => $request->input('payment_method', 'FonePay (Test Mode)'),
                    'status' => 'Success',
                    'gateway_response' => $request->input('gateway_response', '{}')
                ];

                return (new PaymentsController)->payment_success(json_encode($payment_details));
            }

            // Real mode - verify the payment response from FonePay
            // FonePay returns: PRN, BID, UID, P_AMT
            $referenceId = $request->input('PRN'); // Payment Reference Number
            $bankId = $request->input('BID'); // Bank ID
            $uniqueId = $request->input('UID'); // Unique ID
            $paidAmount = $request->input('P_AMT'); // Paid Amount

            Log::info('FonePay real payment callback received', [
                'all_params' => $request->all(),
                'PRN' => $referenceId,
                'BID' => $bankId,
                'UID' => $uniqueId,
                'P_AMT' => $paidAmount,
                'session_reference' => session('fonepay_reference_id')
            ]);

            // Check if required parameters are present
            if (empty($referenceId) || empty($uniqueId)) {
                Log::error('FonePay callback missing required parameters', [
                    'PRN' => $referenceId,
                    'UID' => $uniqueId,
                    'all_params' => $request->all()
                ]);
                return (new PaymentsController)->payment_failed();
            }

            // Verify with stored reference ID
            if ($referenceId !== session('fonepay_reference_id')) {
                Log::error('FonePay reference ID mismatch', [
                    'received' => $referenceId,
                    'expected' => session('fonepay_reference_id')
                ]);
                return (new PaymentsController)->payment_failed();
            }

            // Verify payment with FonePay API
            $verificationResult = $this->verifyPaymentWithFonePay($referenceId, $bankId, $uniqueId, $paidAmount);

            if (!$verificationResult || !$verificationResult['success']) {
                Log::error('FonePay payment verification failed', $verificationResult);
                return (new PaymentsController)->payment_failed();
            }

            // Prepare payment details for storage
            $payment_details = [
                'transaction_id' => $uniqueId,
                'reference_id' => $referenceId,
                'amount' => $paidAmount,
                'payment_method' => 'FonePay',
                'status' => 'Success',
                'gateway_response' => json_encode($request->all())
            ];

            // Clear session data
            session()->forget('fonepay_reference_id');

            return (new PaymentsController)->payment_success(json_encode($payment_details));

        } catch (\Exception $e) {
            Log::error('FonePay success callback failed: ' . $e->getMessage());
            return (new PaymentsController)->payment_failed();
        }
    }

    # failed callback
    public function failed(Request $request)
    {
        Log::info('FonePay payment failed: ' . json_encode($request->all()));

        // Clear session data
        session()->forget('fonepay_reference_id');

        return (new PaymentsController)->payment_failed();
    }

    # verify payment with FonePay API
    private function verifyPaymentWithFonePay($referenceId, $bankId, $uniqueId, $paidAmount)
    {
        try {
            $merchantCode = env('FONEPAY_MERCHANT_CODE');
            $secretKey = env('FONEPAY_SECRET_KEY');

            // Prepare verification data
            $verificationData = [
                'PID' => $merchantCode,
                'PRN' => $referenceId,
                'BID' => $bankId,
                'UID' => $uniqueId,
                'AMT' => $paidAmount
            ];

            // Generate verification hash
            $hashString = $merchantCode . ',' . $paidAmount . ',' . $referenceId . ',' . $bankId . ',' . $uniqueId;
            $verificationData['DV'] = hash_hmac('sha512', $hashString, $secretKey);

            // Call FonePay verification API
            $verificationUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant';
            $queryString = http_build_query($verificationData);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $verificationUrl . '?' . $queryString);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $response) {
                $xmlResponse = simplexml_load_string($response);

                Log::info('FonePay verification response', [
                    'response' => $response,
                    'parsed' => $xmlResponse
                ]);

                return [
                    'success' => (string)$xmlResponse->success === 'true',
                    'response' => $xmlResponse,
                    'raw_response' => $response
                ];
            }

            return ['success' => false, 'error' => 'Invalid response from FonePay'];

        } catch (\Exception $e) {
            Log::error('FonePay verification failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    # legacy verify payment method (kept for compatibility)
    public function verifyPayment($transactionId)
    {
        // This method is kept for backward compatibility
        // Real verification is now done in verifyPaymentWithFonePay
        return $this->verifyPaymentWithFonePay($transactionId, '', '', '');
    }
}
