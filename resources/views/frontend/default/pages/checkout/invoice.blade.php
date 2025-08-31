@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Invoice') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <!--invoice section start-->
    @if (!is_null($orderGroup))
        @php
            $order = $orderGroup->order;
            $orderItems = $order->orderItems;

            // CORRECT calculation logic: Coupon discount on subtotal BEFORE tax, then tax on discounted amount
            // 1. Calculate subtotal using DISCOUNTED price (BEFORE tax) - this is the amount coupon discount applies to
            $subtotal = $orderItems->sum(function($item) {
                $product = $item->product_variation->productWithTrashed;
                // Check if product has taxes to determine which function to use
                $hasTax = false;
                if ($product->taxes && $product->taxes->count() > 0) {
                    foreach ($product->taxes as $tax) {
                        if (($tax->tax_type == 'percent' && $tax->tax_value > 0) ||
                            ($tax->tax_type == 'flat' && $tax->tax_value > 0)) {
                            $hasTax = true;
                            break;
                        }
                    }
                }
                // Use appropriate discounted price function (without tax for subtotal calculation)
                $unitPrice = discountedProductBasePriceWithoutTax($product);
                return $unitPrice * $item->qty;
            });

            // 2. Get coupon code - the coupon code is stored in the Order table, not OrderGroup
            $currentCoupon = $order->applied_coupon_code ?? '';





            // For completed orders, we should primarily use the stored coupon code from Order table
            // Only fallback to session/request for active checkout sessions
            if (empty($currentCoupon)) {
                $currentCoupon = getCoupon();
                if (empty($currentCoupon)) {
                    $currentCoupon = request()->get('coupon', '');
                }
                if (empty($currentCoupon)) {
                    $currentCoupon = session('coupon_code', '');
                }
            }

            // 3. Check for free shipping - same logic as orderSummaryOnly.blade.php
            $is_free_shipping = false;
            if ($currentCoupon != '' && getCouponDiscount($subtotal, $currentCoupon) > 0) {
                $coupon = \App\Models\Coupon::where('code', $currentCoupon)->first();
                if (!is_null($coupon) && $coupon->is_free_shipping == 1) {
                    $is_free_shipping = true;
                }
            }

            // 4. Calculate shipping - same logic as orderSummaryOnly.blade.php
            $shipping = $orderGroup->total_shipping_cost;
            if ($is_free_shipping) {
                $shipping = 0; // Override if free shipping applies
            }

            // 5. Calculate coupon discount - ALWAYS recalculate correctly on subtotal (before tax)
            // Don't use stored amount as it might have been calculated with old incorrect logic
            $couponDiscount = 0;
            if (!empty($currentCoupon)) {
                // Always calculate fresh using correct logic with restrictions
                $couponDiscount = getCouponDiscountFromOrderItems($orderItems, $currentCoupon);
            }
            $discountedSubtotal = $subtotal - $couponDiscount;

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





            // 6. Calculate tax on discounted subtotal (CORRECT: tax after coupon discount)
            // We need to calculate tax on the discounted amount, not the original amount
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

            // 7. Calculate grand total - same logic as orderSummaryOnly.blade.php
            $grandTotal = $discountedSubtotal + $tax + $shipping + $orderGroup->total_tips_amount;
        @endphp
        <section class="invoice-section pt-6 pb-120">
            <div class="container">
                <div class="invoice-box bg-white rounded p-4 p-sm-6">
                    <div class="row g-5 justify-content-between">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="invoice-title d-flex align-items-center flex-wrap">
                                <h3>{{ localize('Invoice') }}</h3>
                                <span class="badge rounded-pill bg-primary-light text-primary fw-medium ms-3">
                                    {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                                </span>
                                @if($orderGroup->payment_status == paidPaymentStatus())
                                    <span class="badge bg-success text-white fw-medium ms-2 px-2 py-1" style="font-size: 10px;" id="payment-status-badge">
                                        <i class="fas fa-check-circle me-1"></i>{{ localize('Payment Confirmed') }}
                                    </span>
                                @elseif($orderGroup->payment_status == unpaidPaymentStatus())
                                    <span class="badge bg-warning text-dark fw-medium ms-2 px-2 py-1" style="font-size: 10px;" id="payment-status-badge">
                                        <i class="fas fa-clock me-1"></i>{{ localize('Payment Pending') }}
                                        <!-- <small class="d-block mt-1" style="font-size: 8px; opacity: 0.8;">{{ localize('Auto-updating...') }}</small> -->
                                    </span>
                                @else
                                    <span class="badge bg-info text-white fw-medium ms-2 px-2 py-1" style="font-size: 10px;" id="payment-status-badge">
                                        <i class="fas fa-info-circle me-1"></i>{{ ucwords(str_replace('_', ' ', $orderGroup->payment_status)) }}
                                    </span>
                                @endif
                            </div>
                            <table class="invoice-table-sm">
                                <tr>
                                    <td><strong>{{ localize('Order Code') }}</strong></td>
                                    <td>{{ getSetting('order_code_prefix') }}{{ $orderGroup->order_code }}</td>
                                </tr>
                                @if(getSetting('business_pan_number'))
                                <tr>
                                    <td><strong>{{ localize('PAN No') }}</strong></td>
                                    <td>{{ getSetting('business_pan_number') }}</td>
                                </tr>
                                @endif

                                <tr>
                                    <td><strong>{{ localize('Date') }}</strong></td>
                                    <td>{{ formatOrderDateTime($orderGroup->created_at, 'd M, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-5 col-md-8 order-1 order-lg-2">
                            <div class="text-lg-end text-center text-lg-end">
                                <a href="{{ route('home') }}"><img src="{{ uploadedAsset(getSetting('invoice_logo')) }}"
                                        alt="logo" class="img-fluid" style="max-width: 120px; max-height: 80px;"></a>
                                <h6 class="mb-0 text-gray mt-4">{{ getSetting('site_address') }}</h6>
                            </div>
                        </div>
                    </div>
                    <span class="my-6 w-100 d-block border-top"></span>
                    <div class="row justify-content-between g-5">
                        <!-- QR Code Section - First on mobile, middle on desktop -->
                        <div class="col-xl-4 col-lg-4 col-12 order-1 order-xl-2 d-flex justify-content-center align-items-center">
                            <div class="qr-code-section text-center">
                                @php
                                    $customerInfo = $orderGroup->getCustomerInfo();
                                    $trackingUrl = route('customers.dashboard') . '#orders-tracker?code=' . urlencode($orderGroup->order_code) . '&email=' . urlencode($customerInfo['email'] ?? '');
                                    $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=' . urlencode($trackingUrl);
                                @endphp
                                <img src="{{ $qrCodeUrl }}" alt="QR Code" class="d-inline-block" style="max-width: 100px; max-height: 100px; border: none;">
                                <p class="small text-muted mt-2 mb-0">{{ localize('Scan to track your order') }}</p>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-12 order-2 order-xl-1">
                            <div class="welcome-message">
                                @php
                                    $customerInfo = $orderGroup->getCustomerInfo();
                                @endphp
                                <h4 class="mb-2">{{ $customerInfo['name'] ?: localize('Guest Customer') }}</h4>
                                <p class="mb-0">
                                    {{ localize('Here are your order details. We thank you for your purchase.') }}</p>

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
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-12 order-3 order-xl-3">
                            @if (!$order->orderGroup->is_pos_order)
                                <div class="shipping-address d-flex justify-content-md-end">
                                    <div class="border-end pe-2">
                                        <h6 class="mb-2">{{ localize('Shipping Address') }}</h6>
                                        @php
                                            $shippingInfo = $orderGroup->getShippingAddressInfo();
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
                                    </div>
                                    <div class="ms-4">
                                        <h6 class="mb-2">{{ localize('Billing Address') }}</h6>
                                        @php
                                            $billingInfo = $orderGroup->getBillingAddressInfo();
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
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mt-6">
                        <table class="table invoice-table">
                            <tr>
                                <th>{{ localize('S/L') }}</th>
                                <th>{{ localize('Products') }}</th>
                                <th>{{ localize('U.Price') }}</th>
                                <th>{{ localize('QTY') }}</th>
                                <th>{{ localize('T.Price') }}</th>
                                @if (getSetting('enable_refund_system') == 1)
                                    <th>{{ localize('Refund') }}</th>
                                @endif
                            </tr>
                            @foreach ($orderItems as $key => $item)
                                @php
                                    $product = $item->product_variation->productWithTrashed;
                                    // Show the product's discounted price as the unit price (BEFORE GST)
                                    $unitPrice = discountedProductBasePriceWithoutTax($product);
                                    $totalPrice = $unitPrice * $item->qty;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-nowrap">
                                        <div class="d-flex">
                                            <img src="{{ uploadedAsset($product->thumbnail_image) }}"
                                                alt="{{ $product->collectLocalization('name') }}"
                                                class="img-fluid product-item d-none">
                                            <div class="">
                                                <span>{{ $product->collectLocalization('name') }}</span>
                                                <div>
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
                                                @if ($product && $product->taxes && $product->taxes->where('tax_value', '>', 0)->count() > 0)
                                                    @php
                                                        $taxPercentage = $product->taxes->where('tax_type', 'percent')->where('tax_value', '>', 0)->sum('tax_value');
                                                    @endphp
                                                    <div class="tax-info mt-1">
                                                        @if ($taxPercentage > 0)
                                                            <small class="text-muted" style="font-size: 0.8em;">[{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]</small>
                                                        @else
                                                            <small class="text-muted" style="font-size: 0.8em;">[{{ localize('tax included') }}]</small>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ formatPrice($unitPrice) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ formatPrice($totalPrice) }}</td>

                                    @if (getSetting('enable_refund_system') == 1)
                                        <td>
                                            @if ($item->refundRequest)
                                                @if ($item->refundRequest->refund_status == 'pending')
                                                    <span class="badge bg-info text-capitalize">
                                                        {{ $item->refundRequest->refund_status }}
                                                    </span>
                                                @elseif($item->refundRequest->refund_status == 'refunded')
                                                    <span class="badge bg-primary text-capitalize">
                                                        {{ $item->refundRequest->refund_status }}
                                                    </span>
                                                @else
                                                    <span class="btn badge bg-danger text-capitalize cursor-pointer"
                                                        onclick="showRejectionReason('{{ $item->refundRequest->refund_reject_reason }}')">
                                                        {{ $item->refundRequest->refund_status }}
                                                    </span>
                                                @endif
                                            @else
                                                @php
                                                    $withinDays = (int) getSetting('refund_within_days');

                                                    $checkDate = \Carbon\Carbon::parse($item->created_at)->addDays($withinDays);
                                                    $today = today();

                                                    $count = $checkDate->diffInDays($today);
                                                @endphp
                                                @if ($count > 0)
                                                    <a href="javascript:void(0);"
                                                        onclick="requestRefund({{ $item->id }})"
                                                        class="fw-semibold badge bg-secondary"><i
                                                            class="fas fa-rotate-left me-1"></i>
                                                        {{ localize('Request Refund') }}</a>
                                                @else
                                                    {{ localize('Time Over') }}
                                                @endif
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach


                        </table>
                    </div>
                    <div class="mt-4 table-responsive">
                        <table class="table footer-table">
                            <tr>
                                <td>
                                    <strong class="text-dark d-block text-nowrap">{{ localize('Payment Method') }}</strong>
                                    <span> {{ ucwords(str_replace('_', ' ', $orderGroup->payment_method)) }}</span>
                                </td>
                                <td>
                                    <strong class="text-dark d-block text-nowrap">{{ localize('Sub Total') }}</strong>
                                    <span>{{ formatPrice($subtotal) }}</span>
                                </td>
                                @if (!empty($currentCoupon))
                                    <td>
                                        <strong class="text-dark d-block text-nowrap">{{ localize('Coupon Discount') }}</strong>
                                        <span>-{{ formatPrice($couponDiscount) }}</span>
                                        @if (!empty($currentCoupon))
                                            <!-- <br><small class="text-muted">{{ localize('Code') }}: {{ $currentCoupon }}</small> -->
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <strong class="text-dark d-block text-nowrap">{{ localize('Taxable Amount') }}</strong>
                                    <span>{{ formatPrice($taxableAmountForDisplay) }}</span>
                                </td>
                                @if ($tax > 0)
                                    <td>
                                        <!-- <strong class="text-dark d-block text-nowrap">{{ localize('Tax') }}</strong> -->
                                        <strong class="text-dark d-block text-nowrap">{{ getTaxDisplayText($orderItems) }}</strong>
                                        <span>{{ formatPrice($tax) }}</span>
                                    </td>
                                @endif
                                <td>
                                    <strong class="text-dark d-block text-nowrap">{{ localize('Shipping Cost') }}</strong>
                                    <span>
                                        @if($is_free_shipping)
                                            {{ localize('FREE SHIPPING') }}
                                        @else
                                            {{ formatPrice($shipping) }}
                                        @endif
                                    </span>
                                </td>
                                @if ($orderGroup->total_tips_amount > 0)
                                    <td>
                                        <strong class="text-dark d-block text-nowrap">{{ localize('Tips') }}</strong>
                                        <span>{{ formatPrice($orderGroup->total_tips_amount) }}</span>
                                    </td>
                                @endif
                                <td>
                                    <strong class="text-dark d-block text-nowrap">{{ localize('Total Price') }}</strong>
                                    <span class="text-primary fw-bold">{{ formatPrice($grandTotal) }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--invoice section end-->

    <!--refund modal-->
    <div class="modal fade refundModal" id="refundModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="gstore-product-quick-view bg-white rounded-3 pt-3 pb-6 px-4">
                        <h2 class="modal-title fs-5 mb-3">{{ localize('Request Refund') }}</h2>
                        <form action="{{ route('customers.requestRefund') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_item_id" value="" class="order_item_id">
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="label-input-field">
                                        <label>{{ localize('Refund Reason') }}</label>
                                        <textarea rows="4" placeholder="{{ localize('Type refund reason') }}" name="refund_reason" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 d-flex">
                                <button type="submit"
                                    class="btn btn-secondary btn-md me-3">{{ localize('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--rejection modal-->
    @include('frontend.default.pages.checkout.inc.rejectionModal')
@endsection


@section('scripts')
    <style>
        /* Professional payment status badges for invoice */
        .invoice-title .badge {
            font-size: 10px;
            font-weight: 600;
            border-radius: 4px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            margin-top: 5px;
        }

        .invoice-title .badge i {
            font-size: 9px;
        }

        .invoice-title .badge.bg-success {
            background-color: #28a745 !important;
            border: 1px solid #1e7e34;
        }

        .invoice-title .badge.bg-warning {
            background-color: #ffc107 !important;
            border: 1px solid #d39e00;
            color: #212529 !important;
        }

        .invoice-title .badge.bg-info {
            background-color: #17a2b8 !important;
            border: 1px solid #117a8b;
        }

        /* Responsive adjustments for invoice badges */
        @media (max-width: 767px) {
            .invoice-title {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .invoice-title .badge {
                margin-top: 10px;
                margin-left: 0 !important;
            }
        }
    </style>

    <script>
        "use strict";

        // request refund
        function requestRefund(order_item_id) {
            $('#refundModal').modal('show');
            $('.order_item_id').val(order_item_id);
        }

        // Auto-refresh payment status every 30 seconds to show real-time updates
        // This ensures the invoice reflects payment status changes made by admin
        setInterval(function() {
            // Only refresh if the payment is still pending to avoid unnecessary requests
            const paymentBadge = document.getElementById('payment-status-badge');
            if (paymentBadge && paymentBadge.textContent.includes('{{ localize("Payment Pending") }}')) {
                // Silently check for payment status updates
                fetch(window.location.href, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Parse the response to check if payment status changed
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newPaymentBadge = doc.getElementById('payment-status-badge');

                    if (newPaymentBadge && newPaymentBadge.textContent !== paymentBadge.textContent) {
                        // Payment status changed, refresh the page to show updated status
                        console.log('Payment status updated! Refreshing page...');
                        window.location.reload();
                    }
                })
                .catch(error => {
                    // Silently handle errors to avoid disrupting user experience
                    console.log('Payment status check failed:', error);
                });
            }
        }, 30000); // Check every 30 seconds
    </script>
@endsection
