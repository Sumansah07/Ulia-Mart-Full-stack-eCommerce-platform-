@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Order Success') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <!--Order Success Section-->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">{{ localize('ORDER SUCCESS') }}</h1>
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}">{{ localize('HOME') }}</a>
                            <span class="mx-1">></span>
                            <span>{{ localize('ORDER SUCCESS') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <div class="success-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h2 class="mb-3">{{ localize('Thank you for your order!') }}</h2>
                    <p class="mb-1">{{ localize('Payment is successfully processed and your order is on the way') }}</p>
                    <p class="mb-4">{{ localize('You will receive an order confirmation email with details of your order and a link to track its progress.') }}</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('home') }}" class="btn btn-secondary me-2 mb-2">
                        <i class="fas fa-arrow-left me-1"></i> {{ localize('CONTINUE SHOPPING') }}
                    </a>
                    <a href="{{ route('customers.trackOrder') }}" class="btn btn-primary mb-2">
                        <i class="fas fa-truck me-1"></i> {{ localize('TRACK YOUR ORDER') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--End Order Success Section-->

    <!-- Cart Emptying Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Simple success page - clearing cart data');
            
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
            
            // Update any cart counters in the UI
            const cartCounters = document.querySelectorAll('.cart-counter, .cart-count, .cart-items-count');
            cartCounters.forEach(counter => {
                counter.textContent = '0';
                counter.classList.add('d-none');
            });
            
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
                    })
                    .catch(error => {
                        console.error('Error emptying cart via AJAX:', error);
                    });
                }
            } catch (e) {
                console.error('Error making AJAX call to empty cart:', e);
            }
        });
    </script>
@endsection
