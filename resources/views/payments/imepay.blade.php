<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ localize('IMEPay/FonePay Payment') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            max-height: 60px;
        }
        .payment-info {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #006633;
            margin: 10px 0;
        }
        .btn-pay {
            background-color: #006633;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .btn-pay:hover {
            background-color: #004d26;
        }
        .loading {
            display: none;
            margin-top: 20px;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #006633;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="logo">
            <img src="{{ staticAsset('frontend/pg/imepay.png') }}" alt="FonePay" onerror="this.style.display='none'">
            <h2>{{ localize('FonePay Payment') }}</h2>
        </div>
        
        <div class="payment-info">
            <h3>{{ localize('Payment Details') }}</h3>
            <div class="amount">{{ formatPrice($paymentData['amount'] / 100) }}</div>
            <p>{{ $paymentData['particulars'] }}</p>
            <p><strong>{{ localize('Reference ID') }}:</strong> {{ $paymentData['referenceId'] }}</p>
        </div>

        <form id="imepayForm" action="https://payment.imepay.com.np:7979/WebPay/WebPayService" method="POST">
            @foreach($paymentData as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            
            <button type="submit" class="btn-pay" onclick="showLoading()">
                {{ localize('Pay with FonePay') }}
            </button>
        </form>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>{{ localize('Redirecting to FonePay...') }}</p>
        </div>

        <div style="margin-top: 20px; font-size: 12px; color: #666;">
            <p>{{ localize('You will be redirected to FonePay to complete your payment securely.') }}</p>
        </div>
    </div>

    <script>
        function showLoading() {
            document.querySelector('.btn-pay').style.display = 'none';
            document.getElementById('loading').style.display = 'block';
        }

        // Auto-submit form after 2 seconds for better UX
        setTimeout(function() {
            document.getElementById('imepayForm').submit();
        }, 2000);
    </script>
</body>
</html>
