<!-- Featured Products Section -->
<section class="pt-4 pb-4 bg-white position-relative overflow-hidden z-1 featured-products-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5">
                <div class="section-title text-center text-xl-start">
                    <h3 class="mb-0"><?php echo e(localize('Featured Produts')); ?></h3>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="filter-btns text-center text-xl-end mt-4 mt-xl-0">
                    <!-- No filter buttons needed for featured products -->
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <?php
                // Get products with highest discounts
                $discounted_products = \App\Models\Product::withoutGlobalScope(\App\Scopes\ThemeProductScope::class)
                    ->isPublished()
                    ->where('discount_value', '>', 0)
                    ->orderBy('discount_value', 'DESC')
                    ->take(8)
                    ->get();

                // If we don't have enough discounted products, add featured products
                if ($discounted_products->count() < 8) {
                    // Get products marked as featured by admin
                    $featured_products = \App\Models\Product::withoutGlobalScope(\App\Scopes\ThemeProductScope::class)
                        ->isPublished()
                        ->where('is_featured', 1)
                        ->whereNotIn('id', $discounted_products->pluck('id')->toArray()) // Avoid duplicates
                        ->take(8 - $discounted_products->count())
                        ->get();

                    // Combine both collections
                    $products = $discounted_products->merge($featured_products);
                } else {
                    // Just use the discounted products
                    $products = $discounted_products;
                }

                // No fallback to newest products - we only want discounted or featured products
            ?>

            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-10 filter_item">
                    <?php echo $__env->make('frontend.default.pages.partials.products.vertical-product-card', [
                        'product' => $product,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- View All Products Button -->
        <div class="text-center mt-7 mb-0">
            <a href="<?php echo e(route('products.index')); ?>" class="btn px-4 py-2 rounded-pill text-white" style="background-color: #006400; position: relative; z-index: 5;">
                View All Products <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/partials/home/featuredProductsNew.blade.php ENDPATH**/ ?>