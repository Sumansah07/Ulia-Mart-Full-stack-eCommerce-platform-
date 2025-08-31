<div class="payment-accordion">
    <div class="accordion" id="accordionPayment">
        <!--COD-->
        @if (getSetting('enable_cod') == 1)
            <div class="accordion-item card mb-2">
                <div class="card-header" id="headingCOD">
                    <button class="card-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCOD" aria-expanded="true" aria-controls="collapseCOD">
                        {{ localize('Cash on delivery') }} ({{ localize('COD') }})
                    </button>
                </div>
                <div id="collapseCOD" class="accordion-collapse collapse show" aria-labelledby="headingCOD" data-bs-parent="#accordionPayment">
                    <div class="card-body">
                        <div class="checkout-radio d-flex align-items-center justify-content-between gap-3">
                            <div class="radio-left d-inline-flex align-items-center">
                                <div class="theme-radio">
                                    <input type="radio" name="payment_method" id="cod" value="cod" required checked>
                                    <span class="custom-radio"></span>
                                </div>
                                <label for="cod" class="ms-2 h6 mb-0">{{ localize('Pay with cash upon delivery') }}</label>
                            </div>
                            <div class="radio-right text-end">
                                <img src="{{ staticAsset('frontend/pg/cod.svg') }}" alt="cod" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!--wallet-->
        @if (getSetting('enable_wallet_checkout') == 1)
            <div class="accordion-item card mb-2">
                <div class="card-header" id="headingWallet">
                    <button class="card-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWallet" aria-expanded="false" aria-controls="collapseWallet">
                        {{ localize('Wallet Payment') }}
                    </button>
                </div>
                <div id="collapseWallet" class="accordion-collapse collapse" aria-labelledby="headingWallet" data-bs-parent="#accordionPayment">
                    <div class="card-body">
                        <div class="checkout-radio d-flex align-items-center justify-content-between gap-3">
                            <div class="radio-left d-inline-flex align-items-center">
                                <div class="theme-radio">
                                    <input type="radio" name="payment_method" id="wallet" value="wallet" required>
                                    <span class="custom-radio"></span>
                                </div>
                                <label for="wallet" class="ms-2 h6 mb-0">{{ localize('Pay with wallet balance') }}
                                    <small>({{ localize('Balance') }}:
                                        {{ formatPrice(auth()->user()->user_balance) }})</small></label>
                            </div>
                            <div class="radio-right text-end">
                                <img src="{{ staticAsset('frontend/pg/wallet.svg') }}" alt="wallet" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!--Other Payment Gateways-->
        @isset($activeGateways)
            @foreach ($activeGateways as $gateway)
                <div class="accordion-item card mb-2">
                    <div class="card-header" id="heading{{ $gateway->gateway }}">
                        <button class="card-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $gateway->gateway }}" aria-expanded="false" aria-controls="collapse{{ $gateway->gateway }}">
                            {{ ucfirst($gateway->gateway) }}
                        </button>
                    </div>
                    <div id="collapse{{ $gateway->gateway }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $gateway->gateway }}" data-bs-parent="#accordionPayment">
                        <div class="card-body">
                            <div class="checkout-radio d-flex align-items-center justify-content-between gap-3">
                                <div class="radio-left d-inline-flex align-items-center">
                                    <div class="theme-radio">
                                        <input type="radio" name="payment_method" id="{{ $gateway->gateway }}" value="{{ $gateway->gateway }}" required>
                                        <span class="custom-radio"></span>
                                    </div>
                                    <label for="{{ $gateway->gateway }}" class="ms-2 h6 mb-0">{{ localize('Pay with ') }} {{ ucfirst($gateway->gateway) }}</label>
                                </div>
                                <div class="radio-right text-end">
                                    <img src="{{ is_numeric($gateway->image) ? uploadedAsset($gateway->image) : asset($gateway->image) }}" alt="{{ $gateway->gateway }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>
