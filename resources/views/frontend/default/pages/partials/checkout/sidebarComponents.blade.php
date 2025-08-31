<div class="cart-info" style="padding-top: 0; margin-top: -55px;">
    <div class="cart-order-detail cart-col" id="checkoutAccordion">
        <!-- Delivery Methods -->
        <div class="block mb-3 delivery-methods">
            <div class="block-content">
                <h3 class="title mb-3 text-uppercase" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseDeliveryMethods" aria-expanded="true" aria-controls="collapseDeliveryMethods">
                    <strong>{{ localize('DELIVERY METHODS') }}</strong>
                    <i class="fas fa-chevron-down float-end"></i>
                </h3>
                <div class="delivery-methods-content collapse show" id="collapseDeliveryMethods" data-bs-parent="#checkoutAccordion">
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
                            <div class="mt-3 ps-4" id="scheduled-options" style="display: none;">
                                <div class="row flex-wrap justify-content-between align-items-center">
                                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ localize('Select Date & Time') }}
                                    </div>

                                    <div class="col-auto d-flex flex-grow-1 align-items-center justify-content-between">
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
                                                <option value="{{ strtotime($date . '+' . $i . ' days') }}">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delivery Methods -->

        <!-- payment methods -->
        <div class="block mb-3 payment-methods">
            <div class="block-content">
                <h3 class="title mb-3 text-uppercase" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapsePaymentMethods" aria-expanded="false" aria-controls="collapsePaymentMethods">
                    <strong>{{ localize('PAYMENT METHODS') }}</strong>
                    <i class="fas fa-chevron-down float-end" style="transform: rotate(-90deg);"></i>
                </h3>
                <div class="collapse" id="collapsePaymentMethods" data-bs-parent="#checkoutAccordion">
                    @include('frontend.default.pages.checkout.inc.newPaymentMethods')
                </div>
            </div>
        </div>
        <!-- payment methods -->

        <!-- Order Comment -->
        <div class="block mb-3 order-comments">
            <div class="block-content">
                <h3 class="title mb-3 text-uppercase" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseOrderComment" aria-expanded="false" aria-controls="collapseOrderComment">
                    <strong>{{ localize('ORDER COMMENT') }}</strong>
                    <i class="fas fa-chevron-down float-end" style="transform: rotate(-90deg);"></i>
                </h3>
                <div class="collapse" id="collapseOrderComment" data-bs-parent="#checkoutAccordion">
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
            </div>
        </div>
        <!-- End Order Comment -->

        <!-- Apply Promocode -->
        <div class="block mb-3 apply-code">
            <div class="block-content">
                <h3 class="title mb-3 text-uppercase" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapsePromocode" aria-expanded="false" aria-controls="collapsePromocode">
                    <strong>{{ localize('APPLY PROMOCODE (OPTIONAL)') }}</strong>
                    <i class="fas fa-chevron-down float-end" style="transform: rotate(-90deg);"></i>
                </h3>
                <div class="collapse" id="collapsePromocode" data-bs-parent="#checkoutAccordion">
                    <div id="coupon" class="coupon-dec">
                        <p>{{ localize('Got a promo code? Then you\'re a few randomly combined numbers & letters away from fab savings!') }}</p>
                        <div class="input-group mb-0 d-flex">
                            <input id="coupon-code" type="text" class="form-control" placeholder="{{ localize('Promotion/Discount Code (Optional)') }}" value="{{ getCoupon() }}" style="border: 1px solid #e0e0e0; border-radius: 0;">
                            <button class="coupon-btn btn btn-primary" type="button" onclick="applyCoupon()" style="background-color: #006400; border-radius: 0;">{{ localize('Apply') }}</button>
                            @if(getCoupon() != '')
                            <button class="coupon-btn btn btn-danger ms-2" type="button" onclick="clearCoupon()" style="border-radius: 0;">{{ localize('Clear') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Apply Promocode -->

        <!-- Place Order button moved to the order summary section -->
    </div>
</div>
