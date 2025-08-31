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
        .progress-tracker {
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .progress-step {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }
        .progress-step:last-child {
            margin-bottom: 0;
        }
        .step-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
            font-size: 12px;
        }
        .step-icon.completed {
            color: #28a745;
        }
        .step-icon.current {
            color: {{ $emailData['color'] }};
        }
        .step-icon.pending {
            color: #6c757d;
        }
        .step-text {
            flex: 1;
            font-weight: 500;
        }
        .step-text.current {
            color: {{ $emailData['color'] }};
            font-weight: 600;
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
        .delivery-info {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
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
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-table th,
        .order-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #dee2e6;
        }
        .order-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
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
            .order-table {
                font-size: 14px;
            }
            .order-table th,
            .order-table td {
                padding: 8px 4px;
            }
            .total-row {
                flex-direction: column;
                align-items: flex-start;
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
                {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
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

            <!-- Progress Tracker -->
            <div class="progress-tracker">
                <h3 style="margin-top: 0; color: #495057;">{{ localize('Order Progress') }}</h3>
                
                @php
                    $statuses = ['order_placed', 'pending', 'processing', 'picked_up', 'out_for_delivery', 'delivered'];
                    $statusLabels = [
                        'order_placed' => localize('Order Placed'),
                        'pending' => localize('Processing'),
                        'processing' => localize('Being Prepared'),
                        'picked_up' => localize('Picked Up'),
                        'out_for_delivery' => localize('Out for Delivery'),
                        'delivered' => localize('Delivered')
                    ];
                    $currentIndex = array_search($order->delivery_status, $statuses);
                @endphp

                @foreach($statuses as $index => $status)
                    @if($status == 'delivered' && $order->delivery_status == 'cancelled')
                        @continue
                    @endif
                    
                    <div class="progress-step">
                        <div class="step-icon {{ $index < $currentIndex ? 'completed' : ($index == $currentIndex ? 'current' : 'pending') }}">
                            @if($index < $currentIndex)
                                ✓
                            @elseif($index == $currentIndex)
                                {{ $index + 1 }}
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <div class="step-text {{ $index == $currentIndex ? 'current' : '' }}">
                            {{ $statusLabels[$status] ?? ucwords(str_replace('_', ' ', $status)) }}
                        </div>
                    </div>
                @endforeach

                @if($order->delivery_status == 'cancelled')
                    <div class="step-icon" style="color: #dc3545;">
                        ✕
                    </div>
                    <div class="step-text" style="color: #dc3545; font-weight: 600;">
                        {{ localize('Order Cancelled') }}
                    </div>
                @endif
            </div>

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
                    <span class="info-label">{{ localize('Delivery Status') }}:</span>
                    <span class="info-value" style="color: {{ $emailData['color'] }}; font-weight: 600;">
                        {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                    </span>
                </div>
                
            </div>

            <!-- Delivery Information -->
            @if($order->delivery_status == 'out_for_delivery' || $order->delivery_status == 'delivered')
                <div class="delivery-info">
                    <h4 style="margin-top: 0; color: #1976d2;">{{ localize('Delivery Information') }}</h4>
                    @if($order->orderGroup->shipping_address)
                        <p><strong>{{ localize('Delivery Address') }}:</strong></p>
                        <p>{{ $order->orderGroup->shipping_address }}</p>
                    @endif
                    @if($order->delivery_status == 'delivered')
                        <p style="color: #28a745; font-weight: 600;">
                            ✓ {{ localize('Successfully delivered on') }} {{ date('M d, Y \a\t H:i', strtotime($order->updated_at)) }}
                        </p>
                    @endif
                </div>
            @endif

            <!-- Order Items Summary -->
            <div style="margin: 20px 0;">
                <h3>{{ localize('Order Summary') }}</h3>

                @php
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

                    // 4. Calculate final total
                    $finalTotal = $discountedSubtotal + $tax + ($order->orderGroup->total_shipping_cost ?? 0);
                @endphp

                <!-- Order Items Table -->
                <div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin: 15px 0;">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th style="text-align: left;">{{ localize('Item') }}</th>
                                <th style="text-align: center;">{{ localize('Qty') }}</th>
                                <th style="text-align: right;">{{ localize('Price') }}</th>
                                <th style="text-align: right;">{{ localize('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $item)
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
                                <tr>
                                    <td style="color: #495057;">
                                        <strong>{{ $product->collectLocalization('name') }}</strong>
                                        @if($item->product_variation->variation_key)
                                            <br><small style="color: #6c757d;">{{ $item->product_variation->variation_key }}</small>
                                        @endif
                                    </td>
                                    <td style="text-align: center; color: #495057;">{{ $item->qty }}</td>
                                    <td style="text-align: right; color: #495057;">{{ formatPrice($discountedPrice) }}</td>
                                    <td style="text-align: right; color: #495057; font-weight: 600;">{{ formatPrice($itemTotal) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Order Totals -->
                <div style="background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin: 15px 0;">
                    <div class="total-row">
                        <span style="color: #6c757d;">{{ localize('Subtotal') }}:</span>
                        <span style="color: #495057; font-weight: 600;">{{ formatPrice($subtotal) }}</span>
                    </div>

                    @if($couponDiscount > 0)
                        <div class="total-row">
                            <span style="color: #6c757d;">{{ localize('Coupon Discount') }}:</span>
                            <span style="color: #dc3545; font-weight: 600;">-{{ formatPrice($couponDiscount) }}</span>
                        </div>
                    @endif

                    @if($tax > 0)
                        <div class="total-row">
                            <span style="color: #6c757d;">{{ localize('Tax') }}:</span>
                            <span style="color: #495057; font-weight: 600;">{{ formatPrice($tax) }}</span>
                        </div>
                    @endif

                    @if(($order->orderGroup->total_shipping_cost ?? 0) > 0)
                        <div class="total-row">
                            <span style="color: #6c757d;">{{ localize('Shipping') }}:</span>
                            <span style="color: #495057; font-weight: 600;">{{ formatPrice($order->orderGroup->total_shipping_cost) }}</span>
                        </div>
                    @endif

                    <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 2px solid #dee2e6;">
                        <span style="color: #495057; font-size: 18px; font-weight: 700;">{{ localize('Total Amount') }}:</span>
                        <span style="color: {{ $emailData['color'] }}; font-size: 18px; font-weight: 700;">{{ formatPrice($finalTotal) }}</span>
                    </div>
                </div>

                <p style="margin-top: 15px; color: #6c757d; font-size: 14px;">
                    {{ localize('Total Items') }}: {{ $order->orderItems->sum('qty') }}
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>{{ localize('Thank you for choosing us!') }}</strong></p>
            @if($order->delivery_status != 'delivered' && $order->delivery_status != 'cancelled')
                <p>{{ localize('We will keep you updated on your order progress.') }}</p>
            @endif
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
