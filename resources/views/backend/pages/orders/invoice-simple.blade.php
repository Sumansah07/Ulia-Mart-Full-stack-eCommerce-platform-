<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--favicon icon-->
    @php
        $faviconUrl = getSetting('favicon') ? uploadedAsset(getSetting('favicon')) : staticAsset('frontend/default/assets/img/favicon.jpg');
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="image/jpg" sizes="16x16">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/jpg">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}" sizes="180x180">
    <title>{{ localize('INVOICE') }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .invoice-header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }

        .company-info {
            float: right;
            text-align: right;
            width: 35%;
        }

        .invoice-info {
            float: left;
            width: 35%;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .invoice-details {
            margin: 20px 0;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th,
        .items-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .items-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .grand-total {
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-header clearfix">
        <div class="invoice-info">
            <h1>{{ localize('INVOICE') }}</h1>
            <p>
                <strong>{{ localize('Invoice No') }}:</strong> {{ getSetting('order_code_prefix') ?? '' }}{{ $order->orderGroup->order_code ?? '' }}<br>
                @if(getSetting('business_pan_number'))
                    <strong>{{ localize('PAN No') }}:</strong> {{ getSetting('business_pan_number') }}<br>
                @endif
                <strong>{{ localize('Order Date') }}:</strong> {{ formatOrderDateTime($order->created_at ?? now(), 'd M, Y h:i A') }}
            </p>
        </div>

        <!-- QR Code in the middle -->
        <div style="float: left; width: 30%; text-align: center; margin-top: 20px;">
            @php
                $trackingUrl = url('/customer-dashboard') . '#orders-tracker?code=' . urlencode($order->orderGroup->order_code ?? '') . '&email=' . urlencode($order->user->email ?? '');
                $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=' . urlencode($trackingUrl);
            @endphp
            <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 80px; max-height: 80px; border: none;">
            <p style="font-size: 8px; color: #666; margin-top: 5px;">{{ localize('Scan to track order') }}</p>
        </div>

        <div class="company-info">
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
            @if($logoPath)
                <div style="margin-bottom: 1px;">
                    <img src="{{ $logoPath }}" alt="logo" style="max-width: 120px; max-height: 60px; margin-bottom: 0;" />
                </div>
            @endif
            <h3 style="margin: 0 0 2px 0; font-size: 1.4em;">{{ getSetting('system_title') ?? 'Company Name' }}</h3>
            <p style="margin: 0; line-height: 1.2;">
                {{ getSetting('topbar_location') ?? 'Company Address' }}<br>
                {{ localize('Phone') }}: {{ getSetting('navbar_contact_number') ?? 'N/A' }}
            </p>
        </div>
    </div>

    <div class="invoice-details clearfix">
        <div style="float: left; width: 48%;">
            <h4>{{ localize('SHIPPING INFORMATION') }}</h4>
            <p>
                @if ($order->orderGroup->is_pos_order)
                    {{ $order->orderGroup->pos_order_address ?? 'POS Order' }}
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
                        <br><strong>{{ localize('Phone') }}:</strong> {{ $shippingInfo['phone'] }}
                    @endif
                @endif
                @if ($order->orderGroup->alternative_phone_no)
                    <br>{{ localize('Alternative Phone') }}: {{ $order->orderGroup->alternative_phone_no }}
                @endif
            </p>
        </div>

        @if (!$order->orderGroup->is_pos_order)
        <div style="float: right; width: 48%;">
            <h4>{{ localize('BILLING INFORMATION') }}</h4>
            @php
                $billingInfo = $order->orderGroup->getBillingAddressInfo();
            @endphp
            <p>
                @if($billingInfo['name'])
                    <strong>{{ $billingInfo['name'] }}</strong><br>
                @endif
                {{ $billingInfo['address'] ?: 'N/A' }}
                @if($billingInfo['city'] || $billingInfo['state'] || $billingInfo['country'])
                    <br>{{ $billingInfo['city'] }}{{ $billingInfo['state'] ? ', ' . $billingInfo['state'] : '' }}{{ $billingInfo['country'] ? ', ' . $billingInfo['country'] : '' }}
                @endif
                @if($billingInfo['phone'])
                    <br><strong>{{ localize('Phone') }}:</strong> {{ $billingInfo['phone'] }}
                @endif
            </p>
        </div>
        @endif
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">{{ localize('Item') }}</th>
                <th style="width: 15%;" class="text-center">{{ localize('Qty') }}</th>
                <th style="width: 30.5%;" class="text-right">{{ localize('Price') }}</th>
                <th style="width: 20.5%;" class="text-right">{{ localize('Subtotal') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                @php
                    $product = $item->product_variation->productWithTrashed ?? null;
                @endphp
                @php
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

                    $itemSubtotalBeforeTax = $discountedPrice * $item->qty;
                @endphp
                <tr>
                    <td>
                        {{ $product ? $product->collectLocalization('name') : 'Product Name' }}
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
                        @if($item->product_variation && $item->product_variation->combinations)
                            <br><small style="color: #666;">
                                @foreach (generateVariationOptions($item->product_variation->combinations) as $variation)
                                    {{ $variation['name'] ?? '' }}:
                                    @foreach ($variation['values'] as $value)
                                        {{ $value['name'] ?? '' }}
                                    @endforeach
                                    @if (!$loop->last), @endif
                                @endforeach
                            </small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->qty ?? 0 }}</td>
                    <td class="text-right">{{ formatPrice($discountedPrice) }}</td>
                    <td class="text-right">
                        @if ($item->refundRequest && $item->refundRequest->refund_status == 'refunded')
                            ({{ $item->refundRequest->refund_status }})
                        @endif
                        {{ formatPrice($itemSubtotalBeforeTax) }}
                    </td>
                </tr>
            @endforeach
            @php
                // CORRECT calculation logic: Coupon discount on subtotal BEFORE tax, then tax on discounted amount
                $orderItems = $order->orderItems;

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

                // Calculate tax on discounted subtotal (CORRECT: tax after coupon discount)
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
                $grandTotal = $discountedSubtotal + $tax + $order->orderGroup->total_shipping_cost + $order->orderGroup->total_tips_amount;

                // For POS orders, also subtract POS discount
                if ($order->orderGroup->is_pos_order && $order->orderGroup->total_discount_amount > 0) {
                    $grandTotal -= $order->orderGroup->total_discount_amount;
                }
            @endphp

            <!-- Totals section integrated into the main table -->
            <!-- Subtotal row -->
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 8px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-top: 1px solid #ddd; border-bottom: 1px solid #eee; font-size: 0.7rem;">{{ localize('Subtotal') }}</td>
                <td class="text-right" style="padding: 8px 10px; border-right: 1px solid #eee; border-top: 1px solid #ddd; border-bottom: 1px solid #eee; font-size: 0.7rem;">{{ formatPrice($subtotal) }}</td>
            </tr>

            <!-- Tips row (if applicable) -->
            @if($order->orderGroup->total_tips_amount > 0)
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 5px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ localize('Tips') }}</td>
                <td class="text-right" style="padding: 5px 10px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ formatPrice($order->orderGroup->total_tips_amount) }}</td>
            </tr>
            @endif

            <!-- Shipping Cost row (if applicable) -->
            @if($order->orderGroup->total_shipping_cost > 0)
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 5px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ localize('Shipping Cost') }}</td>
                <td class="text-right" style="padding: 5px 10px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ formatPrice($order->orderGroup->total_shipping_cost) }}</td>
            </tr>
            @endif

            <!-- Coupon Discount row (if applicable) -->
            @if($couponDiscount > 0)
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 5px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ localize('Coupon Discount') }}</td>
                <td class="text-right" style="padding: 5px 10px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">-{{ formatPrice($couponDiscount) }}</td>
            </tr>
            @endif

            <!-- Taxable Amount row (if applicable) -->
            @if($taxableAmountForDisplay > 0)
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 5px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ localize('Taxable Amount') }}</td>
                <td class="text-right" style="padding: 5px 10px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ formatPrice($taxableAmountForDisplay) }}</td>
            </tr>
            @endif

            <!-- Tax row (if applicable) -->
            @if($tax > 0)
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 5px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ getTaxDisplayText($orderItems) }}</td>
                <td class="text-right" style="padding: 5px 10px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ formatPrice($tax) }}</td>
            </tr>
            @endif

            <!-- POS Discount row (if applicable) -->
            @if($order->orderGroup->is_pos_order && $order->orderGroup->total_discount_amount > 0)
            <tr>
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 5px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">{{ localize('Discount') }}</td>
                <td class="text-right" style="padding: 5px 10px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">-{{ formatPrice($order->orderGroup->total_discount_amount) }}</td>
            </tr>
            @endif

            <!-- Grand Total row -->
            <tr class="grand-total">
                <td colspan="2" style="border: none;"></td>
                <td style="padding: 8px 10px; border-left: 1px solid #eee; border-right: 1px solid #eee; border-top: 2px solid #333; border-bottom: 1px solid #eee; font-size: 0.7rem;"><strong>{{ localize('Grand Total') }}</strong></td>
                <td class="text-right" style="padding: 8px 10px; border-right: 1px solid #eee; border-top: 2px solid #333; border-bottom: 1px solid #eee; font-size: 0.7rem;">
                  <strong>{{ formatPrice($grandTotal) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer clearfix">
        <p>
            @php
                $customerInfo = $order->orderGroup->getCustomerInfo();
            @endphp
            {{ localize('Hello') }} <strong>{{ $customerInfo['name'] ?: localize('Guest Customer') }},</strong><br>
            {{ getSetting('invoice_thanksgiving') ?? 'Thank you for your business!' }}
        </p>
        <br>
        <p>
            {{ localize('Best Regards') }},<br>
            {{ getSetting('system_title') ?? 'Company Name' }}<br>
            {{ localize('Email') }}: {{ getSetting('topbar_email') ?? 'N/A' }}<br>
            {{ localize('Website') }}: {{ env('APP_URL') ?? 'N/A' }}
        </p>
    </div>


</body>
</html>
