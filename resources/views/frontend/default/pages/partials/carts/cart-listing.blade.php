@forelse ($carts as $cart)
    <tr class="border-bottom">
        <td class="ps-4" data-label="{{ localize('Product') }}">
            <div class="d-flex align-items-center">
                @php
                    $productName = '';
                    $thumbnailImage = '';
                    $unitQty = '1';
                    $unitName = 'kg';

                    // Safely get product data with error handling
                    try {
                        if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
                            $product = $cart->product_variation->product;
                            $productName = $product->collectLocalization('name');
                            $thumbnailImage = $product->thumbnail_image;
                            $unitQty = $product->unit_qty ?? '1';
                            $unitName = isset($product->unit) && $product->unit ? $product->unit->name : 'kg';
                        }
                    } catch (\Exception $e) {
                        $productName = 'Product';
                    }
                @endphp

                <img src="{{ uploadedAsset($thumbnailImage) }}"
                    alt="{{ $productName }}" class="img-fluid me-3"
                    width="80" height="80" style="object-fit: cover;">
                <div>
                    <h5 class="mb-2 fw-bold">{{ $productName }}</h5>
                    <div class="text-muted" style="font-size: 16px;">
                        @php
                            $variationOptions = [];
                            try {
                                if (isset($cart->product_variation)) {
                                    $variationOptions = generateVariationOptions($cart->product_variation->combinations);
                                }
                            } catch (\Exception $e) {
                                // Handle error silently
                            }
                        @endphp

                        @foreach ($variationOptions as $variation)
                            <span>
                                {{ $variation['name'] }}:
                                @foreach ($variation['values'] as $value)
                                    {{ $value['name'] }}
                                @endforeach
                                @if (!$loop->last)
                                    ,
                                @endif
                            </span>
                        @endforeach
                    </div>
                    <div class="text-muted mt-2" style="font-size: 16px;">Qty: {{ $unitQty }}{{ $unitName }}</div>
                </div>
            </div>
        </td>

        <td class="align-middle text-center" data-label="{{ localize('Price') }}">
            <span class="fw-medium">
                @php
                    // Use DISCOUNTED PRICE (with admin panel discount applied)
                    $price = 0;
                    try {
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
                            $price = $hasTax ? discountedProductBasePrice($product) : discountedProductBasePriceWithoutTax($product);
                        }
                    } catch (\Exception $e) {
                        // Handle error silently
                    }
                @endphp
                {{ formatPrice($price) }}
            </span>
        </td>

        <td class="align-middle text-center" data-label="{{ localize('Quantity') }}">
            <div class="product-qty d-inline-flex align-items-center justify-content-center">
                <button class="decrese" onclick="handleCartItem('decrease',{{ $cart->id }})"
                        style="width: 25px !important; height: 25px !important; font-size: 12px !important;">-</button>
                <input type="text" readonly value="{{ $cart->qty }}"
                       style="width: 40px !important; height: 25px !important; font-size: 12px !important;">
                <button class="increase" onclick="handleCartItem('increase', {{ $cart->id }})"
                        style="width: 25px !important; height: 25px !important; font-size: 12px !important;">+</button>
            </div>
        </td>

        <td class="align-middle text-center" data-label="{{ localize('Total') }}">
            <span class="fw-bold">
                @php
                    // Use DISCOUNTED PRICE calculation for total (with admin panel discount applied)
                    $totalPrice = 0;
                    try {
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
                            $totalPrice = $discountedPrice * $cart->qty;
                        }
                    } catch (\Exception $e) {
                        // Handle error silently
                    }
                @endphp
                {{ formatPrice($totalPrice) }}
            </span>
        </td>

        <td class="align-middle text-center" data-label="{{ localize('Action') }}">
            <button type="button" class="btn btn-sm text-danger p-0"
                onclick="handleCartItem('delete', {{ $cart->id }})"
                style="font-size: 12px !important; padding: 5px !important;">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="py-4 text-center">{{ localize('Your shopping cart is empty') }}</td>
    </tr>
@endforelse
