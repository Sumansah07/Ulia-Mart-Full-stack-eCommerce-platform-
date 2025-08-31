// Category Zoom Effect Script
document.addEventListener('DOMContentLoaded', function() {
    // Apply zoom effect to category images
    function applyCategoryZoomEffect() {
        // Add CSS directly to the head
        const style = document.createElement('style');
        style.textContent = `
            .category-card .overflow-hidden {
                overflow: hidden !important;
            }
            
            .category-card img {
                transition: transform 0.5s ease !important;
            }
            
            .category-card:hover img {
                transform: scale(1.3) !important;
            }
            
            @media (max-width: 576px) {
                .category-card:hover img {
                    transform: scale(1.25) !important;
                }
            }
        `;
        document.head.appendChild(style);
        
        console.log('Category zoom effect CSS added');
    }
    
    // Call immediately
    applyCategoryZoomEffect();
    
    // Also call after a delay to ensure it works with dynamically loaded content
    setTimeout(applyCategoryZoomEffect, 1000);
    setTimeout(applyCategoryZoomEffect, 2000);
    setTimeout(applyCategoryZoomEffect, 3000);
});
