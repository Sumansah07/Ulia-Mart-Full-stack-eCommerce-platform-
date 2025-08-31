// Admin Sidebar Dark Green Color Override - SINGLE ACTIVE ITEM ONLY
document.addEventListener('DOMContentLoaded', function() {
    // Function to ensure only ONE menu item is active at a time
    function manageSingleActiveState() {
        // First, reset ALL sidebar links to default state
        const allSidebarLinks = document.querySelectorAll('.tt-side-nav .side-nav-link');
        allSidebarLinks.forEach(link => {
            // Remove any forced styling
            link.style.backgroundColor = '';
            link.style.color = '';

            const icon = link.querySelector('.tt-nav-link-icon');
            if (icon) {
                icon.style.color = '';
            }
        });

        // Then apply dark green ONLY to the currently active item
        const currentlyActive = document.querySelector('.tt-side-nav .side-nav-link.active, .tt-side-nav .tt-menu-item-active > .side-nav-link');
        if (currentlyActive) {
            currentlyActive.style.backgroundColor = '#006633';
            currentlyActive.style.color = '#ffffff';

            const icon = currentlyActive.querySelector('.tt-nav-link-icon');
            if (icon) {
                icon.style.color = '#ffffff';
            }
        }

        // Add click handlers to manage active states
        allSidebarLinks.forEach(link => {
            // Remove existing event listeners to avoid duplicates
            link.removeEventListener('click', handleSidebarClick);
            link.addEventListener('click', handleSidebarClick);

            // Add hover effects
            link.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active') &&
                    !this.closest('.side-nav-item').classList.contains('tt-menu-item-active')) {
                    this.style.backgroundColor = '#006633';
                    this.style.color = '#ffffff';

                    const icon = this.querySelector('.tt-nav-link-icon');
                    if (icon) {
                        icon.style.color = '#ffffff';
                    }
                }
            });

            link.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active') &&
                    !this.closest('.side-nav-item').classList.contains('tt-menu-item-active')) {
                    this.style.backgroundColor = '';
                    this.style.color = '';

                    const icon = this.querySelector('.tt-nav-link-icon');
                    if (icon) {
                        icon.style.color = '';
                    }
                }
            });
        });
    }

    // Handle sidebar link clicks to ensure single active state
    function handleSidebarClick(event) {
        // Remove active class from all sidebar items
        const allSidebarItems = document.querySelectorAll('.tt-side-nav .side-nav-item');
        allSidebarItems.forEach(item => {
            item.classList.remove('tt-menu-item-active');
        });

        const allSidebarLinks = document.querySelectorAll('.tt-side-nav .side-nav-link');
        allSidebarLinks.forEach(link => {
            link.classList.remove('active');
            link.style.backgroundColor = '';
            link.style.color = '';

            const icon = link.querySelector('.tt-nav-link-icon');
            if (icon) {
                icon.style.color = '';
            }
        });

        // Add active class to clicked item
        const clickedItem = this.closest('.side-nav-item');
        if (clickedItem) {
            clickedItem.classList.add('tt-menu-item-active');
        }

        this.classList.add('active');
        this.style.backgroundColor = '#006633';
        this.style.color = '#ffffff';

        const icon = this.querySelector('.tt-nav-link-icon');
        if (icon) {
            icon.style.color = '#ffffff';
        }
    }

    // Function to style the sidebar toggle button - Subtle approach
    function styleSidebarToggle() {
        const toggleButtons = document.querySelectorAll('.tt-toggle-sidebar');
        toggleButtons.forEach(button => {
            button.style.backgroundColor = 'transparent';
            button.style.color = '#006633';
            button.style.border = '1px solid #006633';
            button.style.borderRadius = '50%';
            button.style.padding = '6px';
            button.style.width = '32px';
            button.style.height = '32px';
            button.style.display = 'flex';
            button.style.alignItems = 'center';
            button.style.justifyContent = 'center';
            button.style.transition = 'all 0.3s ease';

            // Style the icon inside
            const icon = button.querySelector('i, svg, span');
            if (icon) {
                icon.style.color = '#006633';
                icon.style.stroke = '#006633';
                icon.style.width = '16px';
                icon.style.height = '16px';
            }

            // Add hover effects
            button.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#006633';
                this.style.color = '#ffffff';

                const icon = this.querySelector('i, svg, span');
                if (icon) {
                    icon.style.color = '#ffffff';
                    icon.style.stroke = '#ffffff';
                }
            });

            button.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
                this.style.color = '#006633';

                const icon = this.querySelector('i, svg, span');
                if (icon) {
                    icon.style.color = '#006633';
                    icon.style.stroke = '#006633';
                }
            });
        });
    }

    // Initialize single active state management
    manageSingleActiveState();

    // Style the sidebar toggle button
    styleSidebarToggle();

    // Also apply when the page is fully loaded
    window.addEventListener('load', function() {
        manageSingleActiveState();
        styleSidebarToggle();
    });

    // Monitor for dynamic content changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                setTimeout(function() {
                    manageSingleActiveState();
                    styleSidebarToggle();
                }, 100);
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});

// Simplified jQuery approach for single active state
if (typeof jQuery !== 'undefined') {
    $(document).ready(function() {
        function ensureSingleActiveState() {
            // Reset all sidebar links
            $('.tt-side-nav .side-nav-link').css({
                'background-color': '',
                'color': ''
            });
            $('.tt-side-nav .tt-nav-link-icon').css({
                'color': ''
            });

            // Apply dark green ONLY to the single active item
            const activeLink = $('.tt-side-nav .side-nav-link.active, .tt-side-nav .tt-menu-item-active > .side-nav-link').first();
            if (activeLink.length) {
                activeLink.css({
                    'background-color': '#006633',
                    'color': '#ffffff'
                });
                activeLink.find('.tt-nav-link-icon').css({
                    'color': '#ffffff'
                });
            }
        }

        ensureSingleActiveState();

        // Apply on AJAX complete
        $(document).ajaxComplete(function() {
            setTimeout(ensureSingleActiveState, 100);
        });
    });
}
