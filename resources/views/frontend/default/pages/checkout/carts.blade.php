@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Carts') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb-title')
    {{ localize('YOUR SHOPPING CART') }}
@endsection

@section('breadcrumb-active')
    {{ localize('YOUR SHOPPING CART') }}
@endsection

@section('styles')
<style>
    .cart-section {
        background-color: #f8f9fa;
    }

    .cart-table {
        border: 1px solid #dee2e6;
        margin-bottom: 0;
    }

    .cart-table thead, .cart-header {
        background-color: #ffffff !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }

    .cart-header th, .cart-header tr {
        background-color: #ffffff !important;
    }

    .cart-table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        border-bottom: 1px solid #f0f0f0;
        background-color: #ffffff !important;
        height: 60px;
        padding: 0 15px;
    }

    .cart-table td {
        padding: 25px 15px;
        vertical-align: middle;
    }

    .cart-table tr {
        border-bottom: 1px solid #f0f0f0;
    }

    .discount-codes-box {
        border: 1px solid #dee2e6;
    }

    .cart-summary {
        border: 1px solid #dee2e6;
    }

    .btn-outline-secondary {
        background-color: white;
    }

    .btn-success {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    .btn-success:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .text-success {
        color: #006400 !important; /* Dark green */
    }

    .text-secondary {
        color: #6c757d !important; /* Grey color */
    }

    /* Style for the cart action buttons */
    .d-flex.justify-content-between .btn {
        text-transform: uppercase;
        font-weight: 500;
        padding: 4px 12px;
        font-size: 12px;
        line-height: 1.5;
        height: auto;
    }

    /* Reduce spacing between shop breadcrumb and cart table */
    .shop-breadcrumb + .cart-section {
        margin-top: -10px;
    }

    /* Quantity control styling */
    .product-qty {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        overflow: hidden;
    }

    .product-qty button {
        background: #f8f9fa;
        border: none;
        width: 30px;
        height: 30px;
        font-weight: bold;
        padding: 0;
        line-height: 30px;
        font-size: 16px;
    }

    .product-qty input {
        border: none;
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        height: 30px;
        width: 40px !important;
        text-align: center;
        padding: 0;
        font-size: 14px;
    }

    /* Mobile styles for 375x667 and similar screens */
    @media (max-width: 767px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 10px;
        }

        .d-flex.gap-2 {
            flex-wrap: wrap;
        }

        /* Override global button styles for mobile cart */
        .cart-section .btn,
        .cart-section .btn-sm,
        .cart-section .btn-outline-secondary,
        .cart-section .btn-outline-danger,
        .cart-section .btn-success,
        .cart-section .btn-secondary {
            font-size: 10px !important;
            padding: 6px 8px !important;
            line-height: 1.2 !important;
            min-height: auto !important;
            height: auto !important;
        }

        .d-flex.gap-2 .btn {
            margin-bottom: 10px;
            flex: 1 0 auto;
        }

        /* Mobile cart action buttons - more specific selectors */
        .cart-section .d-flex.justify-content-between .btn,
        .cart-section .d-flex.justify-content-between .btn-sm,
        .cart-section .d-flex.justify-content-between .btn-outline-secondary,
        .cart-section .d-flex.justify-content-between .btn-outline-danger,
        .cart-section .d-flex.justify-content-between .btn-success {
            font-size: 10px !important;
            padding: 6px 8px !important;
            text-transform: uppercase;
            font-weight: 500;
            min-width: auto !important;
            white-space: nowrap;
        }

        /* Mobile quantity buttons */
        .cart-section .product-qty button {
            width: 25px !important;
            height: 25px !important;
            font-size: 12px !important;
            font-weight: bold;
            padding: 0 !important;
            min-height: 25px !important;
        }

        .cart-section .product-qty input {
            width: 40px !important;
            height: 25px !important;
            font-size: 12px !important;
            padding: 0 5px !important;
        }

        /* Mobile coupon buttons */
        .cart-section .apply-coupon-btn,
        .cart-section .clear-coupon-btn,
        .cart-section .btn-secondary,
        .cart-section .btn-success {
            height: 35px !important;
            padding: 6px 12px !important;
            font-size: 12px !important;
            min-height: 35px !important;
        }

        /* Mobile proceed to checkout button */
        .cart-section .btn.w-100.text-uppercase,
        .cart-section .btn.w-100 {
            font-size: 12px !important;
            padding: 10px !important;
            min-height: auto !important;
            height: auto !important;
        }

        /* Mobile delete button */
        .cart-section .btn.text-danger,
        .cart-section .btn[onclick*="handleCartItem('delete'"] {
            font-size: 12px !important;
            padding: 5px !important;
            min-height: auto !important;
        }

        /* Mobile table text */
        .cart-section .cart-table td {
            font-size: 12px !important;
            padding: 8px 4px !important;
        }

        .cart-section .cart-table th {
            font-size: 11px !important;
            padding: 8px 4px !important;
        }

        /* Mobile cart summary */
        .cart-section .cart-summary h5,
        .cart-section .cart-summary h6 {
            font-size: 12px !important;
        }

        /* Mobile discount codes section */
        .cart-section .discount-codes-box h5 {
            font-size: 14px !important;
        }

        .cart-section .discount-codes-box p {
            font-size: 12px !important;
        }
    }

    /* Desktop ONLY styles - Large screens (992px+) - Won't affect mobile */
    @media (min-width: 992px) {
        /* Override inline styles for desktop cart action buttons */
        .cart-section .d-flex.justify-content-between .btn-outline-secondary[style],
        .cart-section .d-flex.justify-content-between .btn-outline-danger[style],
        .cart-section .d-flex.justify-content-between .btn-success[style] {
            font-size: 18px !important;
            padding: 15px 25px !important;
            min-height: 50px !important;
            font-weight: 600 !important;
        }
    }
