// Fix for the green zoom lens in product detail page

document.addEventListener('DOMContentLoaded', function() {
    // Wait for the page to fully load
    setTimeout(function() {
        // Find all zoom lenses and fix their styling
        const zoomLenses = document.querySelectorAll('.zoomLens');
        if (zoomLenses.length > 0) {
            zoomLenses.forEach(function(lens) {
                // Remove any background color
                lens.style.backgroundColor = 'transparent';
                // Add a subtle border
                lens.style.border = '1px dashed rgba(0, 0, 0, 0.3)';
                // Ensure proper cursor
                lens.style.cursor = 'crosshair';
            });
        }

        // Find all zoom windows and fix their styling
        const zoomWindows = document.querySelectorAll('.zoomWindow');
        if (zoomWindows.length > 0) {
            zoomWindows.forEach(function(window) {
                // Ensure proper border
                window.style.border = '1px solid #e0e0e0';
                // Add subtle shadow
                window.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.1)';
            });
        }

        // Fix any zoom buttons or controls
        const zoomButtons = document.querySelectorAll('.product-buttons .btn');
        if (zoomButtons.length > 0) {
            zoomButtons.forEach(function(button) {
                // Make buttons transparent
                button.style.backgroundColor = 'transparent';
                button.style.border = '1px solid #e0e0e0';
                button.style.color = '#333';
            });
        }
    }, 1000); // Wait 1 second for the zoom to initialize
});

// Override the elevateZoom plugin's styling if it's loaded
if (typeof jQuery !== 'undefined' && jQuery.fn.elevateZoom) {
    const originalElevateZoom = jQuery.fn.elevateZoom;
    
    jQuery.fn.elevateZoom = function(options) {
        // Merge our custom options with the provided options
        const customOptions = {
            zoomWindowBgColour: 'transparent',
            borderSize: 1,
            borderColour: '#e0e0e0',
            lensBorderSize: 1,
            lensBorderColour: 'rgba(0, 0, 0, 0.3)',
            lensColour: 'transparent',
            lensOpacity: 0.3
        };
        
        const mergedOptions = {...options, ...customOptions};
        
        // Call the original elevateZoom with our merged options
        return originalElevateZoom.call(this, mergedOptions);
    };
}
