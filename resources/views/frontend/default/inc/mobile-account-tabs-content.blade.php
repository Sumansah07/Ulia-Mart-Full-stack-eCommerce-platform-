<!-- Mobile Account Tabs Component with Content - Only visible on mobile devices -->
@php
    $user = auth()->user();
    $avatar = staticAsset('frontend/default/assets/img/authors/avatar.png');
    if (!is_null($user->avatar)) {
        $avatar = uploadedAsset($user->avatar);
    }
@endphp

<!-- Mobile Breadcrumb -->
<div class="mobile-account-breadcrumb">
    <div class="breadcrumb-title">{{ localize('MY ACCOUNT') }}</div>
    <div class="breadcrumb-links">
        <a href="{{ route('home') }}">{{ localize('Home') }}</a>
        <span class="breadcrumb-separator">></span>
        <span class="current-page">{{ localize('My Account') }}</span>
    </div>
</div>

<div class="mobile-account-container">
    <!-- Profile Header -->
    <div class="mobile-account-profile">
        <div class="mobile-account-image">
            <img src="{{ $avatar }}" alt="{{ $user->name }}" />
        </div>
        <div class="mobile-account-name">{{ $user->name }}</div>
        <div class="mobile-account-email">{{ $user->email }}</div>
    </div>

    <!-- Tab Navigation - Single Row Scrollable -->
    <div class="nav mobile-account-tabs single-row" id="mobileAccountTabs" role="tablist">
        <a class="nav-link active"
           id="account-info-tab"
           data-tab="account-info-content"
           role="tab">
            {{ localize('Account Info') }}
        </a>
        <a class="nav-link"
           id="address-book-tab"
           data-tab="address-book-content"
           role="tab">
            {{ localize('Address Book') }}
        </a>
        <a class="nav-link"
           id="my-orders-tab"
           data-tab="my-orders-content"
           role="tab">
            {{ localize('My Orders') }}
        </a>
        <a class="nav-link"
           id="orders-tracker-tab"
           data-tab="orders-tracker-content"
           role="tab"
           href="javascript:void(0);"
           onclick="activateOrdersTrackerTab()">
            {{ localize('Orders tracking') }}
        </a>
        <a class="nav-link"
           id="profile-tab"
           data-tab="profile-content"
           role="tab">
            {{ localize('Profile') }}
        </a>
        <a class="nav-link"
           id="settings-tab"
           data-tab="settings-content"
           role="tab">
            {{ localize('Settings') }}
        </a>
    </div>

    <!-- Tab Content -->
    <div class="mobile-tab-content-container">
        <!-- Account Info Tab Content -->
        <div class="mobile-tab-content active" id="account-info-content">
            <div class="welcome-section p-3">
                <h2>{{ localize('Hello') }}, <span class="text-success">{{ $user->name }}</span></h2>
                <div class="welcome-dot"></div>
                <p>{{ localize('From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.') }}</p>
            </div>

            <!-- Order Statistics -->
            <div class="mobile-order-stats p-3">
                <div class="row g-3">
                    <div class="col-4">
                        <div class="mobile-stat-box">
                            <div class="stat-icon">
                                <img src="{{ staticAsset('frontend/default/assets/img/icons/sale.png') }}" alt="icon" />
                            </div>
                            <div class="stat-content">
                                <h3 class="number">{{ $user->orders()->count() }}</h3>
                                <p class="label">{{ localize('Total Order') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mobile-stat-box">
                            <div class="stat-icon">
                                <img src="{{ staticAsset('frontend/default/assets/img/icons/homework.png') }}" alt="icon" />
                            </div>
                            <div class="stat-content">
                                <h3 class="number">{{ $user->orders()->isProcessing()->count() }}</h3>
                                <p class="label">{{ localize('Pending Orders') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mobile-stat-box">
                            <div class="stat-icon">
                                <img src="{{ staticAsset('frontend/default/assets/img/icons/order.png') }}" alt="icon" />
                            </div>
                            <div class="stat-content">
                                <h3 class="number">{{ $user->orders()->isPlacedOrPending()->count() }}</h3>
                                <p class="label">{{ localize('Awaiting Payments') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="mobile-account-section p-3 mt-2">
                <h3>{{ localize('Account Information') }}</h3>
                <div class="mobile-contact-info">
                    <h4>{{ localize('Contact Information') }}</h4>
                    <p><strong>{{ $user->name }}</strong></p>
                    <p>{{ $user->email }}</p>
                    <p>
                        <a href="{{ route('customers.profile') }}" class="edit-link">{{ localize('Edit') }}</a> |
                        <a href="{{ route('customers.profile') }}" class="edit-link">{{ localize('Change Password') }}</a>
                    </p>
                </div>
            </div>

            <!-- Address Book -->
            <div class="mobile-account-section p-3">
                <h3>
                    {{ localize('Address Book') }}
                    <a href="{{ route('customers.address') }}" class="edit-link">{{ localize('Edit') }}</a>
                </h3>
                <div class="mobile-address-section">
                    @php
                        $addresses = $user->addresses()->latest()->take(2)->get();
                        $hasBilling = false;
                        $hasShipping = false;
                    @endphp

                    @if(count($addresses) > 0)
                        @foreach($addresses as $address)
                            @if($address->address_type == 'billing')
                                @php $hasBilling = true; @endphp
                                <div class="mobile-address-box mb-3">
                                    <h4>{{ localize('Default Billing Address') }}</h4>
                                    <address>
                                        {{ $address->address }}, {{ $address->city->name }}, {{ $address->state->name }}, {{ $address->country->name }}
                                    </address>
                                    <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Edit Address') }}</a>
                                </div>
                            @endif

                            @if($address->address_type == 'shipping')
                                @php $hasShipping = true; @endphp
                                <div class="mobile-address-box mb-3">
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
                        <div class="mobile-address-box mb-3">
                            <h4>{{ localize('Default Billing Address') }}</h4>
                            <address>{{ localize('You have not set a default billing address.') }}</address>
                            <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Add Address') }}</a>
                        </div>
                    @endif

                    @if(!$hasShipping)
                        <div class="mobile-address-box mb-3">
                            <h4>{{ localize('Default Shipping Address') }}</h4>
                            <address>{{ localize('You have not set a default shipping address.') }}</address>
                            <a href="{{ route('customers.address') }}" class="edit-address">{{ localize('Add Address') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Address Book Tab Content -->
        <div class="mobile-tab-content" id="address-book-content">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">{{ localize('Address Book') }}</h3>
                    <button class="btn btn-sm btn-success" onclick="addNewAddress()">{{ localize('Add New Address') }}</button>
                </div>

                <div class="address-list">
                    @php
                        $addresses = $user->addresses()->latest()->get();
                    @endphp
                    @if(count($addresses) > 0)
                        <div class="row g-3">
                            @foreach($addresses as $address)
                                <div class="col-12">
                                    <div class="card address-card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $address->address_name }}</h5>
                                            <p class="card-text">{{ $address->address }}</p>
                                            <p class="card-text">
                                                {{ $address->city ? $address->city->name . ', ' : '' }}
                                                {{ $address->state ? $address->state->name . ', ' : '' }}
                                                {{ $address->country ? $address->country->name : '' }}
                                            </p>
                                            <p class="card-text">{{ $address->phone }}</p>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-sm btn-outline-primary me-2" onclick="editAddress({{ $address->id }})">{{ localize('Edit') }}</button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteAddress(this)" data-url="{{ route('address.delete', $address->id) }}">{{ localize('Delete') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p>{{ localize('No addresses found.') }}</p>
                            <button class="btn btn-sm btn-success" onclick="addNewAddress()">{{ localize('Add New Address') }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- My Orders Tab Content -->
        <div class="mobile-tab-content" id="my-orders-content">
            <div class="p-3">
                <h3 class="mb-3">{{ localize('My Orders') }}</h3>

                <div class="orders-table-container">
                    <table class="table orders-table">
                        <thead>
                            <tr>
                                <th class="text-center col-sn">#</th>
                                <th class="text-left col-order-id">{{ localize('ORDER ID') }}</th>
                                <th class="text-left col-product">{{ localize('PRODUCT DETAILS') }}</th>
                                <th class="text-right col-price">{{ localize('PRICE') }}</th>
                                <th class="text-left col-status">{{ localize('STATUS') }}</th>
                                <th class="text-center col-action">{{ localize('VIEW') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $orders = auth()->user()->orders()->latest()->paginate(10);
                            @endphp
                            @forelse ($orders as $key => $order)
                                @php
                                    $orderItem = $order->orderItems()->first();
                                    $productImage = staticAsset('frontend/default/assets/img/placeholder.png');
                                    $productName = localize('Product');

                                    if ($orderItem && $orderItem->product_variation && $orderItem->product_variation->product) {
                                        $product = $orderItem->product_variation->product;
                                        $productImage = uploadedAsset($product->thumbnail_image) ?: staticAsset('frontend/default/assets/img/placeholder.png');
                                        $productName = $product->collectLocalization('name') ?: localize('Product');
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center col-sn">
                                        {{ $key + 1 }}
                                    </td>
                                    <td class="product-image col-order-id">
                                        <img src="{{ $productImage }}" alt="product" />
                                        #{{ $order->orderGroup->order_code }}
                                    </td>
                                    <td class="product-name col-product">
                                        {{ $productName }}
                                    </td>
                                    <td class="price col-price">
                                        {{ formatPrice($order->orderGroup->grand_total_amount) }}
                                    </td>
                                    <td class="status col-status">
                                        <span class="order-status">{{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}</span>
                                    </td>
                                    <td class="view-order text-center col-action">
                                        <a href="{{ route('checkout.invoice', $order->orderGroup->order_code) }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">{{ localize('No orders found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container mt-4">
                    {{ $orders->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

        <!-- Orders Tracker Tab Content -->
        <div class="mobile-tab-content" id="orders-tracker-content">
            <div class="mobile-tracking-container">
                <h4 class="mobile-tracking-title">{{ localize('Orders tracking') }}</h4>

                <p class="mobile-tracking-instructions">
                    {{ localize('To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.') }}
                </p>

                <form id="mobileOrderTrackingForm" class="mobile-tracking-form">
                    <div class="form-group mb-2">
                        <div class="input-group">
                            @if (getSetting('order_code_prefix') != null)
                                <span class="input-group-text border border-medium-dark-grey rounded-start bg-white py-2 px-3" style="height: 45px;">
                                    {{ getSetting('order_code_prefix') }}
                                </span>
                            @endif
                            <input type="text" class="form-control border border-medium-dark-grey rounded-end" id="mobile_order_code" name="code" placeholder="{{ localize('Order ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" id="mobile_billing_email" name="email" placeholder="{{ localize('Billing email') }}" value="{{ auth()->user()->email ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-success w-100 track-btn">{{ localize('TRACK') }}</button>
                </form>

                <!-- Order tracking results will be displayed here -->
                <div id="mobileOrderTrackingResults" style="display: none;">
                    <!-- Loading indicator -->
                    <div id="mobileTrackingLoading" class="text-center py-3">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <!-- Results content -->
                    <div id="mobileTrackingContent"></div>
                </div>
            </div>
        </div>

        <!-- Profile Tab Content -->
        <div class="mobile-tab-content" id="profile-content">
            <!-- Profile Section -->
            <div class="mobile-profile-section p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">{{ localize('Profile') }}</h3>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#profileEditModal">
                        <i class="fas fa-pencil-alt"></i> {{ localize('Edit') }}
                    </button>
                </div>

                <div class="mobile-profile-info">
                    @php
                        $defaultAddress = $user->addresses()->where('is_default', 1)->first();
                    @endphp

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Name') }}</div>
                        <div class="mobile-profile-value">{{ $user->name }}</div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Email address') }}</div>
                        <div class="mobile-profile-value">{{ $user->email }}</div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Phone number') }}</div>
                        <div class="mobile-profile-value">{{ $user->phone ?: localize('Not provided') }}</div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('City') }}</div>
                        <div class="mobile-profile-value">
                            @if(isset($defaultAddress) && isset($defaultAddress->city))
                                {{ $defaultAddress->city->name }}
                            @else
                                {{ localize('No city found') }}
                                <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add City') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('State') }}</div>
                        <div class="mobile-profile-value">
                            @if(isset($defaultAddress) && isset($defaultAddress->state))
                                {{ $defaultAddress->state->name }}
                            @else
                                {{ localize('No state found') }}
                                <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add State') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Country') }}</div>
                        <div class="mobile-profile-value">
                            @if(isset($defaultAddress) && isset($defaultAddress->country))
                                {{ $defaultAddress->country->name }}
                            @else
                                {{ localize('No country found') }}
                                <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add Country') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Street address') }}</div>
                        <div class="mobile-profile-value">
                            @if(isset($defaultAddress))
                                {{ $defaultAddress->address }}
                            @else
                                {{ localize('No address found') }}
                                <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add Address') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Zip code') }}</div>
                        <div class="mobile-profile-value">{{ $user->postal_code ?: localize('Not provided') }}</div>
                    </div>
                </div>
            </div>

            <!-- Login Details Section -->
            <div class="mobile-profile-section p-3 mt-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">{{ localize('Login details') }}</h3>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#passwordEditModal">
                        <i class="fas fa-pencil-alt"></i> {{ localize('Edit') }}
                    </button>
                </div>

                <div class="mobile-profile-info">
                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Email address') }}</div>
                        <div class="mobile-profile-value">{{ $user->email }}</div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Phone number') }}</div>
                        <div class="mobile-profile-value">{{ $user->phone ?: '(+40) 123 456 7890' }}</div>
                    </div>

                    <div class="mobile-profile-row">
                        <div class="mobile-profile-label">{{ localize('Password') }}</div>
                        <div class="mobile-profile-value">xxxxxx</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Tab Content -->
        <div class="mobile-tab-content" id="settings-content">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">{{ localize('Settings') }}</h3>
                </div>

                <!-- Notifications Section -->
                <div class="mobile-settings-section mb-4">
                    <h4 class="mb-3">{{ localize('Notifications') }}</h4>
                    <div class="mobile-settings-options">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="mobileAllowDesktopNotifications" checked>
                            <label class="form-check-label" for="mobileAllowDesktopNotifications">
                                {{ localize('Allow Desktop Notifications') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="mobileEnableNotifications">
                            <label class="form-check-label" for="mobileEnableNotifications">
                                {{ localize('Enable Notifications') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="mobileGetOwnActivity">
                            <label class="form-check-label" for="mobileGetOwnActivity">
                                {{ localize('Get notification for my own activity') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="mobileReceiveOffers">
                            <label class="form-check-label" for="mobileReceiveOffers">
                                {{ localize('Receive offers from our partners') }}
                            </label>
                        </div>
                    </div>
                </div>



                <!-- Deactivate Account Section -->
                <div class="mobile-settings-section mb-4">
                    <h4 class="mb-3">{{ localize('Deactivate account') }}</h4>
                    <div class="mobile-settings-options">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobileDeactivateReason" id="mobilePrivacyConcern" checked>
                            <label class="form-check-label" for="mobilePrivacyConcern">
                                {{ localize('I have a privacy concern') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobileDeactivateReason" id="mobileTemporary">
                            <label class="form-check-label" for="mobileTemporary">
                                {{ localize('This is temporary') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobileDeactivateReason" id="mobileDeactivateOther">
                            <label class="form-check-label" for="mobileDeactivateOther">
                                {{ localize('Other') }}
                            </label>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-sm btn-success" id="mobileDeactivateAccountBtn">
                                {{ localize('DEACTIVATE ACCOUNT') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Delete Account Section -->
                <div class="mobile-settings-section">
                    <h4 class="mb-3">{{ localize('Delete account') }}</h4>
                    <div class="mobile-settings-options">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobileDeleteReason" id="mobileNoLongerUsable" checked>
                            <label class="form-check-label" for="mobileNoLongerUsable">
                                {{ localize('No longer usable') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobileDeleteReason" id="mobileSwitchAccount">
                            <label class="form-check-label" for="mobileSwitchAccount">
                                {{ localize('Want to switch on other account') }}
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobileDeleteReason" id="mobileDeleteOther">
                            <label class="form-check-label" for="mobileDeleteOther">
                                {{ localize('Other') }}
                            </label>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-sm btn-success" id="mobileDeleteAccountBtn">
                                {{ localize('DELETE ACCOUNT') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav d-md-none">
    <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>{{ localize('Home') }}</span>
    </a>
    <a href="{{ route('products.index') }}" class="{{ Route::is('products.index') ? 'active' : '' }}">
        <i class="fas fa-store"></i>
        <span>{{ localize('Shop') }}</span>
    </a>
    <a href="{{ route('carts.index') }}" class="{{ Route::is('carts.index') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i>
        <span>{{ localize('Cart') }}</span>
    </a>
    <a href="javascript:void(0);" onclick="redirectToTrackOrderFromMobileBottomNav()" class="{{ Route::is('customers.trackOrder') || (Route::is('customers.dashboard') && request()->get('tab') == 'orders-tracker') ? 'active' : '' }}">
        <i class="fas fa-shipping-fast"></i>
        <span>{{ localize('Track') }}</span>
    </a>
    <a href="{{ route('customers.dashboard') }}" class="{{ Route::is('customers.*') && !Route::is('customers.trackOrder') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        <span>{{ localize('Account') }}</span>
    </a>
</div>

<!-- Mobile Order Tracking Styles -->
<style>
    /* Mobile Order Tracking Styles */
    .mobile-tracking-container {
        background-color: #f0f3f8;
        padding: 15px;
    }

    .mobile-tracking-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .mobile-tracking-instructions {
        font-size: 14px;
        color: #333;
        margin-bottom: 20px;
    }

    .mobile-tracking-form .form-control {
        border: 1px solid #6c757d;
        border-radius: 4px;
        padding: 10px 15px;
        height: 45px;
        margin-bottom: 10px;
    }

    .track-btn {
        background-color: #28a745;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px;
        border-radius: 4px;
    }

    /* Order Tracking Results Styles */
    #mobileOrderTrackingResults {
        margin-top: 20px;
    }

    .mobile-order-tracking-result {
        background-color: #f0f3f8;
    }

    .order-status-section {
        margin-bottom: 15px;
    }

    .order-status-section .status-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 0;
    }

    .product-image-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .product-image-section img {
        max-width: 200px;
        max-height: 200px;
        object-fit: contain;
    }

    .order-details-section {
        margin-bottom: 20px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-label {
        font-weight: 600;
        color: #333;
        width: 40%;
    }

    .detail-value {
        color: #555;
        width: 60%;
        text-align: right;
    }

    .map-section {
        margin-bottom: 20px;
    }

    .view-map-btn {
        background-color: #f8f9fa;
        padding: 8px 15px;
        border-radius: 4px;
        text-align: right;
        margin-bottom: 10px;
    }

    .view-map-btn span {
        color: #28a745;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
    }

    .map-container {
        border-radius: 8px;
        overflow: hidden;
    }

    .tracking-steps-section {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .tracking-step {
        position: relative;
        width: 25%;
        text-align: center;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f0f0f0;
        color: #777;
        font-size: 12px;
        font-weight: 600;
        clip-path: polygon(85% 0%, 100% 50%, 85% 100%, 0% 100%, 15% 50%, 0% 0%);
        margin-right: -10px;
        z-index: 1;
    }

    .tracking-step:first-child {
        clip-path: polygon(85% 0%, 100% 50%, 85% 100%, 0% 100%, 0% 0%);
    }

    .tracking-step:last-child {
        clip-path: polygon(100% 0%, 100% 100%, 0% 100%, 15% 50%, 0% 0%);
        margin-right: 0;
    }

    .tracking-step.done-step {
        background-color: #28a745;
        color: white;
        z-index: 2;
    }

    .tracking-step.current-step {
        background-color: #e9546b;
        color: white;
        z-index: 3;
    }

    .order-updates-section {
        margin-bottom: 20px;
    }

    .updates-table {
        width: 100%;
        border-collapse: collapse;
    }

    .updates-table th {
        background-color: #f8f9fa;
        padding: 10px;
        font-size: 12px;
        font-weight: 600;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .updates-table td {
        padding: 10px;
        font-size: 12px;
        border-bottom: 1px solid #eee;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .tracking-step span {
            font-size: 10px;
        }

        .updates-table th, .updates-table td {
            padding: 8px 5px;
            font-size: 11px;
        }
    }
</style>

<!-- Tab Switching JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.mobile-account-tabs .nav-link');
        const tabContents = document.querySelectorAll('.mobile-tab-content');
        const tabsContainer = document.querySelector('.mobile-account-tabs.single-row');

        // Fix modal issues for mobile
        fixMobileModalIssues();

        // First, remove all active classes to ensure clean state
        tabLinks.forEach(tab => tab.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));

        // Check for hash navigation first
        const hash = window.location.hash;
        let activeTabId = 'account-info-tab'; // Default tab

        console.log('Current hash:', hash); // Debug log

        if (hash.startsWith('#orders-tracker')) {
            activeTabId = 'orders-tracker-tab';
            console.log('Setting active tab to orders-tracker-tab'); // Debug log

            // Check for URL parameters to pre-fill form
            const urlParams = new URLSearchParams(hash.split('?')[1] || '');
            const orderCode = urlParams.get('code');
            const email = urlParams.get('email');

            // Pre-fill form fields if parameters exist
            setTimeout(() => {
                if (orderCode) {
                    const orderCodeInput = document.getElementById('mobile_order_code');
                    if (orderCodeInput) {
                        orderCodeInput.value = orderCode;
                        console.log('Pre-filled order code:', orderCode);
                    }
                }

                if (email) {
                    const emailInput = document.getElementById('mobile_billing_email');
                    if (emailInput) {
                        emailInput.value = email;
                        console.log('Pre-filled email:', email);
                    }
                }
            }, 100);

            // Since orders-tracker-tab now redirects, we need to show the content manually
            // and handle the tab activation properly
            setTimeout(() => {
                // Remove active from all tabs and contents first
                tabLinks.forEach(tab => tab.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Activate orders tracker tab and content
                const ordersTab = document.getElementById('orders-tracker-tab');
                const ordersContent = document.getElementById('orders-tracker-content');

                if (ordersTab && ordersContent) {
                    ordersTab.classList.add('active');
                    ordersContent.classList.add('active');
                    scrollTabIntoView(ordersTab, tabsContainer);
                    console.log('Activated orders tracker tab via hash'); // Debug log
                }

                // Check if there are URL parameters for order tracking
                const urlParams = new URLSearchParams(window.location.search);
                const orderCode = urlParams.get('code');
                const email = urlParams.get('email');

                if (orderCode) {
                    // Pre-fill the form and auto-submit if we have parameters
                    const mobileOrderCodeInput = document.getElementById('mobile_order_code');
                    const mobileEmailInput = document.getElementById('mobile_billing_email');
                    const mobileTrackingForm = document.getElementById('mobileOrderTrackingForm');

                    if (mobileOrderCodeInput && mobileEmailInput && mobileTrackingForm) {
                        mobileOrderCodeInput.value = orderCode;
                        if (email) {
                            mobileEmailInput.value = decodeURIComponent(email);
                        }

                        // Auto-submit the form
                        mobileTrackingForm.dispatchEvent(new Event('submit'));
                    }
                }
            }, 100);
        } else {
            // Set active tab based on current route
            const currentRoute = '{{ Route::currentRouteName() }}';

            if (currentRoute === 'customers.address') {
                activeTabId = 'address-book-tab';
            } else if (currentRoute === 'customers.orderHistory') {
                activeTabId = 'my-orders-tab';
            } else if (currentRoute === 'customers.trackOrder') {
                activeTabId = 'orders-tracker-tab';
            } else if (currentRoute === 'customers.profile') {
                activeTabId = 'profile-tab';
            } else if (currentRoute === 'customers.settings') {
                activeTabId = 'settings-tab';
            }
        }

        // Set active tab (only if not orders-tracker which is handled above)
        if (activeTabId !== 'orders-tracker-tab') {
            const activeTab = document.getElementById(activeTabId);
            if (activeTab) {
                activeTab.classList.add('active');

                // Scroll active tab into view with a slight offset
                setTimeout(() => {
                    scrollTabIntoView(activeTab, tabsContainer);
                }, 100);
            }

            // Show corresponding content
            const activeContentId = activeTab?.getAttribute('data-tab');
            const activeContent = document.getElementById(activeContentId);
            if (activeContent) {
                activeContent.classList.add('active');
            }
        }

        // Add click event listeners
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Skip tab switching for orders-tracker-tab as it has its own onclick handler
                if (this.id === 'orders-tracker-tab') {
                    return; // Let the onclick handler handle the tab activation
                }

                e.preventDefault();

                // Remove active class from all tabs
                tabLinks.forEach(tab => tab.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Scroll the tab into view
                scrollTabIntoView(this, tabsContainer);

                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                const targetContent = document.getElementById(tabId);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });

        // Add touch scrolling to tabs container
        addTouchScrolling(tabsContainer);

        // Initialize mobile orders table
        initMobileOrdersTable();

        // Listen for hash changes
        window.addEventListener('hashchange', function() {
            const newHash = window.location.hash;
            console.log('Hash changed to:', newHash); // Debug log

            if (newHash.startsWith('#orders-tracker')) {
                // Remove active from all tabs and contents
                tabLinks.forEach(tab => tab.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Check for URL parameters to pre-fill form
                const urlParams = new URLSearchParams(newHash.split('?')[1] || '');
                const orderCode = urlParams.get('code');
                const email = urlParams.get('email');

                // Pre-fill form fields if parameters exist
                setTimeout(() => {
                    if (orderCode) {
                        const orderCodeInput = document.getElementById('mobile_order_code');
                        if (orderCodeInput) {
                            orderCodeInput.value = orderCode;
                        }
                    }

                    if (email) {
                        const emailInput = document.getElementById('mobile_billing_email');
                        if (emailInput) {
                            emailInput.value = email;
                        }
                    }
                }, 100);

                // Activate orders tracker tab
                const ordersTab = document.getElementById('orders-tracker-tab');
                const ordersContent = document.getElementById('orders-tracker-content');

                if (ordersTab && ordersContent) {
                    ordersTab.classList.add('active');
                    ordersContent.classList.add('active');
                    scrollTabIntoView(ordersTab, tabsContainer);
                    console.log('Activated orders tracker tab via hash change'); // Debug log
                }
            }
        });
    });

    // Function to handle redirect from mobile bottom navigation
    function redirectToTrackOrderFromMobileBottomNav() {
        // Check if user is authenticated
        @auth
            // Redirect to customer dashboard with orders-tracker hash
            window.location.href = '{{ route("customers.dashboard") }}#orders-tracker';
        @else
            // Redirect to login page
            window.location.href = '{{ route("login") }}';
        @endauth
    }

    // Function to activate orders tracker tab
    function activateOrdersTrackerTab() {
        const tabLinks = document.querySelectorAll('.mobile-account-tabs .nav-link');
        const tabContents = document.querySelectorAll('.mobile-tab-content');
        const tabsContainer = document.querySelector('.mobile-account-tabs.single-row');

        // Remove active from all tabs and contents
        tabLinks.forEach(tab => tab.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));

        // Activate orders tracker tab and content
        const ordersTab = document.getElementById('orders-tracker-tab');
        const ordersContent = document.getElementById('orders-tracker-content');

        if (ordersTab && ordersContent) {
            ordersTab.classList.add('active');
            ordersContent.classList.add('active');

            // Scroll the tab into view
            if (tabsContainer) {
                scrollTabIntoView(ordersTab, tabsContainer);
            }

            console.log('Activated orders tracker tab via click'); // Debug log
        }
    }

    // Scroll tab into view with a nice centered position
    function scrollTabIntoView(tab, container) {
        if (!tab || !container) return;

        // Calculate the center position
        const tabRect = tab.getBoundingClientRect();
        const containerRect = container.getBoundingClientRect();

        // Calculate the scroll position to center the tab
        const centerPosition = tab.offsetLeft - (containerRect.width / 2) + (tabRect.width / 2);

        // Smooth scroll to the position
        container.scrollTo({
            left: centerPosition,
            behavior: 'smooth'
        });
    }

    // Initialize mobile orders table
    function initMobileOrdersTable() {
        const tableContainers = document.querySelectorAll('.orders-table-container');

        if (tableContainers.length === 0) return;

        tableContainers.forEach(container => {
            // Make sure the table is properly sized
            const table = container.querySelector('table');
            if (table) {
                // Ensure the table has the right classes
                table.classList.add('orders-table');

                // Add touch events for better mobile scrolling
                addTouchScrolling(container);
            }
        });
    }

    // Add touch scrolling to container
    function addTouchScrolling(element) {
        if (!element) return;

        let startX, scrollLeft;

        element.addEventListener('touchstart', function(e) {
            startX = e.touches[0].pageX - element.offsetLeft;
            scrollLeft = element.scrollLeft;
        }, { passive: true });

        element.addEventListener('touchmove', function(e) {
            if (!startX) return;

            const x = e.touches[0].pageX - element.offsetLeft;
            const walk = (x - startX) * 1.5; // Scroll speed multiplier
            element.scrollLeft = scrollLeft - walk;
        }, { passive: true });

        element.addEventListener('touchend', function() {
            startX = null;
        }, { passive: true });
    }

    // Handle mobile order tracking form submission
    document.addEventListener('DOMContentLoaded', function() {
        const mobileOrderTrackingForm = document.getElementById('mobileOrderTrackingForm');
        if (mobileOrderTrackingForm) {
            mobileOrderTrackingForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show loading indicator
                const resultsContainer = document.getElementById('mobileOrderTrackingResults');
                const loadingIndicator = document.getElementById('mobileTrackingLoading');
                const contentContainer = document.getElementById('mobileTrackingContent');

                resultsContainer.style.display = 'block';
                loadingIndicator.style.display = 'block';
                contentContainer.innerHTML = '';

                // Get form data
                const orderCode = document.getElementById('mobile_order_code').value;
                const email = document.getElementById('mobile_billing_email').value;

                // Update URL with query parameters to preserve tracking URL
                const trackingUrl = `{{ route('customers.trackOrder') }}?code=${orderCode}&email=${encodeURIComponent(email)}`;

                // Update browser URL without page reload
                window.history.pushState({}, '', trackingUrl);

                // Make AJAX request to track order
                fetch(trackingUrl)
                    .then(response => response.text())
                    .then(html => {
                        // Extract the order tracking details from the response
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const trackingDetails = doc.querySelector('.order-tracking-details');

                        // Hide loading indicator
                        loadingIndicator.style.display = 'none';

                        if (trackingDetails) {
                            // Format and display the tracking details
                            const formattedHTML = formatTrackingDetailsForMobile(trackingDetails);
                            contentContainer.innerHTML = formattedHTML;
                        } else {
                            // No order found
                            contentContainer.innerHTML = `
                                <div class="alert alert-danger">
                                    <p class="mb-0">{{ localize('No order found with this code. Please check and try again.') }}</p>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        // Hide loading indicator and show error
                        loadingIndicator.style.display = 'none';
                        contentContainer.innerHTML = `
                            <div class="alert alert-danger">
                                <p class="mb-0">{{ localize('An error occurred while tracking your order. Please try again.') }}</p>
                            </div>
                        `;
                        console.error('Error tracking order:', error);
                    });
            });
        }
    });

    // Format tracking details for mobile display
    function formatTrackingDetailsForMobile(trackingDetails) {
        // Get order code and product info
        const statusTitle = trackingDetails.querySelector('.status-title');
        const orderCode = statusTitle ? statusTitle.textContent.split(':')[1].trim() : '';

        const productImg = trackingDetails.querySelector('.product-img img');
        const orderName = trackingDetails.querySelector('.tracking-detail li:nth-child(1) .right span');
        const customerNumber = trackingDetails.querySelector('.tracking-detail li:nth-child(2) .right span');
        const orderDate = trackingDetails.querySelector('.tracking-detail li:nth-child(3) .right span');
        const shipDate = trackingDetails.querySelector('.tracking-detail li:nth-child(4) .right span');
        const shippingAddress = trackingDetails.querySelector('.tracking-detail li:nth-child(5) .right span');
        const carrier = trackingDetails.querySelector('.tracking-detail li:nth-child(6) .right span');
        const trackingNumber = trackingDetails.querySelector('.tracking-detail li:nth-child(7) .right span');

        // Get tracking steps
        const trackingSteps = trackingDetails.querySelector('.tracking-steps');
        const steps = trackingSteps ? trackingSteps.querySelectorAll('.step') : [];

        // Get order updates
        const orderTable = trackingDetails.querySelector('.order-table');
        const tableRows = orderTable ? orderTable.querySelectorAll('tbody tr') : [];

        // Build the HTML for the tracking results
        let html = `
            <div class="mobile-order-tracking-result">
                <div class="order-status-section">
                    <h5 class="status-title">{{ localize('Status for order no:') }} ${orderCode}</h5>
                </div>

                <div class="product-image-section">
                    <img src="${productImg ? productImg.src : ''}" alt="Product" class="img-fluid">
                </div>

                <div class="order-details-section">
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Order Name') }}</div>
                        <div class="detail-value">${orderName ? orderName.textContent : ''}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Customer Number') }}</div>
                        <div class="detail-value">${customerNumber ? customerNumber.textContent : ''}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Order Date') }}</div>
                        <div class="detail-value">${orderDate ? orderDate.textContent : ''}</div>
                    </div>
                    ${shipDate ? `
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Ship Date') }}</div>
                        <div class="detail-value">${shipDate.textContent}</div>
                    </div>
                    ` : ''}
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Shipping Address') }}</div>
                        <div class="detail-value">${shippingAddress ? shippingAddress.textContent : ''}</div>
                    </div>
                    ${carrier ? `
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Carrier') }}</div>
                        <div class="detail-value">${carrier.textContent}</div>
                    </div>
                    ` : ''}
                    ${trackingNumber ? `
                    <div class="detail-row">
                        <div class="detail-label">{{ localize('Carrier Tracking Number') }}</div>
                        <div class="detail-value">${trackingNumber.textContent}</div>
                    </div>
                    ` : ''}
                </div>

                <div class="map-section">
                    <div class="view-map-btn">
                        <span>{{ localize('View larger map') }}</span>
                    </div>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.4430467219584!2d85.33529507504224!3d27.70496247620633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb199a06c2eaf9%3A0xc5670a9173e161de!2sNew%20Baneshwor%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1683877428359!5m2!1sen!2snp" allowfullscreen="" height="200" style="border:0; width:100%;"></iframe>
                    </div>
                </div>

                <div class="tracking-steps-section">
        `;

        // Add tracking steps
        if (steps.length > 0) {
            const stepLabels = ['Order Placed', 'Preparing To Ship', 'Shipped', 'Delivered'];
            let currentStep = 0;

            steps.forEach((step, index) => {
                if (step.classList.contains('current')) {
                    currentStep = index;
                }
            });

            stepLabels.forEach((label, index) => {
                const isDone = index < currentStep;
                const isCurrent = index === currentStep;
                const stepClass = isCurrent ? 'current-step' : (isDone ? 'done-step' : '');

                html += `
                    <div class="tracking-step ${stepClass}">
                        ${label}
                    </div>
                `;
            });
        } else {
            // Default tracking steps if none are found
            html += `
                <div class="tracking-step done-step">
                    Order Placed
                </div>
                <div class="tracking-step done-step">
                    Preparing To Ship
                </div>
                <div class="tracking-step current-step">
                    Shipped
                </div>
                <div class="tracking-step">
                    Delivered
                </div>
            `;
        }

        html += `
                </div>

                <div class="order-updates-section">
                    <table class="updates-table">
                        <thead>
                            <tr>
                                <th>{{ localize('DATE') }}</th>
                                <th>{{ localize('TIME') }}</th>
                                <th>{{ localize('DESCRIPTION') }}</th>
                                <th>{{ localize('LOCATION') }}</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        // Add order updates
        if (tableRows.length > 0) {
            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length >= 4) {
                    const date = cells[0].textContent;
                    const time = cells[1].textContent;
                    const description = cells[2].textContent;
                    const location = cells[3].textContent;

                    html += `
                        <tr>
                            <td>${date}</td>
                            <td>${time}</td>
                            <td>${description}</td>
                            <td>${location}</td>
                        </tr>
                    `;
                }
            });
        } else {
            html += `
                <tr>
                    <td colspan="4">{{ localize('No updates available') }}</td>
                </tr>
            `;
        }

        html += `
                        </tbody>
                    </table>
                </div>
            </div>
        `;

        return html;
    }

    // Fix modal issues for mobile
    function fixMobileModalIssues() {
        // Make profile edit button work
        const profileEditBtn = document.querySelector('#profile-content .btn[data-bs-target="#profileEditModal"]');
        if (profileEditBtn) {
            profileEditBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove any existing modal backdrops
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');

                // Show the modal
                $('#profileEditModal').modal('show');

                // Ensure the modal is visible and on top
                setTimeout(function() {
                    $('#profileEditModal').css('z-index', '9999');
                    $('.modal-backdrop').css('z-index', '9998');
                }, 100);
            });
        }

        // Make password edit button work in profile tab
        const profilePasswordEditBtn = document.querySelector('#profile-content .btn[data-bs-target="#passwordEditModal"]');
        if (profilePasswordEditBtn) {
            profilePasswordEditBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove any existing modal backdrops
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');

                // Show the modal
                $('#passwordEditModal').modal('show');

                // Ensure the modal is visible and on top
                setTimeout(function() {
                    $('#passwordEditModal').css('z-index', '9999');
                    $('.modal-backdrop').css('z-index', '9998');
                }, 100);
            });
        }

        // Make password edit button work in settings tab
        const settingsPasswordEditBtn = document.querySelector('#settings-content .btn[data-bs-target="#passwordEditModal"]');
        if (settingsPasswordEditBtn) {
            settingsPasswordEditBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove any existing modal backdrops
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');

                // Show the modal
                $('#passwordEditModal').modal('show');

                // Ensure the modal is visible and on top
                setTimeout(function() {
                    $('#passwordEditModal').css('z-index', '9999');
                    $('.modal-backdrop').css('z-index', '9998');
                }, 100);
            });
        }

        // Make "Add City/State/Country/Address" links work
        const addAddressLinks = document.querySelectorAll('#profile-content a[onclick="addNewAddress()"]');
        if (addAddressLinks.length > 0) {
            addAddressLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Call the addNewAddress function
                    if (typeof addNewAddress === 'function') {
                        addNewAddress();
                    }
                });
            });
        }

        // Make address book buttons work
        const addressEditButtons = document.querySelectorAll('#address-book-content button[onclick^="editAddress"]');
        const addressDeleteButtons = document.querySelectorAll('#address-book-content button[onclick^="deleteAddress"]');
        const addAddressButtons = document.querySelectorAll('#address-book-content button[onclick="addNewAddress()"]');

        // Handle edit address buttons
        addressEditButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const addressId = this.getAttribute('onclick').match(/\d+/)[0];
                if (typeof editAddress === 'function') {
                    editAddress(addressId);
                }
            });
        });

        // Handle delete address buttons
        addressDeleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (typeof deleteAddress === 'function') {
                    deleteAddress(this);
                }
            });
        });

        // Handle add address buttons
        addAddressButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (typeof addNewAddress === 'function') {
                    addNewAddress();
                }
            });
        });

        // Handle mobile deactivate account button click
        const mobileDeactivateBtn = document.getElementById('mobileDeactivateAccountBtn');
        if (mobileDeactivateBtn) {
            mobileDeactivateBtn.addEventListener('click', function() {
                const reason = document.querySelector('input[name="mobileDeactivateReason"]:checked').id;

                if (confirm("{{ localize('Are you sure you want to deactivate your account? This action will log you out.') }}")) {
                    // Create a form and submit it
                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = '{{ route("customers.deactivateAccount") }}';

                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Add reason
                    const reasonInput = document.createElement('input');
                    reasonInput.type = 'hidden';
                    reasonInput.name = 'reason';
                    reasonInput.value = reason;
                    form.appendChild(reasonInput);

                    // Append to body and submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Handle mobile delete account button click
        const mobileDeleteBtn = document.getElementById('mobileDeleteAccountBtn');
        if (mobileDeleteBtn) {
            mobileDeleteBtn.addEventListener('click', function() {
                const reason = document.querySelector('input[name="mobileDeleteReason"]:checked').id;

                if (confirm("{{ localize('Are you sure you want to permanently delete your account? This action cannot be undone.') }}")) {
                    // Create a form and submit it
                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = '{{ route("customers.deleteAccount") }}';

                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Add reason
                    const reasonInput = document.createElement('input');
                    reasonInput.type = 'hidden';
                    reasonInput.name = 'reason';
                    reasonInput.value = reason;
                    form.appendChild(reasonInput);

                    // Append to body and submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        initializeMobileAccountTabs();
        fixMobileModalIssues();
    });

    // Handle hash changes (when user navigates with back/forward buttons)
    window.addEventListener('hashchange', function() {
        const hash = window.location.hash;
        if (hash.startsWith('#orders-tracker')) {
            // Remove active class from all tabs and contents
            const tabLinks = document.querySelectorAll('.mobile-account-tabs .nav-link');
            const tabContents = document.querySelectorAll('.mobile-tab-content');

            // Check for URL parameters to pre-fill form
            const urlParams = new URLSearchParams(hash.split('?')[1] || '');
            const orderCode = urlParams.get('code');
            const email = urlParams.get('email');

            tabLinks.forEach(tab => tab.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Activate orders tracker tab
            const ordersTrackerTab = document.getElementById('orders-tracker-tab');
            const ordersTrackerContent = document.getElementById('orders-tracker-content');

            if (ordersTrackerTab && ordersTrackerContent) {
                ordersTrackerTab.classList.add('active');
                ordersTrackerContent.classList.add('active');

                // Pre-fill form fields if parameters exist
                setTimeout(() => {
                    if (orderCode) {
                        const orderCodeInput = document.getElementById('mobile_order_code');
                        if (orderCodeInput) {
                            orderCodeInput.value = orderCode;
                        }
                    }

                    if (email) {
                        const emailInput = document.getElementById('mobile_billing_email');
                        if (emailInput) {
                            emailInput.value = email;
                        }
                    }
                }, 100);

                // Scroll the tab into view
                const tabsContainer = document.querySelector('.mobile-account-tabs');
                if (tabsContainer) {
                    scrollTabIntoView(ordersTrackerTab, tabsContainer);
                }
            }
        }
    });
</script>
