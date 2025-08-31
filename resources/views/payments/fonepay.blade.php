<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ localize('FonePay Payment') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }
        .logo {
            margin-bottom: 30px;
        }
        .logo img {
            max-height: 80px;
            margin-bottom: 10px;
        }
        .logo h2 {
            color: #2c3e50;
            margin: 0;
            font-weight: 600;
        }
        .payment-info {
            margin: 30px 0;
            padding: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            border-left: 5px solid #007bff;
        }
        .amount {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin: 15px 0;
        }
        .order-details {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border: 1px solid #dee2e6;
        }
        .btn-pay {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 25px;
            transition: all 0.3s ease;
        }
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.4);
        }
        .loading {
            display: none;
            margin-top: 25px;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .security-info {
            margin-top: 25px;
            padding: 15px;
            background: #e8f5e8;
            border-radius: 8px;
            font-size: 14px;
            color: #155724;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 5px 0;
            border-bottom: 1px dotted #ccc;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        .info-value {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="logo">
            <img src="{{ staticAsset('frontend/pg/fonepay.png') }}" alt="FonePay" onerror="this.style.display='none'">
            <h2>{{ localize('FonePay Payment Gateway') }}</h2>
        </div>

        <div class="payment-info">
            <h3 style="margin-top: 0; color: #2c3e50;">{{ localize('Payment Summary') }}</h3>
            <div class="amount">{{ formatPrice($paymentData['amount'] / 100) }}</div>

            <div class="order-details">
                <div class="info-row">
                    <span class="info-label">{{ localize('Order') }}:</span>
                    <span class="info-value">{{ $paymentData['particulars'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">{{ localize('Reference ID') }}:</span>
                    <span class="info-value">{{ $paymentData['referenceId'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">{{ localize('Merchant') }}:</span>
                    <span class="info-value">{{ $paymentData['merchantCode'] }}</span>
                </div>
            </div>
        </div>

        <form id="fonepayForm" action="https://dev-clientapi.fonepay.com/api/merchantRequest" method="GET">
            <input type="hidden" name="PID" value="{{ $paymentData['merchantCode'] }}">
            <input type="hidden" name="MD" value="P">
            <input type="hidden" name="PRN" value="{{ $paymentData['referenceId'] }}">
            <input type="hidden" name="AMT" value="{{ $paymentData['amount'] }}">
            <input type="hidden" name="CRN" value="NPR">
            <input type="hidden" name="DT" value="{{ date('m/d/Y') }}">
            <input type="hidden" name="R1" value="{{ $paymentData['particulars'] }}">
            <input type="hidden" name="R2" value="N/A">
            <input type="hidden" name="RU" value="{{ $paymentData['successUrl'] }}">
            <input type="hidden" name="DV" value="{{ $paymentData['hash'] }}">

            <button type="submit" class="btn-pay" onclick="showLoading()">
                <i class="fas fa-credit-card"></i> {{ localize('Pay with FonePay') }}
            </button>
        </form>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p style="color: #007bff; font-weight: 600;">{{ localize('Connecting to FonePay...') }}</p>
            <p style="font-size: 14px; color: #6c757d;">{{ localize('Please wait while we redirect you securely') }}</p>
        </div>

        <div class="security-info">
            <p style="margin: 0; font-weight: 600;">
                <i class="fas fa-shield-alt"></i> {{ localize('Secure Payment') }}
            </p>
            <p style="margin: 5px 0 0 0; font-size: 12px;">
                {{ localize('Your payment is processed securely through FonePay\'s encrypted gateway') }}
            </p>
        </div>
    </div>

    <script>
        function showLoading() {
            document.querySelector('.btn-pay').style.display = 'none';
            document.getElementById('loading').style.display = 'block';
        }

        // Auto-submit form after 3 seconds for better UX
        setTimeout(function() {
            console.log('Auto-redirecting to FonePay...');
            document.getElementById('fonepayForm').submit();
        }, 3000);

        // Prevent multiple submissions
        document.getElementById('fonepayForm').addEventListener('submit', function() {
            showLoading();
        });
    </script>
</body>
</html>
