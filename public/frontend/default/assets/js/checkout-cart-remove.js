/**
 * Checkout Cart Remove Functionality
 * This script handles removing items from the cart in the checkout page
 * without refreshing the entire page or collapsing the order summary
 */

document.addEventListener('DOMContentLoaded', function() {
    // Override the handleCartItem function for the checkout page only
    // Store the original function
    if (typeof window.originalHandleCartItem === 'undefined' && typeof window.handleCartItem === 'function') {
        window.originalHandleCartItem = window.handleCartItem;

        // Override the function
        window.handleCartItem = function(action, id) {
            // Only override delete action in checkout page
            if (action === 'delete' && window.location.pathname.includes('/checkout')) {
                removeCartItemSmoothly(id);
                return;
            }

            // For other actions, call the original function
            window.originalHandleCartItem(action, id);
        };
    }
});

/**
 * Removes a cart item smoothly without page refresh
 * @param {number} cartId - The ID of the cart item to remove
 */
function removeCartItemSmoothly(cartId) {
    if (!cartId) {
        console.error('No cart ID provided');
        return;
    }

    // Find the row containing this item
    const itemRow = document.querySelector(`a[onclick*="handleCartItem('delete', ${cartId})"]`)?.closest('tr');
    if (!itemRow) {
        console.error('Item row not found');
        return;
    }

    // Get the CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }

    // Show loading state
    itemRow.style.transition = 'opacity 0.3s ease';
    itemRow.style.opacity = '0.5';

    // Make the AJAX request using jQuery to match the original code
    $.ajax({
        type: "POST",
        url: '/update-cart',
        data: {
            _token: csrfToken,
            action: 'delete',
            id: cartId
        },
        success: function(data) {
            if (data.success) {
                // Fade out and remove the row
                setTimeout(() => {
                    // Remove the row
                    itemRow.remove();

                    // Check if there are any items left
                    const remainingItems = document.querySelectorAll('.order-table tbody tr');
                    if (remainingItems.length === 0) {
                        // If no items left, show empty cart message
                        const tableBody = document.querySelector('.order-table tbody');
                        if (tableBody) {
                            tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Your cart is empty</td></tr>';
                        }
                    }

                    // Update the subtotal and total values
                    updateOrderSummaryTotals(data);
                }, 300);
            } else {
                // If there was an error, restore the row
                itemRow.style.opacity = '1';
                console.error('Failed to remove item:', data.message);
            }
        },
        error: function(error) {
            // If there was an error, restore the row
            itemRow.style.opacity = '1';
            console.error('Error removing item:', error);
        }
    });
}

/**
 * Updates the order summary totals without refreshing the page
 * @param {Object} data - The data returned from the AJAX request
 */
function updateOrderSummaryTotals(data) {
    // Update subtotal
    const subtotalElements = document.querySelectorAll('.cart-subtotal-title.cart-subtotal.text-end .money');
    if (subtotalElements.length > 0) {
        subtotalElements.forEach(el => {
            el.textContent = data.subTotal;
        });
    }

    // Update total
    const totalElements = document.querySelectorAll('.cart-subtotal-title.fs-5.cart-subtotal.text-end .money, .cart-subtotal-title.fs-4.cart-subtotal.text-end .money');
    if (totalElements.length > 0) {
        totalElements.forEach(el => {
            el.textContent = data.subTotal; // Use subTotal since that's what's returned
        });
    }

    // Update cart count in the header
    const cartCounters = document.querySelectorAll('.cart-counter');
    if (cartCounters.length > 0) {
        cartCounters.forEach(counter => {
            counter.textContent = data.cartCount;
            if (data.cartCount > 0) {
                counter.classList.remove('d-none');
            } else {
                counter.classList.add('d-none');
            }
        });
    }
}
