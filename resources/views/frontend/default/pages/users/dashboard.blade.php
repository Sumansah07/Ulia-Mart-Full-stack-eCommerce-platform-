@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Customer Dashboard') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="my-account pt-6 pb-120 account-page">
        <div class="container">
            <div class="d-none d-md-block">
                @include('frontend.default.inc.dashboard-breadcrumb', ['title' => localize('MY ACCOUNT')])
            </div>

            <!-- Mobile Account Tabs - Only visible on mobile -->
            <div class="d-md-none">
                @include('frontend.default.inc.mobile-account-tabs-content')
            </div>

            <!-- Desktop Dashboard - Hidden on mobile -->
            <div class="dashboard-container d-none d-md-flex">
                <!-- Dashboard sidebar -->
                <div class="dashboard-sidebar">
                    <div class="profile-section">
                        @php
                            $avatar = staticAsset('frontend/default/assets/img/authors/avatar.png');
                            $user = auth()->user();
                            if (!is_null($user->avatar)) {
                                $avatar = uploadedAsset($user->avatar);
                            }
                        @endphp
                        <div class="profile-image">
                            <img src="{{ $avatar }}" alt="user" />
                        </div>
                        <div class="profile-name">{{ $user->name }}</div>
                        <div class="profile-email">{{ $user->email }}</div>
                    </div>

                    <ul class="dashboard-nav">
                        <li>
                            <a href="{{ route('customers.dashboard') }}" class="{{ areActiveRoutes(['customers.dashboard'], 'active') }}">
                                {{ localize('Account Info') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.address') }}" class="{{ areActiveRoutes(['customers.address'], 'active') }}">
                                {{ localize('Address Book') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.orderHistory') }}" class="{{ areActiveRoutes(['customers.orderHistory'], 'active') }}">
                                {{ localize('My Orders') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.trackOrder') }}" class="{{ areActiveRoutes(['customers.trackOrder'], 'active') }}">
                                {{ localize('Orders tracking') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.profile') }}" class="{{ areActiveRoutes(['customers.profile'], 'active') }}">
                                {{ localize('Profile') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.settings') }}" class="{{ areActiveRoutes(['customers.settings'], 'active') }}">
                                {{ localize('Settings') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                {{ localize('Log Out') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Dashboard sidebar -->

                <!-- Dashboard Content -->
                <div class="dashboard-content">
                    <!-- Welcome Message -->
                    <div class="welcome-section">
                        <h2>{{ localize('Hello') }}, <span style="color: #4CAF50;">{{ $user->name }}</span></h2>
                        <p>{{ localize('From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.') }}</p>
                    </div>

                    <!-- Order Statistics -->
                    <div class="order-stats">
                        <div class="stat-box">
                            <div class="stat-icon">
                                <img src="{{ staticAsset('frontend/default/assets/img/icons/sale.png') }}" alt="icon" />
                            </div>
                            <div class="stat-content">
                                <h3 class="number">{{ $user->orders()->count() }}</h3>
                                <p class="label">{{ localize('Total Order') }}</p>
                            </div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-icon">
                                <img src="{{ staticAsset('frontend/default/assets/img/icons/homework.png') }}" alt="icon" />
                            </div>
                            <div class="stat-content">
                                <h3 class="number">{{ $user->orders()->isProcessing()->count() }}</h3>
                                <p class="label">{{ localize('Pending Orders') }}</p>
                            </div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-icon">
                                <img src="{{ staticAsset('frontend/default/assets/img/icons/order.png') }}" alt="icon" />
                            </div>
                            <div class="stat-content">
                                <h3 class="number">{{ $user->orders()->isPlacedOrPending()->count() }}</h3>
                                <p class="label">{{ localize('Awaiting Payments') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="account-section">
                        <h3>{{ localize('Account Information') }}</h3>
                        <div class="contact-info">
                            <h4>{{ localize('Contact Information') }}</h4>
                            <p><strong>{{ $user->name }}</strong></p>
                            <p>{{ $user->email }}</p>
                            <p><a href="{{ route('customers.profile') }}" class="edit-link">{{ localize('Edit') }}</a> | <a href="{{ route('customers.profile') }}" class="edit-link">{{ localize('Change Password') }}</a></p>
                        </div>
                    </div>

                    <!-- Address Book -->
                    <div class="account-section">
                        <h3>
                            {{ localize('Address Book') }}
                            <a href="{{ route('customers.address') }}" class="edit-link">{{ localize('Edit') }}</a>
                        </h3>
                        <div class="address-section">
                            @php
                                $addresses = $user->addresses()->latest()->take(2)->get();
                                $hasBilling = false;
                                $hasShipping = false;
                            @endphp

                            @if(count($addresses) > 0)
                                @foreach($addresses as $address)
                                    @if($address->address_type == 'billing')
                                        @php $hasBilling = true; @endphp
                                        <div class="address-box">
                                            <h4>{{ localize('Default Billing Address') }}</h4>
                                            <address>
                                                {{ $address->address }}, {{ $address->city->name }}, {{ $address->state->name }}, {{ $address->country->name }}
                                            </address>
                                            <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Edit Address') }}</a>
                                        </div>
                                    @endif

                                    @if($address->address_type == 'shipping')
                                        @php $hasShipping = true; @endphp
                                        <div class="address-box">
                                            <h4>{{ localize('Default Shipping Address') }}</h4>
                                            <address>
                                                {{ $address->address }}, {{ $address->city->name }}, {{ $address->state->name }}, {{ $address->country->name }}
                                            </address>
                                            <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Edit Address') }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            @if(!$hasBilling)
                                <div class="address-box">
                                    <h4>{{ localize('Default Billing Address') }}</h4>
                                    <address>{{ localize('You have not set a default billing address.') }}</address>
                                    <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Add Address') }}</a>
                                </div>
                            @endif

                            @if(!$hasShipping)
                                <div class="address-box">
                                    <h4>{{ localize('Default Shipping Address') }}</h4>
                                    <address>{{ localize('You have not set a default shipping address.') }}</address>
                                    <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Add Address') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End Dashboard Content -->
            </div>
            <!-- End Desktop Dashboard -->
        </div>
    </section>

    <!--address modal start-->
    @include('frontend.default.inc.addressForm', ['countries' => \App\Models\Country::isActive()->get()])
    <!--address modal end-->

    <!-- Profile Edit Modal -->
    @include('frontend.default.pages.users.partials.profileEditModal')

    <!-- Password Edit Modal -->
    @include('frontend.default.pages.users.partials.passwordEditModal')
@endsection
