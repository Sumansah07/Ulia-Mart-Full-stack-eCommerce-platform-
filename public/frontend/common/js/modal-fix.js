/**
 * Modal Fix Script
 * This script fixes issues with Bootstrap modals
 */

(function() {
    // Function to remove stuck backdrops
    function removeModalBackdrop() {
        // Remove any modal backdrops
        $('.modal-backdrop').remove();
        
        // Remove modal-open class from body
        $('body').removeClass('modal-open');
        $('body').css('overflow', '');
        $('body').css('padding-right', '');
    }
    
    // Function to fix modals
    function fixModals() {
        // Override modal show method
        var originalModalShow = $.fn.modal.Constructor.prototype.show;
        if (originalModalShow) {
            $.fn.modal.Constructor.prototype.show = function() {
                // Remove any existing backdrops first
                removeModalBackdrop();
                // Call original show method
                originalModalShow.apply(this, arguments);
            };
        }
        
        // Override modal hide method
        var originalModalHide = $.fn.modal.Constructor.prototype.hide;
        if (originalModalHide) {
            $.fn.modal.Constructor.prototype.hide = function() {
                // Call original hide method
                originalModalHide.apply(this, arguments);
                // Make sure backdrop is removed
                setTimeout(function() {
                    if ($('.modal.show').length === 0) {
                        removeModalBackdrop();
                    }
                }, 300);
            };
        }
        
        // Fix for address modal specifically
        if (typeof addNewAddress === 'function') {
            var originalAddNewAddress = addNewAddress;
            window.addNewAddress = function() {
                // Remove any existing backdrops first
                removeModalBackdrop();
                // Call original function
                originalAddNewAddress.apply(this, arguments);
            };
        }
        
        // Fix for edit address
        if (typeof editAddress === 'function') {
            var originalEditAddress = editAddress;
            window.editAddress = function(addressId) {
                // Remove any existing backdrops first
                removeModalBackdrop();
                // Call original function
                originalEditAddress.apply(this, arguments);
            };
        }
        
        // Fix for delete address
        if (typeof deleteAddress === 'function') {
            var originalDeleteAddress = deleteAddress;
            window.deleteAddress = function(thisAnchorTag) {
                // Remove any existing backdrops first
                removeModalBackdrop();
                // Call original function
                originalDeleteAddress.apply(this, arguments);
            };
        }
    }
    
    // Add global function to fix modal issues
    window.fixModalBackdrop = removeModalBackdrop;
    
    // Run on document ready
    $(document).ready(function() {
        // Fix modals
        fixModals();
        
        // Add event listener for modal triggers
        $('[data-bs-toggle="modal"]').on('click', function() {
            console.log('Modal triggered by:', this);
        });
        
        // Check for stuck backdrops on page load
        setTimeout(removeModalBackdrop, 500);
    });
})();
