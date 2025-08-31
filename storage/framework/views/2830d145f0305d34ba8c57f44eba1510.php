<?php
    // Check if product has any taxes applied with actual tax amount > 0
    $hasTax = false;
    $taxPercentage = 0;
    $totalTaxAmount = 0;

    if ($product->taxes && $product->taxes->count() > 0) {
        $basePrice = $product->min_price; // Use min price for calculation

        foreach ($product->taxes as $tax) {
            if ($tax->tax_type == 'percent' && $tax->tax_value > 0) {
                $taxAmount = ($basePrice * $tax->tax_value) / 100;
                $totalTaxAmount += $taxAmount;
                $taxPercentage += $tax->tax_value;
            } elseif ($tax->tax_type == 'flat' && $tax->tax_value > 0) {
                $totalTaxAmount += $tax->tax_value;
            }
        }

        // Only show tax included if total tax amount is greater than 0
        $hasTax = $totalTaxAmount > 0;
    }

    // Check if there's an active discount
    $hasDiscount = false;
    if ($product->discount_start_date != null && $product->discount_end_date != null) {
        if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date &&
            $product->discount_value > 0) {
            $hasDiscount = true;
        }
    }

    // Determine heading size based on context
    $headingClass = isset($cardContext) && $cardContext ? 'fw-bold h6' : 'fw-bold h4';
?>


<?php if($hasDiscount && (!isset($onlyPrice) || $onlyPrice == false)): ?>
    
    <?php if($hasTax): ?>
        <?php if(productBasePrice($product) == productMaxPrice($product)): ?>
            <span class="<?php echo e($headingClass); ?> deleted text-muted me-2"><?php echo e(formatPrice(productBasePrice($product))); ?></span>
        <?php else: ?>
            <span class="<?php echo e($headingClass); ?> deleted text-muted me-1"><?php echo e(formatPrice(productBasePrice($product))); ?></span>
            -
            <span class="<?php echo e($headingClass); ?> deleted text-muted me-2"><?php echo e(formatPrice(productMaxPrice($product))); ?></span>
        <?php endif; ?>
    <?php else: ?>
        <?php if(productBasePriceWithoutTax($product) == productMaxPriceWithoutTax($product)): ?>
            <span class="<?php echo e($headingClass); ?> deleted text-muted me-2"><?php echo e(formatPrice(productBasePriceWithoutTax($product))); ?></span>
        <?php else: ?>
            <span class="<?php echo e($headingClass); ?> deleted text-muted me-1"><?php echo e(formatPrice(productBasePriceWithoutTax($product))); ?></span>
            -
            <span class="<?php echo e($headingClass); ?> deleted text-muted me-2"><?php echo e(formatPrice(productMaxPriceWithoutTax($product))); ?></span>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


<?php if($hasTax): ?>
    
    <?php if(discountedProductBasePrice($product) == discountedProductMaxPrice($product)): ?>
        <span class="<?php echo e($headingClass); ?>" style="color: #006400;"><?php echo e(formatPrice(discountedProductBasePrice($product))); ?></span>
        <span class="text-muted" style="font-size: 0.8em;">(tax included)</span>
    <?php else: ?>
        <span class="<?php echo e($headingClass); ?>" style="color: #006400;"><?php echo e(formatPrice(discountedProductBasePrice($product))); ?></span>
        -
        <span class="<?php echo e($headingClass); ?>" style="color: #006400;"><?php echo e(formatPrice(discountedProductMaxPrice($product))); ?></span>
        <span class="text-muted" style="font-size: 0.8em;">(tax included)</span>
    <?php endif; ?>
<?php else: ?>
    
    <?php if(discountedProductBasePriceWithoutTax($product) == discountedProductMaxPriceWithoutTax($product)): ?>
        <span class="<?php echo e($headingClass); ?>" style="color: #006400;"><?php echo e(formatPrice(discountedProductBasePriceWithoutTax($product))); ?></span>
    <?php else: ?>
        <span class="<?php echo e($headingClass); ?>" style="color: #006400;"><?php echo e(formatPrice(discountedProductBasePriceWithoutTax($product))); ?></span>
        -
        <span class="<?php echo e($headingClass); ?>" style="color: #006400;"><?php echo e(formatPrice(discountedProductMaxPriceWithoutTax($product))); ?></span>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/partials/products/pricing-with-tax.blade.php ENDPATH**/ ?>