<!-- Hero Carousel from Infinite Application -->
<style>
    /* Navigation arrows visibility control for hero carousel */
    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next {
        display: none !important;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #heroCarousel:hover .carousel-control-prev,
    #heroCarousel:hover .carousel-control-next {
        display: flex !important;
        opacity: 1;
    }

    /* Hero carousel positioning and height */
    #heroCarousel {
        position: relative;
        z-index: 1;
        margin-top: 0;
        width: 100%;
        overflow: hidden;
    }

    /* Ensure carousel is visible and not hidden by header */
    body.sticky-active #heroCarousel {
        margin-top: 0;
    }

    /* Vertical centering for carousel content */
    #heroCarousel .carousel-item {
        min-height: 500px;
        position: relative;
        padding-top: 80px;
        padding-bottom: 80px;
    }

    #heroCarousel .carousel-item .container {
        width: 100%;
        max-width: 1140px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Mobile styles */
    @media (max-width: 767px) {
        /* Basic mobile styling */
        #heroCarousel .carousel-item {
            min-height: 600px;
            position: relative;
            padding-top: 60px;
            padding-bottom: 140px;
        }

        #heroCarousel .carousel-item .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Make text smaller on mobile */
        #heroCarousel .display-4 {
            font-size: 1.8rem;
        }

        /* Show paragraphs on mobile */
        #heroCarousel .d-md-block.d-none {
            display: block !important;
            font-size: 0.9rem;
        }

        /* Make buttons smaller on mobile */
        #heroCarousel .btn-sm-mobile {
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
        }

        /* Add mobile-specific product images */
        .mobile-product-image {
            display: block !important;
            max-width: 180px !important;
            max-height: 180px !important;
            margin: 20px auto !important;
            object-fit: contain !important;
        }

        /* Mobile discount badge */
        .mobile-discount-badge {
            display: flex !important;
            position: absolute !important;
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: 700 !important;
            font-size: 0.7rem !important;
            color: white !important;
            top: 0 !important;
            right: 50% !important;
            margin-right: -110px !important;
            z-index: 10 !important;
        }

        /* Responsive hero image container */
        .hero-image-container {
            /* Desktop: normal right column */
            display: none !important;
        }

        @media (min-width: 768px) {
            .hero-image-container {
                display: block !important;
            }
        }

        /* Mobile: position in top-right corner */
        @media (max-width: 767px) {
            .hero-image-container {
                position: absolute !important;
                top: 15px !important;
                right: 15px !important;
                z-index: 5 !important;
                width: 120px !important;
                height: 120px !important;
                display: block !important;
                opacity: 0 !important;
                transition: opacity 0.3s ease !important;
            }

            /* Only show image in active carousel slide on mobile */
            .carousel-item.active .hero-image-container {
                opacity: 1 !important;
            }

            .hero-image {
                width: 100% !important;
                height: 100% !important;
                object-fit: contain !important;
            }

            .hero-badge {
                width: 35px !important;
                height: 35px !important;
                font-size: 0.65rem !important;
                top: -5px !important;
                right: -5px !important;
            }

            /* Add padding to text content column only in hero carousel to avoid image overlap */
            #heroCarousel .col-md-6:first-child {
                padding-right: 140px !important; /* 120px image + 20px spacing */
            }

            /* Adjust title font size for mobile to fit better - only in hero carousel */
            #heroCarousel .display-4 {
                font-size: 1.8rem !important;
                line-height: 1.2 !important;
            }
        }
    }
</style>

<!-- iPhone-specific styles -->
<style>
    /* Target iPhone specifically */
    @media only screen and (min-device-width: 375px) and (max-device-width: 812px) and (-webkit-min-device-pixel-ratio: 3),
           only screen and (min-device-width: 414px) and (max-device-width: 896px) and (-webkit-min-device-pixel-ratio: 2) {
        .mobile-product-image {
            display: block !important;
            max-width: 150px !important;
            max-height: 150px !important;
            margin: 20px auto !important;
            object-fit: contain !important;
            visibility: visible !important;
        }

        .mobile-discount-badge {
            display: flex !important;
            visibility: visible !important;
        }

        /* Force display on iPhone */
        .mobile-product-container {
            display: block !important;
            visibility: visible !important;
            height: 200px !important;
            position: relative !important;
            margin-top: 20px !important;
        }
    }
