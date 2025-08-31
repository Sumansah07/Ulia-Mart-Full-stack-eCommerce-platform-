/**
 * POS System Dark Green Theme JavaScript
 * Enhances the Point of Sale interface with dark green styling
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        initializePosTheme();
    });

    // Also initialize when page is fully loaded (for dynamic content)
    window.addEventListener('load', function() {
        setTimeout(initializePosTheme, 500);
    });

    function initializePosTheme() {
        console.log('Initializing POS Dark Green Theme...');

        // Apply theme to existing elements
        styleTopNavigation();
        styleScrollArrows();
        styleCategoryButtons();
        styleSearchElements();
        styleProductCards();
        styleCartElements();
        styleButtons();
        styleBillingSection();

        // Set up observers for dynamic content
        setupMutationObserver();

        console.log('POS Dark Green Theme initialized successfully');
    }

    function styleTopNavigation() {
        // Style Categories and Brands toggle buttons
        const navLinks = document.querySelectorAll('.nav-pills .nav-link, .nav-tabs .nav-link');
        navLinks.forEach(link => {
            link.style.backgroundColor = 'transparent';
            link.style.color = '#006633';
            link.style.border = '2px solid #006633';
            link.style.borderRadius = '8px';
            link.style.fontWeight = '600';
            link.style.padding = '10px 20px';
            link.style.marginRight = '8px';
            link.style.transition = 'all 0.3s ease';

            link.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = '#f0f8f4';
                    this.style.transform = 'translateY(-2px)';
                }
            });

            link.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = 'transparent';
                    this.style.transform = '';
                }
            });

            // Handle active state
            if (link.classList.contains('active')) {
                link.style.backgroundColor = '#006633';
                link.style.color = '#ffffff';
                link.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.3)';
            }
        });

        // Style Add Item by Code button
        const outlineButtons = document.querySelectorAll('.btn-outline-primary, .btn-outline-secondary');
        outlineButtons.forEach(btn => {
            btn.style.backgroundColor = 'transparent';
            btn.style.color = '#006633';
            btn.style.border = '2px solid #006633';
            btn.style.borderRadius = '8px';
            btn.style.fontWeight = '600';
            btn.style.padding = '10px 20px';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#006633';
                this.style.color = '#ffffff';
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.3)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
                this.style.color = '#006633';
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });

        // Style Customer button
        const customerButtons = document.querySelectorAll('.btn-info, .btn-customer');
        customerButtons.forEach(btn => {
            btn.style.backgroundColor = '#006633';
            btn.style.borderColor = '#006633';
            btn.style.color = '#ffffff';
            btn.style.borderRadius = '8px';
            btn.style.fontWeight = '600';
            btn.style.padding = '10px 20px';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.3)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    }

    function styleScrollArrows() {
        // Style Swiper navigation arrows
        const swiperArrows = document.querySelectorAll('.swiper-button-next, .swiper-button-prev');
        swiperArrows.forEach(arrow => {
            arrow.style.backgroundColor = '#006633';
            arrow.style.color = '#ffffff';
            arrow.style.borderRadius = '50%';
            arrow.style.width = '40px';
            arrow.style.height = '40px';
            arrow.style.marginTop = '-20px';
            arrow.style.transition = 'all 0.3s ease';
            arrow.style.boxShadow = '0 2px 8px rgba(0, 102, 51, 0.3)';

            arrow.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.transform = 'scale(1.1)';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.4)';
            });

            arrow.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.transform = '';
                this.style.boxShadow = '0 2px 8px rgba(0, 102, 51, 0.3)';
            });
        });

        // Style category and brand slider arrows specifically
        const categoryArrows = document.querySelectorAll('.category-slider .swiper-button-next, .category-slider .swiper-button-prev, .brand-slider .swiper-button-next, .brand-slider .swiper-button-prev');
        categoryArrows.forEach(arrow => {
            arrow.style.backgroundColor = '#006633';
            arrow.style.color = '#ffffff';
            arrow.style.borderRadius = '50%';
            arrow.style.width = '35px';
            arrow.style.height = '35px';
            arrow.style.marginTop = '-17.5px';
            arrow.style.transition = 'all 0.3s ease';
            arrow.style.boxShadow = '0 2px 8px rgba(0, 102, 51, 0.3)';

            arrow.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.transform = 'scale(1.1)';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.4)';
            });

            arrow.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.transform = '';
                this.style.boxShadow = '0 2px 8px rgba(0, 102, 51, 0.3)';
            });
        });

        // Style custom scroll arrows
        const customArrows = document.querySelectorAll('.scroll-arrow, .nav-arrow, .slider-arrow');
        customArrows.forEach(arrow => {
            arrow.style.backgroundColor = '#006633';
            arrow.style.color = '#ffffff';
            arrow.style.border = 'none';
            arrow.style.borderRadius = '50%';
            arrow.style.width = '35px';
            arrow.style.height = '35px';
            arrow.style.display = 'flex';
            arrow.style.alignItems = 'center';
            arrow.style.justifyContent = 'center';
            arrow.style.cursor = 'pointer';
            arrow.style.transition = 'all 0.3s ease';
            arrow.style.boxShadow = '0 2px 8px rgba(0, 102, 51, 0.3)';

            arrow.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.transform = 'scale(1.1)';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.4)';
            });

            arrow.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.transform = '';
                this.style.boxShadow = '0 2px 8px rgba(0, 102, 51, 0.3)';
            });

            // Style icons inside arrows
            const icon = arrow.querySelector('i');
            if (icon) {
                icon.style.color = '#ffffff';
                icon.style.fontSize = '14px';
            }
        });
    }

    function styleBillingSection() {
        // Style billing section headers
        const billingHeaders = document.querySelectorAll('.billing-section h5, .billing-section .card-header');
        billingHeaders.forEach(header => {
            header.style.backgroundColor = '#006633';
            header.style.color = '#ffffff';
            header.style.borderBottom = '2px solid #006633';
            header.style.padding = '12px 16px';
            header.style.borderRadius = '8px 8px 0 0';
        });

        // Style customer selection dropdown
        const customerSelects = document.querySelectorAll('.customer-select, .form-select');
        customerSelects.forEach(select => {
            select.style.borderColor = '#006633';
            select.style.transition = 'all 0.3s ease';

            select.addEventListener('focus', function() {
                this.style.borderColor = '#006633';
                this.style.boxShadow = '0 0 0 0.2rem rgba(0, 102, 51, 0.25)';
            });

            select.addEventListener('blur', function() {
                this.style.boxShadow = '';
            });
        });

        // Style New Order button
        const newOrderButtons = document.querySelectorAll('.btn-new-order, .new-order-btn');
        newOrderButtons.forEach(btn => {
            btn.style.backgroundColor = '#006633';
            btn.style.borderColor = '#006633';
            btn.style.color = '#ffffff';
            btn.style.borderRadius = '6px';
            btn.style.fontWeight = '600';
            btn.style.padding = '8px 16px';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
                this.style.transform = 'translateY(-1px)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
                this.style.transform = '';
            });
        });
    }

    function styleCategoryButtons() {
        // Style category and brand selection buttons
        const categoryButtons = document.querySelectorAll('.tt-category-brand-info');
        categoryButtons.forEach(button => {
            button.style.transition = 'all 0.3s ease';
            button.style.cursor = 'pointer';

            // Add hover effects
            button.addEventListener('mouseenter', function() {
                if (!this.previousElementSibling.checked) {
                    this.style.backgroundColor = '#f0f8f4';
                    this.style.borderColor = '#006633';
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.15)';
                }
            });

            button.addEventListener('mouseleave', function() {
                if (!this.previousElementSibling.checked) {
                    this.style.backgroundColor = '';
                    this.style.borderColor = '';
                    this.style.transform = '';
                    this.style.boxShadow = '';
                }
            });
        });

        // Style radio buttons for categories
        const radioButtons = document.querySelectorAll('input[name="category_id"], input[name="brand_id"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                updateSelectedState(this);
            });
        });
    }

    function updateSelectedState(selectedRadio) {
        // Remove selected state from all buttons of the same type
        const allRadios = document.querySelectorAll(`input[name="${selectedRadio.name}"]`);
        allRadios.forEach(radio => {
            const label = radio.nextElementSibling;
            if (label) {
                label.style.backgroundColor = '';
                label.style.color = '';
                label.style.border = '';
                label.style.transform = '';
                label.style.boxShadow = '';
            }
        });

        // Apply selected state to the chosen button
        const selectedLabel = selectedRadio.nextElementSibling;
        if (selectedLabel) {
            selectedLabel.style.backgroundColor = '#006633';
            selectedLabel.style.color = '#ffffff';
            selectedLabel.style.border = '2px solid #006633';
            selectedLabel.style.transform = 'scale(1.02)';
            selectedLabel.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.3)';

            // Style text elements inside
            const textElements = selectedLabel.querySelectorAll('h6, span, .tt-available-item');
            textElements.forEach(el => {
                el.style.color = '#ffffff';
            });

            // Style icon box
            const iconBox = selectedLabel.querySelector('.tt-icon-box');
            if (iconBox) {
                iconBox.style.backgroundColor = 'rgba(255, 255, 255, 0.2)';
                iconBox.style.border = '2px solid rgba(255, 255, 255, 0.3)';
            }
        }
    }

    function styleSearchElements() {
        // Style search inputs
        const searchInputs = document.querySelectorAll('.tt-search-box input, input[name="search"]');
        searchInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#006633';
                this.style.boxShadow = '0 0 0 0.2rem rgba(0, 102, 51, 0.25)';
            });

            input.addEventListener('blur', function() {
                this.style.borderColor = '';
                this.style.boxShadow = '';
            });
        });

        // Style search buttons
        const searchButtons = document.querySelectorAll('.btn-secondary, button[onclick="getPosProducts()"]');
        searchButtons.forEach(button => {
            button.style.backgroundColor = '#006633';
            button.style.borderColor = '#006633';
            button.style.color = '#ffffff';
            button.style.transition = 'all 0.3s ease';

            button.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
                this.style.transform = 'translateY(-1px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
                this.style.transform = '';
            });
        });
    }

    function styleProductCards() {
        // Style product cards
        const productCards = document.querySelectorAll('.tt-single-pos-item, .tt-pos-product-card');
        productCards.forEach(card => {
            card.style.transition = 'all 0.3s ease';
            card.style.cursor = 'pointer';

            card.addEventListener('mouseenter', function() {
                this.style.borderColor = '#006633';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.15)';
                this.style.transform = 'translateY(-2px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.borderColor = '';
                this.style.boxShadow = '';
                this.style.transform = '';
            });
        });

        // Style product prices
        const priceElements = document.querySelectorAll('.product-price, .price, .tt-pos-product-price');
        priceElements.forEach(price => {
            price.style.color = '#006633';
            price.style.fontWeight = '600';
        });
    }

    function styleCartElements() {
        // Style cart total section
        const cartTotals = document.querySelectorAll('.tt-pos-cart-total, .cart-total, .total-amount');
        cartTotals.forEach(total => {
            total.style.borderTopColor = '#006633';
            total.style.color = '#006633';
            total.style.fontWeight = '700';
        });

        // Style quantity buttons
        const qtyButtons = document.querySelectorAll('.qty-btn, .quantity-btn, .btn-qty');
        qtyButtons.forEach(btn => {
            btn.style.backgroundColor = '#006633';
            btn.style.borderColor = '#006633';
            btn.style.color = '#ffffff';
            btn.style.width = '32px';
            btn.style.height = '32px';
            btn.style.borderRadius = '4px';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
            });
        });
    }

    function styleButtons() {
        // Style primary buttons
        const primaryButtons = document.querySelectorAll('.btn-primary');
        primaryButtons.forEach(btn => {
            btn.style.backgroundColor = '#006633';
            btn.style.borderColor = '#006633';
            btn.style.color = '#ffffff';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
                this.style.transform = 'translateY(-1px)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
                this.style.transform = '';
            });
        });

        // Style checkout buttons
        const checkoutButtons = document.querySelectorAll('.tt-pos-checkout-btn, .checkout-btn');
        checkoutButtons.forEach(btn => {
            btn.style.backgroundColor = '#006633';
            btn.style.borderColor = '#006633';
            btn.style.color = '#ffffff';
            btn.style.fontWeight = '600';
            btn.style.padding = '12px 24px';
            btn.style.borderRadius = '8px';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
                this.style.transform = 'translateY(-1px)';
                this.style.boxShadow = '0 4px 12px rgba(0, 102, 51, 0.3)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });

        // Style add to cart buttons
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn, .cart-btn');
        addToCartButtons.forEach(btn => {
            btn.style.backgroundColor = '#006633';
            btn.style.borderColor = '#006633';
            btn.style.color = '#ffffff';
            btn.style.borderRadius = '6px';
            btn.style.padding = '8px 16px';
            btn.style.fontWeight = '500';
            btn.style.transition = 'all 0.3s ease';

            btn.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
                this.style.transform = 'translateY(-1px)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
                this.style.transform = '';
            });
        });
    }

    function setupMutationObserver() {
        // Watch for dynamically added content
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                    // Re-apply styling to new elements
                    setTimeout(function() {
                        styleTopNavigation();
                        styleCategoryButtons();
                        styleSearchElements();
                        styleProductCards();
                        styleCartElements();
                        styleButtons();
                        styleBillingSection();
                    }, 100);
                }
            });
        });

        // Start observing
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    // Expose functions globally for manual triggering if needed
    window.posTheme = {
        reinitialize: initializePosTheme,
        styleTopNavigation: styleTopNavigation,
        styleCategoryButtons: styleCategoryButtons,
        styleSearchElements: styleSearchElements,
        styleProductCards: styleProductCards,
        styleCartElements: styleCartElements,
        styleButtons: styleButtons,
        styleBillingSection: styleBillingSection
    };

})();
