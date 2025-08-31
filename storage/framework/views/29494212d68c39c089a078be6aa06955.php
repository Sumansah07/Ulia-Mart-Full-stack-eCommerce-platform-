<?php $__empty_1 = true; $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    <li class="d-flex align-items-center pb-3 <?php if(!$loop->first): ?> pt-3 <?php endif; ?>">
        <div class="thumb-wrapper">
            <a href="<?php echo e(route('products.show', $cart->product_variation->product->slug)); ?>"><img
                    src="<?php echo e(uploadedAsset($cart->product_variation->product->thumbnail_image)); ?>" alt="products"
                    class="img-fluid rounded-circle"></a>
        </div>
        <div class="items-content ms-3">
            <a href="<?php echo e(route('products.show', $cart->product_variation->product->slug)); ?>">
                <h6 class="mb-0"><?php echo e($cart->product_variation->product->collectLocalization('name')); ?></h6>
            </a>

            <?php $__currentLoopData = generateVariationOptions($cart->product_variation->combinations); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="fs-xs text-muted">
                    
                    <?php $__currentLoopData = $variation['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($value['name']); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$loop->last): ?>
                        ,
                    <?php endif; ?>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="products_meta mt-1 d-flex align-items-center">
                <div>
                    <?php
                        // Use DISCOUNTED PRICE (with admin panel discount applied)
                        $discountedPrice = 0;
                        if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
                            $product = $cart->product_variation->product;
                            // Check if product has taxes to determine which function to use
                            $hasTax = false;
                            if ($product->taxes && $product->taxes->count() > 0) {
                                foreach ($product->taxes as $tax) {
                                    if (($tax->tax_type == 'percent' && $tax->tax_value > 0) ||
                                        ($tax->tax_type == 'flat' && $tax->tax_value > 0)) {
                                        $hasTax = true;
                                        break;
                                    }
                                }
                            }
                            // Use appropriate discounted price function
                            $discountedPrice = $hasTax ? discountedProductBasePrice($product) : discountedProductBasePriceWithoutTax($product);
                        }
                    ?>
                    <span class="price text-primary fw-semibold"><?php echo e(formatPrice($discountedPrice)); ?></span>
                    <span class="count fs-semibold">x <?php echo e($cart->qty); ?></span>
                </div>
                <button class="remove_cart_btn ms-2" onclick="handleCartItem('delete', <?php echo e($cart->id); ?>)"><i
                        class="fa-solid fa-trash-can"></i></button>
            </div>
        </div>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li>
        <img src="<?php echo e(staticAsset('frontend/default/assets/img/empty-cart.svg')); ?>" alt="" srcset=""
            class="img-fluid">
    </li>
<?php endif; ?>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/partials/carts/cart-navbar.blade.php ENDPATH**/ ?>