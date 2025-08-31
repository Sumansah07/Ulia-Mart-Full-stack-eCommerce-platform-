<!-- Order Summary Only -->
@php
    // Support both Eloquent collections and array-based guest carts
    $cartList = $carts instanceof \Illuminate\Support\Collection ? $carts : collect($carts);

    // Calculate subtotal using DISCOUNTED PRICES (with admin panel discount applied)
    $subtotal = 0;
    foreach ($cartList as $item) {
        $product = $item->product_variation->productWithTrashed ?? $item->product_variation->product;
        if ($product) {
            // Get base price
            $basePrice = $product->base_price ?? $product->min_price ?? 0;

            // Apply discount if active
            $discountedPrice = $basePrice;
            if ($product->discount_start_date && $product->discount_end_date && $product->discount_value > 0) {
                if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                    strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                    if ($product->discount_type == 'percent') {
                        $discountedPrice = $basePrice - (($basePrice * $product->discount_value) / 100);
                    } elseif ($product->discount_type == 'flat') {
                        $discountedPrice = $basePrice - $product->discount_value;
                    }
                }
            }

            $subtotal += $discountedPrice * $item->qty;
        }
    }
    
    $currentCoupon = getCoupon();
    if (empty($currentCoupon)) {
        $currentCoupon = request()->get('coupon', '');
    }
    if (empty($currentCoupon)) {
        $currentCoupon = session('coupon_code', '');
    }
    $is_free_shipping = false;
    if ($currentCoupon != '' && getCouponDiscountWithRestrictions($cartList, $currentCoupon) > 0) {
        $coupon = \App\Models\Coupon::where('code', $currentCoupon)->first();
        if (!is_null($coupon) && $coupon->is_free_shipping == 1) {
            $is_free_shipping = true;
        }
    }
    $shipping = 0;
    if (isset($shippingAmount) && $is_free_shipping == false) {
        $shipping = $shippingAmount;
    }
    $couponDiscount = getCouponDiscountWithRestrictions($cartList, $currentCoupon);
    $discountedSubtotal = $subtotal - $couponDiscount;

    // Calculate taxable amount for display based on DISCOUNTED PRICES (with admin panel discount applied)
    $taxableAmountForDisplay = 0;
    foreach ($cartList as $item) {
        $product = $item->product_variation->productWithTrashed ?? $item->product_variation->product;
        if ($product) {
            // Get base price
            $basePrice = $product->base_price ?? $product->min_price ?? 0;

            // Apply discount if active
            $discountedPrice = $basePrice;
            if ($product->discount_start_date && $product->discount_end_date && $product->discount_value > 0) {
                if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                    strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                    if ($product->discount_type == 'percent') {
                        $discountedPrice = $basePrice - (($basePrice * $product->discount_value) / 100);
                    } elseif ($product->discount_type == 'flat') {
                        $discountedPrice = $basePrice - $product->discount_value;
                    }
                }
            }

            $itemSubtotal = $discountedPrice * $item->qty;

            $hasTaxInfo = false;
            if ($product && $product->taxes) {
                foreach ($product->taxes as $taxObj) {
                    if (($taxObj->tax_type == 'percent' && $taxObj->tax_value > 0) || ($taxObj->tax_type == 'flat' && $taxObj->tax_value > 0)) {
                        $hasTaxInfo = true;
                        break;
                    }
                }
            }

            if ($hasTaxInfo) {
                // Apply proportional discount to this item
                $itemDiscountRatio = $subtotal > 0 ? ($itemSubtotal / $subtotal) : 0;
                $itemCouponDiscount = $couponDiscount * $itemDiscountRatio;
                $itemDiscountedPrice = $itemSubtotal - $itemCouponDiscount;
                $taxableAmountForDisplay += $itemDiscountedPrice;
            }
        }
    }

    // Calculate tax based on DISCOUNTED PRICES (with admin panel discount applied) AND after coupon discount
    $tax = 0;
    foreach ($cartList as $item) {
        $product = $item->product_variation->productWithTrashed ?? $item->product_variation->product;
        if ($product) {
            // Get base price
            $basePrice = $product->base_price ?? $product->min_price ?? 0;

            // Apply discount if active
            $discountedPrice = $basePrice;
            if ($product->discount_start_date && $product->discount_end_date && $product->discount_value > 0) {
                if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                    strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                    if ($product->discount_type == 'percent') {
                        $discountedPrice = $basePrice - (($basePrice * $product->discount_value) / 100);
                    } elseif ($product->discount_type == 'flat') {
                        $discountedPrice = $basePrice - $product->discount_value;
                    }
                }
            }

            $itemSubtotal = $discountedPrice * $item->qty;

            // Apply proportional coupon discount to this item
            $itemCouponDiscount = 0;
            if ($subtotal > 0 && $couponDiscount > 0) {
                $itemDiscountRatio = $itemSubtotal / $subtotal;
                $itemCouponDiscount = $couponDiscount * $itemDiscountRatio;
            }
            $itemSubtotalAfterCoupon = $itemSubtotal - $itemCouponDiscount;

            // Calculate tax on the amount AFTER coupon discount (CORRECT: tax after coupon discount)
            if ($product && $product->taxes) {
                foreach ($product->taxes as $taxObj) {
                    if ($taxObj->tax_type == 'percent' && $taxObj->tax_value > 0) {
                        $tax += ($itemSubtotalAfterCoupon * $taxObj->tax_value) / 100;
                    } elseif ($taxObj->tax_type == 'flat' && $taxObj->tax_value > 0) {
                        $tax += $taxObj->tax_value * $item->qty;
                    }
                }
            }
        }
    }

    $total = $discountedSubtotal + $tax + $shipping;
