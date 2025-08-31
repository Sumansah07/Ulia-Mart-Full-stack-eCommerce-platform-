@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Customer Order History') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
                    <div class="orders-header mb-4">
                        <h2 class="mb-0">{{ localize('My Orders') }}</h2>
                    </div>

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
                <!-- End Dashboard Content -->
            </div>
            <!-- End Desktop Dashboard -->
        </div>
    </section>
@endsection
