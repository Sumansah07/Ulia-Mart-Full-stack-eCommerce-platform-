@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Order Details') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="my-account pt-6 pb-120">
        <div class="container">
            @if (!is_null($orderGroup))
                @php
                    $order = $orderGroup->order;
                    $orderItems = $order->orderItems;

                    // CORRECT calculation logic: Coupon discount on subtotal BEFORE tax, then tax on discounted amount
                    // 1. Calculate subtotal using DISCOUNTED price (BEFORE tax)
                    $subtotal = $orderItems->sum(function($item) {
                        $product = $item->product_variation->productWithTrashed;
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

                        return $discountedPrice * $item->qty;
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

                    // 5. Calculate grand total
                    $grandTotal = $discountedSubtotal + $tax + $orderGroup->total_shipping_cost + $orderGroup->total_tips_amount;

                    // Calculate taxable amount for display based on items with tax
                    $taxableAmountForDisplay = 0;
                    foreach ($orderItems as $item) {
                        $product = $item->product_variation->productWithTrashed;
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

                    // For POS orders, also subtract POS discount
                    if ($orderGroup->is_pos_order && $orderGroup->total_discount_amount > 0) {
                        $grandTotal -= $orderGroup->total_discount_amount;
                    }
                @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <h1 class="h3 mb-0 fw-bold">{{ localize('Order Details') }}</h1>
                            <p class="mb-0">{{ localize('Order Code') }}: {{ getSetting('order_code_prefix') }}{{ $orderGroup->order_code }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Left Column - Order Summary -->
                    <div class="col-lg-8 mb-4">
                        <!-- Order Summary -->
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

                                                    $unitPriceWithoutTax = $discountedPrice;
                                                    $totalPriceWithoutTax = $discountedPrice * $item->qty;
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

                        <!-- Order Totals -->
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
                                    @if($taxableAmountForDisplay > 0)
                                    <tr>
                                        <td><strong>{{ localize('Taxable Amount') }}</strong></td>
                                        <td class="text-end">{{ formatPrice($taxableAmountForDisplay) }}</td>
                                    </tr>
                                    @endif
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
                                    @if ($orderGroup->is_pos_order && $orderGroup->total_discount_amount > 0)
                                        <tr>
                                            <td><strong>{{ localize('DISCOUNT') }}</strong></td>
                                            <td class="text-end text-danger">-{{ formatPrice($orderGroup->total_discount_amount) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="fw-bold border-top pt-2"><strong>{{ localize('TOTAL') }}</strong></td>
                                        <td class="fw-bold text-success border-top pt-2 text-end">{{ formatPrice($grandTotal) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Order Details & Shipping Info -->
                    <div class="col-lg-4">
                        <!-- Order Status -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">{{ localize('ORDER STATUS') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-1">{{ localize('Payment Status') }}</h6>
                                    <span class="badge bg-{{ $orderGroup->payment_status == paidPaymentStatus() ? 'success' : 'warning' }}">
                                        {{ ucwords(str_replace('_', ' ', $orderGroup->payment_status)) }}
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ localize('Delivery Status') }}</h6>
                                    <span class="badge bg-{{ $order->delivery_status == orderDeliveredStatus() ? 'success' : 'primary' }}">
                                        {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Addresses -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">{{ localize('ADDRESSES') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h6 class="fw-bold mb-2">{{ localize('SHIPPING ADDRESS') }}</h6>
                                        @php
                                            $shippingInfo = $orderGroup->getShippingAddressInfo();
                                        @endphp
                                        @if($shippingInfo['name'])
                                            <p class="mb-1"><strong>{{ $shippingInfo['name'] }}</strong></p>
                                        @endif
                                        @if($shippingInfo['address'])
                                            <p class="mb-1">{{ $shippingInfo['address'] }}</p>
                                        @endif
                                        @if($shippingInfo['city'] || $shippingInfo['state'])
                                            <p class="mb-1">{{ $shippingInfo['city'] }}{{ $shippingInfo['state'] ? ', ' . $shippingInfo['state'] : '' }}</p>
                                        @endif
                                        @if($shippingInfo['country'])
                                            <p class="mb-1">{{ $shippingInfo['country'] }}</p>
                                        @endif
                                        @if($shippingInfo['postal_code'])
                                            <p class="mb-0">{{ $shippingInfo['postal_code'] }}</p>
                                        @endif
                                        @if($shippingInfo['phone'])
                                            <p class="mb-0"><strong>{{ localize('Phone') }}:</strong> {{ $shippingInfo['phone'] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-2">{{ localize('BILLING ADDRESS') }}</h6>
                                        @php
                                            $billingInfo = $orderGroup->getBillingAddressInfo();
                                        @endphp
                                        @if($billingInfo['name'])
                                            <p class="mb-1"><strong>{{ $billingInfo['name'] }}</strong></p>
                                        @endif
                                        @if($billingInfo['address'])
                                            <p class="mb-1">{{ $billingInfo['address'] }}</p>
                                        @endif
                                        @if($billingInfo['city'] || $billingInfo['state'])
                                            <p class="mb-1">{{ $billingInfo['city'] }}{{ $billingInfo['state'] ? ', ' . $billingInfo['state'] : '' }}</p>
                                        @endif
                                        @if($billingInfo['country'])
                                            <p class="mb-1">{{ $billingInfo['country'] }}</p>
                                        @endif
                                        @if($billingInfo['postal_code'])
                                            <p class="mb-0">{{ $billingInfo['postal_code'] }}</p>
                                        @endif
                                        @if($billingInfo['phone'])
                                            <p class="mb-0"><strong>{{ localize('Phone') }}:</strong> {{ $billingInfo['phone'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment & Shipping Method -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold">{{ localize('PAYMENT & SHIPPING') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h6 class="fw-bold mb-2">{{ localize('PAYMENT METHOD') }}</h6>
                                        <p class="mb-1">{{ ucwords(str_replace('_', ' ', $orderGroup->payment_method)) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-2">{{ localize('SHIPPING METHOD') }}</h6>
                                        <p class="mb-1">{{ localize('Standard Shipping') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 order-details-buttons">
                            <a href="{{ route('customers.orderHistory') }}" class="btn btn-outline-secondary flex-grow-1">
                                {{ localize('BACK TO ORDERS') }}
                            </a>
                            <a href="{{ route('checkout.invoice', $orderGroup->order_code) }}" class="btn btn-success flex-grow-1" target="_blank">
                                {{ localize('VIEW INVOICE') }}
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <h3 class="fw-bold">{{ localize('No order found') }}</h3>
                        <a href="{{ route('customers.orderHistory') }}" class="btn btn-primary mt-3">
                            {{ localize('BACK TO ORDERS') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Mobile Button Optimization CSS for Order Details -->
    <style>
        /* Mobile Button Styles for iPhone 14 Pro (390px), iPhone 12/13 (375px), iPhone 14 Plus (430px) */
        @media (max-width: 430px) {
            /* Order Details Action Buttons - Mobile Optimization - SAME ROW */
            .order-details-buttons {
                flex-direction: row !important;
                gap: 8px !important;
                width: 100% !important;
                max-width: 100% !important;
                flex-wrap: nowrap !important;
                justify-content: center !important;
                padding: 0 15px !important;
            }

            .order-details-buttons .btn {
                font-size: 11px !important;
                padding: 8px 10px !important;
                height: 36px !important;
                min-height: 36px !important;
                max-height: 36px !important;
                width: auto !important;
                flex: 1 !important;
                max-width: 160px !important;
                margin: 0 !important;
                border-radius: 8px !important;
                font-weight: 600 !important;
                line-height: 1.2 !important;
                text-align: center !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
            }

            /* Specific button styling */
            .order-details-buttons .btn-outline-secondary {
                border: 1.5px solid #6c757d !important;
                color: #6c757d !important;
                background: white !important;
            }

            .order-details-buttons .btn-success {
                background: #198754 !important;
                border: 1.5px solid #198754 !important;
                color: white !important;
            }
        }

        /* Extra small phones (320px) */
        @media (max-width: 375px) {
            .order-details-buttons {
                gap: 6px !important;
                padding: 0 10px !important;
            }

            .order-details-buttons .btn {
                font-size: 10px !important;
                padding: 6px 8px !important;
                height: 32px !important;
                min-height: 32px !important;
                max-height: 32px !important;
                max-width: 140px !important;
                border-radius: 6px !important;
            }
        }
    </style>
@endsection
