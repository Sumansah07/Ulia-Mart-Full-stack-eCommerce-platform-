/**
 * Fix Page Button
 * This script adds a button to fix modal backdrop issues
 */

(function() {
    // Create and add the fix button
    function addFixButton() {
        // Create button element
        var button = document.createElement('button');
        button.id = 'fix-page-button';
        button.innerHTML = 'Fix Page';
        button.style.position = 'fixed';
        button.style.bottom = '20px';
        button.style.right = '20px';
        button.style.zIndex = '9999';
        button.style.backgroundColor = '#dc3545';
        button.style.color = 'white';
        button.style.border = 'none';
        button.style.borderRadius = '4px';
        button.style.padding = '8px 15px';
        button.style.cursor = 'pointer';
        button.style.fontWeight = 'bold';
        button.style.display = 'none'; // Hidden by default
        
        // Add click event
        button.addEventListener('click', function() {
            fixPage();
            this.style.display = 'none';
        });
        
        // Add to body
        document.body.appendChild(button);
        
        // Check for issues periodically
        setInterval(checkForIssues, 1000);
    }
    
    // Function to fix page issues
    function fixPage() {
        // Remove modal backdrops
        var backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(function(backdrop) {
            backdrop.parentNode.removeChild(backdrop);
        });
        
        // Fix body
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        
        console.log('Page fixed!');
    }
    
    // Function to check for issues
    function checkForIssues() {
        var button = document.getElementById('fix-page-button');
        if (!button) return;
        
        // Check if there's a backdrop without an open modal
        var hasBackdrop = document.querySelectorAll('.modal-backdrop').length > 0;
        var hasOpenModal = document.querySelectorAll('.modal.show').length > 0;
        
        if (hasBackdrop && !hasOpenModal) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    }
    
    // Add the button when the document is ready
    if (document.readyState === 'complete') {
        addFixButton();
    } else {
        document.addEventListener('DOMContentLoaded', addFixButton);
    }
    
    // Add global function to fix page
    window.fixPage = fixPage;
})();
