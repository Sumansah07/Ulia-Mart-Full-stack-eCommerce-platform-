// Mobile Navigation Fix JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Get the offcanvas element
    const offcanvasElement = document.getElementById('mobileNav');

    if (offcanvasElement) {
        // Add event listener for when offcanvas is shown
        offcanvasElement.addEventListener('show.bs.offcanvas', function () {
            document.body.classList.add('offcanvas-active');

            // Ensure the offcanvas is visible and above other elements
            offcanvasElement.style.zIndex = '1080';

            // Hide the header when sidebar is open
            const headerWrapper = document.querySelector('.header-wrapper');
            if (headerWrapper) {
                headerWrapper.style.visibility = 'hidden';
            }

            // Hide the mobile toolbar when sidebar is open
            const mobileToolbar = document.querySelector('.mobile-toolbar');
            if (mobileToolbar) {
                mobileToolbar.style.visibility = 'hidden';
            }

            // Hide the mobile search when sidebar is open
            const mobileSearch = document.querySelector('.mobile-search');
            if (mobileSearch) {
                mobileSearch.style.visibility = 'hidden';
            }

            // Fix for iOS devices
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';
        });

        // Add event listener for when offcanvas is hidden
        offcanvasElement.addEventListener('hide.bs.offcanvas', function () {
            document.body.classList.remove('offcanvas-active');

            // Show the header again when sidebar is closed
            const headerWrapper = document.querySelector('.header-wrapper');
            if (headerWrapper) {
                headerWrapper.style.visibility = 'visible';
            }

            // Show the mobile toolbar again when sidebar is closed
            const mobileToolbar = document.querySelector('.mobile-toolbar');
            if (mobileToolbar) {
                mobileToolbar.style.visibility = 'visible';
            }

            // Show the mobile search again when sidebar is closed
            const mobileSearch = document.querySelector('.mobile-search');
            if (mobileSearch) {
                mobileSearch.style.visibility = 'visible';
            }

            // Reset body styles
            document.body.style.position = '';
            document.body.style.width = '';
        });

        // Make submenu toggleable
        const navItems = document.querySelectorAll('.offcanvas-body .nav-item');
        navItems.forEach(function(item) {
            const link = item.querySelector('.nav-link');
            const submenu = item.querySelector('.submenu');

            // SKIP submenus that should always be hidden on mobile
            if (submenu && submenu.classList.contains('mobile-hide-subcategories')) {
                // Do not attach toggle logic or set display
                return;
            }

            if (link && submenu) {
                link.addEventListener('click', function(e) {
                    // Only prevent default if there are submenus
                    if (submenu.children.length > 0) {
                        e.preventDefault();
                        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';

                        // Toggle the chevron icon
                        const icon = link.querySelector('i');
                        if (icon) {
                            icon.classList.toggle('fa-chevron-right');
                            icon.classList.toggle('fa-chevron-down');
                        }
                    }
                });

                // Initially hide submenus
                submenu.style.display = 'none';
            }
        });
    }

    // Fix for navbar toggler
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
        navbarToggler.style.zIndex = '1090';
    }
});
