<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ localize('Order Complete') }} - {{ getSetting('system_title') }}</title>
    <meta http-equiv="refresh" content="0;url={{ route('home') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .loader-container {
            text-align: center;
        }
        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="loader-container">
        <div class="loader"></div>
        <h2>{{ localize('Processing Your Order') }}</h2>
        <p>{{ localize('Please wait while we redirect you...') }}</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Checkout complete page - clearing cart data and redirecting');
            
            // Clear ALL localStorage data related to cart
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key && (key.includes('cart') || key.includes('Cart'))) {
                    localStorage.removeItem(key);
                }
            }
            
            // Specifically clear these known cart-related items
            localStorage.removeItem('cart');
            localStorage.removeItem('cartItems');
            localStorage.removeItem('cartCount');
            localStorage.removeItem('cartTotal');
            
            // Make a direct AJAX call to empty the cart on the server
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (csrfToken) {
                    fetch('/empty-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ force: true })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Cart emptied via AJAX:', data);
                        // Redirect to home after cart is emptied
                        window.location.href = '/';
                    })
                    .catch(error => {
                        console.error('Error emptying cart via AJAX:', error);
                        // Redirect to home even if there's an error
                        window.location.href = '/';
                    });
                } else {
                    // If no CSRF token, redirect to home
                    window.location.href = '/';
                }
            } catch (e) {
                console.error('Error making AJAX call to empty cart:', e);
                // Redirect to home even if there's an error
                window.location.href = '/';
            }
            
            // Fallback redirect in case the AJAX call takes too long
            setTimeout(function() {
                window.location.href = '/';
            }, 3000);
        });
    </script>
</body>
</html>
