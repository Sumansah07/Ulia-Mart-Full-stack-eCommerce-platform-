// Category Menu Dropdown
document.addEventListener('DOMContentLoaded', function() {
    // Get the category menu list element
    const categoryMenuList = document.getElementById('categoryMenuList');

    if (categoryMenuList) {
        // Fetch categories from API
        fetchCategories()
            .then(populateCategoryMenu)
            .catch(error => {
                console.error('Error loading categories:', error);
                categoryMenuList.innerHTML = '<li><a class="dropdown-item" href="#">Failed to load categories</a></li>';
            });
    }

    // Function to fetch categories from API
    async function fetchCategories() {
        try {
            console.log('Fetching categories...');
            // Use window.location.origin to get the base URL
            const baseUrl = window.location.origin;
            const apiUrl = `${baseUrl}/api/category/all`;
            console.log('API URL:', apiUrl);

            const response = await fetch(apiUrl);
            console.log('Response status:', response.status);

            if (!response.ok) {
                throw new Error(`Failed to fetch categories: ${response.status}`);
            }

            const data = await response.json();
            console.log('Categories loaded:', data);

            // Check if data has the expected structure
            if (data && data.data && Array.isArray(data.data)) {
                console.log('Found categories in data.data:', data.data.length);
                return data.data;
            } else if (Array.isArray(data)) {
                console.log('Data is an array of categories:', data.length);
                return data;
            } else {
                console.error('Unexpected API response format:', data);
                throw new Error('Unexpected API response format');
            }
        } catch (error) {
            console.error('Error fetching categories:', error);
            throw error;
        }
    }

    // Function to populate the category menu
    function populateCategoryMenu(categories) {
        console.log('Populating category menu with categories:', categories);

        if (!categories || categories.length === 0) {
            console.warn('No categories found to populate menu');
            categoryMenuList.innerHTML = '<li><a class="dropdown-item" href="#">No categories found</a></li>';
            return;
        }

        let menuHtml = '';

        categories.forEach(category => {
            console.log('Processing category:', category);

            const categoryId = category.id;
            const categoryName = category.name;
            // Use a default image if thumbnail_image is not available
            const defaultImage = '/frontend/default/assets/img/no-data-found.png';
            const thumbnailImage = category.thumbnail_image || defaultImage;

            console.log(`Category ${categoryName} (${categoryId}): Image = ${thumbnailImage}`);

            menuHtml += `
                <li>
                    <a class="dropdown-item" href="${window.location.origin}/products?category_id=${categoryId}">
                        <img src="${thumbnailImage}" alt="${categoryName}" onerror="if(!this.hasAttribute('data-error-handled')){this.setAttribute('data-error-handled', 'true'); this.src='${defaultImage}';}">
                        ${categoryName}
                    </a>
                </li>
            `;
        });

        console.log('Setting menu HTML:', menuHtml);
        categoryMenuList.innerHTML = menuHtml;

        // Make sure the dropdown is properly initialized
        const dropdown = new bootstrap.Dropdown(document.getElementById('categoryMenuDropdown'));
    }
});
