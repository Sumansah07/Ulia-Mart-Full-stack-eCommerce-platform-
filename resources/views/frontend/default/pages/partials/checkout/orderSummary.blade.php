<div class="cart-info" style="padding-top: 0; margin-top: -55px;">
    <div class="cart-order-detail cart-col">
        <!-- Delivery Time -->
        <!-- <div class="block mb-3 delivery-methods" style="margin-top: 0; padding-top: 0; margin-bottom: 0; height: 100%;">
            <div class="block-content" style="padding-top: 0; padding-bottom: 0; height: 100%;">
                <h3 class="title mb-3 text-uppercase" style="margin-top: 0; margin-bottom: 0px;">{{ localize('Delivery Methods') }}</h3>
                <div class="delivery-methods-content">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="customRadio clearfix">
                                <input type="radio" class="radio" name="shipping_delivery_type"
                                    id="regular-shipping" value="regular" checked>
                                <label for="regular-shipping" class="mb-0">
                                    {{ localize('Standard Delivery Rs 50.00 (3-5 days)') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="customRadio clearfix">
                                <input type="radio" class="radio" name="shipping_delivery_type"
                                    id="express-shipping" value="express">
                                <label for="express-shipping" class="mb-0">
                                    {{ localize('Express Delivery Rs 100.00 (1-2 days)') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="customRadio clearfix">
                                <input type="radio" class="radio" name="shipping_delivery_type"
                                    id="same-day-shipping" value="same-day">
                                <label for="same-day-shipping" class="mb-0">
                                    {{ localize('Same-Day Rs 200.00 (Evening Delivery)') }}
                                </label>
                            </div>
                        </div>
                        @if (getSetting('enable_scheduled_order') == 1)
                            <div class="col-12">
                                <div class="customRadio clearfix">
                                    <input type="radio" class="radio" name="shipping_delivery_type"
                                        id="scheduled-shipping" value="scheduled">
                                    <label for="scheduled-shipping" class="mb-0">
                                        {{ localize('Express Delivery Rs 100.00 (1-2 days)') }}
                                    </label>
                                </div>
                                <div class="mt-3 ps-4" id="scheduled-options" style="display: none;">
                                    <div class="row flex-wrap justify-content-between align-items-center">
                                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ localize('Select Date & Time') }}
                                        </div>

                                        <div
                                            class="col-auto d-flex flex-grow-1 align-items-center justify-content-between">

                                            @php
                                                $date = date('Y-m-d');
                                                $dateCount = 7;
                                                if (getSetting('allowed_order_days') != null) {
                                                    $dateCount = getSetting('allowed_order_days');
                                                }
                                            @endphp

                                            <select class="form-select py-1 me-3" name="scheduled_date">
                                                @for ($i = 1; $i <= $dateCount; $i++)
                                                    @php
                                                        $addDay = strtotime($date . '+' . $i . ' days');
                                                    @endphp
                                                    <option
                                                        value="{{ strtotime($date . '+' . $i . ' days') }}">
                                                        {{ date('d F', $addDay) }}</option>
                                                @endfor
                                            </select>

                                            @php
                                                $timeSlots = \App\Models\ScheduledDeliveryTimeList::orderBy('sorting_order', 'ASC')->get();
                                            @endphp

                                            <select class="form-select py-1" name="timeslot">
                                                @foreach ($timeSlots as $slot)
                                                    <option value="{{ $slot->id }}">
                                                        {{ $slot->timeline }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="customRadio clearfix mb-0">
                                    <input type="radio" class="radio" name="shipping_delivery_type"
                                        id="same-day-shipping" value="same-day">
                                    <label for="same-day-shipping" class="mb-0">
                                        {{ localize('Same-Day Rs 200.00 (Evening Delivery)') }}
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Delivery Time -->


        <!-- Order Comment -->
        <!-- <div class="block mb-3 order-comments">
            <div class="block-content">
                <h3 class="title mb-3 text-uppercase">{{ localize('Order Comment') }}</h3>
                <fieldset>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 mb-0">
                            <textarea class="resize-both form-control" rows="4" name="additional_info"
                                placeholder="{{ localize('Type your additional informations here') }}"></textarea>
                            <small class="mt-2 d-block">*{{ localize('Include any special instructions or delivery notes here.') }}</small>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div> -->
        <!-- End Order Comment -->

        <!-- Apply Promocode -->
        <!-- <div class="block mb-3 apply-code">
            <div class="block-content">
                <h3 class="title mb-3 text-uppercase">{{ localize('Apply Promocode') }}</h3>
                <div id="coupon" class="coupon-dec">
                    <p>{{ localize('Got a promo code? Then you\'re a few randomly combined numbers & letters away from fab savings!') }}</p>
                    <div class="input-group mb-0 d-flex">
                        <input id="coupon-code" required="" type="text" class="form-control" placeholder="{{ localize('Promotion/Discount Code') }}" value="{{ getCoupon() }}" style="border: 1px dashed #ffa500; border-radius: 0;">
                        <button class="coupon-btn btn btn-primary" type="button" onclick="applyCoupon()" style="background-color: #006400; border-radius: 0;">{{ localize('Apply') }}</button>
                        @if(getCoupon() != '')
                        <button class="coupon-btn btn btn-danger ms-2" type="button" onclick="clearCoupon()" style="border-radius: 0;">{{ localize('Clear') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Apply Promocode -->

        <!-- Order Summary -->
        <div class="block mb-3 order-summary" style="border: none !important;">
            <div class="block-content">
                <div class="row g-3">
                    <div class="col-lg-8 col-md-12">
                        <h3 class="title mb-3 text-uppercase" style="margin-bottom: 15px !important;">{{ localize('Order Summary') }}</h3>
                        <div class="table-responsive-sm table-bottom-brd order-table" style="border: 1px solid #e0e0e0 !important; padding: 10px !important; border-radius: 4px !important;">
                            <table class="table table-hover align-middle mb-0" style="border: none;">
                                <thead>
                                    <tr>
                                        <th class="action" style="width: 5%;">&nbsp;</th>
                                        <th class="text-start" style="width: 15%;">{{ localize('Image') }}</th>
                                        <th class="text-start proName" style="width: 40%;">{{ localize('Product') }}</th>
                                        <th class="text-center" style="width: 15%;">{{ localize('Qty') }}</th>
                                        <th class="text-end" style="width: 25%;">{{ localize('Subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carts as $cart)
                                    <tr>
                                        <td class="text-center cart-delete">
                                            <button type="button" class="btn btn-sm text-danger p-0" onclick="handleCartItem('delete', {{ $cart->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Remove from Cart') }}" style="font-size: 14px !important; padding: 5px !important;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <td class="text-start">
                                            <a href="{{ route('products.show', $cart->product_variation->product->slug) }}" class="thumb">
                                                <img class="rounded-0 blur-up lazyload" src="{{ uploadedAsset($cart->product_variation->product->thumbnail_image) }}" alt="{{ $cart->product_variation->product->collectLocalization('name') }}" width="40" height="55" />
                                            </a>
                                        </td>
                                        <td class="text-start proName">
                                            <div class="list-view-item-title">
                                                <a href="{{ route('products.show', $cart->product_variation->product->slug) }}">{{ $cart->product_variation->product->collectLocalization('name') }}</a>
                                                @if ($cart->product_variation->product && $cart->product_variation->product->taxes && $cart->product_variation->product->taxes->where('tax_value', '>', 0)->count() > 0)
                                                    @php
                                                        $taxPercentage = $cart->product_variation->product->taxes->where('tax_type', 'percent')->where('tax_value', '>', 0)->sum('tax_value');
                                                    @endphp
                                                    @if ($taxPercentage > 0)
                                                        <small class="text-muted" style="font-size: 0.8em; margin-left: 5px;">[{{ number_format($taxPercentage, 0) }}% {{ localize('tax included') }}]</small>
                                                    @else
                                                        <small class="text-muted" style="font-size: 0.8em; margin-left: 5px;">[{{ localize('tax included') }}]</small>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="cart-meta-text">
                                                @foreach ($cart->product_variation->combinations as $combination)
                                                    {{ $combination->attribute->collectLocalization('name') }}: {{ $combination->attribute_value->collectLocalization('name') }}
                                                @endforeach
                                            </div>

                                        </td>
                                        <td class="text-center">{{ $cart->qty }}</td>
                                        <td class="text-end"><strong>{{ formatPrice($cart->product_price * $cart->qty) }}</strong></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h3 class="title mb-3 text-uppercase" style="margin-bottom: 15px !important;">{{ localize('Subtotal') }}</h3>
                        <div class="order-totals" style="border: 1px solid #e0e0e0 !important; padding: 15px !important; background-color: #f9f9f9 !important; border-radius: 4px !important;">
                            <div class="border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between">
                                    <span class="cart-subtotal-title"><strong>{{ localize('Subtotal') }}</strong></span>
                                    <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">{{ formatPrice(getSubTotal($carts, false, '', false)) }}</span></span>
                                </div>
                            </div>

                            @if (getCoupon() != '' && getCouponDiscountWithRestrictions($carts, getCoupon()) > 0)
                            <div class="border-bottom py-2 mb-2">
                                <div class="d-flex justify-content-between">
                                    <span class="cart-subtotal-title"><strong>{{ localize('Coupon Discount') }}</strong></span>
                                    <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">{{ formatPrice(getCouponDiscountWithRestrictions($carts, getCoupon())) }}</span></span>
                                </div>
                            </div>
                            @endif

                            <div class="border-bottom py-2 mb-2">
                                <div class="d-flex justify-content-between">
                                    <span class="cart-subtotal-title"><strong>{{ localize('Tax') }}</strong></span>
                                    <span class="cart-subtotal-title cart-subtotal text-end"><span class="money">{{ formatPrice(getTotalTaxWithCouponDiscount($carts, getCoupon())) }}</span></span>
                                </div>
                            </div>

                            @php
                                $is_free_shipping = false;
                                if (getCoupon() != '' && getCouponDiscountWithRestrictions($carts, getCoupon()) > 0) {
                                    $coupon = \App\Models\Coupon::where('code', getCoupon())->first();
                                    if (!is_null($coupon) && $coupon->is_free_shipping == 1) {
                                        $is_free_shipping = true;
                                    }
                                }

                                $shipping = 0;
                                if (isset($shippingAmount) && $is_free_shipping == false) {
                                    $shipping = $shippingAmount;
                                }

                                $total =
                                    getSubTotal($carts, false, '', false) +
                                    getTotalTaxWithCouponDiscount($carts, getCoupon()) +
                                    $shipping -
                                    getCouponDiscountWithRestrictions($carts, getCoupon());
                            @endphp

                            <div class="border-bottom py-2 mb-2">
                                <div class="d-flex justify-content-between">
                                    <span class="cart-subtotal-title"><strong>{{ localize('Shipping') }}</strong></span>
                                    <span class="cart-subtotal-title cart-subtotal text-end">
                                        <span class="money">
                                            @if(isset($shippingAmount))
                                                @if($is_free_shipping)
                                                    {{ localize('Free shipping') }}
                                                @else
                                                    {{ formatPrice($shippingAmount) }}
                                                @endif
                                            @else
                                                {{ localize('Calculated at next step') }}
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>

                            @if (getSetting('enable_delivery_tips') == 1)
                            <div class="border-bottom py-2 mb-2">
                                <div class="d-flex justify-content-between">
                                    <span class="cart-subtotal-title"><strong>{{ localize('Delivery Tips') }}</strong></span>
                                    <span class="cart-subtotal-title cart-subtotal text-end">
                                        <div class="form-group mb-0">
                                            <input type="number" name="tips" value="0" min="0" step="0.001" class="form-control text-end">
                                        </div>
                                    </span>
                                </div>
                            </div>
                            @endif

                            <div class="pt-2 mb-3">
                                <div class="d-flex justify-content-between">
                                    <span class="cart-subtotal-title fs-6"><strong>{{ localize('Total') }}</strong></span>
                                    <span class="cart-subtotal-title fs-5 cart-subtotal text-end text-primary"><b class="money">{{ formatPrice($total) }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-lg my-4 checkout w-50" style="background-color: #006400; border-radius: 0; max-width: 100%; word-wrap: break-word;">{{ localize('Place Order') }}</button>
</div>
<div class="mb-5"></div> <!-- Extra space to prevent footer overlap -->
