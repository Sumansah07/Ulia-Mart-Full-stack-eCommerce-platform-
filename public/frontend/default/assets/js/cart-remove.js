/**
 * Cart Remove Functionality
 * This script handles removing items from the cart in the checkout page
 */

// Make removeFromCart available globally
window.removeFromCart = function(cartId) {
    if (!cartId) {
        console.error('No cart ID provided');
        return;
    }

    // Confirm before removing
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        console.log('Removing cart item with ID:', cartId);

        // Use the handleCartItem function which is the standard way to remove items in this application
        if (typeof handleCartItem === 'function') {
            handleCartItem('delete', cartId);

            // Also remove the item from the DOM for immediate visual feedback
            const itemRow = document.querySelector(`a[onclick*="removeFromCart(${cartId})"]`).closest('tr');
            if (itemRow) {
                itemRow.style.opacity = '0.5';
                setTimeout(() => {
                    itemRow.remove();

                    // If cart is empty, show message
                    const remainingItems = document.querySelectorAll('.order-table tbody tr');
                    if (remainingItems.length === 0) {
                        const tableBody = document.querySelector('.order-table tbody');
                        if (tableBody) {
                            tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-4">Your cart is empty</td></tr>';
                        }
                    }
                }, 500);
            }

            return;
        }

        // Fallback if handleCartItem is not available
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Make a direct AJAX call to remove the item
        fetch('/update-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                action: 'delete',
                id: cartId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload the page to reflect changes
                location.reload();
            } else {
                alert('Failed to remove item from cart. Please try again.');
            }
        })
        .catch(() => {
            alert('An error occurred. Please try again.');
        });
    }
}
