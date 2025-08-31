/**
 * Mobile Menu Override
 * This script overrides the default mobile menu behavior to prevent product listings
 * from appearing in the mobile menu.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Override the mobile category menu population
    const mobileCategoryMenu = document.querySelector('.mobile-category-menu');
    
    // If the mobile category menu exists, prevent it from being populated
    if (mobileCategoryMenu) {
        // Remove any existing content
        mobileCategoryMenu.innerHTML = '';
        
        // Add a simple message or navigation links if needed
        mobileCategoryMenu.innerHTML = `
            <li><a href="${window.location.origin}">Home</a></li>
        `;
    }
    
    // Override any other functions that might be populating the mobile menu
    if (typeof window.loadCategoriesForNavbar === 'function') {
        // Store the original function
        const originalLoadCategoriesForNavbar = window.loadCategoriesForNavbar;
        
        // Override the function
        window.loadCategoriesForNavbar = function() {
            // Call the original function but prevent it from populating the mobile menu
            const result = originalLoadCategoriesForNavbar.apply(this, arguments);
            
            // Clear the mobile menu again to be sure
            if (mobileCategoryMenu) {
                mobileCategoryMenu.innerHTML = '';
                mobileCategoryMenu.innerHTML = `
                    <li><a href="${window.location.origin}">Home</a></li>
                `;
            }
            
            return result;
        };
    }
});
