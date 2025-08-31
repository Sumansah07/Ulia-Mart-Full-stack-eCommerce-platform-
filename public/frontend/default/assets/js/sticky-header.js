/* Professional Sticky Header JavaScript */

class StickyHeader {
    constructor() {
        this.header = null;
        this.lastScrollTop = 0;
        this.scrollThreshold = 100;
        this.hideThreshold = 50;
        this.isSticky = false;
        this.isHidden = false;
        this.headerHeight = 0;
        this.ticking = false;
        
        this.init();
    }
    
    init() {
        // Find header element - look for the wrapper that contains everything
        this.header = document.querySelector('.header-sticky') ||
                     document.querySelector('.header-wrapper') ||
                     document.querySelector('header');

        if (!this.header) {
            console.warn('Sticky header: No header element found');
            return;
        }

        // Calculate initial header height
        this.calculateHeaderHeight();

        // Bind events
        this.bindEvents();

        // Initial check
        this.handleScroll();
    }
    
    calculateHeaderHeight() {
        if (this.header) {
            this.headerHeight = this.header.offsetHeight;
            document.documentElement.style.setProperty('--header-height', this.headerHeight + 'px');
        }
    }
    
    bindEvents() {
        // Optimized scroll event with requestAnimationFrame
        window.addEventListener('scroll', () => {
            if (!this.ticking) {
                requestAnimationFrame(() => {
                    this.handleScroll();
                    this.ticking = false;
                });
                this.ticking = true;
            }
        }, { passive: true });
        
        // Recalculate on resize
        window.addEventListener('resize', () => {
            this.calculateHeaderHeight();
        }, { passive: true });
        
        // Recalculate when images load (logo, etc.)
        window.addEventListener('load', () => {
            setTimeout(() => {
                this.calculateHeaderHeight();
            }, 100);
        });
    }
    
    handleScroll() {
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollDirection = currentScrollTop > this.lastScrollTop ? 'down' : 'up';
        const scrollDistance = Math.abs(currentScrollTop - this.lastScrollTop);
        
        // Make header sticky
        if (currentScrollTop > this.scrollThreshold && !this.isSticky) {
            this.makeSticky();
        } else if (currentScrollTop <= this.scrollThreshold && this.isSticky) {
            this.removeSticky();
        }
        
        // Smart hide/show based on scroll direction (only when sticky)
        if (this.isSticky) {
            if (scrollDirection === 'down' && scrollDistance > this.hideThreshold && !this.isHidden) {
                this.hideHeader();
            } else if (scrollDirection === 'up' && scrollDistance > this.hideThreshold && this.isHidden) {
                this.showHeader();
            }
        }
        
        this.lastScrollTop = currentScrollTop;
    }
    
    makeSticky() {
        if (!this.header || this.isSticky) return;
        
        this.isSticky = true;
        
        // Add sticky classes
        this.header.classList.add('sticky-on');
        document.body.classList.add('sticky-header-active');
        
        // Create spacer to prevent content jump
        this.createSpacer();
        
        // Trigger custom event
        this.dispatchEvent('stickyHeaderActivated');
    }
    
    removeSticky() {
        if (!this.header || !this.isSticky) return;
        
        this.isSticky = false;
        this.isHidden = false;
        
        // Remove sticky classes
        this.header.classList.remove('sticky-on', 'scroll-up', 'scroll-down');
        document.body.classList.remove('sticky-header-active');
        
        // Remove spacer
        this.removeSpacer();
        
        // Trigger custom event
        this.dispatchEvent('stickyHeaderDeactivated');
    }
    
    hideHeader() {
        if (!this.header || this.isHidden) return;
        
        this.isHidden = true;
        this.header.classList.add('scroll-down');
        this.header.classList.remove('scroll-up');
        
        // Trigger custom event
        this.dispatchEvent('stickyHeaderHidden');
    }
    
    showHeader() {
        if (!this.header || !this.isHidden) return;
        
        this.isHidden = false;
        this.header.classList.add('scroll-up');
        this.header.classList.remove('scroll-down');
        
        // Trigger custom event
        this.dispatchEvent('stickyHeaderShown');
    }
    
    createSpacer() {
        // Remove existing spacer
        this.removeSpacer();
        
        // Create new spacer
        const spacer = document.createElement('div');
        spacer.className = 'sticky-header-spacer';
        spacer.style.height = this.headerHeight + 'px';
        
        // Insert spacer after header
        this.header.parentNode.insertBefore(spacer, this.header.nextSibling);
    }
    
    removeSpacer() {
        const existingSpacer = document.querySelector('.sticky-header-spacer');
        if (existingSpacer) {
            existingSpacer.remove();
        }
    }
    
    dispatchEvent(eventName) {
        const event = new CustomEvent(eventName, {
            detail: {
                header: this.header,
                isSticky: this.isSticky,
                isHidden: this.isHidden
            }
        });
        window.dispatchEvent(event);
    }
    
    // Public methods
    forceSticky() {
        this.makeSticky();
    }
    
    forceUnsticky() {
        this.removeSticky();
    }
    
    forceShow() {
        this.showHeader();
    }
    
    forceHide() {
        this.hideHeader();
    }
    
    getState() {
        return {
            isSticky: this.isSticky,
            isHidden: this.isHidden,
            headerHeight: this.headerHeight,
            scrollPosition: window.pageYOffset || document.documentElement.scrollTop
        };
    }
}

// Initialize sticky header when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Wait a bit for other scripts to load
    setTimeout(() => {
        window.stickyHeader = new StickyHeader();
    }, 100);
});

// Expose global functions for manual control
window.stickyHeaderForceSticky = function() {
    if (window.stickyHeader) {
        window.stickyHeader.forceSticky();
    }
};

window.stickyHeaderForceUnsticky = function() {
    if (window.stickyHeader) {
        window.stickyHeader.forceUnsticky();
    }
};

window.stickyHeaderForceShow = function() {
    if (window.stickyHeader) {
        window.stickyHeader.forceShow();
    }
};

window.stickyHeaderForceHide = function() {
    if (window.stickyHeader) {
        window.stickyHeader.forceHide();
    }
};

window.getStickyHeaderState = function() {
    if (window.stickyHeader) {
        return window.stickyHeader.getState();
    }
    return null;
};

// Event listeners for integration with other components
window.addEventListener('stickyHeaderActivated', function(e) {
    console.log('Sticky header activated');
});

window.addEventListener('stickyHeaderDeactivated', function(e) {
    console.log('Sticky header deactivated');
});

window.addEventListener('stickyHeaderHidden', function(e) {
    console.log('Sticky header hidden');
});

window.addEventListener('stickyHeaderShown', function(e) {
    console.log('Sticky header shown');
});

// Override the existing sticky header functionality if it exists
document.addEventListener('DOMContentLoaded', function() {
    // Disable the old sticky header code
    if (typeof jQuery !== 'undefined') {
        jQuery(window).off('scroll.stickyHeader');
        
        // Remove old sticky functionality
        setTimeout(() => {
            const oldStickyElements = document.querySelectorAll('.sticky-on');
            oldStickyElements.forEach(el => {
                if (!el.classList.contains('cart-sidebar')) {
                    el.classList.remove('sticky-on');
                }
            });
        }, 200);
    }
});
