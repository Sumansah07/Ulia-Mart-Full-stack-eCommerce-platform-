@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Customer Addresses') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="my-account pt-6 pb-120 account-page">
        <div class="container">
            @include('frontend.default.inc.dashboard-breadcrumb', ['title' => localize('ADDRESS BOOK')])

            <div class="dashboard-container">
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
                    <div class="address-header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">{{ localize('Address Book') }}</h2>
                        <button type="button" class="btn btn-success btn-sm" onclick="addNewAddress()">
                            <i class="fas fa-plus me-1"></i> {{ localize('ADD NEW') }}
                        </button>
                    </div>

                    <div class="address-book-section">
                        <div class="row g-3 justify-content-start">
                            @forelse ($addresses as $address)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="address-card bg-white p-2 border rounded">
                                        <div class="address-header d-flex justify-content-between mb-1">
                                            <h5 class="m-0 fs-6">{{ $user->name }}</h5>
                                            <span class="address-type-badge
                                                @if($address->address_type == 'home') bg-info text-white
                                                @elseif($address->address_type == 'office') bg-warning text-white
                                                @else bg-secondary text-white @endif
                                                px-2 py-0 rounded">
                                                {{ strtoupper($address->address_type) }}
                                            </span>
                                        </div>
                                        <div class="address-content mb-2">
                                            <p class="mb-0 small">{{ $address->address }}, {{ $address->city->name }},</p>
                                            <p class="mb-0 small">{{ $address->state->name }} {{ $address->country->name }}</p>
                                            <p class="mb-0 small">{{ localize('Mobile') }}: {{ $address->phone }}</p>
                                        </div>
                                        <div class="address-actions d-flex justify-content-between">
                                            <button type="button" class="btn btn-sm btn-outline-secondary px-2" onclick="editAddress({{ $address->id }})">
                                                {{ localize('EDIT') }}
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary px-2"
                                                data-url="{{ route('address.delete', $address->id) }}"
                                                onclick="deleteAddress(this)">
                                                {{ localize('REMOVE') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        {{ localize('No addresses found. Please add a new address.') }}
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- End Dashboard Content -->
            </div>
        </div>

        <!--add address modal start-->
        @include('frontend.default.inc.addressForm', ['countries' => $countries])
        <!--add address modal end-->

    </section>
@endsection