</style>
@endsection

@section('contents')
    <!--shop breadcrumb-->
    @include('frontend.default.inc.shop-breadcrumb')
    <!--shop breadcrumb-->

    <!--cart section start-->
    <section class="cart-section pt-10 pb-120">
        <div class="container">
            <div class="border rounded-2 overflow-hidden mt-0 mb-4">
                <table class="cart-table w-100 bg-white">
                    <thead class="bg-white cart-header" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important; background-color: #ffffff !important;">
                        <tr style="background-color: #ffffff !important;">
                            <th class="ps-4 text-uppercase py-3 text-start" style="background-color: #ffffff !important;">{{ localize('Product') }}</th>
                            <th class="text-uppercase py-3 text-center" style="background-color: #ffffff !important;">{{ localize('Price') }}</th>
                            <th class="text-uppercase py-3 text-center" style="background-color: #ffffff !important;">{{ localize('Quantity') }}</th>
                            <th class="text-uppercase py-3 text-center" style="background-color: #ffffff !important;">{{ localize('Total') }}</th>
                            <th class="text-uppercase text-center py-3" style="background-color: #ffffff !important;">{{ localize('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="cart-listing">
                        <!--cart listing-->
                        @include('frontend.default.pages.partials.carts.cart-listing', ['carts' => $carts])
                        <!--cart listing-->
                    </tbody>
                </table>
            </div>
            <!-- Cart action buttons -->
            <div class="d-flex justify-content-between mt-4 mb-3">
                <div>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary border-secondary"
                       style="font-size: 10px !important; padding: 6px 8px !important;">{{ localize('CONTINUE SHOPPING') }}</a>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearCart()"
                            style="font-size: 10px !important; padding: 6px 8px !important;">{{ localize('CLEAR SHOPPING CART') }}</button>
                    <button type="button" class="btn btn-sm btn-success" onclick="updateCart()"
                            style="font-size: 10px !important; padding: 6px 8px !important;">{{ localize('UPDATE CART') }}</button>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="discount-codes-box bg-white rounded-2 p-4 p-lg-5">
                        <h5 class="fw-bold mb-3 text-uppercase">{{ localize('DISCOUNT CODES') }}</h5>
                        <p class="mb-3">{{ localize('Enter your coupon code if you have one.') }}</p>

                        <!-- coupon form -->
                        <form class="coupon-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="mb-2">
                                <input type="text" name="code" placeholder="{{ localize('Enter your coupon code') }}"
                                    class="form-control coupon-input w-100"
                                    style="border: 1px solid #dee2e6; height: 50px; padding: 8px 12px;"
                                    @if (getCoupon() != '') value="{{ getCoupon() }}" disabled @endif
                                    required>
                            </div>

                            <div>
                                @if (getCoupon() != '')
                                    <button type="button" class="btn btn-secondary clear-coupon-btn"
                                        style="height: 35px !important; padding: 6px 12px !important; font-size: 12px !important;">
                                        <i class="fas fa-close"></i> {{ localize('REMOVE COUPON') }}
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success apply-coupon-btn"
                                        style="height: 35px !important; padding: 6px 12px !important; font-size: 12px !important;">
                                        {{ localize('APPLY COUPON') }}
                                    </button>
                                @endif
                            </div>
                        </form>
                        <!-- coupon form -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="cart-summary bg-white rounded-2 p-4 p-lg-5">
                        <table class="w-100">
                            <tr>
                                <td class="py-2">
                                    <h6 class="mb-0 fw-normal text-uppercase">{{ localize('SUBTOTAL') }}</h6>
                                </td>
                                <td class="py-2 text-end">
                                    <h6 class="mb-0 fw-normal sub-total-price text-secondary">
                                        @php
                                            // Calculate subtotal using DISCOUNTED PRICES (with admin panel discount applied)
                                            $cartSubtotal = 0;
                                            foreach ($carts as $cart) {
                                                try {
                                                    if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
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

                                                        $cartSubtotal += $discountedPrice * $cart->qty;
                                                    }
                                                } catch (\Exception $e) {
                                                    // Handle error silently
                                                }
                                            }

                                            // Calculate coupon discount
                                            $couponDiscount = getCouponDiscountWithRestrictions($carts, getCoupon());
                                            $discountedSubtotal = $cartSubtotal - $couponDiscount;

                                            // Calculate tax based on DISCOUNTED PRICES AND after coupon discount (same logic as orderSummaryOnly)
                                            $tax = 0;
                                            foreach ($carts as $cart) {
                                                try {
                                                    if (isset($cart->product_variation) && isset($cart->product_variation->product)) {
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

                                                        $itemSubtotal = $discountedPrice * $cart->qty;

                                                        // Apply proportional coupon discount to this item
                                                        $itemCouponDiscount = 0;
                                                        if ($cartSubtotal > 0 && $couponDiscount > 0) {
                                                            $itemDiscountRatio = $itemSubtotal / $cartSubtotal;
                                                            $itemCouponDiscount = $couponDiscount * $itemDiscountRatio;
                                                        }
                                                        $itemSubtotalAfterCoupon = $itemSubtotal - $itemCouponDiscount;

                                                        // Calculate tax on the amount AFTER coupon discount (CORRECT: tax after coupon discount)
                                                        if ($product && $product->taxes) {
                                                            foreach ($product->taxes as $taxObj) {
                                                                if ($taxObj->tax_type == 'percent' && $taxObj->tax_value > 0) {
                                                                    $tax += ($itemSubtotalAfterCoupon * $taxObj->tax_value) / 100;
                                                                } elseif ($taxObj->tax_type == 'flat' && $taxObj->tax_value > 0) {
                                                                    $tax += $taxObj->tax_value * $cart->qty;
                                                                }
                                                            }
                                                        }
                                                    }
                                                } catch (\Exception $e) {
                                                    // Handle error silently
                                                }
                                            }
                                        @endphp
                                        {{ formatPrice($cartSubtotal) }}</h6>
                                </td>
                            </tr>

                            <tr class="coupon-discount-wrapper {{ getCoupon() == '' ? 'd-none' : '' }}">
                                <td class="py-2">
                                    <h6 class="mb-0 fw-normal text-uppercase">{{ localize('COUPON DISCOUNT') }}</h6>
                                </td>
                                <td class="py-2 text-end">
                                    <h6 class="mb-0 fw-normal coupon-discount-price text-secondary">
                                        -{{ formatPrice($couponDiscount) }}</h6>
                                </td>
                            </tr>

                           

                            <tr class="border-top">
                                <td class="py-3">
                                    <h5 class="mb-0 fw-bold text-uppercase">{{ localize('TOTAL') }}</h5>
                                </td>
                                <td class="py-3 text-end">
                                    <h5 class="mb-0 fw-bold cart-total-price" style="color: #006400;">
                                        @php
                                            // Calculate total using DISCOUNTED PRICES (with admin panel discount applied) + tax
                                            $finalTotal = $discountedSubtotal + $tax;
                                        @endphp
                                        {{ formatPrice($finalTotal) }}</h5>
                                </td>
                            </tr>
                        </table>

                        <div class="form-check mt-3 mb-4">
                            <input class="form-check-input" type="checkbox" id="terms-conditions">
                            <label class="form-check-label" for="terms-conditions">
                                {{ localize('I agree with the terms and conditions') }}
                            </label>
                        </div>

                        <a href="{{ route('checkout.proceed') }}"
                           class="btn btn-success w-100 text-uppercase"
                           style="font-size: 12px !important; padding: 10px !important;">{{ localize('PROCEED TO CHECKOUT') }}</a>
                    </div>
                </div>
            </div>

            <script>
                // Desktop-only button resizing
                function resizeCartButtonsForDesktop() {
                    // Only apply on desktop screens (992px+)
                    if (window.innerWidth >= 992) {
                        const cartActionButtons = document.querySelectorAll('.cart-section .d-flex.justify-content-between .btn');
                        cartActionButtons.forEach(button => {
                            button.style.fontSize = '16px';
                            button.style.padding = '12px 20px';
                            button.style.minHeight = '42px';
                            button.style.fontWeight = '500';
                        });
                    }
                }

                // Apply on page load
                document.addEventListener('DOMContentLoaded', resizeCartButtonsForDesktop);

                // Apply on window resize
                window.addEventListener('resize', resizeCartButtonsForDesktop);

                function clearCart() {
                    if(confirm("{{ localize('Are you sure you want to clear your cart?') }}")) {
                        window.location.href = "{{ route('carts.clear') }}";
                    }
                }

                function updateCart() {
                    window.location.reload();
                }

                // Override the updateCouponPrice function to also update the total
                function updateCouponPrice(data) {
                    $('.coupon-discount-wrapper').toggleClass('d-none');
                    $('.coupon-discount-price').html(data.couponDiscount);

                    // Update the total price by recalculating
                    updateCartTotal(data);
                }

                // Function to update cart total
                function updateCartTotal(data) {
                    // Get the current subtotal value (remove currency formatting)
                    var subtotalText = $('.sub-total-price').text();
                    var subtotalValue = parseFloat(subtotalText.replace(/[^\d.-]/g, ''));

                    // Get the coupon discount value (remove currency formatting and minus sign)
                    var discountText = $('.coupon-discount-price').text();
                    var discountValue = parseFloat(discountText.replace(/[^\d.-]/g, ''));

                    // Calculate new total
                    var newTotal = subtotalValue - (isNaN(discountValue) ? 0 : discountValue);

                    // Format and update the total
                    var formattedTotal = 'Rs. ' + newTotal.toFixed(2);
                    $('.cart-total-price').text(formattedTotal);
                }

                // Override the updateCarts function to preserve coupon state
                if (typeof window.originalUpdateCarts === 'undefined') {
                    window.originalUpdateCarts = window.updateCarts;

                    window.updateCarts = function(data) {
                        // Check if coupon was applied before update
                        var hadCoupon = !$('.coupon-discount-wrapper').hasClass('d-none');

                        // Call original function
                        window.originalUpdateCarts(data);

                        // If coupon was applied, don't hide the discount wrapper
                        if (hadCoupon && data.couponDiscount && data.couponDiscount !== 'Rs. 0.00') {
                            $('.coupon-discount-wrapper').removeClass('d-none');
                            $('.coupon-discount-price').html(data.couponDiscount);
                            updateCartTotal(data);
                        }
                    };
                }
            </script>
        </div>
    </section>
    <!--cart section end-->
@endsection
