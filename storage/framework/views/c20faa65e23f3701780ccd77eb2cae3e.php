<!-- Category-wise Products Section -->
<section class="pt-4 pb-4 bg-light position-relative overflow-hidden z-1 category-wise-products">
    <div class="container">
        <?php
            // Simple and safe approach: Get categories and filter them
            $categories = collect();
            $allCategories = \App\Models\Category::withoutGlobalScope(\App\Scopes\ThemeCategoryScope::class)->get();

            foreach ($allCategories as $category) {
                // Check if this category has any published products using product_categories table
                $hasProducts = \App\Models\ProductCategory::where('category_id', $category->id)
                    ->whereHas('product', function($query) {
                        $query->isPublished();
                    })
                    ->exists();

                if ($hasProducts) {
                    $categories->push($category);

                    // Stop when we have 3 categories with products
                    if ($categories->count() >= 3) {
                        break;
                    }
                }
            }
        ?>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Get products for this category using product_categories table
                $productIds = \App\Models\ProductCategory::where('category_id', $category->id)->pluck('product_id');
                $categoryProducts = \App\Models\Product::withoutGlobalScope(\App\Scopes\ThemeProductScope::class)
                    ->whereIn('id', $productIds)
                    ->isPublished()
                    ->take(6)
                    ->get();
            ?>
                <div class="category-section mb-5">
                    <!-- Category Header -->
                    <div class="row align-items-center mb-4">
                        <div class="col-12">
                            <!-- Desktop: Category name and View All side by side -->
                            <div class="d-none d-lg-flex align-items-center">
                                <h4 class="mb-0 text-uppercase fw-bold text-dark me-3">
                                    <?php echo e($category->collectLocalization('name')); ?>

                                </h4>
                                <a href="<?php echo e(route('products.index')); ?>?category_id=<?php echo e($category->id); ?>"
                                   class="btn btn-link text-decoration-none fw-bold text-primary p-0">
                                    <?php echo e(localize('VIEW ALL')); ?> <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                            <!-- Mobile: Category name left, View All right -->
                            <div class="d-lg-none d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-uppercase fw-bold text-dark">
                                    <?php echo e($category->collectLocalization('name')); ?>

                                </h4>
                                <a href="<?php echo e(route('products.index')); ?>?category_id=<?php echo e($category->id); ?>"
                                   class="btn btn-link text-decoration-none fw-bold text-primary p-0">
                                    <?php echo e(localize('VIEW ALL')); ?> <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Products Carousel - Single row with horizontal scroll -->
                    <div class="position-relative">
                        <!-- Navigation Arrows -->
                        <?php if($categoryProducts->count() > 4): ?>
                            <button class="carousel-nav-btn carousel-prev" data-category="<?php echo e($category->id); ?>"
                                    style="position: absolute; left: -20px; top: 50%; transform: translateY(-50%); z-index: 10;
                                           background: white; border: 1px solid #ddd; border-radius: 50%; width: 40px; height: 40px;
                                           display: flex; align-items: center; justify-content: center;
                                           box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;">
                                <i class="fas fa-chevron-left text-dark"></i>
                            </button>
                            <button class="carousel-nav-btn carousel-next" data-category="<?php echo e($category->id); ?>"
                                    style="position: absolute; right: -20px; top: 50%; transform: translateY(-50%); z-index: 10;
                                           background: white; border: 1px solid #ddd; border-radius: 50%; width: 40px; height: 40px;
                                           display: flex; align-items: center; justify-content: center;
                                           box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;">
                                <i class="fas fa-chevron-right text-dark"></i>
                            </button>
                        <?php endif; ?>

                        <!-- Scrollable Products Container -->
                        <div class="products-carousel-container" data-category="<?php echo e($category->id); ?>"
                             style="overflow-x: auto; overflow-y: hidden; scroll-behavior: smooth;
                                    scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="products-carousel-track d-flex" style="gap: 15px; padding: 5px 0;">
                                <?php $__currentLoopData = $categoryProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-carousel-item flex-shrink-0 lazy-product-card"
                                         style="width: 290px; min-width: 290px; height: auto;"
                                         data-aos="fade-up"
                                         data-aos-duration="600"
                                         data-aos-delay="<?php echo e($loop->index * 100); ?>">
                                        <div class="vertical-product-card rounded-2 position-relative swiper-slide product-hover-zoom bg-white"
                                             style="cursor: pointer;"
                                             onclick="navigateToProduct(event, '<?php echo e(route('products.show', $product->slug)); ?>')">
                                    <?php
                                        $discountPercentage = discountPercentage($product);
                                        $isNew = $product->is_new ?? false;

                                        // Check if discount is applicable
                                        $discount_applicable = false;
                                        if ($product->discount_start_date != null && $product->discount_end_date != null) {
                                            if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                                                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                                                $discount_applicable = true;
                                            }
                                        }
                                    ?>

                                    <!-- Discount Badge -->
                                    <?php if($discountPercentage > 0 && $discount_applicable): ?>
                                        <span class="offer-badge text-white fw-bold fs-xxs position-absolute start-0 top-0 m-3 px-3 py-1 rounded-pill"
                                              style="background-color: #FFB800; z-index: 1;">
                                            <?php if($product->discount_type == 'percent'): ?>
                                                <?php echo e($discountPercentage); ?>% OFF
                                            <?php else: ?>
                                                Rs.<?php echo e(number_format($product->discount_value, 0)); ?> OFF
                                            <?php endif; ?>
                                        </span>
                                    <?php elseif($isNew): ?>
                                        <span class="offer-badge text-white fw-bold fs-xxs position-absolute start-0 top-0 m-3 px-3 py-1 rounded-pill"
                                              style="background-color: #2ECC71; z-index: 1;">
                                            NEW
                                        </span>
                                    <?php endif; ?>

                                    <!-- Product Image - EXACT 270x170px SIZE -->
                                    <div class="thumbnail position-relative text-center" style="height: 170px; padding: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        <img data-src="<?php echo e(uploadedAsset($product->thumbnail_image)); ?>"
                                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='170'%3E%3Crect width='100%25' height='100%25' fill='%23f8f9fa'/%3E%3C/svg%3E"
                                             alt="<?php echo e($product->collectLocalization('name')); ?>"
                                             class="img-fluid lazy-image"
                                             style="width: 100%; height: 100%; object-fit: cover; object-position: center; border-radius: 8px; transition: opacity 0.3s ease;">

                                        <div class="product-btns position-absolute d-flex gap-2 flex-column">
                                            <a href="javascript:void(0);" class="rounded-btn" onclick="showProductDetailsModal(<?php echo e($product->id); ?>)"><i
                                                    class="fa-regular fa-eye"></i></a>
                                        </div>
                                    </div>

                                    <!-- Card Content - EXACT SAME PADDING -->
                                    <div class="card-content p-3">
                                        <!--product category start-->
                                        <div class="mb-2 tt-category tt-line-clamp tt-clamp-1">
                                            <?php if($product->categories()->count() > 0): ?>
                                                <?php $__currentLoopData = $product->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('products.index')); ?>?&category_id=<?php echo e($category->id); ?>"
                                                        class="d-inline-block text-muted fs-xxs text-uppercase"><?php echo e($category->collectLocalization('name')); ?>

                                                        <?php if(!$loop->last): ?>
                                                            ,
                                                        <?php endif; ?>
                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <!--product category end-->

                                        <!-- Product Name - EXACT SAME STYLING -->
                                        <a href="<?php echo e(route('products.show', $product->slug)); ?>"
                                            class="card-title fw-medium mb-2 tt-line-clamp tt-clamp-1 text-dark"><?php echo e($product->collectLocalization('name')); ?>

                                        </a>

                                        <!-- Product Price - EXACT SAME STYLING -->
                                        <div class="product-price d-flex-center my-3">
                                            <span class="text-success text-bold fs-xxs" style="font-family: inherit; font-size: 0.6rem;">
                                                <?php echo $__env->make('frontend.default.pages.partials.products.pricing-with-tax', [
                                                    'product' => $product,
                                                    'cardContext' => true
                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </span>
                                        </div>

                                        <!-- Add to Cart Section - EXACT SAME DIMENSIONS -->
                                        <?php
                                            $isVariantProduct = 0;
                                            $stock = 0;
                                            if ($product->variations()->count() > 1) {
                                                $isVariantProduct = 1;
                                            } else {
                                                $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
                                            }
                                        ?>

                                        <?php if($isVariantProduct): ?>
                                            <div class="d-flex align-items-center mt-3" style="gap: 5px; flex-wrap: nowrap;">
                                                <div class="d-flex align-items-center flex-shrink-0" style="border: 1px solid #dee2e6; border-radius: 25px; height: 40px; width: 48%; min-width: 90px;">
                                                    <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>-</button>
                                                    <input type="text" class="form-control text-center border-0 px-0 flex-shrink-0" value="1" readonly style="width: 34%; height: 100%; box-shadow: none; min-width: 30px;">
                                                    <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>+</button>
                                                </div>
                                                <a href="javascript:void(0);" class="btn fw-medium px-1 d-flex align-items-center justify-content-center" onclick="showProductDetailsModal(<?php echo e($product->id); ?>)"
                                                   style="background-color: #2ECC71 !important; color: white !important; height: 40px; text-transform: uppercase; font-size: 12px; width: 48%; min-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px; border-radius: 25px; transition: background-color 0.3s ease; border: none !important; outline: none !important; box-shadow: none !important;"
                                                   onmouseover="this.style.backgroundColor='#27ae60' !important" onmouseout="this.style.backgroundColor='#2ECC71' !important"><?php echo e(strtoupper(localize('Add to Cart'))); ?></a>
                                            </div>
                                        <?php else: ?>
                                            <form action="" class="direct-add-to-cart-form">
                                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                <input type="hidden" name="product_variation_id" value="<?php echo e($product->variations[0]->id); ?>">
                                                <input type="hidden" value="1" name="quantity" id="hidden-quantity-<?php echo e($product->id); ?>">

                                                <?php if(!$isVariantProduct && $stock < 1): ?>
                                                    <div class="d-flex align-items-center mt-3" style="gap: 5px; flex-wrap: nowrap;">
                                                        <div class="d-flex align-items-center flex-shrink-0" style="border: 1px solid #dee2e6; border-radius: 25px; height: 40px; width: 48%; min-width: 90px;">
                                                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>-</button>
                                                            <input type="text" class="form-control text-center border-0 px-0 flex-shrink-0" value="1" readonly style="width: 34%; height: 100%; box-shadow: none; min-width: 30px;">
                                                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" disabled>+</button>
                                                        </div>
                                                        <button type="button" class="btn fw-medium px-1 d-flex align-items-center justify-content-center" style="background-color: #CCCCCC; color: white !important; height: 40px; text-transform: uppercase; font-size: 12px; width: 48%; min-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px; border-radius: 25px; border: none !important; outline: none !important; box-shadow: none !important;" disabled>
                                                            <?php echo e(strtoupper(localize('Out of Stock'))); ?>

                                                        </button>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="d-flex align-items-center mt-3" style="gap: 5px; flex-wrap: nowrap;">
                                                        <div class="d-flex align-items-center flex-shrink-0" style="border: 1px solid #dee2e6; border-radius: 25px; height: 40px; width: 48%; min-width: 90px;">
                                                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" onclick="decrementQuantity(this)">-</button>
                                                            <input type="text" name="quantity" class="form-control text-center border-0 px-0 flex-shrink-0" value="1" readonly style="width: 34%; height: 100%; box-shadow: none; min-width: 30px;"
                                                                   onchange="document.getElementById('hidden-quantity-<?php echo e($product->id); ?>').value = this.value;">
                                                            <button type="button" class="btn px-1 py-0 border-0 flex-shrink-0" style="font-size: 18px; font-weight: bold; height: 100%; min-width: 30px; width: 33%;" onclick="incrementQuantity(this)">+</button>
                                                        </div>
                                                        <button type="button" onclick="directAddToCartFormSubmit(this)" class="btn fw-medium px-1 direct-add-to-cart-btn add-to-cart-text d-flex align-items-center justify-content-center"
                                                                style="background-color:rgb(24, 147, 65) !important; color: white !important; height: 40px; text-transform: uppercase; font-size: 12px; width: 48%; min-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px; border-radius: 25px; transition: background-color 0.3s ease; border: none !important; outline: none !important; box-shadow: none !important;"
                                                                onmouseover="this.style.backgroundColor='#27ae60' !important" onmouseout="this.style.backgroundColor='#2ECC71' !important">
                                                            <?php echo e(strtoupper(localize('Add to Cart'))); ?>

                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- View All Card - Static at the end -->
                                <div class="product-carousel-item view-all-item flex-shrink-0"
                                     style="width: 160px; min-width: 160px; height: auto;"
                                     data-aos="fade-up"
                                     data-aos-duration="600"
                                     data-aos-delay="<?php echo e($categoryProducts->count() * 100); ?>">
                                    <div class="view-all-card rounded-2 position-relative bg-light border d-flex flex-column align-items-center justify-content-center text-center h-100"
                                         style="cursor: pointer; min-height: 400px; transition: all 0.3s ease;"
                                         onclick="window.location.href='<?php echo e(route('products.index')); ?>?category_id=<?php echo e($category->id); ?>'">

                                        <!-- Icon -->
                                        <div class="mb-3">
                                            <i class="fas fa-arrow-right text-primary" style="font-size: 2rem;"></i>
                                        </div>

                                        <!-- View All Text -->
                                        <h6 class="fw-bold text-dark mb-2"><?php echo e(localize('View All')); ?></h6>
                                        <p class="text-muted mb-0 small"><?php echo e($category->collectLocalization('name')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<style>
/* Hide scrollbar for webkit browsers */
.products-carousel-container::-webkit-scrollbar {
    display: none;
}

/* View All Card Styling */
.view-all-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #2ECC71 !important;
}

.view-all-card:hover .fas {
    transform: translateX(5px);
    color: #2ECC71 !important;
}

/* Smooth Lazy Loading Styles */
.lazy-img {
    opacity: 0;
    transform: scale(1.02);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    background: linear-gradient(90deg, #f1f3f4 25%, #e8eaed 50%, #f1f3f4 75%);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

.lazy-img.loaded {
    opacity: 1;
    transform: scale(1);
    animation: none;
    background: none;
}

@keyframes shimmer {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Smooth product card entrance animations */
.product-carousel-item {
    opacity: 0;
    transform: translateY(15px);
    animation: smoothSlideUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
}

.product-carousel-item:nth-child(1) { animation-delay: 0.1s; }
.product-carousel-item:nth-child(2) { animation-delay: 0.15s; }
.product-carousel-item:nth-child(3) { animation-delay: 0.2s; }
.product-carousel-item:nth-child(4) { animation-delay: 0.25s; }
.product-carousel-item:nth-child(5) { animation-delay: 0.3s; }

@keyframes smoothSlideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Beautiful fade-up animation */
@keyframes fadeUpIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-up-animation {
    animation: fadeUpIn 0.6s ease forwards;
}

/* Smooth hover effects for navigation buttons */
.carousel-nav-btn:hover {
    background-color: #f8f9fa !important;
    transform: translateY(-50%) scale(1.1);
    transition: all 0.2s ease;
}

.carousel-nav-btn:active {
    transform: translateY(-50%) scale(0.95);
}

/* Fixed product width - increased from 270px to 320px */
.product-carousel-item {
    width: 320px !important;
    min-width: 320px !important;
}

/* View All card should be half width */
.view-all-item {
    width: 160px !important;
    min-width: 160px !important;
}

/* Responsive View All card for small screens */
@media (max-width: 480px) {
    .product-carousel-item {
        width: 250px !important;
        min-width: 250px !important;
    }

    .view-all-item {
        width: 125px !important;
        min-width: 125px !important;
    }

    .view-all-item .view-all-card {
        min-height: 300px !important;
    }

    .view-all-item .fas {
        font-size: 1.5rem !important;
    }

    .view-all-item h6 {
        font-size: 0.8rem !important;
    }

    .view-all-item p {
        font-size: 0.7rem !important;
    }
}

@media (max-width: 430px) {
    .product-carousel-item {
        width: 220px !important;
        min-width: 220px !important;
    }

    .view-all-item {
        width: 110px !important;
        min-width: 110px !important;
    }
}

@media (max-width: 390px) {
    .product-carousel-item {
        width: 200px !important;
        min-width: 200px !important;
    }

    .view-all-item {
        width: 100px !important;
        min-width: 100px !important;
    }
}

@media (max-width: 375px) {
    .product-carousel-item {
        width: 180px !important;
        min-width: 180px !important;
    }

    .view-all-item {
        width: 90px !important;
        min-width: 90px !important;
    }
}

/* Ensure image container height matches vertical-product-card */
.product-carousel-item .thumbnail {
    height: 170px !important;
}


</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize carousel navigation for each category
    document.querySelectorAll('.carousel-nav-btn').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category');
            const container = document.querySelector(`.products-carousel-container[data-category="${categoryId}"]`);
            const isNext = this.classList.contains('carousel-next');

            // Responsive scroll amount based on screen size
            let scrollAmount = 335; // Default: 320px + 15px gap

            if (window.innerWidth <= 375) {
                scrollAmount = 195; // 180px + 15px gap
            } else if (window.innerWidth <= 390) {
                scrollAmount = 215; // 200px + 15px gap
            } else if (window.innerWidth <= 430) {
                scrollAmount = 235; // 220px + 15px gap
            } else if (window.innerWidth <= 480) {
                scrollAmount = 265; // 250px + 15px gap
            }

            if (container) {
                if (isNext) {
                    container.scrollLeft += scrollAmount;
                } else {
                    container.scrollLeft -= scrollAmount;
                }
            }
        });
    });

    // Auto-hide navigation buttons when not needed
    document.querySelectorAll('.products-carousel-container').forEach(container => {
        const categoryId = container.getAttribute('data-category');
        const prevBtn = document.querySelector(`.carousel-prev[data-category="${categoryId}"]`);
        const nextBtn = document.querySelector(`.carousel-next[data-category="${categoryId}"]`);

        function updateButtonVisibility() {
            if (prevBtn && nextBtn) {
                const isAtStart = container.scrollLeft <= 5; // Small tolerance
                const isAtEnd = container.scrollLeft >= (container.scrollWidth - container.clientWidth - 5);

                prevBtn.style.opacity = isAtStart ? '0.3' : '1';
                nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
                prevBtn.style.pointerEvents = isAtStart ? 'none' : 'auto';
                nextBtn.style.pointerEvents = isAtEnd ? 'none' : 'auto';
            }
        }

        // Update button visibility on scroll
        container.addEventListener('scroll', updateButtonVisibility);

        // Initial check
        setTimeout(updateButtonVisibility, 100);
    });
});

// Lazy Loading Implementation
function initLazyLoading() {
    const lazyImages = document.querySelectorAll('.lazy-image');
    const lazyCards = document.querySelectorAll('.lazy-product-card');

    // Intersection Observer for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.getAttribute('data-src');

                if (src) {
                    img.src = src;
                    img.classList.add('loaded');
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.1
    });

    // Intersection Observer for cards animation
    const cardObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('fade-up-animation');
                }, index * 100); // Stagger animation
                observer.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '20px 0px',
        threshold: 0.1
    });

    // Observe all lazy images
    lazyImages.forEach(img => imageObserver.observe(img));

    // Observe all lazy cards
    lazyCards.forEach(card => cardObserver.observe(card));
}

// Initialize AOS (Animate On Scroll) if available
function initAOS() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 600,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            delay: 100
        });
    }
}

// Navigation function for product clicks
function navigateToProduct(event, url) {
    // Only navigate if the click wasn't on a button or input
    if (!event.target.closest('button, input, .btn')) {
        window.location.href = url;
    }
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initLazyLoading();
    initAOS();
});
</script>

<!-- AOS JavaScript -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/partials/home/categorywise.blade.php ENDPATH**/ ?>