<div class="block mb-3" style="border: 1px solid #e0e0e0; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); border-radius: 5px; background-color: #fff;">
    <div class="block-content">
        <h3 class="title mb-3 text-uppercase">{{ localize('Available Logistics') }}</h3>
        @forelse ($logisticZoneCities as $zoneCity)
            <div class="checkout-radio d-flex align-items-center justify-content-between gap-3 bg-white rounded p-2 mt-2" style="border: 1px solid #e0e0e0; border-radius: 4px;">
                <div class="radio-left d-inline-flex align-items-center">
                    <div class="theme-radio">
                        <input type="radio" name="chosen_logistic_zone_id" id="logistic-{{ $zoneCity->logistic_zone_id }}"
                            value="{{ $zoneCity->logistic_zone_id }}">
                        <span class="custom-radio"></span>
                    </div>
                    <div>
                        <label for="logistic-{{ $zoneCity->logistic_zone_id }}" class="ms-3 mb-0">
                            <div class="h6 mb-0">{{ $zoneCity->logistic->name }}</div>
                            <div> {{ localize('Shipping Charge') }}
                                {{ formatPrice($zoneCity->logisticZone->standard_delivery_charge) }}</div>
                        </label>
                    </div>
                </div>
                <div class="radio-right text-end">
                    <img src="{{ uploadedAsset($zoneCity->logistic->thumbnail_image) }}" alt="{{ $zoneCity->logistic->name }}"
                        class="img-fluid" style="max-width: 60px; max-height: 60px;">
                </div>
            </div>
@empty
            <div class="col-12 mt-3">
                <div class="tt-address-content">
                    <div class="alert alert-danger text-center" style="border-radius: 0;">
                        {{ localize('We are not shipping to your city now.') }}
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
