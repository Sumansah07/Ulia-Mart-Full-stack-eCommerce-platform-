@php
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
@endphp

{{-- Show actual base price as strikethrough if there's a discount --}}
@if ($hasDiscount && (!isset($onlyPrice) || $onlyPrice == false))
    {{-- Show actual base price from admin panel (with tax if applicable) --}}
    @if ($hasTax)
        @if (productBasePrice($product) == productMaxPrice($product))
            <span class="{{ $headingClass }} deleted text-muted me-2">{{ formatPrice(productBasePrice($product)) }}</span>
        @else
            <span class="{{ $headingClass }} deleted text-muted me-1">{{ formatPrice(productBasePrice($product)) }}</span>
            -
            <span class="{{ $headingClass }} deleted text-muted me-2">{{ formatPrice(productMaxPrice($product)) }}</span>
        @endif
    @else
        @if (productBasePriceWithoutTax($product) == productMaxPriceWithoutTax($product))
            <span class="{{ $headingClass }} deleted text-muted me-2">{{ formatPrice(productBasePriceWithoutTax($product)) }}</span>
        @else
            <span class="{{ $headingClass }} deleted text-muted me-1">{{ formatPrice(productBasePriceWithoutTax($product)) }}</span>
            -
            <span class="{{ $headingClass }} deleted text-muted me-2">{{ formatPrice(productMaxPriceWithoutTax($product)) }}</span>
        @endif
    @endif
@endif

{{-- Show discounted price in green (actual selling price) --}}
@if ($hasTax)
    {{-- With tax: Show discounted price with tax --}}
    @if (discountedProductBasePrice($product) == discountedProductMaxPrice($product))
        <span class="{{ $headingClass }}" style="color: #006400;">{{ formatPrice(discountedProductBasePrice($product)) }}</span>
        <span class="text-muted" style="font-size: 0.8em;">(tax included)</span>
    @else
        <span class="{{ $headingClass }}" style="color: #006400;">{{ formatPrice(discountedProductBasePrice($product)) }}</span>
        -
        <span class="{{ $headingClass }}" style="color: #006400;">{{ formatPrice(discountedProductMaxPrice($product)) }}</span>
        <span class="text-muted" style="font-size: 0.8em;">(tax included)</span>
    @endif
@else
    {{-- Without tax: Show discounted price only --}}
    @if (discountedProductBasePriceWithoutTax($product) == discountedProductMaxPriceWithoutTax($product))
        <span class="{{ $headingClass }}" style="color: #006400;">{{ formatPrice(discountedProductBasePriceWithoutTax($product)) }}</span>
    @else
        <span class="{{ $headingClass }}" style="color: #006400;">{{ formatPrice(discountedProductBasePriceWithoutTax($product)) }}</span>
        -
        <span class="{{ $headingClass }}" style="color: #006400;">{{ formatPrice(discountedProductMaxPriceWithoutTax($product)) }}</span>
    @endif
@endif
