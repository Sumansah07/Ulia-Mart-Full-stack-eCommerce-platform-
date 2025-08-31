@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Checkout') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@push('head-styles')
<style>
    /* EMERGENCY CHECKBOX FIX - Load in HEAD for highest priority */
    input[type="checkbox"]#billingSameAsShipping,
    input[type="checkbox"]#guestBillingSameAsShipping {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        width: 18px !important;
        height: 18px !important;
        border: 2px solid #6c757d !important;
        border-radius: 3px !important;
        background-color: #ffffff !important;
        position: relative !important;
        cursor: pointer !important;
        display: inline-block !important;
        vertical-align: middle !important;
        margin-right: 8px !important;
        transition: all 0.2s ease !important;
    }

    input[type="checkbox"]#billingSameAsShipping:checked,
    input[type="checkbox"]#guestBillingSameAsShipping:checked {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    input[type="checkbox"]#billingSameAsShipping:checked::before,
    input[type="checkbox"]#guestBillingSameAsShipping:checked::before {
        content: "✓" !important;
        position: absolute !important;
        top: -3px !important;
        left: 1px !important;
        color: white !important;
        font-size: 12px !important;
        font-weight: bold !important;
        line-height: 1 !important;
    }

    input[type="checkbox"]#billingSameAsShipping:hover,
    input[type="checkbox"]#guestBillingSameAsShipping:hover {
        border-color: #28a745 !important;
    }

    /* Phone input styling for better UX */
    .phone-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='%236c757d' d='M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.94a.678.678 0 0 1-.725-.332l-.81-1.214a.678.678 0 0 1 .332-.725l1.508-.503a.678.678 0 0 0 .122-.58L8.613 5.279a.678.678 0 0 0-1.015-.063L6.564 6.25a.678.678 0 0 1-.725.332L4.625 6.08a.678.678 0 0 1-.332-.725l.503-1.508a.678.678 0 0 0-.122-.58L3.654 1.328z'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 12px center !important;
        background-size: 16px 16px !important;
        padding-right: 40px !important;
    }

    .phone-input:focus {
        border-color: #28a745 !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }

    .phone-input:invalid {
        border-color: #dc3545 !important;
    }

    /* Phone error message styling */
    .phone-error-msg {
        margin-top: 5px !important;
        animation: fadeIn 0.3s ease-in-out !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .phone-error-msg small {
        font-size: 12px !important;
        font-weight: 500 !important;
    }

    .phone-error-msg i {
        margin-right: 5px !important;
    }
</style>
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/checkout-new.css') }}">
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/checkout-border-fix.css') }}">
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/checkout-borders.css') }}">
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/checkout-spacing.css') }}">
    <link rel="stylesheet" href="{{ staticAsset('frontend/default/assets/css/order-summary-layout-fix.css') }}">
    <script src="{{ staticAsset('frontend/default/assets/js/checkout-cart-remove.js') }}"></script>
@endsection

@section('simple-breadcrumb-content')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ localize('Home') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ localize('Checkout') }}</li>
@endsection

