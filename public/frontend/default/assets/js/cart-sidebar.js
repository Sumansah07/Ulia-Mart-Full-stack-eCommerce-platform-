/* Shopping Cart Sidebar JavaScript */

class CartSidebar {
    constructor() {
        this.sidebar = null;
        this.isOpen = false;
        this.autoShowTimeout = null;
        this.mainWrapper = null;

        this.init();
    }
    
    init() {
        // Create sidebar HTML if it doesn't exist
        this.createSidebar();

        // Bind events
        this.bindEvents();

        // Override the existing updateCarts function
        this.overrideUpdateCarts();

        // Load initial cart data
        setTimeout(() => {
            this.loadCurrentCartData();
        }, 100);
    }
    
    createSidebar() {
        // Check if sidebar already exists
        if (document.querySelector('.cart-sidebar')) {
            this.sidebar = document.querySelector('.cart-sidebar');
            this.mainWrapper = document.querySelector('.main-wrapper');
            return;
        }

        // Get main wrapper reference
        this.mainWrapper = document.querySelector('.main-wrapper');
        
        // Create sidebar
        this.sidebar = document.createElement('div');
        this.sidebar.className = 'cart-sidebar';
        this.sidebar.innerHTML = `
            <div class="cart-sidebar-header">
                <h3 class="cart-sidebar-title">My Cart - <span class="cart-date">${this.getCurrentDate()}</span></h3>
                <button class="cart-close-btn" type="button">×</button>
                <div class="cart-header-info">
                    <span class="cart-items-count">0 / 0 items confirmed</span>
                </div>
                <div class="cart-header-controls">
                    <button class="cart-control-btn clear-cart-btn" type="button">
                        <i class="fa-solid fa-trash"></i> Clear cart
                    </button>
                    <button class="cart-control-btn search-cart-btn" type="button">
                        <i class="fa-solid fa-search"></i> Search cart
                    </button>
                </div>
                <div class="cart-search-box" style="display: none;">
                    <input type="text" class="cart-search-input" placeholder="Search items in cart...">
                    <button class="cart-search-close" type="button">×</button>
                </div>
            </div>
            <div class="cart-sidebar-content">
                <div class="cart-add-item-section">
                    <button class="cart-add-item-btn" type="button">
                        <i class="fa-solid fa-plus"></i> Add new item
                    </button>
                </div>
                <div class="cart-sidebar-items">
                    <!-- Cart items will be loaded here -->
                </div>
                <div class="cart-sidebar-summary">
                    <!-- Cart summary will be loaded here -->
                </div>
            </div>
            <div class="cart-sidebar-actions">
                <button class="cart-action-btn primary" onclick="window.location.href='/checkout'">
                    Proceed to Checkout
                </button>
            </div>
        `;
        
        document.body.appendChild(this.sidebar);

        // Bind new control events
        this.bindControlEvents();
    }

