@if (productBasePriceWithoutTax($product) == discountedProductBasePriceWithoutTax($product))
    @if (productBasePriceWithoutTax($product) == productMaxPriceWithoutTax($product))
        <span class="fw-bold h4" style="color: #006400;">{{ formatPrice(productBasePriceWithoutTax($product)) }}</span>
    @else
        <span class="fw-bold h4" style="color: #006400;">{{ formatPrice(productBasePriceWithoutTax($product)) }}</span>
        -
        <span class="fw-bold h4" style="color: #006400;">{{ formatPrice(productMaxPriceWithoutTax($product)) }}</span>
    @endif
@else
    @if (discountedProductBasePriceWithoutTax($product) == discountedProductMaxPriceWithoutTax($product))
        <span class="fw-bold h4" style="color: #006400;">{{ formatPrice(discountedProductBasePriceWithoutTax($product)) }}</span>
    @else
        <span class="fw-bold h4" style="color: #006400;">{{ formatPrice(discountedProductBasePriceWithoutTax($product)) }}</span>
        -
        <span class="fw-bold h4" style="color: #006400;">{{ formatPrice(discountedProductMaxPriceWithoutTax($product)) }}</span>
    @endif

    @if (isset($br))
        <br>
    @endif

    @if (!isset($onlyPrice) || $onlyPrice == false)
        @if (productBasePriceWithoutTax($product) == productMaxPriceWithoutTax($product))
            <span
                class="fw-bold h4 deleted text-muted {{ isset($br) ? '' : 'ms-1' }}">{{ formatPrice(productBasePriceWithoutTax($product)) }}</span>
        @else
            <span
                class="fw-bold h4 deleted text-muted {{ isset($br) ? '' : 'ms-1' }}">{{ formatPrice(productBasePriceWithoutTax($product)) }}</span>
            -
            <span class="fw-bold h4 deleted text-muted ms-1">{{ formatPrice(productMaxPriceWithoutTax($product)) }}</span>
        @endif
    @endif
@endif