@section('contents')
    <!--simple breadcrumb-->
    @include('frontend.default.inc.simple-breadcrumb')
    <!--simple breadcrumb-->

    <!--checkout form start-->
    <form class="checkout-form" action="{{ route('checkout.complete') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="checkout-section checkout-page" style="margin-bottom: 60px;">
            <div class="container">
                <style>
                    /* Completely remove all borders from the checkout page */
                    .checkout-page *,
                    .order-summary,
                    .order-summary *,
                    .subtotal,
                    .subtotal *,
                    .table-bottom-brd,
                    .table-bottom-brd *,
                    .order-table,
                    .order-table *,
                    .order-totals,
                    .order-totals * {
                        border: none !important;
                        outline: none !important;
                        box-shadow: none !important;
                    }

                    /* Override any inline styles with !important */
                    [style*="border"],
                    [style*="outline"],
                    [style*="box-shadow"] {
                        border: none !important;
                        outline: none !important;
                        box-shadow: none !important;
                    }

                    /* Add back subtle borders where needed */
                    .checkout-page .form-control {
                        border: 1px solid #e0e0e0 !important;
                    }

                    /* Add subtle bottom borders to table rows */
                    .checkout-page tr {
                        border-bottom: 1px solid #f0f0f0 !important;
                    }

                    /* Add border to subtotal section */
                    .order-totals {
                        border: 1px solid #e0e0e0 !important;
                        padding: 15px !important;
                        background-color: #f9f9f9 !important;
                        border-radius: 4px !important;
                    }

                    /* Add border to order summary table */
                    .table-responsive-sm.table-bottom-brd.order-table {
                        border: 1px solid #e0e0e0 !important;
                        padding: 10px !important;
                        border-radius: 4px !important;
                    }

                    /* Remove all yellow/orange colors */
                    [style*="#ffa500"],
                    [style*="#FFA500"],
                    [style*="orange"],
                    [style*="yellow"] {
                        border-color: transparent !important;
                    }

                    /* Fix for logistics section */
                    .checkout-logistics .radio-right img {
                        max-width: 60px !important;
                        max-height: 60px !important;
                    }

                    /* Reduce vertical spacing */
                    .checkout-logistics .checkout-radio {
                        padding: 10px !important;
                        margin-top: 5px !important;
                        margin-bottom: 5px !important;
                    }

                    /* Reduce gap between sections */
                    .checkout-page .block {
                        margin-bottom: 10px !important;
                    }

                    /* Reduce vertical gap between contact info and order summary */
                    .row[style="margin-bottom: 60px;"] {
                        margin-bottom: 10px !important;
                    }

                    /* Add subtle borders and shadows to blocks */
                    .checkout-page .block {
                        border: 1px solid #e0e0e0 !important;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05) !important;
                        border-radius: 5px !important;
                        padding: 15px !important;
                        background-color: #fff !important;
                    }

                    /* Add subtle borders to address blocks */
                    .tt-address-info {
                        border: 1px solid #e0e0e0 !important;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important;
                    }

                    /* Add subtle borders to logistics blocks */
                    .checkout-logistics .checkout-radio {
                        border: 1px solid #e0e0e0 !important;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important;
                    }

                    /* Add subtle borders to order summary */
                    .order-summary,
                    .order-summary .table-bottom-brd,
                    .order-summary .order-table,
                    .order-totals {
                        border: 1px solid #e0e0e0 !important;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03) !important;
                    }

                    /* Add subtle hover effect */
                    .checkout-page .block:hover,
                    .tt-address-info:hover,
                    .checkout-logistics .checkout-radio:hover {
                        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08) !important;
                    }

                    /* Fix sidebar position to align with left side components */
                    @media (min-width: 1200px) {
                        .checkout-sidebar {
                            margin-top: -40px !important;
                            position: relative;
                        }

                        /* Adjust spacing for delivery methods section */
                        .delivery-methods-wrapper {
                            margin-top: 0 !important;
                        }

                        /* Make sure the sidebar components have proper spacing */
                        .checkout-sidebar .block {
                            margin-bottom: 20px !important;
                        }
                    }
                </style>
                <div class="row g-4" style="margin-bottom: 10px;">
                    <!-- form data -->
                    <div class="col-xl-7">
                        <div class="checkout-steps">
                            @if(isLoggedIn())
                                <!-- shipping address (LOGGED IN) -->
                                <div class="block mb-3 shipping-address-block">
                                    <div class="block-content">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="title mb-3 text-uppercase">{{ localize('Shipping Address') }}</h3>
                                            <a href="javascript:void(0);" onclick="addNewAddress()" class="fw-semibold"><i class="fas fa-plus me-1"></i> {{ localize('Add Address') }}</a>
                                        </div>
                                        <div class="row g-4">
                                            @forelse ($addresses as $address)
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="tt-address-content">
                                                        <input type="radio" class="tt-custom-radio" name="shipping_address_id"
                                                            id="shipping-{{ $address->id }}" value="{{ $address->id }}"
                                                            onchange="getLogistics({{ $address->city_id }})"
                                                            @if ($address->is_default) checked @endif
                                                            data-city_id="{{ $address->city_id }}">
                                                        <label for="shipping-{{ $address->id }}"
                                                            class="tt-address-info bg-white rounded p-4 position-relative">
                                                            @include('frontend.default.inc.address', ['address' => $address])
                                                            <a href="javascript:void(0);" onclick="editAddress({{ $address->id }})"
                                                                class="tt-edit-address checkout-radio-link position-absolute">{{ localize('Edit') }}</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 mt-5">
                                                    <div class="tt-address-content">
                                                        <div class="alert alert-secondary text-center">
                                                            {{ localize('Add your address to checkout') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <!-- shipping address (LOGGED IN) -->
                                <!-- checkout-logistics -->
                                <div class="checkout-logistics available-logistics-block" style="margin-top: 40px; margin-bottom: 40px;"></div>
                                <!-- billing address (LOGGED IN) -->
                                @if (count($addresses) > 0)
                                    <div class="block mb-3 billing-address-block" style="margin-bottom: 10px !important;">
                                        <div class="block-content">
                                            <h3 class="title mb-3 text-uppercase">{{ localize('Billing Address') }}</h3>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="billing_same_as_shipping" id="billingSameAsShipping" value="1"
                                                style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; width: 18px !important; height: 18px !important; border: 2px solid #6c757d !important; border-radius: 3px !important; background-color: #ffffff !important; cursor: pointer !important; display: inline-block !important; vertical-align: middle !important; margin-right: 8px !important;"
                                                onchange="
                                                    if (this.checked) {
                                                        this.style.backgroundColor = '#28a745';
                                                        this.style.borderColor = '#28a745';
                                                    } else {
                                                        this.style.backgroundColor = '#ffffff';
                                                        this.style.borderColor = '#6c757d';
                                                    }
                                                    handleBillingSameAsShipping();
                                                ">
                                                <label class="form-check-label" for="billingSameAsShipping" style="cursor: pointer !important; font-weight: 500 !important;">
                                                    {{ localize('Same as Shipping Address') }}
                                                </label>
                                            </div>
                                            <div id="billingAddressSelection">
                                                <div class="row g-4">
                                                    @foreach ($addresses as $address)
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="tt-address-content">
                                                                <input type="radio" class="tt-custom-radio" name="billing_address_id"
                                                                    id="billing-{{ $address->id }}" value="{{ $address->id }}">
                                                                <label for="billing-{{ $address->id }}"
                                                                    class="tt-address-info bg-white rounded p-4 position-relative">
                                                                    @include('frontend.default.inc.address', ['address' => $address])
                                                                    <a href="javascript:void(0);" onclick="editAddress({{ $address->id }})"
                                                                        class="tt-edit-address checkout-radio-link position-absolute">{{ localize('Edit') }}</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- billing address (LOGGED IN) -->
                                <!-- spacer div -->
                                <div style="height: 30px;"></div>
                                <!-- personal information (LOGGED IN) -->
                                <div class="block mb-3 contact-information-block" style="margin-top: 30px !important;">
                                    <div class="block-content">
                                        <h3 class="title mb-3 text-uppercase">{{ localize('Contact Information') }}</h3>
                                        <div class="row g-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Phone') }}</label>
                                                    <input type="tel" name="phone" class="form-control phone-input"
                                                        placeholder="{{ localize('Phone Number') }}" value="{{ $user->phone }}"
                                                        pattern="[0-9+\-\s\(\)]+" title="Please enter a valid phone number (numbers only)"
                                                        oninput="validatePhoneInput(this, 'user_phone_error')"
                                                        required>
                                                    <div id="user_phone_error" class="phone-error-msg" style="display: none;">
                                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please enter numeric characters only (0-9, +, -, spaces, parentheses allowed)</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Alternative Phone') }}</label>
                                                    <input type="tel" name="alternative_phone" class="form-control phone-input"
                                                        placeholder="{{ localize('Your Alternative Phone') }}"
                                                        pattern="[0-9+\-\s\(\)]+" title="Please enter a valid phone number (numbers only)"
                                                        oninput="validatePhoneInput(this, 'user_alternative_phone_error')">
                                                    <div id="user_alternative_phone_error" class="phone-error-msg" style="display: none;">
                                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please enter numeric characters only (0-9, +, -, spaces, parentheses allowed)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- personal information (LOGGED IN) -->
                            @else
                                <!-- GUEST CHECKOUT FIELDS -->
                                <div class="block mb-3 shipping-address-block">
                                    <div class="block-content">
                                        <h3 class="title mb-3 text-uppercase">{{ localize('Shipping Address') }}</h3>
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Full Name') }}</label>
                                                    <input type="text" name="guest_shipping_name" class="form-control" placeholder="{{ localize('Full Name') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Phone Number') }}</label>
                                                    <input type="tel" name="guest_shipping_phone" class="form-control phone-input" placeholder="{{ localize('Phone Number') }}" required
                                                    pattern="[0-9+\-\s\(\)]+" title="Please enter a valid phone number (numbers only)"
                                                    oninput="validatePhoneInput(this, 'guest_shipping_phone_error')">
                                                    <div id="guest_shipping_phone_error" class="phone-error-msg" style="display: none;">
                                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please enter numeric characters only (0-9, +, -, spaces, parentheses allowed)</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Email Address') }}</label>
                                                    <input type="email" name="guest_shipping_email" class="form-control" placeholder="{{ localize('Email Address') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Address') }}</label>
                                                    <input type="text" name="guest_shipping_address" class="form-control" placeholder="{{ localize('Address') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('City') }}</label>
                                                    <input type="text" name="guest_shipping_city" class="form-control" placeholder="{{ localize('City') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- billing address (GUEST) -->
                                <div class="block mb-3 billing-address-block" style="margin-bottom: 10px !important;">
                                    <div class="block-content">
                                        <h3 class="title mb-3 text-uppercase">{{ localize('Billing Address') }}</h3>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="guest_billing_same_as_shipping" id="guestBillingSameAsShipping" value="1"
                                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; width: 18px !important; height: 18px !important; border: 2px solid #6c757d !important; border-radius: 3px !important; background-color: #ffffff !important; cursor: pointer !important; display: inline-block !important; vertical-align: middle !important; margin-right: 8px !important;"
                                            onchange="
                                                if (this.checked) {
                                                    this.style.backgroundColor = '#28a745';
                                                    this.style.borderColor = '#28a745';
                                                    var shippingName = document.querySelector('input[name=&quot;guest_shipping_name&quot;]').value;
                                                    var shippingPhone = document.querySelector('input[name=&quot;guest_shipping_phone&quot;]').value;
                                                    var shippingEmail = document.querySelector('input[name=&quot;guest_shipping_email&quot;]').value;
                                                    var shippingAddress = document.querySelector('input[name=&quot;guest_shipping_address&quot;]').value;
                                                    var shippingCity = document.querySelector('input[name=&quot;guest_shipping_city&quot;]').value;
                                                    document.querySelector('input[name=&quot;guest_billing_name&quot;]').value = shippingName;
                                                    document.querySelector('input[name=&quot;guest_billing_phone&quot;]').value = shippingPhone;
                                                    document.querySelector('input[name=&quot;guest_billing_email&quot;]').value = shippingEmail;
                                                    document.querySelector('input[name=&quot;guest_billing_address&quot;]').value = shippingAddress;
                                                    document.querySelector('input[name=&quot;guest_billing_city&quot;]').value = shippingCity;
                                                    var billingFields = document.querySelectorAll('#guestBillingAddressFields input');
                                                    billingFields.forEach(function(field) { field.readOnly = true; field.classList.add('bg-light'); });
                                                } else {
                                                    this.style.backgroundColor = '#ffffff';
                                                    this.style.borderColor = '#6c757d';
                                                    var billingFields = document.querySelectorAll('#guestBillingAddressFields input');
                                                    billingFields.forEach(function(field) { field.readOnly = false; field.classList.remove('bg-light'); field.value = ''; });
                                                }
                                            ">
                                            <label class="form-check-label" for="guestBillingSameAsShipping" style="cursor: pointer !important; font-weight: 500 !important;">
                                                {{ localize('Same as Shipping Address') }}
                                            </label>
                                        </div>
                                        <div id="guestBillingAddressFields">
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label" style="color: #198754;">{{ localize('Full Name') }}</label>
                                                        <input type="text" name="guest_billing_name" class="form-control" placeholder="{{ localize('Full Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label" style="color: #198754;">{{ localize('Phone Number') }}</label>
                                                        <input type="tel" name="guest_billing_phone" class="form-control phone-input" placeholder="{{ localize('Phone Number') }}" required
                                                        pattern="[0-9+\-\s\(\)]+" title="Please enter a valid phone number (numbers only)"
                                                        oninput="validatePhoneInput(this, 'guest_billing_phone_error')">
                                                        <div id="guest_billing_phone_error" class="phone-error-msg" style="display: none;">
                                                            <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please enter numeric characters only (0-9, +, -, spaces, parentheses allowed)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label" style="color: #198754;">{{ localize('Email Address') }}</label>
                                                        <input type="email" name="guest_billing_email" class="form-control" placeholder="{{ localize('Email Address') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label" style="color: #198754;">{{ localize('Address') }}</label>
                                                        <input type="text" name="guest_billing_address" class="form-control" placeholder="{{ localize('Address') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label" style="color: #198754;">{{ localize('City') }}</label>
                                                        <input type="text" name="guest_billing_city" class="form-control" placeholder="{{ localize('City') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- personal information (GUEST) -->
                                <!-- <div class="block mb-3 contact-information-block" style="margin-top: 30px !important display:none;"> -->
                                    <!-- <div class="block-content"> -->
                                        <!-- <h3 class="title mb-3 text-uppercase">{{ localize('Contact Information') }}</h3>
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Phone') }}</label>
                                                    <input type="tel" name="guest_contact_phone" class="form-control phone-input" placeholder="{{ localize('Phone Number') }}" required
                                                    pattern="[0-9+\-\s\(\)]+" title="Please enter a valid phone number (numbers only)"
                                                    oninput="validatePhoneInput(this, 'guest_contact_phone_error')">
                                                    <div id="guest_contact_phone_error" class="phone-error-msg" style="display: none;">
                                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please enter numeric characters only (0-9, +, -, spaces, parentheses allowed)</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label class="form-label" style="color: #198754;">{{ localize('Alternative Phone') }}</label>
                                                    <input type="tel" name="guest_contact_alternative_phone" class="form-control phone-input" placeholder="{{ localize('Your Alternative Phone') }}"
                                                    pattern="[0-9+\-\s\(\)]+" title="Please enter a valid phone number (numbers only)"
                                                    oninput="validatePhoneInput(this, 'guest_alternative_phone_error')">
                                                    <div id="guest_alternative_phone_error" class="phone-error-msg" style="display: none;">
                                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Please enter numeric characters only (0-9, +, -, spaces, parentheses allowed)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <!-- personal information (GUEST) -->
                                <!-- Hide shipping address radio and logistics for guests -->
                                <style>
                                    .checkout-logistics.available-logistics-block { display: none !important; }
                                    input[name="shipping_address_id"] { display: none !important; }
                                </style>
                            @endif
                        </div>
                    </div>
                    <!-- form data -->

                    <!-- sidebar components -->
                    <div class="col-xl-5">
                        <div class="checkout-sidebar" style="position: sticky; top: 20px;">
                            @include('frontend.default.pages.partials.checkout.sidebarComponents', [
                                'carts' => $carts,
                            ])
                        </div>
                    </div>
                    <!-- sidebar components -->
                    <!-- <div class="row g-4 mt-3 justify-content-center">
                    <div class="col-xl-7">
                        <div class="block mb-3 centered-form-width-order-summary">
                            <div class="block-content">
                                <div class="checkout-sidebar">
                                    @include('frontend.default.pages.partials.checkout.orderSummaryOnly', [
                                        'carts' => $carts,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                </div>

                <!-- Order summary centered with form sections width -->

                <!-- Order summary centered with form sections width -->
                </div>
            </div>
        </div>
    </form>
    <!--checkout form end-->

    <!-- Inline script for immediate function availability -->
    <script>
        // Phone validation function with real-time error display
        function validatePhoneInput(input, errorId) {
            var originalValue = input.value;
            var cleanValue = originalValue.replace(/[^0-9+\-\s\(\)]/g, '');
            var errorDiv = document.getElementById(errorId);

            // Update input value to clean value
            input.value = cleanValue;

            // Show/hide error message based on whether invalid characters were removed
            if (originalValue !== cleanValue && originalValue.length > 0) {
                // Invalid characters were found and removed
                errorDiv.style.display = 'block';
                input.style.borderColor = '#dc3545';

                // Hide error message after 3 seconds
                setTimeout(function() {
                    errorDiv.style.display = 'none';
                    input.style.borderColor = '';
                }, 3000);
            } else if (cleanValue.length === 0) {
                // Field is empty, hide error
                errorDiv.style.display = 'none';
                input.style.borderColor = '';
            } else {
                // Valid input, hide error
                errorDiv.style.display = 'none';
                input.style.borderColor = '#28a745';

                // Remove green border after 1 second
                setTimeout(function() {
                    input.style.borderColor = '';
                }, 1000);
            }
        }

        // Handle billing same as shipping functionality
        function handleBillingSameAsShipping() {
            var checkbox = document.getElementById('billingSameAsShipping');
            var billingSection = document.getElementById('billingAddressSelection');

            if (!checkbox || !billingSection) {
                return;
            }

            var isChecked = checkbox.checked;

            if (isChecked) {
                // Hide billing address selection
                billingSection.style.display = 'none';

                // Get selected shipping address
                var shippingRadio = document.querySelector('input[name="shipping_address_id"]:checked');
                var shippingId = shippingRadio ? shippingRadio.value : '';

                // Clear any existing billing selection
                var billingRadios = document.querySelectorAll('input[name="billing_address_id"]');
                billingRadios.forEach(function(radio) {
                    radio.checked = false;
                });

                // Create/update hidden input with shipping ID as billing ID
                var hiddenInput = document.getElementById('hiddenBillingInput');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.id = 'hiddenBillingInput';
                    hiddenInput.name = 'billing_address_id';
                    document.querySelector('form.checkout-form').appendChild(hiddenInput);
                }
                hiddenInput.value = shippingId;

                // Show confirmation message
                var message = document.getElementById('billing-same-message');
                if (!message) {
                    message = document.createElement('div');
                    message.id = 'billing-same-message';
                    message.className = 'alert alert-info mt-2';
                    message.innerHTML = '<i class="fas fa-info-circle me-2"></i>Billing address will be same as shipping address';
                    checkbox.parentNode.appendChild(message);
                }

            } else {
                // Show billing address selection
                billingSection.style.display = 'block';

                // Remove hidden input
                var hiddenInput = document.getElementById('hiddenBillingInput');
                if (hiddenInput) {
                    hiddenInput.remove();
                }

                // Remove message
                var message = document.getElementById('billing-same-message');
                if (message) {
                    message.remove();
                }
            }
        }

        // Form submission handler to ensure billing address is set
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form.checkout-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    var checkbox = document.getElementById('billingSameAsShipping');
                    if (checkbox && checkbox.checked) {
                        // Ensure hidden input exists and has correct value
                        var shippingRadio = document.querySelector('input[name="shipping_address_id"]:checked');
                        var shippingId = shippingRadio ? shippingRadio.value : '';

                        var hiddenInput = document.getElementById('hiddenBillingInput');
                        if (!hiddenInput && shippingId) {
                            hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.id = 'hiddenBillingInput';
                            hiddenInput.name = 'billing_address_id';
                            hiddenInput.value = shippingId;
                            form.appendChild(hiddenInput);
                        }
                    }
                });
            }
        });
    </script>

    <div style="height: 60px; clear: both;"></div> <!-- Extra space to prevent footer overlap -->


    <!--add address modal start-->
    @include('frontend.default.inc.addressForm', ['countries' => $countries])
    <!--add address modal end-->
