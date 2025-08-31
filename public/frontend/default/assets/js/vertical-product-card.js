// Vertical Product Card Quantity Selector
document.addEventListener('DOMContentLoaded', function() {
    initVerticalProductCardQuantitySelectors();

    // Re-initialize after AJAX content loads
    document.addEventListener('ajaxContentLoaded', function() {
        initVerticalProductCardQuantitySelectors();
    });
});

function initVerticalProductCardQuantitySelectors() {
    // Add event listeners to all increment and decrement buttons in vertical product cards
    document.querySelectorAll('.vertical-product-card').forEach(card => {
        setupQuantityButtons(card);
    });
}

function setupQuantityButtons(card) {
    const decrementBtn = card.querySelector('button[onclick="decrementQuantity(this)"]');
    const incrementBtn = card.querySelector('button[onclick="incrementQuantity(this)"]');

    if (decrementBtn && incrementBtn) {
        // Remove the onclick attributes to prevent duplicate event handlers
        decrementBtn.removeAttribute('onclick');
        incrementBtn.removeAttribute('onclick');

        // Add event listeners
        decrementBtn.addEventListener('click', function() {
            decrementQuantity(this);
        });

        incrementBtn.addEventListener('click', function() {
            incrementQuantity(this);
        });
    }
}

function decrementQuantity(button) {
    const form = button.closest('form');
    if (!form) return;

    const quantityInput = form.querySelector('input[name="quantity"]:not([type="hidden"])');
    const hiddenQuantityInput = form.querySelector('input[type="hidden"][name="quantity"]');

    if (quantityInput) {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            value--;
            quantityInput.value = value;

            // Update hidden input if it exists
            if (hiddenQuantityInput) {
                hiddenQuantityInput.value = value;
            }

            // Trigger change event to ensure any listeners are notified
            const event = new Event('change');
            quantityInput.dispatchEvent(event);
        }
    }
}

function incrementQuantity(button) {
    const form = button.closest('form');
    if (!form) return;

    const quantityInput = form.querySelector('input[name="quantity"]:not([type="hidden"])');
    const hiddenQuantityInput = form.querySelector('input[type="hidden"][name="quantity"]');

    if (quantityInput) {
        let value = parseInt(quantityInput.value);
        // Get max stock if available
        const maxStock = quantityInput.hasAttribute('max')
            ? parseInt(quantityInput.getAttribute('max'))
            : 999;

        if (value < maxStock) {
            value++;
            quantityInput.value = value;

            // Update hidden input if it exists
            if (hiddenQuantityInput) {
                hiddenQuantityInput.value = value;
            }

            // Trigger change event to ensure any listeners are notified
            const event = new Event('change');
            quantityInput.dispatchEvent(event);
        }
    }
}
