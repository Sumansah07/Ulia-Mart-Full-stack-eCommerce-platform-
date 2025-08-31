@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Customer Profile') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
                    <!-- Profile Section -->
                    <div class="profile-details-section">
                        <div class="section-header">
                            <h3>{{ localize('Profile') }}</h3>
                            <button type="button" class="edit-btn" data-bs-toggle="modal" data-bs-target="#profileEditModal">
                                <i class="fas fa-pencil-alt"></i> {{ localize('Edit') }}
                            </button>
                        </div>

                        <div class="profile-info">
                            <table class="profile-table">
                                <tr>
                                    <td class="profile-label">{{ localize('Name') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Email address') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Phone number') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ $user->phone ?: localize('Not provided') }}</td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('City') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">
                                        @if(isset($defaultAddress) && isset($defaultAddress->city))
                                            {{ $defaultAddress->city->name }}
                                        @else
                                            {{ localize('No city found') }}
                                            <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add City') }}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('State') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">
                                    @if(isset($defaultAddress->state))
                                        {{ $defaultAddress->state->name }}
                                    @else
                                        {{ localize('No state found') }}
                                        <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add State') }}</a>
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Country') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">
                                    @if(isset($defaultAddress) && isset($defaultAddress->country))
                                        {{ $defaultAddress->country->name }}
                                    @else
                                        {{ localize('No country found') }}
                                        <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add Country') }}</a>
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Street address') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">
                                    @if(isset($defaultAddress))
                                        {{ $defaultAddress->address }}
                                    @else
                                        {{ localize('No address found') }}
                                        <a href="javascript:void(0);" onclick="addNewAddress()" class="text-success">{{ localize('Add Address') }}</a>
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Zip code') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ $user->postal_code ?: localize('Not provided') }}</td>
                                </tr>
                                <!-- <tr>
                                    <td class="profile-label">{{ localize('Category') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ localize('Clothing') }}</td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="profile-label">{{ localize('Year est') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ date('Y') }}</td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="profile-label">{{ localize('Total employees') }}</td>
                                    <td class="profile-spacer"></td>
                                    <td class="profile-value">{{ localize('50 - 100 People') }}</td>
                                </tr> -->
                            </table>
                        </div>
                    </div>
                    <!-- End Profile Section -->

                    <!-- Login Details Section -->
                    <div class="profile-details-section mt-4">
                        <div class="section-header">
                            <h3>{{ localize('Login details') }}</h3>
                            <button type="button" class="edit-btn" data-bs-toggle="modal" data-bs-target="#passwordEditModal">
                                <i class="fas fa-pencil-alt"></i> {{ localize('Edit') }}
                            </button>
                        </div>

                        <div class="profile-info">
                            <table class="profile-table">
                                <tr>
                                    <td class="profile-label">{{ localize('Email address') }}</td>
                                    <td class="profile-value">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Phone number') }}</td>
                                    <td class="profile-value">{{ $user->phone ?: '(+40) 123 456 7890' }}</td>
                                </tr>
                                <tr>
                                    <td class="profile-label">{{ localize('Password') }}</td>
                                    <td class="profile-value">xxxxxx</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- End Login Details Section -->
                </div>
                <!-- End Dashboard Content -->
            </div>
            <!-- End Desktop Dashboard -->
        </div>
    </section>

    <!--address modal start-->
    @include('frontend.default.inc.addressForm', ['countries' => $countries])
    <!--address modal end-->

    <!-- Profile Edit Modal -->
    <div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered" style="margin-top: 5rem;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileEditModalLabel">{{ localize('Update Profile') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="profile-form" action="{{ route('customers.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="info">
                        <div class="file-upload text-center rounded-3 mb-4">
                            <input type="file" name="avatar">
                            <img src="{{ staticAsset('frontend/default/assets/img/icons/image.svg') }}" alt="dp" class="img-fluid">
                            <p class="text-dark fw-bold mb-2 mt-3">{{ localize('Drop your files here or browse') }}</p>
                            <p class="mb-0 file-name"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ localize('Your Name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ localize('Your Company Name') }}" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ localize('Email Address') }}</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ localize('Phone') }}</label>
                            <input type="text" name="phone" class="form-control" placeholder="{{ localize('Your Phone') }}" value="{{ $user->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ localize('Zip Code') }}</label>
                            <input type="text" name="postal_code" class="form-control" placeholder="{{ localize('Zip Code') }}" value="{{ $user->postal_code }}">
                        </div>
                        <!-- <div class="mb-3">
                            <label class="form-label">{{ localize('Category') }}</label>
                            <select name="category" class="form-control">
                                <option value="Clothing" selected>{{ localize('Clothing') }}</option>
                                <option value="Electronics">{{ localize('Electronics') }}</option>
                                <option value="Food">{{ localize('Food') }}</option>
                                <option value="Other">{{ localize('Other') }}</option>
                            </select>
                        </div> -->
                        <!-- <div class="mb-3">
                            <label class="form-label">{{ localize('Year Established') }}</label>
                            <input type="number" name="year_established" class="form-control" placeholder="{{ localize('Year Established') }}" value="{{ date('Y') }}">
                        </div> -->
                        <!-- <div class="mb-3">
                            <label class="form-label">{{ localize('Total Employees') }}</label>
                            <select name="total_employees" class="form-control">
                                <option value="1-10">{{ localize('1-10 People') }}</option>
                                <option value="11-50">{{ localize('11-50 People') }}</option>
                                <option value="50-100" selected>{{ localize('50-100 People') }}</option>
                                <option value="100+">{{ localize('100+ People') }}</option>
                            </select>
                        </div> -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ localize('Update Profile') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Edit Modal -->
    <div class="modal fade" id="passwordEditModal" tabindex="-1" aria-labelledby="passwordEditModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered" style="margin-top: 5rem;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordEditModalLabel">{{ localize('Change Password') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="password-reset-form" action="{{ route('customers.updateProfile') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="password">
                        <div class="mb-3">
                            <label class="form-label">{{ localize('New Password') }}</label>
                            <input type="password" name="password" class="form-control" placeholder="******" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ localize('Re-type Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="******" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ localize('Change Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<style>
    /* Modal Fix for Navbar Overlap */
    .modal {
        z-index: 9999 !important;
    }

    .modal-backdrop {
        z-index: 9998 !important;
    }

    .modal-dialog {
        margin: 2rem auto;
        max-height: calc(100vh - 4rem);
        overflow-y: auto;
    }

    /* Fix for body when modal is open */
    body.modal-open {
        overflow: auto !important;
        padding-right: 0 !important;
    }

    /* Profile Details Section Styling */
    .profile-details-section {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .section-header h3 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .edit-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .edit-btn:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .profile-info {
        padding: 10px 15px;
    }

    .profile-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 16px;
        table-layout: fixed;
    }

    .profile-label {
        width: 180px;
        font-weight: 500;
        color: #333;
        vertical-align: top;
        padding-bottom: 16px;
        padding-right: 100px;
        font-size: 16px;
    }

    .profile-value {
        color: #0066cc;
        padding-bottom: 16px;
        padding-left: 80px;
        font-size: 16px;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 8px;
        border: none;
    }



    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
        color: #555;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px 15px;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }

    .file-upload {
        border: 2px dashed #ddd;
        padding: 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .file-upload:hover {
        border-color: #4CAF50;
    }

    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    /* Profile Spacer */
    .profile-spacer {
        width: 120px;
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .profile-label {
            width: 140px;
            padding-right: 30px;
            font-size: 15px;
        }

        .profile-value {
            padding-left: 20px;
            font-size: 15px;
        }

        .profile-spacer {
            width: 60px;
        }
    }
</style>

<script>
    "use strict";

    // Fix modal issues
    function fixModalIssues() {
        // Remove any existing modal backdrops
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('overflow', '');
        $('body').css('padding-right', '');

        // Ensure modals have proper z-index
        $('.modal').css('z-index', '9999');

        // Fix modal button click
        $('[data-bs-toggle="modal"]').on('click', function() {
            var targetModal = $(this).data('bs-target');
            setTimeout(function() {
                $(targetModal).css('z-index', '9999');
                $('.modal-backdrop').css('z-index', '9998');
            }, 100);
        });
    }

    // Run on document ready
    $(document).ready(function() {
        fixModalIssues();
    });

    var parent = '.addAddressModal';

    // runs when the document is ready
    $(document).ready(function() {
        // Initialize select2 for address form
        addressModalSelect2(parent);
    });

    // Initialize select2 for address form
    function addressModalSelect2(parent) {
        $(parent + ' .select2Address').select2({
            dropdownParent: $(parent)
        });
    }

    // Add new addressdd
    function addNewAddress() {
        // Remove any existing modal backdrops
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('overflow', '');
        $('body').css('padding-right', '');

        // Show the modal
        $('#addAddressModal').modal('show');

        // Ensure the modal is visible and on top
        setTimeout(function() {
            // Make sure backdrop doesn't block interaction
            $('.modal-backdrop').css('z-index', '1040');
            $('#addAddressModal').css('z-index', '1050');
        }, 100);

        parent = '.addAddressModal';
        addressModalSelect2(parent);
    }

    // Get states on country change
    $(document).on('change', '[name=country_id]', function() {
        var country_id = $(this).val();
        getStates(country_id);
    });

    // Get states
    function getStates(country_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('address.getStates') }}",
            type: 'POST',
            data: {
                country_id: country_id
            },
            success: function(response) {
                $('[name="state_id"]').html("");
                $('[name="state_id"]').html(JSON.parse(response));
                addressModalSelect2(parent);
            }
        });
    }

    // Get cities on state change
    $(document).on('change', '[name=state_id]', function() {
        var state_id = $(this).val();
        getCities(state_id);
    });

    // Get cities
    function getCities(state_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('address.getCities') }}",
            type: 'POST',
            data: {
                state_id: state_id
            },
            success: function(response) {
                $('[name="city_id"]').html("");
                $('[name="city_id"]').html(JSON.parse(response));
                addressModalSelect2(parent);
            }
        });
    }
</script>
@endsection