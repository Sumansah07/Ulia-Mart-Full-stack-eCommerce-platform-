<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--favicon icon-->
    @php
        $faviconUrl = getSetting('favicon') ? uploadedAsset(getSetting('favicon')) : staticAsset('frontend/default/assets/img/favicon.jpg');
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="image/jpg" sizes="16x16">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/jpg">
    <title>Delivery Slip - {{ getSetting('order_code_prefix') }}{{ $orderCode }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 8px;
            line-height: 1.1;
            color: #333;
            background: #f5f5f5;
            height: 100vh;
            min-height: 100vh;
            margin: 0;
            padding: 10px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            overflow-x: hidden;
        }

        .delivery-slip {
            width: fit-content;
            min-width: fit-content;
            max-width: none;
            margin: 10px 0;
            padding: 1.5mm;
            border: 1px solid #ddd;
            min-height: auto;
            height: auto;
            transform: scale(2.2);
            transform-origin: top left;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: white;
            display: inline-block;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 1mm;
            margin-bottom: 1mm;
        }

        .company-name {
            font-size: 9px;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5mm;
        }

        .header-logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5mm;
        }

        .header-logo {
            max-width: 8mm;
            max-height: 6mm;
            margin-right: 1mm;
            border: none;
        }

        .slip-title {
            font-size: 8px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .order-info {
            margin-bottom: 1mm;
        }

        .order-info table {
            width: 100%;
            font-size: 7px;
        }

        .order-info td {
            padding: 0.2mm 0;
            vertical-align: top;
        }

        .order-info .label {
            font-weight: bold;
            width: 40%;
        }

        .order-info .value {
            width: 60%;
        }

        .customer-info {
            border: 1px solid #eee;
            padding: 0.8mm;
            margin-bottom: 0.8mm;
            background: #fafafa;
        }

        .section-title {
            font-size: 7px;
            font-weight: bold;
            margin-bottom: 0.5mm;
            color: #333;
            text-transform: uppercase;
        }

        .address {
            font-size: 7px;
            line-height: 1.2;
        }

        .items-section {
            margin-bottom: 0.8mm;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 6px;
            table-layout: fixed;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 0.3mm;
            text-align: left;
            line-height: 1.1;
        }

        .items-table th {
            background: #f5f5f5;
            font-weight: bold;
            font-size: 6px;
        }

        .items-table .product-col {
            text-align: left;
            word-wrap: break-word;
            width: 60%;
        }

        .items-table .qty-col {
            text-align: center;
            width: 15%;
        }

        .items-table .price-col {
            text-align: right;
            width: 25%;
        }

        .total-section {
            border-top: 1px solid #ddd;
            padding-top: 0.8mm;
            margin-top: 0.8mm;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 6px;
            margin-bottom: 0.2mm;
        }

        .total-row.grand-total {
            font-weight: bold;
            font-size: 7px;
            border-top: 1px solid #ddd;
            padding-top: 0.5mm;
        }

        .payment-info {
            margin-top: 0.8mm;
            padding: 0.8mm;
            border: 1px solid #eee;
            background: #f9f9f9;
        }

        .status-badges {
            display: flex;
            gap: 1mm;
            margin-top: 1mm;
        }

        .status-badge {
            padding: 0.5mm 1mm;
            border-radius: 1mm;
            font-size: 5px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-paid {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-unpaid {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-delivered {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .footer {
            margin-top: 0.5mm;
            padding-top: 0.5mm;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 5px;
            color: #666;
        }

        .barcode-section {
            text-align: center;
            margin: 0.5mm 0;
        }

        .order-code-large {
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 0.5px;
            font-family: 'Courier New', monospace;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                height: auto;
                min-height: auto;
                background: white;
                display: block;
            }

            .delivery-slip {
                border: none;
                box-shadow: none;
                height: auto;
                min-height: auto;
                transform: scale(1);
                margin: 0;
                width: fit-content;
                min-width: fit-content;
                max-width: none;
                display: inline-block;
            }
        }
    </style>
</head>
<body>
    <div class="delivery-slip">
        <!-- Header -->
        <div class="header">
            @php
                $logoPath = null;
                try {
                    if(getSetting('invoice_logo')) {
                        $media = \App\Models\MediaManager::find(getSetting('invoice_logo'));
                        if($media && $media->media_file) {
                            // Use direct file path for PDF generation
                            $filePath = public_path('uploads/media/' . basename($media->media_file));
                            if(file_exists($filePath)) {
                                $logoPath = $filePath;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Logo loading failed, continue without logo
                }
            @endphp
            <div class="header-logo-container">
                @if($logoPath)
                    <img src="{{ $logoPath }}" alt="logo" class="header-logo" />
                @endif
                <div class="company-name">{{ getSetting('site_name') }}</div>
            </div>
            <div class="slip-title">Delivery Slip</div>
        </div>

        <!-- Order Information with QR Code -->
        <div class="order-info">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 28%; text-align: center;">
                        <div><strong>Order:</strong> {{ getSetting('order_code_prefix') }}{{ $orderCode }}</div>
                    </td>
                    <td style="width: 44%;"></td>
                    <td rowspan="2" style="width: 28%; text-align: right; vertical-align: top;">
                        @php
                            $trackingUrl = url('/customer-dashboard') . '#orders-tracker?code=' . urlencode($orderCode) . '&email=' . urlencode($order->user->email ?? '');
                            // Use a larger QR code size for better print quality
                            $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . urlencode($trackingUrl);
                        @endphp
                        <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 12mm; max-height: 12mm; border: none; display: block;">
                        <div style="font-size: 6px; margin-top: 1mm; color: #333; text-align: center; font-weight: normal; white-space: nowrap;">Scan to track</div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <div><strong>Date:</strong> {{ date('d M, Y', strtotime($order->created_at)) }}</div>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <!-- Order Code Display -->
        <div class="barcode-section">
            <div class="order-code-large">{{ getSetting('order_code_prefix') }}{{ $orderCode }}</div>
        </div>

        <!-- Customer Information -->
        <div class="customer-info">
            <div class="section-title">Delivery Address</div>
            <div class="address">
                @if($order->orderGroup->is_pos_order)
                    <strong>{{ $order->user->name ?? 'POS Customer' }}</strong><br>
                    {{ $order->orderGroup->pos_order_address ?? 'POS Order - Address not specified' }}<br>
                    @if($order->user && $order->user->phone)
                        Phone: {{ $order->user->phone }}
                    @endif
                @else
                    @php
                        $shippingInfo = $order->orderGroup->getShippingAddressInfo();
                    @endphp
                    @if($shippingInfo['name'])
                        <strong>{{ $shippingInfo['name'] }}</strong><br>
                    @endif
                    {{ $shippingInfo['address'] ?: 'N/A' }}
                    @if($shippingInfo['city'] || $shippingInfo['state'] || $shippingInfo['country'])
                        <br>{{ $shippingInfo['city'] }}{{ $shippingInfo['state'] ? ', ' . $shippingInfo['state'] : '' }}{{ $shippingInfo['country'] ? ', ' . $shippingInfo['country'] : '' }}
                    @endif
                    @if($shippingInfo['phone'])
                        <br>Phone: {{ $shippingInfo['phone'] }}
                    @endif
                @endif
            </div>
        </div>

        <!-- Items Section -->
        <div class="items-section">
            <div class="section-title">Items ({{ $orderItems->count() }} items)</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th class="product-col">Product</th>
                        <th class="qty-col">Qty</th>
                        <th class="price-col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $item)
                    @php
                        // Use discounted price for consistency
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
                    @endphp
                    <tr>
                        <td class="product-col">
                            {{ $item->product_variation->product->name }}
                            @php
                                try {
                                    $hasTaxInfo = false;
                                    $taxPercentage = 0;
                                    if ($product && $product->taxes) {
                                        foreach ($product->taxes as $tax) {
                                            if ($tax->tax_type == 'percent' && $tax->tax_value > 0) {
                                                $hasTaxInfo = true;
                                                $taxPercentage += $tax->tax_value;
                                            }
                                        }
                                    }
                                } catch (Exception $e) {
                                    $hasTaxInfo = false;
                                    $taxPercentage = 0;
                                }
                            @endphp
                            @if ($hasTaxInfo)
                                <small style="color: #666; font-size: 0.8em; margin-left: 8px;">[{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]</small>
                            @endif
                            @if($item->product_variation->variation_key)
                                <br><small style="color: #666;">{{ $item->product_variation->variation_key }}</small>
                            @endif
                        </td>
                        <td class="qty-col">{{ $item->qty }}</td>
                        <td class="price-col">
                            @php
                                $itemTax = 0;
                                if ($product && $product->taxes) {
                                    foreach ($product->taxes as $tax) {
                                        if ($tax->tax_type == 'percent') {
                                            $itemTax += ($discountedPrice * $tax->tax_value) / 100;
                                        } elseif ($tax->tax_type == 'flat') {
                                            $itemTax += $tax->tax_value;
                                        }
                                    }
                                }
                                $taxIncludedPrice = $discountedPrice + $itemTax;
                            @endphp
                            {{ formatPrice($taxIncludedPrice) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            // 1. Calculate subtotal for display: price WITH tax included (discounted price + tax for each item)
            $subtotalWithTax = $orderItems->sum(function($item) {
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

                $itemTax = 0;
                if ($product && $product->taxes) {
                    foreach ($product->taxes as $tax) {
                        if ($tax->tax_type == 'percent') {
                            $itemTax += ($discountedPrice * $tax->tax_value) / 100;
                        } elseif ($tax->tax_type == 'flat') {
                            $itemTax += $tax->tax_value;
                        }
                    }
                }
                $taxIncludedPrice = $discountedPrice + $itemTax;
                return $taxIncludedPrice * $item->qty;
            });

            // 2. Calculate subtotal for grand total: discounted price only
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

            // 3. Get coupon code from order
            $currentCoupon = $order->applied_coupon_code ?? '';

            // 4. Calculate coupon discount correctly with restrictions
            $couponDiscount = 0;
            if (!empty($currentCoupon)) {
                $couponDiscount = getCouponDiscountFromOrderItems($orderItems, $currentCoupon);
            }
            $discountedSubtotal = $subtotal - $couponDiscount;

            // 5. Calculate tax on discounted subtotal
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

            // 6. Calculate grand total (old logic)
            $grandTotal = $discountedSubtotal + $tax + $orderGroup->total_shipping_cost + $orderGroup->total_tips_amount;
        @endphp

        <!-- Total Section -->
        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>{{ formatPrice($subtotalWithTax) }}</span>
            </div>
            @if($couponDiscount > 0)
            <div class="total-row">
                <span>Discount:</span>
                <span>-{{ formatPrice($couponDiscount) }}</span>
            </div>
            @endif
            @if($orderGroup->total_shipping_cost > 0)
            <div class="total-row">
                <span>Shipping:</span>
                <span>{{ formatPrice($orderGroup->total_shipping_cost) }}</span>
            </div>
            @endif
            @if($orderGroup->total_tips_amount > 0)
            <div class="total-row">
                <span>Tips:</span>
                <span>{{ formatPrice($orderGroup->total_tips_amount) }}</span>
            </div>
            @endif
            <div class="total-row grand-total">
                <span><strong>Total:</strong></span>
                <span><strong>{{ formatPrice($grandTotal) }}</strong></span>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="payment-info">
            <div class="section-title">Payment & Status</div>
            <div style="font-size: 9px;">
                <strong>Payment Method:</strong> {{ ucwords(str_replace('_', ' ', $orderGroup->payment_method)) }}<br>
                <div class="status-badges">
                    <span class="status-badge {{ $order->payment_status == 'paid' ? 'status-paid' : 'status-unpaid' }}">
                        {{ ucwords($order->payment_status) }}
                    </span>
                    <span class="status-badge {{ $order->delivery_status == 'delivered' ? 'status-delivered' : 'status-pending' }}">
                        {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>{{ getSetting('site_address') }}</div>
            <div style="margin-top: 1mm;">Thank you for shopping with us!</div>
        </div>
    </div>


</body>
</html>
