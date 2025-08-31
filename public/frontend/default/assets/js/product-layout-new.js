// Product Layout New JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Product Tabs
    initProductTabs();
    
    // Product Image Gallery
    initProductGallery();
    
    // Quantity Buttons
    initQuantityButtons();
    
    // Mobile Tabs Accordion
    initMobileTabsAccordion();
});

// Initialize Product Tabs
function initProductTabs() {
    const tabLinks = document.querySelectorAll('.product-tabs li');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if (tabLinks.length > 0) {
        tabLinks.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('rel');
                
                // Remove active class from all tabs
                tabLinks.forEach(t => t.classList.remove('active'));
                
                // Add active class to current tab
                this.classList.add('active');
                
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.style.display = 'none';
                });
                
                // Show current tab content
                document.getElementById(tabId).style.display = 'block';
            });
        });
        
        // Show first tab by default
        if (tabLinks[0]) {
            tabLinks[0].click();
        }
    }
}

// Initialize Product Gallery
function initProductGallery() {
    const mainImage = document.getElementById('zoompro');
    const galleryThumbs = document.querySelectorAll('#gallery a');
    
    if (mainImage && galleryThumbs.length > 0) {
        galleryThumbs.forEach(thumb => {
            thumb.addEventListener('click', function(e) {
                e.preventDefault();
                
                const imageUrl = this.getAttribute('data-image');
                const zoomImageUrl = this.getAttribute('data-zoom-image');
                
                // Update main image
                mainImage.src = imageUrl;
                mainImage.setAttribute('data-zoom-image', zoomImageUrl);
                
                // Update active class
                galleryThumbs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
}

// Initialize Quantity Buttons
function initQuantityButtons() {
    const decreaseButtons = document.querySelectorAll('.qtyField .decrease');
    const increaseButtons = document.querySelectorAll('.qtyField .increase');
    
    if (decreaseButtons.length > 0) {
        decreaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('input');
                let value = parseInt(input.value);
                const min = parseInt(input.getAttribute('min') || 1);
                
                if (value > min) {
                    value--;
                    input.value = value;
                }
            });
        });
    }
    
    if (increaseButtons.length > 0) {
        increaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('input');
                let value = parseInt(input.value);
                const max = parseInt(input.getAttribute('max') || 999);
                
                if (value < max) {
                    value++;
                    input.value = value;
                }
            });
        });
    }
}

// Initialize Mobile Tabs Accordion
function initMobileTabsAccordion() {
    const accordionTitles = document.querySelectorAll('.tabs-ac-style');
    
    if (accordionTitles.length > 0) {
        accordionTitles.forEach(title => {
            title.addEventListener('click', function() {
                const tabId = this.getAttribute('rel');
                const tabContent = document.getElementById(tabId);
                
                // Toggle display
                if (tabContent.style.display === 'block') {
                    tabContent.style.display = 'none';
                } else {
                    // Hide all tab contents
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Show current tab content
                    tabContent.style.display = 'block';
                }
            });
        });
        
        // Show first tab by default on mobile
        if (window.innerWidth < 768 && accordionTitles[0]) {
            const tabId = accordionTitles[0].getAttribute('rel');
            document.getElementById(tabId).style.display = 'block';
        }
    }
}

// Product Countdown Timer
function initCountdownTimer() {
    const countdownElements = document.querySelectorAll('.product-countdown');
    
    if (countdownElements.length > 0) {
        countdownElements.forEach(element => {
            const endDate = element.getAttribute('data-countdown');
            
            if (endDate) {
                const targetDate = new Date(endDate).getTime();
                
                // Update countdown every second
                const countdownInterval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = targetDate - now;
                    
                    // Time calculations
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    // Display countdown
                    element.innerHTML = `
                        <div class="countdown-item">
                            <div class="countdown-number">${days}</div>
                            <div class="countdown-text">Days</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-number">${hours}</div>
                            <div class="countdown-text">Hrs</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-number">${minutes}</div>
                            <div class="countdown-text">Min</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-number">${seconds}</div>
                            <div class="countdown-text">Sec</div>
                        </div>
                    `;
                    
                    // If countdown is finished
                    if (distance < 0) {
                        clearInterval(countdownInterval);
                        element.innerHTML = "EXPIRED";
                    }
                }, 1000);
            }
        });
    }
}

// Initialize countdown timer
document.addEventListener('DOMContentLoaded', function() {
    initCountdownTimer();
});
