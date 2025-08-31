// Admin Panel Button Color Override
document.addEventListener('DOMContentLoaded', function() {
    // Direct targeting of specific buttons in the admin dashboard
    const specificButtons = [
        document.querySelector('a.btn[href*="add-product"]'),
        document.querySelector('a.btn[href*="manage-sales"]')
    ];

    specificButtons.forEach(button => {
        if (button) {
            button.style.backgroundColor = '#006633';
            button.style.borderColor = '#006633';
            button.style.color = 'white';

            // Add hover effect
            button.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
            });

            button.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
            });
        }
    });
    // Target "Add Product" button
    const addProductButtons = document.querySelectorAll('a[class*="btn"]:not(.btn-primary):not(.btn-success):not(.btn-info)');
    addProductButtons.forEach(button => {
        if (button.textContent.trim().includes('Add Product') ||
            button.textContent.trim().includes('Add') ||
            button.textContent.trim().includes('Create')) {
            button.style.backgroundColor = '#006633';
            button.style.borderColor = '#006633';
            button.style.color = 'white';

            // Add hover effect
            button.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
            });

            button.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
            });
        }
    });

    // Target "View All" buttons
    const viewAllButtons = document.querySelectorAll('a[class*="btn"]:not(.btn-primary):not(.btn-success):not(.btn-info)');
    viewAllButtons.forEach(button => {
        if (button.textContent.trim().includes('View All')) {
            button.style.backgroundColor = '#006633';
            button.style.borderColor = '#006633';
            button.style.color = 'white';

            // Add hover effect
            button.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#004d26';
                this.style.borderColor = '#004d26';
            });

            button.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#006633';
                this.style.borderColor = '#006633';
            });
        }
    });

    // Target any other green buttons that might not be covered by CSS
    const allButtons = document.querySelectorAll('button, a[class*="btn"]');
    allButtons.forEach(button => {
        const computedStyle = window.getComputedStyle(button);
        const bgColor = computedStyle.backgroundColor;

        // Check if the button has a green background (but not our dark green)
        if (bgColor.includes('rgb(') && !bgColor.includes('rgb(0, 102, 51)')) {
            const rgb = bgColor.match(/\d+/g);
            if (rgb && rgb.length >= 3) {
                const r = parseInt(rgb[0]);
                const g = parseInt(rgb[1]);
                const b = parseInt(rgb[2]);

                // If it's a greenish color (more green than red or blue)
                if (g > r && g > b) {
                    button.style.backgroundColor = '#006633';
                    button.style.borderColor = '#006633';
                    button.style.color = 'white';

                    // Add hover effect
                    button.addEventListener('mouseenter', function() {
                        this.style.backgroundColor = '#004d26';
                        this.style.borderColor = '#004d26';
                    });

                    button.addEventListener('mouseleave', function() {
                        this.style.backgroundColor = '#006633';
                        this.style.borderColor = '#006633';
                    });
                }
            }
        }
    });

    // jQuery approach for more reliable targeting
    if (typeof jQuery !== 'undefined') {
        $(document).ready(function() {
            // Target specific buttons by text content
            $('a.btn, button.btn').each(function() {
                const buttonText = $(this).text().trim();
                if (
                    buttonText.includes('Add Product') ||
                    buttonText.includes('Manage Sales') ||
                    buttonText.includes('View All')
                ) {
                    $(this).css({
                        'background-color': '#006633',
                        'border-color': '#006633',
                        'color': 'white'
                    });

                    $(this).hover(
                        function() {
                            $(this).css({
                                'background-color': '#004d26',
                                'border-color': '#004d26'
                            });
                        },
                        function() {
                            $(this).css({
                                'background-color': '#006633',
                                'border-color': '#006633'
                            });
                        }
                    );
                }
            });

            // Target buttons by class that might be added dynamically
            $(document).on('mouseover', '.btn-success, .btn-primary, .btn-info', function() {
                $(this).css({
                    'background-color': '#006633',
                    'border-color': '#006633',
                    'color': 'white'
                });
            });
        });
    }
});
