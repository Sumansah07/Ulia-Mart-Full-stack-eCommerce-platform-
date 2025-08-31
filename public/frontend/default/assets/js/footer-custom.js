// Back to Top Button Functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.querySelector('.back-to-top');

    if (backToTopButton) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            // Use scrollY instead of deprecated pageYOffset
            const scrollPosition = window.scrollY || document.documentElement.scrollTop;
            if (scrollPosition > 300) {
                backToTopButton.classList.add('active');
            } else {
                backToTopButton.classList.remove('active');
            }
        });

        // Scroll to top when clicked
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Check if we're on a mobile device
        const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

        // Adjust position for mobile devices with bottom navigation
        if (isMobile) {
            // Check if there's a bottom toolbar
            const bottomToolbar = document.querySelector('.bottom-toolbar');
            if (bottomToolbar) {
                // Get the height of the bottom toolbar
                const toolbarHeight = bottomToolbar.offsetHeight;
                // Adjust the bottom position of the back-to-top button
                backToTopButton.style.bottom = (toolbarHeight + 10) + 'px';
            }
        }
    }
});