@endsection

@section('scripts')
<script>


    // Toggle billing address selection for logged-in users (MOVED TO INLINE SCRIPT)

    // Simple guest billing toggle function
    function toggleGuestBillingFields() {
        var checkbox = document.getElementById('guestBillingSameAsShipping');
        var isChecked = checkbox.checked;

        if (isChecked) {
            // Copy shipping address values to billing fields
            var shippingName = document.querySelector('input[name="guest_shipping_name"]').value;
            var shippingPhone = document.querySelector('input[name="guest_shipping_phone"]').value;
            var shippingEmail = document.querySelector('input[name="guest_shipping_email"]').value;
            var shippingAddress = document.querySelector('input[name="guest_shipping_address"]').value;
            var shippingCity = document.querySelector('input[name="guest_shipping_city"]').value;

            document.querySelector('input[name="guest_billing_name"]').value = shippingName;
            document.querySelector('input[name="guest_billing_phone"]').value = shippingPhone;
            document.querySelector('input[name="guest_billing_email"]').value = shippingEmail;
            document.querySelector('input[name="guest_billing_address"]').value = shippingAddress;
            document.querySelector('input[name="guest_billing_city"]').value = shippingCity;

            // Make billing fields read-only and add visual indication
            var billingFields = document.querySelectorAll('#guestBillingAddressFields input');
            billingFields.forEach(function(field) {
                field.readOnly = true;
                field.classList.add('bg-light');
            });

            // Add a note to show that fields are auto-filled
            var existingNote = document.getElementById('billing-auto-fill-note');
            if (!existingNote) {
                var note = document.createElement('div');
                note.id = 'billing-auto-fill-note';
                note.className = 'alert alert-info alert-sm mb-3';
                note.innerHTML = '<i class="fas fa-info-circle me-2"></i>Billing address fields are automatically filled from shipping address';
                document.getElementById('guestBillingAddressFields').insertBefore(note, document.getElementById('guestBillingAddressFields').firstChild);
            }
        } else {
            // Make billing fields editable again
            var billingFields = document.querySelectorAll('#guestBillingAddressFields input');
            billingFields.forEach(function(field) {
                field.readOnly = false;
                field.classList.remove('bg-light');
            });

            // Remove the auto-fill note
            var note = document.getElementById('billing-auto-fill-note');
            if (note) {
                note.remove();
            }

            // Clear billing fields when unchecked
            document.querySelector('input[name="guest_billing_name"]').value = '';
            document.querySelector('input[name="guest_billing_phone"]').value = '';
            document.querySelector('input[name="guest_billing_email"]').value = '';
            document.querySelector('input[name="guest_billing_address"]').value = '';
            document.querySelector('input[name="guest_billing_city"]').value = '';
        }
    }

    // Fix for address modal on checkout page
    document.addEventListener('DOMContentLoaded', function() {
        // Fix page on load
        if (typeof fixPage === 'function') {
            fixPage();
        }

        // Fix sidebar position
        adjustSidebarPosition();

        // Add click handler to the "Add Address" button
        var addAddressBtn = document.querySelector('a[onclick*="addNewAddress"]');
        if (addAddressBtn) {
            addAddressBtn.addEventListener('click', function(e) {
                // Prevent default action
                e.preventDefault();
                e.stopPropagation();

                // Fix page first
                if (typeof fixPage === 'function') {
                    fixPage();
                }

                // Then call addNewAddress after a short delay
                setTimeout(function() {
                    addNewAddress();
                }, 100);
            });
        }

        // Modal events
        $(document).on('shown.bs.modal', '.modal', function() {
            // Ensure modal is on top
            $(this).css('z-index', '1050');
            $('.modal-backdrop').css('z-index', '1040');
        });

        $(document).on('hidden.bs.modal', '.modal', function() {
            // Check if there are no visible modals
            if ($('.modal.show').length === 0) {
                // Remove any stuck backdrops
                if (typeof fixPage === 'function') {
                    fixPage();
                }
            }
        });

        // Handle scheduled delivery options
        $('#scheduled-shipping').on('change', function() {
            if ($(this).is(':checked')) {
                $('#scheduled-options').slideDown();
            } else {
                $('#scheduled-options').slideUp();
            }
        });

        $('#regular-shipping, #express-shipping, #same-day-shipping').on('change', function() {
            if ($(this).is(':checked')) {
                $('#scheduled-options').slideUp();

                // Update shipping cost based on selected delivery method
                var deliveryType = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('checkout.getShippingAmount') }}",
                    type: 'POST',
                    data: {
                        shipping_delivery_type: deliveryType
                    },
                    success: function(data) {
                        // Update the order summary in the main layout
                        $('.order-summary').empty();
                        $('.order-summary').html(data);
                    }
                });
            }
        });

        // Initialize accordion for payment methods
        $('.payment-methods .accordion-item .card-link').on('click', function() {
            var target = $(this).data('bs-target');
            var radio = $(target).find('input[type="radio"]');
            setTimeout(function() {
                radio.prop('checked', true);
            }, 100);
        });

        // Handle credit card form
        $('#card_number').on('input', function() {
            // Format credit card number with spaces after every 4 digits
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, '')
                    .replace(/(.{4})/g, '$1 ')
                    .trim();
            });
        });

        $('#cvv').on('input', function() {
            // Limit to 3 digits for CVC
            $(this).val(function(index, value) {
                return value.replace(/\D/g, '').substring(0, 3);
            });
        });

        // Format expiration date as MM / YY
        $('#expiry_date').on('input', function() {
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, '')
                    .replace(/^(\d{2})(\d)/, '$1 / $2')
                    .replace(/^(\d{2}\s\/\s\d{2}).*$/, '$1');
            });
        });

        // Show tooltip when info icon is clicked
        $('.info-icon').on('click', function() {
            alert('{{ localize("The security code (CVC) is a 3-digit number on the back of your card.") }}');
        });

        // Submit credit card form
        $('#submit_card').on('click', function() {
            var cardName = $('#card_name').val();
            var cardType = $('#card_type').val();
            var cardNumber = $('#card_number').val();
            var cvv = $('#cvv').val();
            var expiryDate = $('#expiry_date').val();

            // Basic validation
            if (!cardName || !cardType || !cardNumber || !cvv || !expiryDate) {
                alert('{{ localize("Please fill in all required fields") }}');
                return false;
            }

            // Add credit card radio if it doesn't exist
            if ($('#credit_card').length === 0) {
                $('<input>').attr({
                    type: 'radio',
                    id: 'credit_card',
                    name: 'payment_method',
                    value: 'credit_card',
                    style: 'display: none;'
                }).appendTo('form.checkout-form');
            }

            // Select credit card as payment method
            $('#credit_card').prop('checked', true);

            // Store card details in hidden fields
            if ($('#card_details').length === 0) {
                $('<input>').attr({
                    type: 'hidden',
                    id: 'card_details',
                    name: 'card_details',
                    value: JSON.stringify({
                        name: cardName,
                        type: cardType,
                        number: cardNumber.replace(/\s/g, ''),
                        cvv: cvv,
                        expiry: expiryDate
                    })
                }).appendTo('form.checkout-form');
            } else {
                $('#card_details').val(JSON.stringify({
                    name: cardName,
                    type: cardType,
                    number: cardNumber.replace(/\s/g, ''),
                    cvv: cvv,
                    expiry: expiryDate
                }));
            }

            // Close the accordion
            $('#collapseCreditCard').collapse('hide');

            return true;
        });

        // Handle PayPal payment
        $('#paypal_pay_btn').on('click', function() {
            var paypalEmail = $('#paypal_email').val();

            // Basic validation
            if (!paypalEmail || !paypalEmail.includes('@')) {
                alert('{{ localize("Please enter a valid PayPal email address") }}');
                return false;
            }

            // Select PayPal as payment method
            $('#paypal').prop('checked', true);

            // Store PayPal email in hidden field
            if ($('#paypal_details').length === 0) {
                $('<input>').attr({
                    type: 'hidden',
                    id: 'paypal_details',
                    name: 'paypal_details',
                    value: paypalEmail
                }).appendTo('form.checkout-form');
            } else {
                $('#paypal_details').val(paypalEmail);
            }

            // Submit the form
            $('.checkout-form').submit();

            return true;
        });

        // Apply coupon function
        window.applyCoupon = function() {
            var couponCode = $('#coupon-code').val();
            if (couponCode) {
                $.ajax({
                    url: '{{ route('carts.applyCoupon') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        code: couponCode
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message);
                    }
                });
            } else {
                alert('{{ localize('Please enter a coupon code to apply, or continue checkout without a coupon') }}');
            }
        };

        // Clear coupon function
        window.clearCoupon = function() {
            $.ajax({
                url: '{{ route('carts.clearCoupon') }}',
                type: 'GET',
                success: function(data) {
                    location.reload();
                }
            });
        };

        // Billing address: same as shipping toggle for logged-in users
        $(document).ready(function() {
            // Initialize billing address toggle functionality
            function initializeBillingToggle() {
                var checkbox = $('#billingSameAsShipping');
                if (checkbox.length > 0) {
                    // Handle checkbox change
                    checkbox.on('change', function() {
                        toggleBillingAddressSelection();
                    });

                    // Handle shipping address changes
                    $('input[name="shipping_address_id"]').on('change', function() {
                        if (checkbox.is(':checked')) {
                            // Update the hidden billing address ID to match shipping
                            var shippingId = $(this).val();
                            var hiddenInput = $('#hiddenBillingAddressId');
                            if (hiddenInput.length > 0) {
                                hiddenInput.val(shippingId);
                            } else {
                                // Create hidden input if it doesn't exist
                                $('<input>').attr({
                                    type: 'hidden',
                                    id: 'hiddenBillingAddressId',
                                    name: 'billing_address_id',
                                    value: shippingId
                                }).appendTo('form.checkout-form');
                            }
                        }
                    });

                    // Handle billing address radio changes
                    $('#billingAddressSelection input[name="billing_address_id"]').on('change', function() {
                        // If user manually selects a billing address, uncheck the "same as shipping" checkbox
                        checkbox.prop('checked', false);
                        toggleBillingAddressSelection();
                    });
                }
            }

            // Call initialization
            initializeBillingToggle();
        });

        // Initialize guest billing toggle when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('guestBillingSameAsShipping');

            if (checkbox) {
                // Bind the checkbox change event
                checkbox.addEventListener('change', function() {
                    toggleGuestBillingFields();
                });

                // Bind shipping field changes
                var shippingFields = [
                    'guest_shipping_name',
                    'guest_shipping_phone',
                    'guest_shipping_email',
                    'guest_shipping_address',
                    'guest_shipping_city'
                ];

                shippingFields.forEach(function(fieldName) {
                    var field = document.querySelector('input[name="' + fieldName + '"]');
                    if (field) {
                        field.addEventListener('input', function() {
                            if (checkbox.checked) {
                                toggleGuestBillingFields();
                            }
                        });
                    }
                });

                // Initial state
                setTimeout(function() {
                    toggleGuestBillingFields();
                }, 500);
            }
        });

        // Function to adjust sidebar position
        function adjustSidebarPosition() {
            // Get the height of the shipping address block
            var shippingAddressHeight = $('.shipping-address-block').outerHeight() || 0;

            // Get the height of the billing address block
            var billingAddressHeight = $('.billing-address-block').outerHeight() || 0;

            // Calculate the total height of the left column components
            var leftColumnHeight = shippingAddressHeight + billingAddressHeight;

            // Get the height of the sidebar
            var sidebarHeight = $('.checkout-sidebar').outerHeight() || 0;

            // If the sidebar is shorter than the left column, adjust its position
            if (sidebarHeight < leftColumnHeight) {
                // Set the sidebar's top margin to align with the shipping address block
                $('.checkout-sidebar').css('margin-top', '0');
            }

            // Make the sidebar sticky on scroll
            $(window).on('scroll', function() {
                var scrollTop = $(window).scrollTop();
                var headerHeight = 100; // Approximate header height

                if (scrollTop > headerHeight) {
                    $('.checkout-sidebar').addClass('sticky-sidebar');
                } else {
                    $('.checkout-sidebar').removeClass('sticky-sidebar');
                }
            });
        }

        // Call the function on window resize as well
        $(window).on('resize', function() {
            adjustSidebarPosition();
        });

        // Handle collapse icon rotation for all collapsible sections
        $('#checkoutAccordion .collapse').on('show.bs.collapse', function () {
            // Rotate the current section's icon
            $(this).prev('h3').find('.fas.fa-chevron-down').css('transform', 'rotate(0deg)');

            // Make sure all other icons are rotated to collapsed state
            $('#checkoutAccordion .collapse').not(this).each(function() {
                $(this).prev('h3').find('.fas.fa-chevron-down').css('transform', 'rotate(-90deg)');
            });
        });

        $('#checkoutAccordion .collapse').on('hide.bs.collapse', function () {
            $(this).prev('h3').find('.fas.fa-chevron-down').css('transform', 'rotate(-90deg)');
        });

        // Initialize the accordion - ensure first section is open by default
        $(document).ready(function() {
            // Show the first section
            $('#collapseDeliveryMethods').collapse('show');

            // Make sure all other sections are collapsed
            $('#checkoutAccordion .collapse').not('#collapseDeliveryMethods').collapse('hide');
        });
    });
