// Category grid functionality
$(document).ready(function() {
    // Add any additional functionality for category grid here if needed
    
    // For example, you could add hover effects or click tracking
    $('.category-item').on('click', function() {
        // You can add analytics tracking here if needed
        console.log('Category clicked: ' + $(this).find('.category-title').text());
    });
});
