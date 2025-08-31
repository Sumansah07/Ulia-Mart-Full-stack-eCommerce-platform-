<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ localize('Order Invoice') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg,rgb(61, 168, 28) 0%,rgb(107, 162, 75) 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .invoice-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .invoice-content {
            padding: 30px;
        }

        .invoice-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 60px; /* Adds space between company-logo and invoice-info */
        }

        .invoice-info {
            flex: 1;
            min-width: 250px;
            margin-left: 60px; /* Adds left margin for extra spacing */
        }

        .company-logo {
            text-align: right;
            flex: 1;
            min-width: 200px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin-right: 60px; /* Adds right margin for extra spacing */
        }

        .company-logo img {
            max-width: 150px;
            height: auto;
            display: block;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .info-table td:first-child {
            font-weight: 600;
            width: 120px;
            color: #555;
        }

        .status-badges {
            margin: 15px 0;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-right: 10px;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-info {
            background-color:rgb(25, 183, 20);
            color: white;
        }

        .badge-primary {
            background-color:rgb(27, 170, 34);
            color: white;
        }

        .customer-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .customer-section h4 {
            color: #495057;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .address-section {
            display: flex;
            gap: 30px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .address-block {
            flex: 1;
            min-width: 200px;
        }

        .address-block h6 {
            font-weight: 600;
            margin-bottom: 8px;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 5px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .products-table th {
            background: linear-gradient(135deg,rgb(67, 169, 39) 0%,rgb(56, 148, 35) 100%);
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .products-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .products-table tr:hover {
            background-color: #f8f9fa;
        }

        .product-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .product-variation {
            font-size: 12px;
            color: #6c757d;
        }

        .totals-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .totals-table {
            width: 100%;
            max-width: 400px;
            margin-left: auto;
        }

        .totals-table td {
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .totals-table td:first-child {
            font-weight: 600;
            color: #495057;
        }

        .totals-table td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .grand-total {
            border-top: 2px solid #495057 !important;
            font-size: 18px;
            color: #495057 !important;
        }

        .grand-total td {
            padding-top: 15px !important;
            font-size: 18px !important;
            font-weight: 700 !important;
        }

        .footer-section {
            background-color: #495057;
            color: white;
            padding: 25px;
            text-align: center;
            margin-top: 30px;
        }

        .footer-section h5 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .company-info {
            margin-top: 15px;
            font-size: 14px;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            body {
                padding: 5px;
            }

            .invoice-container {
                margin: 0;
                border-radius: 0;
            }

            .invoice-header {
                padding: 20px 15px;
            }

            .invoice-header h1 {
                font-size: 22px;
            }

            .invoice-content {
                padding: 20px 15px;
            }

            .invoice-top {
                flex-direction: column;
                gap: 15px;
                margin-bottom: 20px;
            }

            .invoice-info {
                min-width: 100%;
                order: 2;
                margin-top: 15px;
            }

            .company-logo {
                text-align: center;
                min-width: 100%;
                order: 1;
                margin-bottom: 15px;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
            }

            .company-logo img {
                max-width: 120px;
                height: auto;
                display: block;
                margin: 0 auto;
            }

            .company-logo div {
                font-size: 12px !important;
                line-height: 1.4 !important;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
            }

            .info-table {
                font-size: 14px;
            }

            .info-table td {
                padding: 6px 0;
            }

            .info-table td:first-child {
                width: 100px;
                font-size: 13px;
            }

            .status-badges {
                margin: 10px 0;
            }

            .badge {
                font-size: 10px;
                padding: 4px 8px;
                margin-bottom: 5px;
                display: inline-block;
            }

            .customer-section {
                padding: 15px;
                margin-bottom: 20px;
            }

            .customer-section h4 {
                font-size: 16px;
            }

            .address-section {
                flex-direction: column;
                gap: 15px;
            }

            .address-block h6 {
                font-size: 14px;
            }

            .products-table {
                font-size: 12px;
                margin: 20px 0;
            }

            .products-table th,
            .products-table td {
                padding: 8px 4px;
                font-size: 12px;
            }

            .products-table th {
                font-size: 11px;
            }

            .product-name {
                font-size: 13px;
                line-height: 1.3;
            }

            .product-variation {
                font-size: 10px;
            }

            .totals-section {
                padding: 15px;
                margin-top: 20px;
            }

            .totals-table {
                font-size: 13px;
            }

            .totals-table td {
                padding: 6px 0;
            }

            .grand-total td {
                font-size: 15px !important;
                padding-top: 10px !important;
            }

            .footer-section {
                padding: 20px 15px;
            }

            .footer-section h5 {
                font-size: 16px;
            }

            .company-info {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .invoice-header h1 {
                font-size: 20px;
            }

            .invoice-content {
                padding: 15px 10px;
            }

            .company-logo {
                margin-bottom: 15px !important;
                margin-top: 0 !important;
            }

            .company-logo img {
                max-width: 100px !important;
            }

            .company-logo div {
                font-size: 11px !important;
                line-height: 1.3 !important;
            }

            .customer-section {
                padding: 12px;
            }

            .products-table th,
            .products-table td {
                padding: 6px 2px;
                font-size: 11px;
            }

            .products-table th {
                font-size: 10px;
            }

            .totals-section {
                padding: 12px;
            }

            .totals-table {
                font-size: 12px;
            }

            .grand-total td {
                font-size: 14px !important;
            }
        }

        /* Additional mobile email client compatibility */
        @media screen and (max-width: 600px) {
            .invoice-container {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .invoice-top {
                display: block !important;
                width: 100% !important;
            }

            .invoice-info,
            .company-logo {
                width: 100% !important;
                display: block !important;
                float: none !important;
            }

            .company-logo {
                text-align: center !important;
                margin-bottom: 20px !important;
                margin-top: 0 !important;
            }

            .address-section {
                display: block !important;
            }

            .address-block {
                width: 100% !important;
                margin-bottom: 15px !important;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <h1>{{ localize('Order Invoice') }}</h1>
            <p>{{ localize('Thank you for your purchase!') }}</p>
        </div>

        <!-- Content -->
        <div class="invoice-content">
            <!-- Top Section -->
            <div class="invoice-top">
                <div class="company-logo">
                    @if(getSetting('invoice_logo'))
                        <img src="{{ uploadedAsset(getSetting('invoice_logo')) }}" alt="logo" style="max-width: 150px; height: auto; display: block; margin: 0 auto;">
                    @endif
                    <div style="margin-top: 15px; color: #6c757d; font-size: 14px; line-height: 1.4;">
                        <strong style="display: block; margin-bottom: 5px;">{{ getSetting('system_title') ?? env('APP_NAME') }}</strong>
                        @if(getSetting('site_address'))
                            <div style="margin-bottom: 3px;">{{ getSetting('site_address') }}</div>
                        @endif
                        @if(getSetting('navbar_contact_number'))
                            <div style="margin-bottom: 3px;">{{ localize('Phone') }}: {{ getSetting('navbar_contact_number') }}</div>
                        @endif
                        @if(getSetting('topbar_email'))
                            <div>{{ localize('Email') }}: {{ getSetting('topbar_email') }}</div>
                        @endif
                    </div>
                </div>

                <div class="invoice-info">
                    <h3>{{ localize('Invoice') }}</h3>

                    <!-- Status Badges -->
                    <div class="status-badges">
                        <span class="badge badge-primary">
                            {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                        </span>
                        @if($order->orderGroup->payment_status == 'paid')
                            <span class="badge badge-success">
                                ✓ {{ localize('Payment Confirmed') }}
                            </span>
                        @elseif($order->orderGroup->payment_status == 'unpaid')
                            <span class="badge badge-warning">
                                ⏰ {{ localize('Payment Pending') }}
                            </span>
                        @else
                            <span class="badge badge-info">
                                ℹ️ {{ ucwords(str_replace('_', ' ', $order->orderGroup->payment_status)) }}
                            </span>
                        @endif
                    </div>

                    <!-- Order Info Table -->
                    <table class="info-table">
                        <tr>
                            <td><strong>{{ localize('Order Code') }}</strong></td>
                            <td>{{ getSetting('order_code_prefix') }}{{ $order->orderGroup->order_code }}</td>
                        </tr>
                        @if(getSetting('business_pan_number'))
                        <tr>
                            <td><strong>{{ localize('PAN No') }}</strong></td>
                            <td>{{ getSetting('business_pan_number') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>{{ localize('Date') }}</strong></td>
                            <td>{{ formatOrderDateTime($order->orderGroup->created_at, 'd M, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Customer Section -->
            <div class="customer-section">
                @php
                    $customerInfo = $order->orderGroup->getCustomerInfo();
                @endphp
                <h4>{{ $customerInfo['name'] ?: localize('Guest Customer') }}</h4>
                <p>{{ localize('Here are your order details. We thank you for your purchase.') }}</p>

                @php
                    $deliveryInfo = json_decode($order->scheduled_delivery_info);
                @endphp

                <p style="margin-top: 10px;">
                    <strong>{{ localize('Delivery Type') }}:</strong>
                    <span class="badge badge-primary">{{ Str::title(Str::replace('_', ' ', $order->shipping_delivery_type)) }}</span>
                </p>

                @if ($order->shipping_delivery_type == getScheduledDeliveryType())
                    <p>
                        <strong>{{ localize('Delivery Time') }}:</strong>
                        {{ date('d F', $deliveryInfo->scheduled_date) }}, {{ $deliveryInfo->timeline }}
                @endif

                <!-- Address Section -->
                @if (!$order->orderGroup->is_pos_order)
                    <div class="address-section">
                        <div class="address-block">
                            <h6>{{ localize('Shipping Address') }}</h6>
                            @php
                                $shippingInfo = $order->orderGroup->getShippingAddressInfo();
                            @endphp
                            <p>
                                @if($shippingInfo['name'])
                                    <strong>{{ $shippingInfo['name'] }}</strong><br>
                                @endif
                                {{ $shippingInfo['address'] }}
                                @if($shippingInfo['city'] || $shippingInfo['state'] || $shippingInfo['country'])
                                    <br>{{ $shippingInfo['city'] }}{{ $shippingInfo['state'] ? ', ' . $shippingInfo['state'] : '' }}{{ $shippingInfo['country'] ? ', ' . $shippingInfo['country'] : '' }}
                                @endif
                                @if($shippingInfo['phone'])
                                    <br><strong>{{ localize('Phone') }}:</strong> {{ $shippingInfo['phone'] }}
                                @endif
                            </p>
                        </div>

                        <div class="address-block">
                            <h6>{{ localize('Billing Address') }}</h6>
                            @php
                                $billingInfo = $order->orderGroup->getBillingAddressInfo();
                            @endphp
                            <p>
                                @if($billingInfo['name'])
                                    <strong>{{ $billingInfo['name'] }}</strong><br>
                                @endif
                                {{ $billingInfo['address'] }}
                                @if($billingInfo['city'] || $billingInfo['state'] || $billingInfo['country'])
                                    <br>{{ $billingInfo['city'] }}{{ $billingInfo['state'] ? ', ' . $billingInfo['state'] : '' }}{{ $billingInfo['country'] ? ', ' . $billingInfo['country'] : '' }}
                                @endif
                                @if($billingInfo['phone'])
                                    <br><strong>{{ localize('Phone') }}:</strong> {{ $billingInfo['phone'] }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Products Table -->
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
                $shipping = $order->orderGroup->total_shipping_cost;
                $grandTotal = $discountedSubtotal + $tax + $shipping + $order->orderGroup->total_tips_amount;
            @endphp

            <table class="products-table">
                <thead>
                    <tr>
                        <th>{{ localize('S/L') }}</th>
                        <th>{{ localize('Products') }}</th>
                        <th>{{ localize('U.Price') }}</th>
                        <th>{{ localize('QTY') }}</th>
                        <th>{{ localize('T.Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $key => $item)
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

                            $unitPrice = $discountedPrice;
                            $totalPrice = $discountedPrice * $item->qty;
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="product-name">{{ $product->collectLocalization('name') }}</div>
                                @if($item->product_variation->variation_key)
                                    <div class="product-variation">{{ $item->product_variation->variation_key }}</div>
                                @endif
                                @if ($product && $product->taxes && $product->taxes->where('tax_value', '>', 0)->count() > 0)
                                    @php
                                        $taxPercentage = $product->taxes->where('tax_type', 'percent')->where('tax_value', '>', 0)->sum('tax_value');
                                    @endphp
                                    <div style="font-size: 12px; color: #666; margin-top: 2px;">
                                        @if ($taxPercentage > 0)
                                            [{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]
                                        @else
                                            [{{ localize('tax included') }}]
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td>{{ formatPrice($unitPrice) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ formatPrice($totalPrice) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals Section -->
            <div class="totals-section">
                <table class="totals-table">
                    <tr>
                        <td><strong>{{ localize('Payment Method') }}</strong></td>
                        <td>{{ ucwords(str_replace('_', ' ', $order->orderGroup->payment_method)) }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ localize('Sub Total') }}</strong></td>
                        <td>{{ formatPrice($subtotal) }}</td>
                    </tr>
                    @if (!empty($currentCoupon))
                        <tr>
                            <td><strong>{{ localize('Coupon Discount') }}</strong></td>
                            <td style="color: #28a745;">-{{ formatPrice($couponDiscount) }}</td>
                        </tr>
                    @endif
                    @if ($tax > 0)
                        <tr>
                            <td><strong>{{ getTaxDisplayText($orderItems) }}</strong></td>
                            <td>{{ formatPrice($tax) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>{{ localize('Shipping Cost') }}</strong></td>
                        <td>{{ formatPrice($shipping) }}</td>
                    </tr>
                    @if ($order->orderGroup->total_tips_amount > 0)
                        <tr>
                            <td><strong>{{ localize('Tips') }}</strong></td>
                            <td>{{ formatPrice($order->orderGroup->total_tips_amount) }}</td>
                        </tr>
                    @endif
                    <tr class="grand-total">
                        <td><strong>{{ localize('Total Price') }}</strong></td>
                        <td style="color: #007bff;">{{ formatPrice($grandTotal) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-section">
            <h5>{{ localize('Thank you for choosing us!') }}</h5>
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