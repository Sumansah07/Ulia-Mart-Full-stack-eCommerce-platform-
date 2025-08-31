// Featured Products Quantity Selector
$(document).ready(function() {
    // Quantity selector functionality
    $('.featured-products .quantity-btn.plus').on('click', function() {
        var input = $(this).siblings('.quantity-input');
        var currentValue = parseInt(input.val());
        input.val(currentValue + 1);
        
        // Update the hidden quantity input for the form
        var hiddenInput = $(this).closest('form').find('input[name="quantity"]');
        hiddenInput.val(currentValue + 1);
    });

    $('.featured-products .quantity-btn.minus').on('click', function() {
        var input = $(this).siblings('.quantity-input');
        var currentValue = parseInt(input.val());
        if (currentValue > 1) {
            input.val(currentValue - 1);
            
            // Update the hidden quantity input for the form
            var hiddenInput = $(this).closest('form').find('input[name="quantity"]');
            hiddenInput.val(currentValue - 1);
        }
    });
});
