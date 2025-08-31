@extends('backend.layouts.master')

@section('title')
    {{ localize('Order Details') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Order Details') }}</h2>
                            </div>
                            <div class="tt-action">
                                <div class="btn-group me-2" role="group">
                                    <a href="{{ route('admin.orders.printInvoice', $order->id) }}" target="__blank" class="btn btn-dark">
                                        <i data-feather="printer" width="18"></i>
                                        {{ localize('Print Invoice') }}
                                    </a>
                                    <a href="{{ route('admin.orders.downloadInvoice', $order->id) }}" class="btn btn-primary">
                                        <i data-feather="download" width="18"></i>
                                        {{ localize('Download Invoice') }}
                                    </a>
                                </div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.orders.printDeliverySlip', $order->id) }}" target="__blank" class="btn btn-success">
                                        <i data-feather="package" width="18"></i>
                                        {{ localize('Print Delivery Slip') }}
                                    </a>
                                    <a href="{{ route('admin.orders.downloadDeliverySlip', $order->id) }}" class="btn btn-outline-success">
                                        <i data-feather="download" width="18"></i>
                                        {{ localize('Download Slip') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <div class="card mb-4" id="section-1">
                        <div class="card-header border-bottom-0">

                            <!--order status-->
                            <div class="row align-items-end g-3">
                                <div class="col-lg-5">
                                    <h5 class="mb-0">{{ localize('Invoice') }}
                                        <span
                                            class="text-accent">{{ getSetting('order_code_prefix') }}{{ $order->orderGroup->order_code }}
                                        </span>
                                    </h5>
                                    @if(getSetting('business_pan_number'))
                                        <span class="text-muted">{{ localize('PAN No') }}:
                                            {{ getSetting('business_pan_number') }}
                                        </span><br>
                                    @endif
                                    <span class="text-muted">{{ localize('Order Date') }}:
                                        {{ formatOrderDateTime($order->created_at, 'd M, Y h:i A') }}
                                    </span>

                                    @if ($order->location_id != null)
                                        <div>
                                            <span class="text-muted">
                                                <i class="las la-map-marker"></i> {{ optional($order->location)->name }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-7">
                                    @can('assign_deliveryman')
                                    <!-- Show all three fields in one row when user has deliveryman permission -->
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <label class="form-label">{{ localize('Assign Deliveryman') }}</label>
                                            <select class="form-select select2" name="assign_deliveryman"
                                                data-minimum-results-for-search="Infinity" id="assign_deliveryman"
                                                @if ($order->delivery_status == orderDeliveredStatus() || $order->delivery_status == orderCancelledStatus()) disabled @endif>
                                                <option value="">{{ localize('Assign Deliveryman') }}</option>
                                                @foreach ($deliverymen as $deliveryman)
                                                    <option value="{{ $deliveryman->id }}"
                                                        @if ($order->deliveryman_id == $deliveryman->id) selected @endif>
                                                        {{ $deliveryman->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">{{ localize('Payment Status') }}</label>
                                            <select class="form-select select2" name="payment_status"
                                                data-minimum-results-for-search="Infinity" id="update_payment_status">
                                                <option value="" disabled>{{ localize('Payment Status') }}</option>
                                                <option value="paid" @if ($order->payment_status == 'paid') selected @endif>
                                                    {{ localize('Paid') }}</option>
                                                <option value="unpaid" @if ($order->payment_status == 'unpaid') selected @endif>
                                                    {{ localize('Unpaid') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">{{ localize('Delivery Status') }}</label>
                                            <select class="form-select select2" name="delivery_status"
                                                data-minimum-results-for-search="Infinity" id="update_delivery_status">
                                                <option value="" disabled>{{ localize('Delivery Status') }}</option>
                                                <option value="order_placed" @if ($order->delivery_status == orderPlacedStatus()) selected @endif>
                                                    {{ localize('Order Placed') }}</option>
                                                <option value="pending" @if ($order->delivery_status == orderPendingStatus()) selected @endif>
                                                    {{ localize('Pending') }}</option>
                                                <option value="processing" @if ($order->delivery_status == orderProcessingStatus()) selected @endif>
                                                    {{ localize('Processing') }}</option>
                                                <option value="picked_up" @if ($order->delivery_status == orderPickedUpStatus()) selected @endif>
                                                    {{ localize('Picked Up') }}</option>
                                                <option value="out_for_delivery"
                                                    @if ($order->delivery_status == orderOutForDeliveryStatus()) selected @endif>
                                                    {{ localize('Out For Delivery') }}</option>
                                                <option value="delivered" @if ($order->delivery_status == orderDeliveredStatus()) selected @endif>
                                                    {{ localize('Delivered') }}</option>
                                                <option value="cancelled" @if ($order->delivery_status == orderCancelledStatus()) selected @endif>
                                                    {{ localize('Cancelled') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @else
                                    <!-- Show only payment and delivery status when no deliveryman permission -->
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">{{ localize('Payment Status') }}</label>
                                            <select class="form-select select2" name="payment_status"
                                                data-minimum-results-for-search="Infinity" id="update_payment_status">
                                                <option value="" disabled>{{ localize('Payment Status') }}</option>
                                                <option value="paid" @if ($order->payment_status == 'paid') selected @endif>
                                                    {{ localize('Paid') }}</option>
                                                <option value="unpaid" @if ($order->payment_status == 'unpaid') selected @endif>
                                                    {{ localize('Unpaid') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">{{ localize('Delivery Status') }}</label>
                                            <select class="form-select select2" name="delivery_status"
                                                data-minimum-results-for-search="Infinity" id="update_delivery_status">
                                                <option value="" disabled>{{ localize('Delivery Status') }}</option>
                                                <option value="order_placed" @if ($order->delivery_status == orderPlacedStatus()) selected @endif>
                                                    {{ localize('Order Placed') }}</option>
                                                <option value="pending" @if ($order->delivery_status == orderPendingStatus()) selected @endif>
                                                    {{ localize('Pending') }}</option>
                                                <option value="processing" @if ($order->delivery_status == orderProcessingStatus()) selected @endif>
                                                    {{ localize('Processing') }}</option>
                                                <option value="picked_up" @if ($order->delivery_status == orderPickedUpStatus()) selected @endif>
                                                    {{ localize('Picked Up') }}</option>
                                                <option value="out_for_delivery"
                                                    @if ($order->delivery_status == orderOutForDeliveryStatus()) selected @endif>
                                                    {{ localize('Out For Delivery') }}</option>
                                                <option value="delivered" @if ($order->delivery_status == orderDeliveredStatus()) selected @endif>
                                                    {{ localize('Delivered') }}</option>
                                                <option value="cancelled" @if ($order->delivery_status == orderCancelledStatus()) selected @endif>
                                                    {{ localize('Cancelled') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <!--customer info-->
                        <div class="card-body">
                            <div class="row justify-content-between g-3">
                                <div class="col-xl-7 col-lg-6">
                                    <div class="welcome-message">
                                        <h6 class="mb-2">{{ localize('Customer Info') }}</h6>
                                        @php
                                            $customerInfo = $order->orderGroup->getCustomerInfo();
                                        @endphp
                                        <p class="mb-0">{{ localize('Name') }}: {{ $customerInfo['name'] ?: localize('Guest Customer') }}</p>
                                        <p class="mb-0">{{ localize('Email') }}: {{ $customerInfo['email'] ?: localize('N/A') }}</p>
                                        <p class="mb-0">{{ localize('Phone') }}: {{ $customerInfo['phone'] ?: localize('N/A') }}</p>

                                        @php
                                            $deliveryInfo = json_decode($order->scheduled_delivery_info);
                                        @endphp

                                        <p class="mb-0">{{ localize('Delivery Type') }}:
                                            <span class="badge bg-primary">
                                                {{ Str::title(Str::replace('_', ' ', $order->shipping_delivery_type)) }}
                                            </span>
                                        </p>
                                        @if ($order->shipping_delivery_type == getScheduledDeliveryType())
                                            <p class="mb-0">
                                                {{ localize('Delivery Time') }}:
                                                {{ date('d F', $deliveryInfo->scheduled_date) }},
                                                {{ $deliveryInfo->timeline }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-6">
                                    <div class="shipping-address d-flex justify-content-md-end">
                                        <div class="border-end pe-2">
                                            <h6 class="mb-2">{{ localize('Shipping Address') }}</h6>
                                            @if ($order->orderGroup->is_pos_order)
                                                <p class="mb-0">{{ $order->orderGroup->pos_order_address }}</p>
                                            @else
                                                @php
                                                    $shippingInfo = $order->orderGroup->getShippingAddressInfo();
                                                @endphp
                                                <p class="mb-0">
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
                                            @endif
                                        </div>
                                        @if (!$order->orderGroup->is_pos_order)
                                            <div class="ms-4">
                                                <h6 class="mb-2">{{ localize('Billing Address') }}</h6>
                                                @php
                                                    $billingInfo = $order->orderGroup->getBillingAddressInfo();
                                                @endphp
                                                <p class="mb-0">
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
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--order details-->
                        <table class="table tt-footable border-top" data-use-parent-width="true">
                            <thead>
                                <tr>
                                    <th class="text-center" width="7%">{{ localize('S/L') }}</th>
                                    <th>{{ localize('Products') }}</th>
                                    <th data-breakpoints="xs sm">{{ localize('Unit Price') }}</th>
                                    <th data-breakpoints="xs sm">{{ localize('QTY') }}</th>
                                    <th data-breakpoints="xs sm" class="text-end">{{ localize('Total Price') }}</th>
                                </tr>
                            </thead>

                            <tbody>
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

                                        $unitPriceWithoutTax = $discountedPrice;
                                        $totalPriceWithoutTax = $discountedPrice * $item->qty;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm"> <img
                                                        src="{{ uploadedAsset($product->thumbnail_image) }}"
                                                        alt="{{ $product->collectLocalization('name') }}"
                                                        class="rounded-circle">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="fs-sm mb-0">
                                                        {{ $product->collectLocalization('name') }}
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
                                                            <small class="text-muted ms-2" style="font-size: 0.8em;">[{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]</small>
                                                        @endif
                                                    </h6>
                                                    <div class="text-muted">
                                                        @foreach (generateVariationOptions($item->product_variation->combinations) as $variation)
                                                            <span class="fs-xs">
                                                                {{ $variation['name'] }}:
                                                                @foreach ($variation['values'] as $value)
                                                                    {{ $value['name'] }}
                                                                @endforeach
                                                                @if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="tt-tb-price">
                                            <span class="fw-bold">{{ formatPrice($unitPriceWithoutTax) }}
                                            </span>
                                        </td>
                                        <td class="fw-bold">{{ $item->qty }}</td>

                                        <td class="tt-tb-price text-end">
                                            @if ($item->refundRequest && $item->refundRequest->refund_status == 'refunded')
                                                <span
                                                    class="badge bg-soft-info rounded-pill text-capitalize">{{ $item->refundRequest->refund_status }}</span>
                                            @endif
                                            <span class="text-accent fw-bold">{{ formatPrice($totalPriceWithoutTax) }}
                                            </span>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @php
                            // CORRECT calculation logic: Coupon discount on subtotal BEFORE tax, then tax on discounted amount
                            $orderItems = $order->orderItems;

                            // 1. Calculate subtotal using DISCOUNTED price WITHOUT tax (this is what coupon discount applies to)
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
                            $grandTotal = $discountedSubtotal + $tax + $order->orderGroup->total_shipping_cost + $order->orderGroup->total_tips_amount;

                            // For POS orders, also subtract POS discount
                            if ($order->orderGroup->is_pos_order && $order->orderGroup->total_discount_amount > 0) {
                                $grandTotal -= $order->orderGroup->total_discount_amount;
                            }
                        @endphp

                        <div class="row justify-content-md-end px-4">
                            <div class="col-md-6">
                                <div class="text-end">
                                    <table class="table table-sm text-end ms-auto">
                                        <tbody>
                                            <tr>
                                                <td class="text-dark fw-bold">{{ localize('Taxable Amount') }}</td>
                                                <td class="text-dark fw-bold">
                                                    {{ formatPrice($taxableAmountForDisplay) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!--grand total-->
                        <div class="card-body">
                            <div class="card-footer border-top-0 px-4 py-3 rounded">
                                <div class="row g-4">
                                    <div class="col-auto">
                                        <h6 class="mb-1">{{ localize('Payment Method') }}</h6>
                                        <span>{{ ucwords(str_replace('_', ' ', $order->orderGroup->payment_method)) }}</span>
                                    </div>

                                    <div class="col-auto flex-grow-1 ms-lg-5">
                                        <h6 class="mb-1">{{ localize('Logistic') }}</h6>
                                        <span>{{ $order->logistic_name }}</span>
                                    </div>
                                    @if ($couponDiscount > 0)
                                    <div class="col-auto">
                                        <h6 class="mb-1">{{ localize('Taxable Amount') }}</h6>
                                        <strong>{{ formatPrice($discountedSubtotal) }}</strong>
                                    </div>
                                    @endif
                                    <div class="col-auto">
                                        <h6 class="mb-1">{{ localize('Subtotal') }}</h6>
                                        <strong>{{ formatPrice($subtotal) }}</strong>
                                    </div>

                                    <div class="col-auto">
                                        <h6 class="mb-1">{{ localize('Tips') }}</h6>
                                        <strong>{{ formatPrice($order->orderGroup->total_tips_amount) }}</strong>
                                    </div>

                                    <div class="col-auto ps-lg-5">
                                        <h6 class="mb-1">{{ localize('Shipping Cost') }}</h6>
                                        <strong>{{ formatPrice($order->orderGroup->total_shipping_cost) }}</strong>
                                    </div>

                                    @if ($couponDiscount > 0)
                                        <div class="col-auto ps-lg-5">
                                            <h6 class="mb-1">{{ localize('Coupon Discount') }}</h6>
                                            <strong>-{{ formatPrice($couponDiscount) }}</strong>
                                        </div>
                                    @endif

                                    @if ($tax > 0)
                                        <div class="col-auto ps-lg-5">
                                            <h6 class="mb-1">{{ getTaxDisplayText($orderItems) }}</h6>
                                            <strong>{{ formatPrice($tax) }}</strong>
                                        </div>
                                    @endif

                                    @if ($order->orderGroup->is_pos_order && $order->orderGroup->total_discount_amount > 0)
                                        <div class="col-auto ps-lg-5">
                                            <h6 class="mb-1">{{ localize('Discount') }}</h6>
                                            <strong>-{{ formatPrice($order->orderGroup->total_discount_amount) }}</strong>
                                        </div>
                                    @endif

                                    <div class="col-auto text-lg-end ps-lg-5">
                                        <h6 class="mb-1">{{ localize('Grand Total') }}</h6>
                                        <strong class="text-accent">{{ formatPrice($grandTotal) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="tt-sticky-sidebar">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Order Logs') }}</h5>
                                <div class="tt-vertical-step">
                                    <ul class="list-unstyled">

                                        @forelse ($order->orderUpdates as $orderUpdate)
                                            <li>
                                                <a class="{{ $loop->first ? 'active' : '' }}">
                                                    {{ $orderUpdate->note }} <br> By
                                                    <span
                                                        class="text-capitalize">{{ optional($orderUpdate->user)->name }}</span>
                                                    at
                                                    {{ date('d M, Y', strtotime($orderUpdate->created_at)) }}.</a>
                                            </li>
                                        @empty
                                            <li>
                                                <a class="active">{{ localize('No logs found') }}</a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        "use strict";

        // assign deliveryman
        $('#assign_deliveryman').on('change', function() {
            var order_id = {{ $order->id }};
            var deliveryman_id = $('#assign_deliveryman').val();
            $.post('{{ route('admin.orders.assignDeliveryman') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                deliveryman_id: deliveryman_id
            }, function(data) {
                notifyMe('success', '{{ localize('Deliveryman has been updated') }}');
                window.location.reload();
            });
        });

        // payment status
        $('#update_payment_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('admin.orders.update_payment_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                notifyMe('success', '{{ localize('Payment status has been updated') }}');
                window.location.reload();
            });
        });

        // delivery status
        $('#update_delivery_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('admin.orders.update_delivery_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                notifyMe('success', '{{ localize('Delivery status has been updated') }}');
                window.location.reload();
            });
        });

    </script>
@endsection
