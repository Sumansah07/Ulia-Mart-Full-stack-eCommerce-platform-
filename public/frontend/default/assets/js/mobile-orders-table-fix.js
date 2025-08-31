/**
 * Mobile Orders Table Fix JavaScript
 * Adds touch-friendly horizontal scrolling to order tables on mobile devices
 */

document.addEventListener('DOMContentLoaded', function() {
    // Only run on mobile devices
    if (window.innerWidth <= 767) {
        initMobileOrdersTable();
    }

    // Also run on resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 767) {
            initMobileOrdersTable();
        }
    });
});

/**
 * Initialize mobile orders table
 */
function initMobileOrdersTable() {
    const tableContainers = document.querySelectorAll('.orders-table-container');

    if (tableContainers.length === 0) return;

    tableContainers.forEach(container => {
        // Make sure the table is properly sized
        const table = container.querySelector('table');
        if (table) {
            // Ensure the table has the right classes
            table.classList.add('orders-table');

            // Add touch events for better mobile scrolling
            addTouchScrolling(container);
        }
    });
}

/**
 * Add touch scrolling to container
 */
function addTouchScrolling(element) {
    let startX, scrollLeft;

    element.addEventListener('touchstart', function(e) {
        startX = e.touches[0].pageX - element.offsetLeft;
        scrollLeft = element.scrollLeft;
    }, { passive: true });

    element.addEventListener('touchmove', function(e) {
        if (!startX) return;

        const x = e.touches[0].pageX - element.offsetLeft;
        const walk = (x - startX) * 1.5; // Scroll speed multiplier
        element.scrollLeft = scrollLeft - walk;
    }, { passive: true });

    element.addEventListener('touchend', function() {
        startX = null;
    }, { passive: true });
}

/**
 * Check if container is scrollable horizontally
 */
function isScrollable(element) {
    return element.scrollWidth > element.clientWidth;
}

/**
 * Add visual feedback when scrolling
 * This function is not currently used but kept for future reference
 */
function addScrollFeedback(container) {
    container.addEventListener('scroll', function() {
        // Add a class when scrolling
        container.classList.add('is-scrolling');

        // Remove the class after scrolling stops
        clearTimeout(container.scrollTimeout);
        container.scrollTimeout = setTimeout(() => {
            container.classList.remove('is-scrolling');
        }, 200);
    });
}