</script>

<style>
    /* Additional styles for the sticky sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 20px;
        transition: all 0.3s ease;
    }

    @media (min-width: 1200px) {
        .checkout-sidebar {
            padding-top: 0 !important;
        }
    }

    /* Styles for collapsible sections */
    .title[data-bs-toggle="collapse"] {
        position: relative;
        transition: all 0.3s ease;
    }

    .title[data-bs-toggle="collapse"]:hover {
        color: #006400;
    }

    .title[data-bs-toggle="collapse"] .fas.fa-chevron-down {
        transition: transform 0.3s ease;
    }

    /* PROTECT SEARCH BUTTON FROM RECEIPT TEXT INTERFERENCE */
    .search-btn {
        font-size: 0 !important;
    }

    .search-btn i {
        font-size: 16px !important;
    }

    /* Ensure search button never shows receipt text */
    .search-btn:not(:empty):not(:has(i)) {
        font-size: 0 !important;
    }

    /* ORDER SUMMARY WIDTH CONTROL - CENTERED WITH FORM SECTIONS WIDTH */
    .centered-form-width-order-summary {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 auto !important;
    }

    .centered-form-width-order-summary .checkout-sidebar {
        width: 100% !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Ensure order summary table doesn't overflow and matches form sections */
    .centered-form-width-order-summary .table-responsive-sm {
        overflow-x: auto !important;
        width: 100% !important;
    }

    /* Match the block styling of other sections */
    .centered-form-width-order-summary .block-content {
        padding: 15px !important;
    }

    /* Ensure order summary follows the same constraints as form sections */
    .centered-form-width-order-summary {
        margin-bottom: 20px !important;
    }

    /* Responsive adjustments for order summary */
    @media (max-width: 768px) {
        .centered-order-summary {
            margin: 0 10px !important;
        }
    }

    /* Prevent order summary from being too wide on large screens */
    @media (min-width: 1400px) {
        .col-xl-8.col-lg-10.col-md-12 {
            max-width: 800px !important;
        }
    }

    /* Styles for auto-filled billing address fields */
    .bg-light {
        background-color: #f8f9fa !important;
        border-color: #dee2e6 !important;
    }

    input[readonly].bg-light {
        cursor: not-allowed;
        opacity: 0.8;
    }

    .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }

    /* ULTRA STRONG Custom checkbox styling - Override everything */
    input[type="checkbox"].form-check-input,
    .form-check-input[type="checkbox"],
    #billingSameAsShipping,
    #guestBillingSameAsShipping {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        width: 20px !important;
        height: 20px !important;
        border: 2px solid #6c757d !important;
        border-radius: 4px !important;
        background-color: #fff !important;
        position: relative !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        vertical-align: middle !important;
        margin-right: 8px !important;
    }

    /* Checked state with custom checkmark */
    input[type="checkbox"].form-check-input:checked,
    .form-check-input[type="checkbox"]:checked,
    #billingSameAsShipping:checked,
    #guestBillingSameAsShipping:checked {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    /* Custom checkmark using ::after pseudo-element */
    input[type="checkbox"].form-check-input:checked::after,
    .form-check-input[type="checkbox"]:checked::after,
    #billingSameAsShipping:checked::after,
    #guestBillingSameAsShipping:checked::after {
        content: '✓' !important;
        position: absolute !important;
        top: -2px !important;
        left: 2px !important;
        color: white !important;
        font-size: 14px !important;
        font-weight: bold !important;
        line-height: 1 !important;
    }

    /* Hover effects */
    input[type="checkbox"].form-check-input:hover,
    .form-check-input[type="checkbox"]:hover,
    #billingSameAsShipping:hover,
    #guestBillingSameAsShipping:hover {
        border-color: #28a745 !important;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.3) !important;
    }

    /* Focus effects */
    input[type="checkbox"].form-check-input:focus,
    .form-check-input[type="checkbox"]:focus,
    #billingSameAsShipping:focus,
    #guestBillingSameAsShipping:focus {
        outline: none !important;
        border-color: #28a745 !important;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.25) !important;
    }

    /* Make the label clickable and improve spacing */
    .form-check-label {
        margin-left: 0.5rem !important;
        cursor: pointer !important;
        font-weight: 500 !important;
        color: #495057 !important;
        user-select: none !important;
    }
</style>
@endsection
