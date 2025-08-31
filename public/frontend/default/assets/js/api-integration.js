/**
 * API Integration for Uliaa E-commerce
 * This file contains functions to integrate backend APIs with the frontend
 */

// Base URL for API calls
const API_BASE_URL = window.location.origin;

/**
 * Fetch categories from the API and update the dropdown menu
 */
function fetchAndDisplayCategories() {
    // Make API request to get all categories
    fetch(`${API_BASE_URL}/api/category/all`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.data && data.data.length > 0) {
            // Get the category dropdown menu element
            const categoryDropdownMenu = document.querySelector('.category-dropdown-menu');
            
            if (categoryDropdownMenu) {
                // Clear existing categories
                categoryDropdownMenu.innerHTML = '';
                
                // Loop through categories and add them to the dropdown
                data.data.forEach(category => {
                    const categoryItem = document.createElement('li');
                    categoryItem.innerHTML = `
                        <a href="${API_BASE_URL}/products?category_id=${category.id}" class="d-flex align-items-center">
                            <div class="me-2 avatar-icon">
                                <img src="${category.thumbnail_image}" alt="" class="rounded-circle h-100 w-100">
                            </div>
                            <span>${category.name}</span>
                        </a>
                    `;
                    categoryDropdownMenu.appendChild(categoryItem);
                });
            }
        }
    })
    .catch(error => {
        console.error('Error fetching categories:', error);
    });
}

/**
 * Initialize all API integrations
 */
function initApiIntegrations() {
    // Fetch and display categories when the page loads
    fetchAndDisplayCategories();
}

// Initialize when the document is ready
document.addEventListener('DOMContentLoaded', function() {
    initApiIntegrations();
});
