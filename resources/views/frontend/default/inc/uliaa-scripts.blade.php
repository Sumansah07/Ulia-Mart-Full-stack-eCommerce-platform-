<script>
// Function to fetch categories from API
async function fetchCategories() {
    try {
        // Use relative URL instead of hardcoded localhost
        const response = await fetch('/api/category/all');
        if (!response.ok) {
            throw new Error('Failed to fetch categories');
        }

        // Log the response for debugging
        const data = await response.json();
        console.log('API Response:', data);

        // Check the structure of the response and extract categories
        if (data && data.data) {
            return data.data;
        } else if (Array.isArray(data)) {
            return data;
        } else {
            console.error('Unexpected API response format:', data);
            return [];
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        return [];
    }
}

// Function to populate category dropdowns - DISABLED
// Category select component has been commented out
async function populateCategoryDropdowns() {
    console.log('Category dropdown population disabled - component commented out');
    return Promise.resolve(); // Return resolved promise to maintain chain
}

// Function to populate navigation menu
async function populateNavigationMenu() {
    const categories = await fetchCategories();
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('category_id');
    let targetParentId = null;

    if (categories && categories.length > 0) {
        const navbarContainer = document.querySelector('.navbar.collapse.navbar-collapse');

        if (navbarContainer) {
            let navHtml = '';

            categories.forEach(category => {
                // Handle different API response formats
                const categoryIdStr = String(category.id || category.category_id);
                const categoryName = category.name || (category.translations && category.translations.length > 0 ?
                                    category.translations[0].name : 'Unknown Category');
                // Desktop: Original dropdown behavior
                // Tablet: Direct link redirect
                // Add data-category-id and data-parent-id
                let btnClass = 'dropbtn desktop-dropdown-btn';
                let tabletLinkClass = 'dropbtn tablet-direct-link';
                let btnExtra = '';
                // Highlight parent if needed
                if (categoryId && (categoryIdStr === categoryId)) {
                    btnClass += ' active-category';
                    tabletLinkClass += ' active-category';
                }
                if (categoryId && targetParentId && (categoryIdStr === targetParentId)) {
                    btnClass += ' active-category';
                    tabletLinkClass += ' active-category';
                }
                // REDUCE CATEGORY GAP: set margin-right and padding to minimal
                navHtml += `<div class="dropdown" style="margin-right:8px !important;">
                    <button class="${btnClass}" data-category-id="${categoryIdStr}" data-parent-id="0" style="padding:10px 10px !important;">
                        ${categoryName}
                    </button>
                    <a class="${tabletLinkClass}" href="/products?category_id=${categoryIdStr}" style="padding:8px 8px !important; font-size:14px !important; display:none; background:transparent; border:none; outline:none; white-space:nowrap; color:#006633; cursor:pointer; text-decoration:none; pointer-events:auto !important;">
                        ${categoryName}
                    </a>
                    <div class="dropdown-content desktop-dropdown-content">`;

                // Always add a "View All" link for the category

                // Check if category has subcategories and add them
                if (category.subcategories && category.subcategories.length > 0) {
                    category.subcategories.forEach(subcategory => {
                        const subCategoryId = String(subcategory.id || subcategory.category_id);
                        const subCategoryName = subcategory.name || (subcategory.translations && subcategory.translations.length > 0 ?
                                              subcategory.translations[0].name : 'Unknown Subcategory');
                        // Highlight subcategory if needed
                        let subActive = '';
                        if (categoryId && subCategoryId === categoryId) {
                            subActive = 'active-category';
                            targetParentId = categoryIdStr;
                        }
                        navHtml += `<a href="/products?category_id=${subCategoryId}" data-category-id="${subCategoryId}" data-parent-id="${categoryIdStr}" class="${subActive}">${subCategoryName}</a>`;
                    });
                }

                navHtml += `</div>\n                </div>`;
            });

            navbarContainer.innerHTML = navHtml;
        }

        // Also update mobile menu
        const mobileNav = document.querySelector('#mobileNav .offcanvas-body ul.nav');

        if (mobileNav) {
            let mobileNavHtml = '';

            categories.forEach(category => {
                const categoryIdStr = String(category.id || category.category_id);
                const categoryName = category.name || (category.translations && category.translations.length > 0 ?
                                    category.translations[0].name : 'Unknown Category');
                let navLinkClass = 'nav-link';
                if (categoryId && categoryIdStr === categoryId) {
                    navLinkClass += ' active-category';
                }
                mobileNavHtml += `\n                <li class="nav-item">\n                    <a class="${navLinkClass}" href="/products?category_id=${categoryIdStr}" data-category-id="${categoryIdStr}" data-parent-id="0">\n                        ${categoryName}\n                    </a>`;
                // Dynamic subcategories
                if (category.subcategories && category.subcategories.length > 0) {
                    mobileNavHtml += '<ul class="submenu">';
                    category.subcategories.forEach(subcategory => {
                        const subCategoryId = String(subcategory.id || subcategory.category_id);
                        const subCategoryName = subcategory.name || (subcategory.translations && subcategory.translations.length > 0 ?
                                              subcategory.translations[0].name : 'Unknown Subcategory');
                        let subActive = '';
                        if (categoryId && subCategoryId === categoryId) {
                            subActive = 'active-category';
                        }
                        mobileNavHtml += `<li><a href="/products?category_id=${subCategoryId}" data-category-id="${subCategoryId}" data-parent-id="${categoryIdStr}" class="${subActive}">${subCategoryName}</a></li>`;
                    });
                    mobileNavHtml += '</ul>';
                }
                mobileNavHtml += '</li>';
            });

            mobileNav.innerHTML = mobileNavHtml;
        }
    }
    // --- Call highlight after nav is built ---
    if (window.highlightActiveCategory) {
        console.log('DEBUG: Calling highlightActiveCategory after nav build');
        window.highlightActiveCategory();
    } else {
        console.warn('highlightActiveCategory is not defined!');
    }
}

// Function to show loading state
function showLoading() {
    // Add loading class to category selects
    document.querySelectorAll('.category-select-wrapper').forEach(wrapper => {
        wrapper.classList.add('api-loading');
    });

    // Add loading class to navigation
    const navbarContainer = document.querySelector('.navbar.collapse.navbar-collapse');
    if (navbarContainer) {
        navbarContainer.classList.add('api-loading');
    }

    const mobileNav = document.querySelector('#mobileNav .offcanvas-body ul.nav');
    if (mobileNav) {
        mobileNav.classList.add('api-loading');
    }
}

// Function to hide loading state
function hideLoading() {
    // Remove loading class from category selects
    document.querySelectorAll('.category-select-wrapper').forEach(wrapper => {
        wrapper.classList.remove('api-loading');
    });

    // Remove loading class from navigation
    const navbarContainer = document.querySelector('.navbar.collapse.navbar-collapse');
    if (navbarContainer) {
        navbarContainer.classList.remove('api-loading');
    }

    const mobileNav = document.querySelector('#mobileNav .offcanvas-body ul.nav');
    if (mobileNav) {
        mobileNav.classList.remove('api-loading');
    }
}

// Function to show error message
function showApiError(message, details = null) {
    console.error(message, details);

    // Create and show error notification
    const errorDiv = document.createElement('div');
    errorDiv.className = 'api-error-notification';
    errorDiv.style.position = 'fixed';
    errorDiv.style.bottom = '20px';
    errorDiv.style.right = '20px';
    errorDiv.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
    errorDiv.style.color = 'white';
    errorDiv.style.padding = '10px 15px';
    errorDiv.style.borderRadius = '5px';
    errorDiv.style.zIndex = '9999';
    errorDiv.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
    errorDiv.textContent = message;

    document.body.appendChild(errorDiv);
    setTimeout(() => errorDiv.remove(), 5000);
}



// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Show loading state
    showLoading();

    // Fetch and populate categories
    Promise.all([
        populateCategoryDropdowns(),
        populateNavigationMenu()
    ]).then(() => {
        // Hide loading state on success
        hideLoading();
    }).catch(error => {
        // Hide loading and show error
        hideLoading();
        showApiError('Failed to load categories. Please try refreshing the page.', error);

        // Fallback: Try to load categories from PHP
        fetch('/api/fallback-categories')
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    // Populate with fallback data
                    populateCategoryDropdowns();
                    populateNavigationMenu();
                }
            })
            .catch(fallbackError => {
                console.error('Fallback categories also failed:', fallbackError);
            });
    });
});

// Function to handle product card navigation
function navigateToProduct(event, url) {
    // Check if the click was on a button or input
    const target = event.target;
    const isButton = target.tagName === 'BUTTON' ||
                     target.closest('button') ||
                     target.tagName === 'INPUT' ||
                     target.closest('.direct-add-to-cart-btn') ||
                     target.closest('.add-to-cart-text');

    // If the click was on a button or input, don't navigate
    if (isButton) {
        event.stopPropagation();
        return;
    }

    // Navigate to the product page
    window.location.href = url;
}
</script>
