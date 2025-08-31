/**
 * Category Slider Fix for Mobile View
 * This script enhances the category slider in mobile view:
 * 1. Increases the height of category cards with images filling the entire card
 * 2. Makes the slider continuously loop in a circular fashion without stopping
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize the category slider fix
    initCategorySliderFix();
});

function initCategorySliderFix() {
    // Check if we're on a mobile device
    const isMobile = window.innerWidth <= 767;
    
    // Apply CSS fixes for mobile view
    if (isMobile) {
        applyCategoryCardStyles();
    }
    
    // Initialize or reinitialize the slider with proper settings
    initializeSlider();
    
    // Listen for window resize events to reapply styles
    window.addEventListener('resize', function() {
        const newIsMobile = window.innerWidth <= 767;
        if (newIsMobile) {
            applyCategoryCardStyles();
        }
        // Reinitialize slider on resize to ensure proper behavior
        initializeSlider();
    });
}

function applyCategoryCardStyles() {
    // Get all category items in the slider
    const categoryItems = document.querySelectorAll('.collection-slider-6items .category-item');
    
    // Apply styles to each category item
    categoryItems.forEach(item => {
        // Increase the height of the category card
        item.style.height = 'auto';
        
        // Get the image container and image
        const imageContainer = item.querySelector('.zoom-scal');
        const image = item.querySelector('img');
        
        if (imageContainer) {
            // Make the image container taller
            imageContainer.style.height = '180px'; // Increased height
            imageContainer.style.overflow = 'hidden';
        }
        
        if (image) {
            // Make the image fill the entire container
            image.style.width = '100%';
            image.style.height = '100%';
            image.style.objectFit = 'cover';
        }
    });
}

function initializeSlider() {
    // Check if jQuery and slick are available
    if (typeof jQuery === 'undefined' || typeof jQuery.fn.slick === 'undefined') {
        console.warn('jQuery or Slick slider not found. Make sure they are properly loaded.');
        
        // If slick is not available, try to use a fallback approach
        tryFallbackSliderInitialization();
        return;
    }
    
    // Get the slider element
    const $slider = jQuery('.collection-slider-6items');
    
    // Check if the slider exists
    if ($slider.length === 0) {
        console.warn('Category slider not found on the page.');
        return;
    }
    
    // Check if the slider is already initialized
    if ($slider.hasClass('slick-initialized')) {
        // Unslick first to reinitialize
        $slider.slick('unslick');
    }
    
    // Initialize the slider with proper settings
    $slider.slick({
        dots: true,
        arrows: true,
        infinite: true, // Enable infinite loop
        speed: 800,
        slidesToShow: 5, // Show 5 slides on desktop
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2, // Show 2 slides on mobile
                    slidesToScroll: 1,
                    dots: true,
                    arrows: true,
                    infinite: true, // Ensure infinite loop on mobile
                    centerMode: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2, // Show 2 slides on small mobile
                    slidesToScroll: 1,
                    dots: true,
                    arrows: true,
                    infinite: true, // Ensure infinite loop on mobile
                    centerMode: false
                }
            },
            {
                breakpoint: 375,
                settings: {
                    slidesToShow: 2, // Show ONLY 2 slides for iPhone 14/12 Pro (375px)
                    slidesToScroll: 1,
                    dots: true,
                    arrows: true,
                    infinite: true,
                    centerMode: false
                }
            }
        ]
    });
}

function tryFallbackSliderInitialization() {
    // If slick is not available, try to use Swiper if available
    if (typeof Swiper !== 'undefined') {
        console.log('Trying to initialize with Swiper instead of Slick');
        
        // Get the slider element
        const sliderElement = document.querySelector('.collection-slider-6items');
        
        if (!sliderElement) {
            console.warn('Category slider not found on the page.');
            return;
        }
        
        // Initialize Swiper
        new Swiper(sliderElement, {
            slidesPerView: 2, // Show 2 slides on mobile
            spaceBetween: 10,
            loop: true, // Enable infinite loop
            autoplay: {
                delay: 4000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                375: {
                    slidesPerView: 2 // iPhone 14/12 Pro - ONLY 2 categories
                },
                480: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                },
                1400: {
                    slidesPerView: 5
                }
            }
        });
    }
}
