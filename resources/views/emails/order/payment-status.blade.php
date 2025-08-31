<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailData['subject'] }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, {{ $emailData['color'] }}, {{ $emailData['color'] }}dd);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .status-badge {
            display: inline-block;
            background-color: {{ $emailData['color'] }};
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .order-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .order-info h3 {
            margin-top: 0;
            color: #495057;
            font-size: 18px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        .info-value {
            color: #495057;
        }
        .order-items {
            margin: 20px 0;
        }
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .item:last-child {
            border-bottom: none;
        }
        .item-details {
            flex: 1;
        }
        .item-name {
            font-weight: 600;
            color: #495057;
        }
        .item-price {
            font-weight: 600;
            color: {{ $emailData['color'] }};
        }
        .total-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total-row.grand-total {
            font-size: 18px;
            font-weight: 700;
            color: {{ $emailData['color'] }};
            border-top: 2px solid #e9ecef;
            padding-top: 15px;
            margin-top: 15px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #6c757d;
        }
        .footer p {
            margin: 5px 0;
        }
        .company-info {
            margin-top: 20px;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            .content {
                padding: 20px 15px;
            }
            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>{{ $emailData['title'] }}</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="status-badge">
                {{ ucwords(str_replace('_', ' ', $order->payment_status)) }}
            </div>

            <p style="font-size: 16px; margin-bottom: 10px;">
                {{ localize('Hello') }} <strong>{{ $customerInfo['name'] ?: localize('Valued Customer') }},</strong>
            </p>

            <p style="font-size: 16px; margin-bottom: 20px;">
                {{ $emailData['message'] }}
            </p>

            <p style="color: #6c757d; margin-bottom: 30px;">
                {{ $emailData['description'] }}
            </p>

            <!-- Order Information -->
            <div class="order-info">
                <h3>{{ localize('Order Information') }}</h3>
                <div class="info-row">
                    <span class="info-label">{{ localize('Order Number') }}:</span>
                    <span class="info-value">{{ $orderCode }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">{{ localize('Order Date') }}:</span>
                    <span class="info-value">{{ date('M d, Y', strtotime($order->created_at)) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">{{ localize('Payment Status') }}:</span>
                    <span class="info-value" style="color: {{ $emailData['color'] }}; font-weight: 600;">
                        {{ ucwords(str_replace('_', ' ', $order->payment_status)) }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">{{ localize('Delivery Status') }}:</span>
                    <span class="info-value">{{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}</span>
                </div>
            </div>

            <!-- Order Items -->
            <div class="order-items">
                <h3>{{ localize('Order Items') }}</h3>
                @foreach($order->orderItems as $item)
                @php
                    $product = $item->product_variation->productWithTrashed ?? $item->product_variation->product;
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

                    $itemTotal = $discountedPrice * $item->qty;
                @endphp
                <div class="item">
                    <div class="item-details">
                        <div class="item-name">{{ $product->collectLocalization('name') }}</div>
                        @if($item->product_variation->variation_key)
                            <div style="font-size: 14px; color: #6c757d;">
                                {{ $item->product_variation->variation_key }}
                            </div>
                        @endif
                        @if ($product && $product->taxes && $product->taxes->where('tax_value', '>', 0)->count() > 0)
                            @php
                                $taxPercentage = $product->taxes->where('tax_type', 'percent')->where('tax_value', '>', 0)->sum('tax_value');
                            @endphp
                            <div style="font-size: 12px; color: #6c757d; margin-top: 2px;">
                                @if ($taxPercentage > 0)
                                    [{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]
                                @else
                                    [{{ localize('tax included') }}]
                                @endif
                            </div>
                        @endif
                        <div style="font-size: 14px; color: #6c757d;">
                            {{ localize('Qty') }}: {{ $item->qty }} × {{ formatPrice($discountedPrice) }}
                        </div>
                    </div>
                    <div class="item-price">
                        {{ formatPrice($itemTotal) }}
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total Section -->
            @php
                // EXACT SAME LOGIC AS WORKING FRONTEND INVOICE
                $orderItems = $order->orderItems;

                // 1. Calculate subtotal using DISCOUNTED price (BEFORE tax) - same as frontend
                $subtotal = $orderItems->sum(function($item) {
                    $product = $item->product_variation->productWithTrashed ?? $item->product_variation->product;
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

                // 2. Get coupon code and calculate discount with restrictions
                $currentCoupon = $order->applied_coupon_code ?? '';
                $couponDiscount = 0;
                if (!empty($currentCoupon)) {
                    $couponDiscount = getCouponDiscountFromOrderItems($orderItems, $currentCoupon);
                }
                $discountedSubtotal = $subtotal - $couponDiscount;

                // 3. Calculate tax on discounted subtotal - EXACT same logic as frontend
                $tax = 0;
                foreach ($orderItems as $item) {
                    $product = $item->product_variation->productWithTrashed ?? $item->product_variation->product;
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
                    if ($product && $product->taxes) {
                        foreach ($product->taxes as $productTax) {
                            if ($productTax->tax_type == 'percent') {
                                $tax += ($itemDiscountedPrice * $productTax->tax_value) / 100;
                            } elseif ($productTax->tax_type == 'flat') {
                                $tax += $productTax->tax_value * $item->qty;
                            }
                        }
                    }
                }

                // 4. Calculate grand total - same as frontend
                $grandTotal = $discountedSubtotal + $tax + $order->orderGroup->total_shipping_cost;
            @endphp
            <div class="total-section">
                <div class="total-row">
                    <span>{{ localize('Subtotal') }}:</span>
                    <span>{{ formatPrice($subtotal) }}</span>
                </div>
                @if($couponDiscount > 0)
                <div class="total-row">
                    <span>{{ localize('Coupon Discount') }}:</span>
                    <span style="color: #28a745;">-{{ formatPrice($couponDiscount) }}</span>
                </div>
                @endif
                @if($order->orderGroup->total_shipping_cost > 0)
                <div class="total-row">
                    <span>{{ localize('Shipping Cost') }}:</span>
                    <span>{{ formatPrice($order->orderGroup->total_shipping_cost) }}</span>
                </div>
                @endif
                @if($tax > 0)
                <div class="total-row">
                    <span>{{ getTaxDisplayText($orderItems) }}:</span>
                    <span>{{ formatPrice($tax) }}</span>
                </div>
                @endif
                <div class="total-row grand-total">
                    <span>{{ localize('Grand Total') }}:</span>
                    <span>{{ formatPrice($grandTotal) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>{{ localize('Thank you for choosing us!') }}</strong></p>
            <p>{{ localize('If you have any questions, please contact our support team.') }}</p>

            <div class="company-info">
                <p><strong>{{ getSetting('system_title') ?? env('APP_NAME') }}</strong></p>
                <p>{{ localize('Email') }}: {{ getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS') }}</p>
                <p>{{ localize('Website') }}: {{ env('APP_URL') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