    getCurrentDate() {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'short',
            day: '2-digit'
        };
        return new Date().toLocaleDateString('en-US', options);
    }

    bindControlEvents() {
        // Clear cart button
        const clearBtn = this.sidebar.querySelector('.clear-cart-btn');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => this.clearCart());
        }

        // Search cart button
        const searchBtn = this.sidebar.querySelector('.search-cart-btn');
        if (searchBtn) {
            searchBtn.addEventListener('click', () => this.toggleSearch());
        }

        // Search close button
        const searchCloseBtn = this.sidebar.querySelector('.cart-search-close');
        if (searchCloseBtn) {
            searchCloseBtn.addEventListener('click', () => this.closeSearch());
        }

        // Search input
        const searchInput = this.sidebar.querySelector('.cart-search-input');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => this.searchItems(e.target.value));
        }

        // Add new item button
        const addItemBtn = this.sidebar.querySelector('.cart-add-item-btn');
        if (addItemBtn) {
            addItemBtn.addEventListener('click', () => this.addNewItem());
        }
    }

    bindEvents() {
        // Close button
        const closeBtn = this.sidebar.querySelector('.cart-close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.hide());
        }

        // Escape key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.hide();
            }
        });

        // Click outside to close (works on both desktop and mobile)
        const handleOutsideClick = (e) => {
            if (this.isOpen && this.sidebar) {
                // Check if click is outside the sidebar and not on cart icons
                const isClickInsideSidebar = this.sidebar.contains(e.target);
                const isClickOnCartIcon = e.target.closest('.header-icon, .cart-icon, .fa-shopping-cart, .cart-counter, .cart-amount');

                if (!isClickInsideSidebar && !isClickOnCartIcon) {
                    this.hide();
                }
            }
        };

        // Add both click and touchstart events for mobile compatibility
        document.addEventListener('click', handleOutsideClick);
        document.addEventListener('touchstart', handleOutsideClick);

        // Handle window resize for responsive behavior
        window.addEventListener('resize', () => {
            if (this.isOpen && this.mainWrapper) {
                // Always keep body class for cart dropdown hiding
                document.body.classList.add('cart-sidebar-open');

                if (window.innerWidth > 768) {
                    // Desktop: push content
                    this.mainWrapper.classList.add('cart-sidebar-open');
                } else {
                    // Mobile: overlay mode (don't push content)
                    this.mainWrapper.classList.remove('cart-sidebar-open');
                }
            }
        });
    }
    
    show() {
        this.isOpen = true;
        this.sidebar.classList.add('show');

        // Add class to body for both desktop and mobile (needed for hiding cart dropdown)
        document.body.classList.add('cart-sidebar-open');

        // Add class to main wrapper to push content left (desktop only)
        if (this.mainWrapper && window.innerWidth > 768) {
            this.mainWrapper.classList.add('cart-sidebar-open');
        }

        // Load current cart data when sidebar is opened manually
        this.loadCurrentCartData();

        // Add cart icon bounce animation
        const cartIcons = document.querySelectorAll('.header-icon, .cart-icon');
        cartIcons.forEach(icon => {
            icon.classList.add('cart-icon-bounce');
            setTimeout(() => icon.classList.remove('cart-icon-bounce'), 600);
        });
    }
    
    hide() {
        this.isOpen = false;
        this.sidebar.classList.remove('show');

        // Remove class from main wrapper to restore content position
        if (this.mainWrapper) {
            this.mainWrapper.classList.remove('cart-sidebar-open');
            document.body.classList.remove('cart-sidebar-open');
        }
    }
    
    toggle() {
        if (this.isOpen) {
            this.hide();
        } else {
            this.show();
        }
    }

    loadCurrentCartData() {
        // Try multiple selectors to find cart data
        const cartNavWrapper = document.querySelector('.cart-navbar-wrapper .simplebar-content') ||
                              document.querySelector('.cart-navbar-wrapper') ||
                              document.querySelector('.cart-box-wrapper .cart-navbar-wrapper');

        const cartCounter = document.querySelector('.cart-counter:not(.d-none)') ||
                           document.querySelector('.cart-counter');

        const subTotalElement = document.querySelector('.sub-total-price') ||
                               document.querySelector('.cart-amount') ||
                               document.querySelector('.cart-subtotal');

        // Get cart count
        let cartCount = 0;
        if (cartCounter && !cartCounter.classList.contains('d-none')) {
            cartCount = parseInt(cartCounter.textContent.trim()) || 0;
        }

        // Get subtotal
        let subTotal = 'Rs 0';
        if (subTotalElement) {
            subTotal = subTotalElement.textContent.trim();
        }

        // Get cart HTML
        let cartsHtml = '';
        if (cartNavWrapper) {
            cartsHtml = cartNavWrapper.innerHTML;
        }

        // Create cart data object similar to what updateCarts receives
        const cartData = {
            cartCount: cartCount,
            subTotal: subTotal,
            navCarts: cartsHtml,
            carts: cartsHtml
        };

        // Update sidebar content
        this.updateContent(cartData);
    }
    
    updateContent(cartData) {
        const itemsContainer = this.sidebar.querySelector('.cart-sidebar-items');
        const summaryContainer = this.sidebar.querySelector('.cart-sidebar-summary');
        const itemsCountElement = this.sidebar.querySelector('.cart-items-count');

        // Update items count
        const cartCount = cartData ? cartData.cartCount || 0 : 0;
        if (itemsCountElement) {
            itemsCountElement.textContent = `${cartCount} / ${cartCount} items confirmed`;
        }

        if (!cartData || cartData.cartCount === 0) {
            // Show empty cart
            itemsContainer.innerHTML = `
                <div class="cart-sidebar-empty">
                    <img src="/frontend/default/assets/img/empty-cart.svg" alt="Empty Cart">
                    <h3>Your cart is empty</h3>
                    <p>Add some products to get started!</p>
                </div>
            `;
            summaryContainer.innerHTML = '';
            return;
        }

        // Use navCarts if available, otherwise use carts
        const cartsHtml = cartData.navCarts || cartData.carts;

        // Update items
        itemsContainer.innerHTML = this.renderCartItems(cartsHtml);

        // Update summary
        summaryContainer.innerHTML = this.renderCartSummary(cartData);
    }
    
    renderCartItems(carts) {
        if (!carts) {
            return `
                <div class="cart-sidebar-empty">
                    <img src="/frontend/default/assets/img/empty-cart.svg" alt="Empty Cart">
                    <h3>Your cart is empty</h3>
                    <p>Add some products to get started!</p>
                </div>
            `;
        }

        // Parse the HTML string to extract cart items
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = carts;
        const cartItems = tempDiv.querySelectorAll('li');

        // Check if we have any actual cart items (not just empty cart message)
        const hasRealItems = Array.from(cartItems).some(item =>
            item.querySelector('img') &&
            item.querySelector('.product_title, .cart-item-title, h6') &&
            item.querySelector('.price')
        );

        if (!hasRealItems) {
            return `
                <div class="cart-sidebar-empty">
                    <img src="/frontend/default/assets/img/empty-cart.svg" alt="Empty Cart">
                    <h3>Your cart is empty</h3>
                    <p>Add some products to get started!</p>
                </div>
            `;
        }

        let itemsHtml = '';
        cartItems.forEach(item => {
            const img = item.querySelector('img');
            const title = item.querySelector('.product_title, .cart-item-title, h6, .product-title');
            const price = item.querySelector('.price');
            const count = item.querySelector('.count');
            const removeBtn = item.querySelector('.remove_cart_btn, button[onclick*="handleCartItem"]');

            // Skip empty cart items
            if (!img || !title || !price || img.src.includes('empty-cart.svg')) {
                return;
            }

            const cartId = removeBtn ? (removeBtn.getAttribute('onclick').match(/\d+/) || [''])[0] : '';
            const quantity = count ? count.textContent.replace('x ', '').trim() : '1';

            itemsHtml += `
                <div class="cart-sidebar-item">
                    <img src="${img.src}" alt="${title.textContent.trim()}" class="cart-item-image">
                    <div class="cart-item-details">
                        <div class="cart-item-name">${title.textContent.trim()}</div>
                        <div class="cart-item-price">${price.textContent.trim()}</div>
                        <div class="cart-item-quantity">
                            <button class="qty-btn" onclick="handleCartItem('decrease', ${cartId})">-</button>
                            <input type="text" class="qty-input" value="${quantity}" readonly>
                            <button class="qty-btn" onclick="handleCartItem('increase', ${cartId})">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" onclick="handleCartItem('delete', ${cartId})">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            `;
        });

        return itemsHtml || `
            <div class="cart-sidebar-empty">
                <img src="/frontend/default/assets/img/empty-cart.svg" alt="Empty Cart">
                <h3>Your cart is empty</h3>
                <p>Add some products to get started!</p>
            </div>
        `;
    }

    clearCart() {
        // Use SweetAlert2-style confirmation with Toastr
        this.showConfirmation(
            'Clear Cart',
            'Are you sure you want to clear all items from your cart?',
            'warning',
            () => {
                // Find all remove buttons and click them
                const removeButtons = this.sidebar.querySelectorAll('.cart-item-remove');
                let itemsRemoved = 0;

                removeButtons.forEach(btn => {
                    const onclickAttr = btn.getAttribute('onclick');
                    if (onclickAttr) {
                        // Execute the onclick function
                        eval(onclickAttr);
                        itemsRemoved++;
                    }
                });

                // Show success message using existing notifyMe function
                if (itemsRemoved > 0) {
                    this.showToast('success', `Cart cleared successfully! ${itemsRemoved} items removed.`);
                } else {
                    this.showToast('info', 'Cart is already empty.');
                }
            }
        );
    }

    toggleSearch() {
        const searchBox = this.sidebar.querySelector('.cart-search-box');
        const searchInput = this.sidebar.querySelector('.cart-search-input');

        if (searchBox.style.display === 'none') {
            searchBox.style.display = 'block';
            searchInput.focus();
        } else {
            this.closeSearch();
        }
    }

    closeSearch() {
        const searchBox = this.sidebar.querySelector('.cart-search-box');
        const searchInput = this.sidebar.querySelector('.cart-search-input');

        searchBox.style.display = 'none';
        searchInput.value = '';
        this.searchItems(''); // Clear search results
    }

    searchItems(query) {
        const items = this.sidebar.querySelectorAll('.cart-sidebar-item');
        const lowerQuery = query.toLowerCase();

        items.forEach(item => {
            const itemName = item.querySelector('.cart-item-name');
            if (itemName) {
                const text = itemName.textContent.toLowerCase();
                if (text.includes(lowerQuery) || query === '') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            }
        });
    }

    addNewItem() {
        // Redirect to products page or show product search
        window.location.href = '/products';
    }

    showToast(type, message) {
        // Use the existing notifyMe function from the project
        if (typeof notifyMe === 'function') {
            notifyMe(type, message);
        } else {
            // Fallback to toastr directly if notifyMe is not available
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    "timeOut": "5000",
                    "closeButton": true,
                    "positionClass": "toast-top-center",
                };
                toastr[type](message);
            } else {
                // Final fallback to console
                console.log(`${type.toUpperCase()}: ${message}`);
            }
        }
    }

    showConfirmation(title, message, type, onConfirm, onCancel = null) {
        // Create a beautiful confirmation modal
        const modal = document.createElement('div');
        modal.className = 'cart-confirmation-modal';
        modal.innerHTML = `
            <div class="cart-confirmation-overlay">
                <div class="cart-confirmation-dialog">
                    <div class="cart-confirmation-header">
                        <div class="cart-confirmation-icon cart-confirmation-icon-${type}">
                            <i class="fa-solid ${this.getIconForType(type)}"></i>
                        </div>
                        <h3 class="cart-confirmation-title">${title}</h3>
                    </div>
                    <div class="cart-confirmation-body">
                        <p class="cart-confirmation-message">${message}</p>
                    </div>
                    <div class="cart-confirmation-footer">
                        <button class="cart-confirmation-btn cart-confirmation-btn-cancel" type="button">
                            Cancel
                        </button>
                        <button class="cart-confirmation-btn cart-confirmation-btn-confirm" type="button">
                            Yes, Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Add event listeners
        const confirmBtn = modal.querySelector('.cart-confirmation-btn-confirm');
        const cancelBtn = modal.querySelector('.cart-confirmation-btn-cancel');
        const overlay = modal.querySelector('.cart-confirmation-overlay');

        const closeModal = () => {
            modal.remove();
            if (onCancel) onCancel();
        };

        confirmBtn.addEventListener('click', () => {
            modal.remove();
            if (onConfirm) onConfirm();
        });

        cancelBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeModal();
        });

        // Close on Escape key
        const handleEscape = (e) => {
            if (e.key === 'Escape') {
                closeModal();
                document.removeEventListener('keydown', handleEscape);
            }
        };
        document.addEventListener('keydown', handleEscape);
    }

    getIconForType(type) {
        const icons = {
            'warning': 'fa-triangle-exclamation',
            'error': 'fa-circle-xmark',
            'success': 'fa-circle-check',
            'info': 'fa-circle-info'
        };
        return icons[type] || 'fa-circle-info';
    }

    renderCartSummary(cartData) {
        return `
            <div class="cart-summary-row">
                <span>Subtotal (${cartData.cartCount} items)</span>
                <span class="cart-summary-price">${cartData.subTotal}</span>
            </div>
            <div class="cart-summary-row total">
                <span>Total</span>
                <span class="cart-summary-price">${cartData.subTotal}</span>
            </div>
        `;
    }
    
    overrideUpdateCarts() {
        // Store original function
        if (typeof window.originalUpdateCarts === 'undefined' && typeof window.updateCarts === 'function') {
            window.originalUpdateCarts = window.updateCarts;
        }

        // Store previous cart count to detect additions
        let previousCartCount = 0;

        // Override with enhanced version
        const self = this;
        window.updateCarts = function(data) {
            // Call original function
            if (window.originalUpdateCarts) {
                window.originalUpdateCarts(data);
            }

            // Update sidebar content
            self.updateContent(data);

            // Auto-show sidebar when items are added (not when removed or on page load)
            const currentCartCount = data.cartCount || 0;
            const isItemAdded = currentCartCount > previousCartCount;

            if (isItemAdded && currentCartCount > 0 && !self.isOpen) {
                // Clear any existing timeout
                if (self.autoShowTimeout) {
                    clearTimeout(self.autoShowTimeout);
                }

                // Show sidebar after a short delay
                self.autoShowTimeout = setTimeout(() => {
                    self.show();
                }, 500);
            }

            // Update previous count for next comparison
            previousCartCount = currentCartCount;

            // Animate cart counter
            const cartCounters = document.querySelectorAll('.cart-counter');
            cartCounters.forEach(counter => {
                counter.classList.add('cart-counter-animate');
                setTimeout(() => counter.classList.remove('cart-counter-animate'), 500);
            });
        };
    }
}

// Initialize cart sidebar when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.cartSidebar = new CartSidebar();
    
    // Add click handler to cart icons to toggle sidebar
    document.addEventListener('click', function(e) {
        const cartIcon = e.target.closest('.header-icon, .cart-icon');
        if (cartIcon && cartIcon.querySelector('.fa-shopping-cart, .cart-counter')) {
            e.preventDefault();
            window.cartSidebar.toggle();
        }
    });
});

// Expose functions globally for easy access
window.showCartSidebar = function() {
    if (window.cartSidebar) {
        window.cartSidebar.show();
    }
};

window.hideCartSidebar = function() {
    if (window.cartSidebar) {
        window.cartSidebar.hide();
    }
};

window.toggleCartSidebar = function() {
    if (window.cartSidebar) {
        window.cartSidebar.toggle();
    }
};