</style>
<!-- Hero Carousel Start -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <?php if(count($sliders) > 1): ?>
    <div class="carousel-indicators">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo e($index); ?>"
                class="<?php echo e($index == 0 ? 'active' : ''); ?>"
                aria-current="<?php echo e($index == 0 ? 'true' : 'false'); ?>"
                aria-label="Slide <?php echo e($index + 1); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <div class="carousel-inner">
        <?php if(count($sliders) > 0): ?>
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Define color schemes that cycle through blue, green, yellow
                $colorSchemes = [
                    0 => [
                        'background' => 'linear-gradient(to right, #003366, #004080)',
                        'textClass' => 'text-white',
                        'buttonClass' => 'btn-outline-light',
                        'badgeClass' => 'bg-success',
                        'discount' => '-30%'
                    ],
                    1 => [
                        'background' => 'linear-gradient(to right, #1e7e34, #28a745)',
                        'textClass' => 'text-white',
                        'buttonClass' => 'btn-outline-light',
                        'badgeClass' => 'bg-success',
                        'discount' => '-25%'
                    ],
                    2 => [
                        'background' => 'linear-gradient(to right, #ffc107, #ffdb58)',
                        'textClass' => 'text-dark',
                        'buttonClass' => 'btn-outline-dark',
                        'badgeClass' => 'bg-danger',
                        'discount' => '-40%'
                    ]
                ];
                $colorIndex = $index % 3; // Cycle through 0, 1, 2
                $colors = $colorSchemes[$colorIndex];
            ?>
            <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>" style="background: <?php echo e($colors['background']); ?>;">
                <div class="container position-relative">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6 <?php echo e($colors['textClass']); ?> text-start">
                            <div class="mb-2 small <?php echo e($colors['textClass']); ?>"><?php echo e($slider->sub_title ?? 'UliaaMart'); ?></div>
                            <h1 class="display-4 fw-bold mb-md-4 mb-2 <?php echo e($colors['textClass']); ?>">
                                <?php echo nl2br(e($slider->title ?? '100% Organic<br>Fruits &<br>Vegetables')); ?>

                            </h1>
                            <p class="mb-md-4 mb-2 <?php echo e($colors['textClass']); ?> d-md-block d-none">
                                <?php echo e($slider->text ?? 'Praesent eu tellus vitae quam fermentum facilisis at sit amet mauris. Nam ac tristique sapien. In sollicitudin tristique urna, a venenatis purus luctus non.'); ?>

                            </p>
                            <a href="<?php echo e($slider->link ?? route('products.index')); ?>" class="btn <?php echo e($colors['buttonClass']); ?> px-md-4 px-3 py-md-2 py-1 btn-sm-mobile">BROWSE PRODUCTS</a>
                        </div>
                        <div class="col-md-6 position-relative hero-image-container">
                            <img src="<?php echo e($slider->image ? uploadedAsset($slider->image) : staticAsset('frontend/default/assets/img/products/product-1.png')); ?>"
                                 class="img-fluid hero-image" alt="<?php echo e($slider->title ?? 'Organic Products'); ?>">
                            <div class="position-absolute top-0 end-0 <?php echo e($colors['badgeClass']); ?> text-white rounded-circle d-flex align-items-center justify-content-center discount-badge hero-badge" style="width: 60px; height: 60px; font-weight: 700;"><?php echo e($colors['discount']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            
            <div class="carousel-item active" style="background: linear-gradient(to right, #003366, #004080);">
                <div class="container position-relative">
                    <!-- Mobile image removed from fallback to prevent duplicates -->

                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6 text-white text-start">
                            <div class="mb-2 small text-white">UliaaMart</div>
                            <h1 class="display-4 fw-bold mb-md-4 mb-2 text-white">
                                100% Organic<br>
                                Fruits &<br>
                                Vegetables
                            </h1>
                            <p class="mb-md-4 mb-2 text-white d-md-block d-none">
                                Praesent eu tellus vitae quam fermentum facilisis at sit amet mauris. Nam ac tristique sapien. In sollicitudin tristique urna, a venenatis purus luctus non.
                            </p>
                            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-light px-md-4 px-3 py-md-2 py-1 btn-sm-mobile">BROWSE PRODUCTS</a>
                        </div>
                        <div class="col-md-6 position-relative d-none d-md-block">
                            <img src="<?php echo e(staticAsset('frontend/default/assets/img/products/product-1.png')); ?>" class="img-fluid" alt="Organic Products">
                            <div class="position-absolute top-0 end-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center discount-badge" style="width: 60px; height: 60px; font-weight: 700;">-30%</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Hero Carousel End -->

<script>
    // Apply navigation arrow visibility control for hero carousel
    document.addEventListener('DOMContentLoaded', function() {
        // Apply the effect using JavaScript as a backup to CSS
        function applyHeroArrowsEffect() {
            const heroCarousel = document.getElementById('heroCarousel');
            const prevButton = heroCarousel.querySelector('.carousel-control-prev');
            const nextButton = heroCarousel.querySelector('.carousel-control-next');

            if (prevButton && nextButton) {
                // Set initial state
                prevButton.style.display = 'none';
                nextButton.style.display = 'none';
                prevButton.style.opacity = '0';
                nextButton.style.opacity = '0';
                prevButton.style.transition = 'opacity 0.3s ease';
                nextButton.style.transition = 'opacity 0.3s ease';

                // Add hover effect
                heroCarousel.addEventListener('mouseenter', function() {
                    prevButton.style.display = 'flex';
                    nextButton.style.display = 'flex';
                    // Small delay to allow display to take effect before opacity transition
                    setTimeout(function() {
                        prevButton.style.opacity = '1';
                        nextButton.style.opacity = '1';
                    }, 10);
                });

                heroCarousel.addEventListener('mouseleave', function() {
                    prevButton.style.opacity = '0';
                    nextButton.style.opacity = '0';
                    // Wait for opacity transition to complete before hiding
                    setTimeout(function() {
                        prevButton.style.display = 'none';
                        nextButton.style.display = 'none';
                    }, 300);
                });

                console.log('Hero carousel navigation arrows effect applied');
            }
        }

        // Apply immediately
        applyHeroArrowsEffect();

        // Also apply after a delay to catch any dynamic content
        setTimeout(applyHeroArrowsEffect, 1000);
    });

    // jQuery implementation for additional compatibility
    $(document).ready(function() {
        function applyJQueryHeroArrowsEffect() {
            // Set initial state
            $('#heroCarousel .carousel-control-prev, #heroCarousel .carousel-control-next').css({
                'display': 'none',
                'opacity': '0',
                'transition': 'opacity 0.3s ease'
            });

            // Add hover effect
            $('#heroCarousel').hover(
                function() {
                    // Show the elements first
                    $(this).find('.carousel-control-prev, .carousel-control-next').css('display', 'flex');

                    // Small delay to allow display to take effect before opacity transition
                    setTimeout(function() {
                        $('#heroCarousel').find('.carousel-control-prev, .carousel-control-next').css('opacity', '1');
                    }, 10);
                },
                function() {
                    // First fade out
                    $(this).find('.carousel-control-prev, .carousel-control-next').css('opacity', '0');

                    // Then hide after transition completes
                    setTimeout(function() {
                        $('#heroCarousel').find('.carousel-control-prev, .carousel-control-next').css('display', 'none');
                    }, 300);
                }
            );

            console.log('jQuery hero carousel navigation arrows effect applied');
        }

        // Apply immediately
        applyJQueryHeroArrowsEffect();

        // Also apply after delays to catch dynamically loaded content
        setTimeout(applyJQueryHeroArrowsEffect, 1000);
        setTimeout(applyJQueryHeroArrowsEffect, 2000);
    });
</script>

<!-- iPhone-specific JavaScript -->
<script>
    $(document).ready(function() {
        // Force mobile images to display on iPhone and ensure only active slide image is visible
        function forceIphoneImages() {
            if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                console.log("iPhone detected - forcing images to display");

                // Force display of hero image containers on mobile
                if (window.innerWidth < 768) {
                    $('.hero-image-container').attr('style', 'position: absolute !important; top: 15px !important; right: 15px !important; z-index: 5 !important; width: 120px !important; height: 120px !important; display: block !important; visibility: visible !important;');
                    $('.hero-image').attr('style', 'width: 100% !important; height: 100% !important; object-fit: contain !important; display: block !important; visibility: visible !important;');
                    $('.hero-badge').attr('style', 'position: absolute !important; width: 35px !important; height: 35px !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; font-weight: 700 !important; font-size: 0.65rem !important; color: white !important; top: -5px !important; right: -5px !important; z-index: 10 !important; visibility: visible !important;');
                }
            }
        }

        // Function to ensure only active slide image is visible on mobile
        function ensureSingleImage() {
            if (window.innerWidth < 768) {
                // Hide all mobile images first
                $('.hero-image-container').css('opacity', '0');

                // Show only the active slide's image
                $('.carousel-item.active .hero-image-container').css('opacity', '1');
            }
        }

        // Apply immediately and after delays to ensure it works
        forceIphoneImages();
        ensureSingleImage();
        setTimeout(forceIphoneImages, 500);
        setTimeout(ensureSingleImage, 500);
        setTimeout(forceIphoneImages, 1000);
        setTimeout(ensureSingleImage, 1000);
        setTimeout(forceIphoneImages, 2000);
        setTimeout(ensureSingleImage, 2000);

        // Also apply on window resize and carousel slide events
        $(window).resize(function() {
            forceIphoneImages();
            ensureSingleImage();
        });

        // Apply when carousel slides change
        $('#heroCarousel').on('slid.bs.carousel', function() {
            ensureSingleImage();
        });
    });
</script>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/partials/home/hero.blade.php ENDPATH**/ ?>