@endphp



<div class="block mb-0 order-summary" style="border: 1px solid #e0e0e0 !important; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05) !important; border-radius: 5px !important; background-color: #fff !important; padding: 15px !important;">
    <div class="block-content">
        <div class="row g-3">
            <div class="col-lg-8 col-md-12">
                <h3 class="title mb-3 text-uppercase">{{ localize('Order Summary') }}</h3>
                <div class="table-responsive-sm table-bottom-brd order-table" style="border: 1px solid #e0e0e0 !important; padding: 10px !important; border-radius: 4px !important; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important;">
                    <table class="table table-hover align-middle mb-0" style="border: none;">
                        <thead>
                            <tr>
                                <th class="action" style="width: 3%;">&nbsp;</th>
                                <th class="text-start" style="width: 8%;">{{ localize('Image') }}</th>
                                <th class="text-start proName" style="width: 50%;">{{ localize('Product') }}</th>
                                <th class="text-center" style="width: 10%;">{{ localize('Qty') }}</th>
                                <th class="text-center" style="width: 14%;">{{ localize('Price') }}</th>
                                <th class="text-end" style="width: 15%;">{{ localize('Subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartList as $cart)
                            <tr>
                                <td class="text-center cart-delete">
                                    <button type="button" class="btn btn-sm text-danger p-0" onclick="handleCartItem('delete', {{ $cart->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Remove from Cart') }}" style="font-size: 14px !important; padding: 5px !important;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-start">
                                    <a href="{{ $cart->product_variation && $cart->product_variation->product ? route('products.show', $cart->product_variation->product->slug) : '#' }}" class="thumb">
                                        <img class="rounded-0 blur-up lazyload" src="{{ $cart->product_variation && $cart->product_variation->product ? uploadedAsset($cart->product_variation->product->thumbnail_image) : '' }}" alt="{{ $cart->product_variation && $cart->product_variation->product ? $cart->product_variation->product->collectLocalization('name') : 'Product' }}" width="60" height="80" />
                                    </a>
                                </td>
                                <td class="text-start proName">
                                    <div class="list-view-item-title">
                                        <a href="{{ $cart->product_variation && $cart->product_variation->product ? route('products.show', $cart->product_variation->product->slug) : '#' }}">
                                            {{ $cart->product_variation && $cart->product_variation->product ? $cart->product_variation->product->collectLocalization('name') : 'Product' }}
                                        </a>
                                        @if ($cart->product_variation && $cart->product_variation->product && $cart->product_variation->product->taxes && $cart->product_variation->product->taxes->where('tax_value', '>', 0)->count() > 0)
                                            @php
                                                $taxPercentage = $cart->product_variation->product->taxes->where('tax_type', 'percent')->where('tax_value', '>', 0)->sum('tax_value');
                                            @endphp
                                            @if ($taxPercentage > 0)
                                                <small class="text-muted" style="font-size: 0.8em; margin-left: 5px;">[{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]</small>
                                            @else
                                                <small class="text-muted" style="font-size: 0.8em; margin-left: 5px;">[{{ localize('tax included') }}]</small>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="cart-meta-text">
                                        @if($cart->product_variation && $cart->product_variation->combinations)
                                            @foreach ($cart->product_variation->combinations as $combination)
                                                @if($combination && $combination->attribute && $combination->attribute_value)
                                                    {{ $combination->attribute->collectLocalization('name') }}: {{ $combination->attribute_value->collectLocalization('name') }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>

                                </td>
                                <td class="text-center">{{ $cart->qty }}</td>
                                <td class="text-center">
                                    @php
                                        $discountedPrice = 0;
                                        if ($cart->product_variation && $cart->product_variation->product) {
                                            $product = $cart->product_variation->product;
                                            // Get base price
                                            $basePrice = $product->base_price ?? $product->min_price ?? 0;

                                            // Apply discount if active
                                            $discountedPrice = $basePrice;
                                            if ($product->discount_start_date && $product->discount_end_date && $product->discount_value > 0) {
                                                if (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                                                    strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                                                    if ($product->discount_type == 'percent') {
                                                        $discountedPrice = $basePrice - (($basePrice * $product->discount_value) / 100);
                                                    } elseif ($product->discount_type == 'flat') {
                                                        $discountedPrice = $basePrice - $product->discount_value;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    {{ formatPrice($discountedPrice) }}
                                </td>
                                <td class="text-end"><strong>{{ formatPrice($discountedPrice * $cart->qty) }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <h3 class="title mb-3 text-uppercase">{{ localize('Subtotal') }}</h3>
                <div class="order-totals" style="border: 1px solid #e0e0e0 !important; padding: 15px !important; background-color: #f9f9f9 !important; border-radius: 4px !important; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important; max-width: 100%; overflow: hidden;">
                    <div class="border-bottom pb-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title"><strong>{{ localize('Subtotal') }}</strong></span>
                            <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">{{ formatPrice($subtotal) }}</span></span>
                        </div>
                    </div>

                    <div class="border-bottom py-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title"><strong>{{ localize('Taxable Amount') }}</strong></span>
                            <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">{{ formatPrice($taxableAmountForDisplay) }}</span></span>
                        </div>
                    </div>



                    @if ($currentCoupon != '' && $couponDiscount > 0)
                    <div class="border-bottom py-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title"><strong>{{ localize('Coupon Discount') }}</strong></span>
                            <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">-{{ formatPrice($couponDiscount) }}</span></span>
                        </div>
                    </div>
                    @endif

                    <div class="border-bottom py-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title"><strong>{{ localize('Tax') }}</strong></span>
                            <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">{{ formatPrice($tax) }}</span></span>
                        </div>
                    </div>



                    <div class="border-bottom py-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title"><strong>{{ localize('Shipping') }}</strong></span>
                            <span class="cart-subtotal-title cart-subtotal text-end">
                                <span class="money">
                                    @if(isset($shippingAmount))
                                        @if($is_free_shipping)
                                            {{ localize('FREE SHIPPING') }}
                                        @else
                                            {{ formatPrice($shippingAmount) }}
                                        @endif
                                    @else
                                        {{ localize('Calculated at next step') }}
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>

                    @if (getSetting('enable_delivery_tips') == 1)
                    <div class="border-bottom py-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title"><strong>{{ localize('Delivery Tips') }}</strong></span>
                            <span class="cart-subtotal-title cart-subtotal text-end">
                                <div class="form-group mb-0">
                                    <input type="number" name="tips" value="0" min="0" step="0.001" class="form-control text-end">
                                </div>
                            </span>
                        </div>
                    </div>
                    @endif

                    <div class="pt-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="cart-subtotal-title fs-5"><strong>{{ localize('TOTAL') }}</strong></span>
                            <span class="cart-subtotal-title fs-4 cart-subtotal text-end text-success"><b class="money">{{ formatPrice($total) }}</b></span>
                        </div>
                    </div>

                    <div class="pt-3 mb-0">
                        <button type="submit" class="btn btn-primary btn-md w-100" style="max-width: 100%; word-wrap: break-word;">{{ localize('PLACE ORDER') }}</button>
                    </div>
                </div>
            </div>

            <!-- This section is now handled in the right column -->
        </div>
    </div>
</div>
