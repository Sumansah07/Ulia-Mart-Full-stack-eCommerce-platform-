/**
 * Cart Price Update Fix
 * 
 * This script fixes the issue where the cart price in the header doesn't update
 * when items are added to the cart, only the count updates.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Override the updateCarts function to also update the cart amount
    if (typeof window.originalUpdateCarts === 'undefined') {
        // Store the original function
        window.originalUpdateCarts = window.updateCarts;
        
        // Replace with our enhanced version
        window.updateCarts = function(data) {
            // Call the original function first
            window.originalUpdateCarts(data);
            
            // Now update the cart amount in the header
            const cartAmountElements = document.querySelectorAll('.cart-amount');
            if (cartAmountElements.length > 0) {
                cartAmountElements.forEach(element => {
                    element.textContent = data.subTotal;
                });
            }
        };
    }
    
    // Also handle direct DOM updates for cases where the function might be bypassed
    const observeCartChanges = function() {
        // Create a MutationObserver to watch for changes to the cart counter
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList' || mutation.type === 'characterData') {
                    // If the cart counter was updated, we should also update the price
                    // by making an AJAX request to get the current cart data
                    fetchCartData();
                }
            });
        });
        
        // Observe all cart counters
        const cartCounters = document.querySelectorAll('.cart-counter');
        cartCounters.forEach(function(counter) {
            observer.observe(counter, { 
                childList: true,
                characterData: true,
                subtree: true
            });
        });
    };
    
    // Function to fetch current cart data via AJAX
    const fetchCartData = function() {
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Only proceed if we have the token
        if (csrfToken) {
            fetch('/get-cart-data', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the cart amount in the header
                    const cartAmountElements = document.querySelectorAll('.cart-amount');
                    if (cartAmountElements.length > 0) {
                        cartAmountElements.forEach(element => {
                            element.textContent = data.subTotal;
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching cart data:', error);
            });
        }
    };
    
    // Start observing cart changes
    observeCartChanges();
});
