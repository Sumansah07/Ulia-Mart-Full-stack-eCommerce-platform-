<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ localize('INVOICE') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <style type="text/css">
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        * {
            box-sizing: border-box;

        }

        pre,
        p {
            padding: 0;
            margin: 0;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            padding: 1px;

        }

        td,
        th {
            text-align: left;

        }

        .visibleMobile {
            display: none;

        }

        .hiddenMobile {
            display: block;

        }
    </style>
</head>

<body>


    {{-- header start --}}
    <table style="width: 100%; table-layout: fixed">
        <tr>
            <td colspan="4"
                style="border-right: 1px solid #e4e4e4; width: 300px; color: #323232; line-height: 1.5; vertical-align: top;">

                <p style="font-size: 15px; color: #5b5b5b; font-weight: bold; line-height: 1; vertical-align: top; ">
                    {{ localize('INVOICE') }}</p>
                <br>
                <p style="font-size: 12px; color: #5b5b5b; line-height: 24px; vertical-align: top;">
                    {{ localize('Invoice No') }} : {{ getSetting('order_code_prefix') ?? '' }}{{ $order->orderGroup->order_code ?? '' }}<br>
                    @if(getSetting('business_pan_number'))
                        {{ localize('PAN No') }} : {{ getSetting('business_pan_number') }}<br>
                    @endif
                    {{ localize('Order Date') }} : {{ formatOrderDateTime($order->created_at ?? now(), 'd M, Y h:i A') }}
                </p>

                <!-- QR Code for Order Tracking -->
                <div style="margin-top: 10px;">
                    @php
                        $trackingUrl = url('/customer-dashboard') . '#orders-tracker?code=' . urlencode($order->orderGroup->order_code ?? '') . '&email=' . urlencode($order->user->email ?? '');
                        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=' . urlencode($trackingUrl);
                    @endphp
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 80px; max-height: 80px; border: none;">
                    <p style="font-size: 8px; color: #666; margin-top: 5px; margin-bottom: 0;">{{ localize('Scan to track order') }}</p>
                </div>

                @if ($order->location_id != null)
                    <p>
                        {{ optional($order->location)->name }}
                    </p>
                @endif
            </td>
            <td colspan="4" align="right"
                style="width: 300px; text-align: right; padding-left: 50px; line-height: 1.5; color: #323232;">
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
                        } elseif(getSetting('favicon')) {
                            $media = \App\Models\MediaManager::find(getSetting('favicon'));
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
                    <img src="{{ $logoPath }}" alt="logo" border="0" style="max-width: 120px; max-height: 60px;" />
                @endif
                <p style="font-size: 12px;font-weight: bold; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                    {{ getSetting('system_title') }}</p>
                <p style="font-size: 12px; color: #5b5b5b; line-height: 24px; vertical-align: top;">
                    {{ getSetting('topbar_location') }}<br>
                    {{ localize('Phone') }}: {{ getSetting('navbar_contact_number') }}
                </p>
            </td>
        </tr>
        <tr class="visibleMobile">
            <td height="10"></td>
        </tr>
        <tr>
            <td colspan="10" style="border-bottom:1px solid #e4e4e4"></td>
        </tr>
    </table>
    {{-- header end --}}

    {{-- billing and shipping start --}}
    <table class="table" style="width: 100%;">
        <tbody style="display: table-header-group">
            <tr class="visibleMobile">
                <td height="20"></td>
            </tr>
            <tr style=" margin: 0;">
                <td colspan="4" style="width: 300px;">
                    <p
                        style="font-size: 12px; font-weight: bold; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                        {{ localize('SHIPPING INFORMATION') }}</p>

                    <p style="font-size: 12px; color: #5b5b5b; line-height: 24px; vertical-align: top;">
                        @if ($order->orderGroup->is_pos_order)
                            {{ $order->orderGroup->pos_order_address }}
                        @else
                            @php
                                $shippingInfo = $order->orderGroup->getShippingAddressInfo();
                            @endphp
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
                        @endif
                        @if ($order->orderGroup->alternative_phone_no)
                            <br>
                            {{ localize('Alternative Phone') }}: {{ $order->orderGroup->alternative_phone_no }}
                        @endif
                        <br>
                        {{ localize('Logistic') }}: {{ $order->logistic_name }}
                        <br>
                        @php
                            $deliveryInfo = json_decode($order->scheduled_delivery_info);
                        @endphp

                    <p class="mb-0">{{ localize('Delivery Type') }}:
                        <span
                            class="badge bg-primary">{{ Str::title(Str::replace('_', ' ', $order->shipping_delivery_type)) }}</span>


                    </p>

                    @if ($order->shipping_delivery_type == getScheduledDeliveryType())
                        <p class="mb-0">
                            {{ localize('Delivery Time') }}:
                            {{ date('d F', $deliveryInfo->scheduled_date) }},
                            {{ $deliveryInfo->timeline }}</p>
                    @endif
                    </p>

                </td>


                @if (!$order->orderGroup->is_pos_order)
                    <td colspan="4" style="width: 300px;">
                        <p
                            style="font-size: 11px; font-weight: bold; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                            {{ localize('BILLING INFORMATION') }}</p>
                        @php
                            $billingInfo = $order->orderGroup->getBillingAddressInfo();
                        @endphp
                        <p style="font-size: 12px; color: #5b5b5b; line-height: 24px; vertical-align: top;">
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
                    </td>
                @endif


            </tr>

        </tbody>
    </table>
    {{-- billing and shipping end --}}

    {{-- item details start --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#ffffff">
        <tbody>
            <tr>
                <td>
                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff">
                        <tbody>
                            <tr class="visibleMobile">
                                <td height="40"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"
                                        class="fullPadding">
                                        <tbody>
                                            <tr>
                                                <th style="font-size: 12px; color: #000000; font-weight: normal;
                  line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                    width="52%" align="left">
                                                    {{ localize('Item') }}
                                                </th>
                                                <th style="font-size: 12px; color: #000000; font-weight: normal;
                  line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                    align="left">
                                                    {{ localize('Price') }}
                                                </th>
                                                <th style="font-size: 12px; color: #000000; font-weight: normal;
                  line-height: 1; vertical-align: top; padding: 0 0 7px; text-align: center; "
                                                    align="center">
                                                    {{ localize('Qty') }}
                                                </th>
                                                <th style="font-size: 12px; color: #000000; font-weight:
                  normal; line-height: 1; vertical-align: top; padding: 0 0 7px; text-align: right; "
                                                    align="right">
                                                    {{ localize('Subtotal') }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <td height="1" style="background: #e4e4e4;" colspan="4"></td>
                                            </tr>

                                            @foreach ($order->orderItems as $key => $item)
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

                                                    $unitPrice = $discountedPrice;
                                                    $itemTotal = $discountedPrice * $item->qty;
                                                @endphp
                                                <tr>
                                                    <td style="font-size: 12px; color: #5b5b5b;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                        class="article">
                                                        <div>{{ $product ? $product->collectLocalization('name') : 'Product Name' }}</div>
                                                        @if($item->product_variation && $item->product_variation->combinations)
                                                        <div class="text-muted">
                                                            @foreach (generateVariationOptions($item->product_variation->combinations) as $variation)
                                                                <span class="fs-xs">
                                                                    {{ $variation['name'] ?? '' }}:
                                                                    @foreach ($variation['values'] as $value)
                                                                        {{ $value['name'] ?? '' }}
                                                                    @endforeach
                                                                    @if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                        @endif
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
                                                            <div style="font-size: 10px; color: #999; margin-top: 2px;">[{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]</div>
                                                        @endif
                                                    </td>
                                                    <td
                                                        style="font-size: 12px; color: #646a6e;  line-height:
              18px;  vertical-align: top; padding:10px 0;">
                                                        {{ formatPrice($unitPrice) }}</td>
                                                    <td style="font-size: 12px; color: #646a6e;  line-height:
              18px;  vertical-align: top; padding:10px 0; text-align: center;"
                                                        align="center">{{ $item->qty }}</td>
                                                    <td style="font-size: 12px; color: #1e2b33;  line-height:
              18px;  vertical-align: top; padding:10px 0; text-transform: capitalize !important;"
                                                        align="right">
                                                        @if ($item->refundRequest && $item->refundRequest->refund_status == 'refunded')
                                                            ({{ $item->refundRequest->refund_status }})
                                                        @endif
                                                        <strong>{{ formatPrice($itemTotal) }}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" style="background: #e4e4e4;" colspan="4"></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="20"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    {{-- item details end --}}

    {{-- item total start --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#ffffff">
        <tbody>
            <tr>
                <td>
                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff">
                        <tbody>
                            <tr>
                                <td>
                                    <!-- Table Total -->
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
                                        $grandTotal = $discountedSubtotal + $tax + $order->orderGroup->total_shipping_cost + $order->orderGroup->total_tips_amount;
                                    @endphp
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                        align="center" class="fullPadding">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    {{ localize('Subtotal') }}
                                                </td>
                                                <td style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                    width="80">
                                                    {{ formatPrice($subtotal) }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    {{ localize('Tips') }}
                                                </td>
                                                <td style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                    width="80">
                                                    {{ formatPrice($order->orderGroup->total_tips_amount) }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    {{ localize('Shipping Cost') }}
                                                </td>
                                                <td
                                                    style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    {{ formatPrice($order->orderGroup->total_shipping_cost) }}
                                                </td>
                                            </tr>

                                            @if ($couponDiscount > 0)
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                        {{ localize('Coupon Discount') }}
                                                    </td>
                                                    <td
                                                        style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                        -{{ formatPrice($couponDiscount) }}
                                                    </td>
                                                </tr>
                                            @endif

                                            @if($tax > 0)
                                            <tr>
                                                <td
                                                    style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    {{ getTaxDisplayText($orderItems) }}
                                                </td>
                                                <td
                                                    style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    {{ formatPrice($tax) }}
                                                </td>
                                            </tr>
                                            @endif

                                            @if ($order->orderGroup->is_pos_order)
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                        {{ localize('Discount') }}
                                                    </td>
                                                    <td
                                                        style="font-size: 12px; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                        {{ formatPrice($order->orderGroup->total_discount_amount) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td
                                                    style="font-size: 12px; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    <strong>{{ localize('Grand Total') }}</strong>
                                                </td>
                                                <td
                                                    style="font-size: 12px; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    <strong>{{ formatPrice($grandTotal) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- /Table Total -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    {{-- item total end --}}

    {{-- footer start --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#ffffff">

        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                    <tr>
                    <tr class="hiddenMobile">
                        <td height="30"></td>
                    </tr>
                    <tr class="visibleMobile">
                        <td height="20"></td>
                    </tr>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullPadding">
                            <tbody>
                                <tr>
                                    <td
                                        style="font-size: 12px; color: #5b5b5b; line-height: 18px; vertical-align: top; text-align: left;">
                                        <p
                                            style="font-size: 12px; color: #5b5b5b; line-height: 18px; vertical-align: top; text-align: left;">
                                            {{ localize('Hello') }}
                                            @php
                                                $customerInfo = $order->orderGroup->getCustomerInfo();
                                            @endphp
                                            <strong>{{ $customerInfo['name'] ?: localize('Guest Customer') }},</strong>
                                            <br>
                                            {{ getSetting('invoice_thanksgiving') }}
                                        </p>
                                        <br><br>
                                        <p
                                            style="font-size: 12px; color: #5b5b5b; line-height: 18px; vertical-align: top; text-align: left;">
                                            {{ localize('Best Regards') }},
                                            <br>{{ getSetting('system_title') }} <br>
                                            {{ localize('Email') }}: {{ getSetting('topbar_email') }}<br>
                                            {{ localize('Website') }}: {{ env('APP_URL') }}
                                        </p>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
    {{-- footer end --}}



</body>

</html>
