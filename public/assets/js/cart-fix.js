/**
 * Cart Fix JavaScript
 * This script ensures the cart is properly updated in the frontend after checkout
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the order success or invoice page
    if (window.location.href.includes('/orders/') ||
        window.location.href.includes('/checkout-complete') ||
        window.location.href.includes('/checkout/success') ||
        window.location.href.includes('/checkout/invoice')) {

        console.log('Order success/invoice page detected - clearing cart data');

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

        // If there's a mini cart, empty it
        const miniCartItems = document.querySelectorAll('.mini-cart-item, .cart-item');
        miniCartItems.forEach(item => {
            item.remove();
        });

        // Add empty cart message if needed
        const miniCartContainers = document.querySelectorAll('.mini-cart-items, .cart-items, .cart-navbar-wrapper .simplebar-content');
        miniCartContainers.forEach(container => {
            if (container && container.children.length === 0) {
                const emptyMessage = document.createElement('li');
                emptyMessage.className = 'empty-cart-message';

                // Add empty cart image if available
                const emptyCartImg = document.createElement('img');
                emptyCartImg.src = '/frontend/default/assets/img/empty-cart.svg';
                emptyCartImg.alt = 'Empty Cart';
                emptyCartImg.className = 'img-fluid';

                emptyMessage.appendChild(emptyCartImg);
                container.appendChild(emptyMessage);
            }
        });

        // Force a refresh of the cart via AJAX if needed
        if (typeof updateCarts === 'function') {
            try {
                // Create mock data with empty cart
                const mockData = {
                    cartCount: 0,
                    subTotal: '0.00',
                    navCarts: '',
                    carts: ''
                };
                updateCarts(mockData);
            } catch (e) {
                console.error('Error updating cart UI:', e);
            }
        }

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

        // Redirect to home if we're on the checkout-complete page
        if (window.location.href.includes('/checkout-complete')) {
            console.log('Checkout complete page detected - redirecting to home');
            setTimeout(function() {
                window.location.href = '/';
            }, 1000);
        }
    }
});
