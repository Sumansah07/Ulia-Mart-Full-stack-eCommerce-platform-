@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Order Success') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <!--order success section start-->
    @if (!is_null($orderGroup))
        @php
            $order = $orderGroup->order;
            $orderItems = $order->orderItems;

            // CORRECT calculation logic: Coupon discount on subtotal BEFORE tax, then tax on discounted amount
            // 1. Calculate subtotal using DISCOUNTED price (BEFORE tax)
            $subtotal = $orderItems->sum(function($item) {
                $product = $item->product_variation->productWithTrashed;
                // Use discounted price without tax for subtotal calculation
                $unitPrice = discountedProductBasePriceWithoutTax($product);
                return $unitPrice * $item->qty;
            });

            // 2. Get coupon code from order
            $currentCoupon = $order->applied_coupon_code ?? '';

            // 3. Calculate coupon discount correctly with restrictions
            $couponDiscount = 0;
            if (!empty($currentCoupon)) {
                $couponDiscount = getCouponDiscountFromOrderItems($orderItems, $currentCoupon);
            }
            $discountedSubtotal = $subtotal - $couponDiscount;

            // 4. Calculate tax on discounted subtotal (CORRECT: tax after coupon discount)
            $tax = 0;
            foreach ($orderItems as $item) {
                $product = $item->product_variation->productWithTrashed;
                // Use discounted price without tax for tax calculation
                $unitPriceBeforeTax = discountedProductBasePriceWithoutTax($product);
                $itemSubtotal = $unitPriceBeforeTax * $item->qty;

                // Apply proportional discount to this item
                $itemDiscountRatio = $subtotal > 0 ? ($itemSubtotal / $subtotal) : 0;
                $itemCouponDiscount = $couponDiscount * $itemDiscountRatio;
                $itemDiscountedPrice = $itemSubtotal - $itemCouponDiscount;

                // Calculate tax on the discounted price
                foreach ($product->taxes as $productTax) {
                    if ($productTax->tax_type == 'percent') {
                        $tax += ($itemDiscountedPrice * $productTax->tax_value) / 100;
                    } elseif ($productTax->tax_type == 'flat') {
                        $tax += $productTax->tax_value * $item->qty;
                    }
                }
            }

            // Calculate taxable amount for display based on items with tax
            $taxableAmountForDisplay = 0;
            foreach ($orderItems as $item) {
                $product = $item->product_variation->productWithTrashed;
                // Use discounted price without tax for taxable amount calculation
                $unitPriceBeforeTax = discountedProductBasePriceWithoutTax($product);
                $itemSubtotal = $unitPriceBeforeTax * $item->qty;

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

            // 5. Calculate grand total
            $grandTotal = $discountedSubtotal + $tax + $orderGroup->total_shipping_cost + $orderGroup->total_tips_amount;
        @endphp
        <section class="order-success-section py-5">
            <div class="container">
                <!-- Page Title -->
                <div class="row mb-4">
                    <div class="col-6">
                        <h1 class="fw-bold">{{ localize('ORDER SUCCESS') }}</h1>
                    </div>
                    <div class="col-6 text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ localize('HOME') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ localize('ORDER SUCCESS') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <img src="{{ staticAsset('frontend/default/assets/img/success-icon.svg') }}" alt="success" class="img-fluid" style="width: 80px;">
                    </div>
                    <h2 class="fw-bold mb-3">{{ localize('Thank you for your order!') }}</h2>
                    <p class="text-muted">
                        {{ localize('Payment is successfully processed and your order is on the way') }}
                    </p>
                    <p class="text-muted">
                        {{ localize('You will receive an order confirmation email with details of your order and a link to track its progress.') }}
                    </p>
                </div>

                <!-- Main Content Row -->
                <div class="row">
                    <!-- Left Column - Order Summary -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">{{ localize('ORDER SUMMARY') }}</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">{{ localize('IMAGE') }}</th>
                                                <th>{{ localize('PRODUCT') }}</th>
                                                <th>{{ localize('QTY') }}</th>
                                                <th>{{ localize('PRICE') }}</th>
                                                <th class="text-end pe-4">{{ localize('SUBTOTAL') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItems as $key => $item)
                                                @php
                                                    $product = $item->product_variation->productWithTrashed;
                                                    // Show the product's discounted price WITHOUT tax as the unit price
                                                    $unitPriceWithoutTax = discountedProductBasePriceWithoutTax($product);
                                                    $totalPriceWithoutTax = $unitPriceWithoutTax * $item->qty;
                                                @endphp
                                                <tr>
                                                    <td class="ps-4">
                                                        <img src="{{ uploadedAsset($product->thumbnail_image) }}"
                                                            alt="{{ $product->collectLocalization('name') }}"
                                                            class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h6 class="mb-0">{{ $product->collectLocalization('name') }}</h6>
                                                            <small class="text-muted">
                                                                @if($product->product_type == 'variable')
                                                                    @foreach (generateVariationOptions($item->product_variation->combinations) as $variation)
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
                                                                @endif
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ formatPrice($unitPriceWithoutTax) }}</td>
                                                    <td class="text-end pe-4">{{ formatPrice($totalPriceWithoutTax) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Order Totals - Moved here from below -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td><strong>{{ localize('SUBTOTAL') }}</strong></td>
                                        <td class="text-end">{{ formatPrice($subtotal) }}</td>
                                    </tr>
                                    @if($couponDiscount > 0 || $orderGroup->total_coupon_discount_amount > 0)
                                    <tr>
                                        <td><strong>{{ localize('COUPON DISCOUNT') }}</strong></td>
                                        <td class="text-end text-danger">-{{ formatPrice($couponDiscount > 0 ? $couponDiscount : $orderGroup->total_coupon_discount_amount) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="total-row">
                                        <td><strong>{{ localize('Taxable Amount') }}</strong></td>
                                        <td class="text-end"><span>{{ formatPrice($taxableAmountForDisplay) }}</span></td>
                                    </tr>
                                    @if($tax > 0)
                                    <tr>
                                        <td><strong>{{ getTaxDisplayText($orderItems) }}</strong></td>
                                        <td class="text-end">{{ formatPrice($tax) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>{{ localize('SHIPPING') }}</strong></td>
                                        <td class="text-end">
                                            @if($orderGroup->total_shipping_cost > 0)
                                                {{ formatPrice($orderGroup->total_shipping_cost) }}
                                            @else
                                                <span class="text-success">{{ localize('FREE SHIPPING') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="fw-bold border-top pt-2"><strong>{{ localize('TOTAL') }}</strong></td>
                                        <td class="fw-bold text-success border-top pt-2 text-end">{{ formatPrice($grandTotal) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Shipping & Billing Info -->
                    <div class="col-lg-6 mb-4">
                        <!-- Addresses -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h5 class="fw-bold mb-3">{{ localize('SHIPPING ADDRESS') }}</h5>
                                        @if($orderGroup->user_id)
                                            {{-- Logged in user - use address relationship --}}
                                            @php
                                                $shippingAddress = $orderGroup->shippingAddress;
                                            @endphp
                                            <p class="mb-1"><strong>{{ optional($shippingAddress)->name }}</strong></p>
                                            <p class="mb-1">{{ optional($shippingAddress)->phone }}</p>
                                            <p class="mb-1">{{ optional($shippingAddress)->address }}</p>
                                            <p class="mb-1">{{ optional(optional($shippingAddress)->city)->name }},
                                                {{ optional(optional($shippingAddress)->state)->name }}</p>
                                            <p class="mb-1">{{ optional(optional($shippingAddress)->country)->name }}</p>
                                            <p class="mb-0">{{ optional($shippingAddress)->postal_code }}</p>
                                        @else
                                            {{-- Guest user - use guest fields --}}
                                            <p class="mb-1"><strong>{{ $orderGroup->guest_shipping_name }}</strong></p>
                                            <p class="mb-1">{{ $orderGroup->guest_shipping_phone }}</p>
                                            <p class="mb-1">{{ $orderGroup->guest_shipping_address }}</p>
                                            <p class="mb-0">{{ $orderGroup->guest_shipping_city }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">{{ localize('BILLING ADDRESS') }}</h5>
                                        @if($orderGroup->user_id)
                                            {{-- Logged in user - use address relationship --}}
                                            @php
                                                $billingAddress = $orderGroup->billingAddress;
                                            @endphp
                                            <p class="mb-1"><strong>{{ optional($billingAddress)->name }}</strong></p>
                                            <p class="mb-1">{{ optional($billingAddress)->phone }}</p>
                                            <p class="mb-1">{{ optional($billingAddress)->address }}</p>
                                            <p class="mb-1">{{ optional(optional($billingAddress)->city)->name }},
                                                {{ optional(optional($billingAddress)->state)->name }}</p>
                                            <p class="mb-1">{{ optional(optional($billingAddress)->country)->name }}</p>
                                            <p class="mb-0">{{ optional($billingAddress)->postal_code }}</p>
                                        @else
                                            {{-- Guest user - use guest fields --}}
                                            <p class="mb-1"><strong>{{ $orderGroup->guest_billing_name }}</strong></p>
                                            <p class="mb-1">{{ $orderGroup->guest_billing_phone }}</p>
                                            <p class="mb-1">{{ $orderGroup->guest_billing_address }}</p>
                                            <p class="mb-0">{{ $orderGroup->guest_billing_city }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping & Payment Method -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h5 class="fw-bold mb-3">{{ localize('SHIPPING METHOD') }}</h5>
                                        <p class="mb-1">{{ localize('Flat Rate - Fixed') }}</p>
                                        <p class="mb-0">{{ localize('Delivery Date') }}: N/A</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">{{ localize('PAYMENT METHOD') }}</h5>
                                        <p class="mb-1">{{ ucwords(str_replace('_', ' ', $orderGroup->payment_method)) }}</p>
                                        <p class="mb-0">{{ localize('Status') }}:
                                            <span class="badge bg-{{ $orderGroup->payment_status == paidPaymentStatus() ? 'success' : 'warning' }}">
                                                {{ ucwords(str_replace('_', ' ', $orderGroup->payment_status)) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h5 class="fw-bold mb-3">{{ localize('ORDER DETAILS') }}</h5>
                                        <p class="mb-1">{{ localize('Order ID') }}: {{ getSetting('order_code_prefix') }}{{ $orderGroup->order_code }}</p>
                                        <p class="mb-1">{{ localize('Order Date') }}: {{ formatOrderDateTime($orderGroup->created_at, 'F d, Y h:i A') }}</p>
                                        <p class="mb-0">{{ localize('Order Total') }}: {{ formatPrice($grandTotal) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">{{ localize('EXPECTED DATE OF DELIVERY') }}</h5>
                                        <p class="mb-1">{{ localize('Your order is on the way') }}</p>
                                        <p class="mb-3">{{ date('F d, Y', strtotime($orderGroup->created_at . ' +5 days')) }}</p>
                                        <a href="{{ route('customers.trackOrder') }}" class="btn btn-outline-secondary btn-sm">{{ localize('Track order') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Row -->
                <div class="row">
                    <div class="col-12 mb-4 d-flex justify-content-center">
                        <div class="d-flex gap-3">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                {{ localize('CONTINUE SHOPPING') }}
                            </a>
                            <a href="{{ route('customers.orderDetails', ['code' => $orderGroup->order_code]) }}" class="btn btn-success">
                                {{ localize('VIEW ORDER') }}
                            </a>
                            <a href="javascript:void(0);" onclick="window.print()" class="btn btn-success">
                                {{ localize('PRINT ORDER') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--order success section end-->
@endsection

@section('scripts')
    <script>
        "use strict";
        // Add any JavaScript needed for the order success page

        // FORCE MOBILE BUTTON SIZING FOR 430px
        $(document).ready(function() {
            function forceMobileButtonSizing() {
                const screenWidth = window.innerWidth;
                console.log('Screen width:', screenWidth);

                if (screenWidth <= 430) {
                    console.log('Applying 430px button styles...');

                    // Force button container styles
                    $('.order-success-section .d-flex.gap-3').css({
                        'flex-direction': 'row',
                        'gap': '5px',
                        'width': '100%',
                        'flex-wrap': 'nowrap',
                        'justify-content': 'center',
                        'padding': '0 10px'
                    });

                    // Force individual button styles
                    $('.order-success-section .d-flex.gap-3 .btn').css({
                        'font-size': '10px',
                        'padding': '6px 8px',
                        'height': '32px',
                        'min-height': '32px',
                        'max-height': '32px',
                        'width': 'auto',
                        'flex': '1',
                        'max-width': '110px',
                        'margin': '0',
                        'border-radius': '6px',
                        'font-weight': '600',
                        'line-height': '1.2',
                        'text-align': 'center',
                        'display': 'flex',
                        'align-items': 'center',
                        'justify-content': 'center',
                        'white-space': 'nowrap'
                    });

                    console.log('430px button styles applied!');
                }
            }

            // Apply on page load
            forceMobileButtonSizing();

            // Apply on window resize
            $(window).resize(function() {
                forceMobileButtonSizing();
            });
        });
    </script>

    <!-- Mobile Button Optimization CSS -->
    <style>
        /* Mobile Button Styles for iPhone 14 Plus (430px) and smaller */
        @media (max-width: 430px) and (min-width: 376px) {
            /* iPhone 14 Plus specific - 430*932 */
            .order-success-section .d-flex.gap-3 {
                flex-direction: row !important;
                gap: 3px !important;
                width: 100% !important;
                max-width: 100% !important;
                flex-wrap: nowrap !important;
                justify-content: center !important;
            }

            .order-success-section .d-flex.gap-3 .btn {
                font-size: 8px !important;
                padding: 4px 5px !important;
                height: 26px !important;
                min-height: 26px !important;
                max-height: 26px !important;
                width: auto !important;
                flex: 1 !important;
                max-width: 95px !important;
                margin: 0 !important;
                border-radius: 4px !important;
                font-weight: 600 !important;
                line-height: 1.1 !important;
                text-align: center !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
            }

            /* Container adjustments for 430px */
            .order-success-section .d-flex.justify-content-center {
                padding: 0 8px !important;
            }
        }

        /* Mobile Button Styles for all mobile devices */
        @media (max-width: 430px) {
            /* Order Success Action Buttons - Mobile Optimization - SAME ROW */
            .order-success-section .d-flex.gap-3 {
                flex-direction: row !important;
                gap: 4px !important;
                width: 100% !important;
                max-width: 100% !important;
                flex-wrap: nowrap !important;
                justify-content: center !important;
            }

            .order-success-section .d-flex.gap-3 .btn {
                font-size: 9px !important;
                padding: 5px 6px !important;
                height: 28px !important;
                min-height: 28px !important;
                max-height: 28px !important;
                width: auto !important;
                flex: 1 !important;
                max-width: 100px !important;
                margin: 0 !important;
                border-radius: 5px !important;
                font-weight: 600 !important;
                line-height: 1.1 !important;
                text-align: center !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
            }

            /* Specific button styling */
            .order-success-section .btn-outline-secondary {
                border: 1.5px solid #6c757d !important;
                color: #6c757d !important;
                background: white !important;
            }

            .order-success-section .btn-success {
                background: #198754 !important;
                border: 1.5px solid #198754 !important;
                color: white !important;
            }

            /* Container adjustments */
            .order-success-section .d-flex.justify-content-center {
                padding: 0 10px !important;
            }

            /* Track Order button in delivery section - also make smaller */
            .order-success-section .btn-sm {
                font-size: 11px !important;
                padding: 6px 10px !important;
                height: 32px !important;
                border-radius: 6px !important;
            }
        }

        /* Extra small phones (320px) */
        @media (max-width: 375px) {
            .order-success-section .d-flex.gap-3 {
                gap: 4px !important;
            }

            .order-success-section .d-flex.gap-3 .btn {
                font-size: 9px !important;
                padding: 5px 6px !important;
                height: 30px !important;
                min-height: 30px !important;
                max-height: 30px !important;
                max-width: 100px !important;
                border-radius: 5px !important;
            }
        }

        /* AGGRESSIVE OVERRIDE FOR 430px SCREENS */
        @media screen and (max-width: 430px) {
            body .order-success-section .d-flex.gap-3 .btn,
            html body .order-success-section .d-flex.gap-3 .btn {
                font-size: 8px !important;
                padding: 4px 5px !important;
                height: 26px !important;
                min-height: 26px !important;
                max-height: 26px !important;
                max-width: 95px !important;
                border-radius: 4px !important;
                line-height: 1.1 !important;
            }

            body .order-success-section .d-flex.gap-3,
            html body .order-success-section .d-flex.gap-3 {
                gap: 3px !important;
            }
        }
    </style>
@endsection
