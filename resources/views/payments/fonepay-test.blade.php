<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FonePay Payment Gateway - Test Mode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .payment-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        
        .payment-header {
            margin-bottom: 30px;
        }
        
        .payment-header h2 {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .test-badge {
            background: #ff6b6b;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .payment-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #007bff;
        }
        
        .amount {
            font-size: 2.5rem;
            font-weight: 700;
            color: #007bff;
            margin: 15px 0;
        }
        
        .payment-details {
            text-align: left;
            margin: 20px 0;
        }
        
        .payment-details .row {
            margin-bottom: 10px;
        }
        
        .payment-details .label {
            font-weight: 600;
            color: #666;
        }
        
        .payment-details .value {
            color: #333;
            word-break: break-all;
        }
        
        .btn-pay {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            width: 100%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,123,255,0.3);
        }
        
        .security-note {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .security-note small {
            color: #155724;
            font-weight: 500;
        }
        
        .loading-spinner {
            display: none;
            margin: 20px 0;
        }
        
        .success-message {
            display: none;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            color: #155724;
        }
        
        .countdown {
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="payment-card">
        <div class="payment-header">
            <div class="test-badge">🧪 TEST MODE</div>
            <h2>FonePay Payment Gateway</h2>
        </div>

        <div class="payment-summary">
            <h5 class="mb-3">Payment Summary</h5>
            <div class="amount">Rs. {{ number_format($paymentData['amount'] / 100, 2) }}</div>
            
            <div class="payment-details">
                <div class="row">
                    <div class="col-5 label">Order:</div>
                    <div class="col-7 value">{{ $paymentData['particulars'] }}</div>
                </div>
                <div class="row">
                    <div class="col-5 label">Reference ID:</div>
                    <div class="col-7 value">{{ $paymentData['referenceId'] }}</div>
                </div>
                <div class="row">
                    <div class="col-5 label">Merchant:</div>
                    <div class="col-7 value">{{ $paymentData['merchantCode'] }}</div>
                </div>
            </div>
        </div>

        <div id="payment-form">
            <button type="button" class="btn btn-pay" onclick="simulatePayment()">
                💳 Pay with FonePay (Test)
            </button>
            
            <div class="countdown" id="countdown">
                Auto-processing in <span id="timer">5</span> seconds...
            </div>
        </div>

        <div class="loading-spinner" id="loading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Processing payment...</span>
            </div>
            <p class="mt-3">Processing your payment...</p>
        </div>

        <div class="success-message" id="success">
            <h5>✅ Payment Successful!</h5>
            <p>Your test payment has been processed successfully.</p>
            <p><strong>Transaction ID:</strong> {{ $payment_details['transaction_id'] }}</p>
            <p>Redirecting to order confirmation...</p>
        </div>

        <div class="security-note">
            <small>
                🔒 <strong>Test Mode Active:</strong> This is a simulated payment for testing purposes. 
                No real money will be charged. The order will be marked as successful automatically.
            </small>
        </div>
    </div>

    <script>
        let countdown = 5;
        let countdownInterval;

        // Start countdown immediately
        function startCountdown() {
            countdownInterval = setInterval(function() {
                countdown--;
                document.getElementById('timer').textContent = countdown;
                
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    simulatePayment();
                }
            }, 1000);
        }

        function simulatePayment() {
            // Clear countdown
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            
            // Hide payment form and countdown
            document.getElementById('payment-form').style.display = 'none';
            document.getElementById('countdown').style.display = 'none';
            
            // Show loading
            document.getElementById('loading').style.display = 'block';
            
            // Simulate processing time (2 seconds)
            setTimeout(function() {
                // Hide loading
                document.getElementById('loading').style.display = 'none';
                
                // Show success
                document.getElementById('success').style.display = 'block';
                
                // Redirect to success page after 3 seconds
                setTimeout(function() {
                    // Create a form and submit to success route
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("fonepay.success") }}';
                    
                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    // Add payment details
                    const paymentData = @json($payment_details);
                    for (const [key, value] of Object.entries(paymentData)) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = value;
                        form.appendChild(input);
                    }
                    
                    document.body.appendChild(form);
                    form.submit();
                }, 3000);
            }, 2000);
        }

        // Start countdown when page loads
        window.onload = function() {
            startCountdown();
        };
    </script>
</body>
</html>
