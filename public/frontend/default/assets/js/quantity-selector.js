// Quantity Selector for Product Cards
document.addEventListener('DOMContentLoaded', function() {
    initQuantitySelectors();
    
    // Re-initialize after AJAX content loads
    document.addEventListener('ajaxContentLoaded', function() {
        initQuantitySelectors();
    });
});

function initQuantitySelectors() {
    // Get all quantity selectors
    const quantitySelectors = document.querySelectorAll('.quantity-selector');
    
    quantitySelectors.forEach(selector => {
        const minusBtn = selector.querySelector('.minus');
        const plusBtn = selector.querySelector('.plus');
        const input = selector.querySelector('.quantity-input');
        const form = selector.closest('form');
        const hiddenInput = form ? form.querySelector('input[name="quantity"]') : null;
        
        if (minusBtn && plusBtn && input) {
            // Minus button click
            minusBtn.addEventListener('click', function() {
                let value = parseInt(input.value);
                if (value > 1) {
                    value--;
                    input.value = value;
                    
                    // Update hidden input if it exists
                    if (hiddenInput) {
                        hiddenInput.value = value;
                    }
                }
            });
            
            // Plus button click
            plusBtn.addEventListener('click', function() {
                let value = parseInt(input.value);
                // Get max stock if available
                const form = selector.closest('form');
                const maxStock = form && form.querySelector('input[name="quantity"]').hasAttribute('max') 
                    ? parseInt(form.querySelector('input[name="quantity"]').getAttribute('max')) 
                    : 999;
                
                if (value < maxStock) {
                    value++;
                    input.value = value;
                    
                    // Update hidden input if it exists
                    if (hiddenInput) {
                        hiddenInput.value = value;
                    }
                }
            });
        }
    });
}
