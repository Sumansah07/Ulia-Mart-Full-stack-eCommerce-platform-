@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Settings') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="my-account pt-6 pb-120 account-page">
        <div class="container">
            @include('frontend.default.inc.dashboard-breadcrumb', ['title' => localize('MY ACCOUNT')])

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
                    <div class="profile-details-section">
                        <div class="section-header">
                            <h3>{{ localize('Settings') }}</h3>
                        </div>

                        <div class="row g-4 px-4 mt-3">
                            <!-- Notifications Section -->
                            <div class="col-md-6">
                                <div class="settings-section">
                                    <h4 class="mb-3">{{ localize('Notifications') }}</h4>
                                    <div class="settings-options">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="allowDesktopNotifications" checked>
                                            <label class="form-check-label" for="allowDesktopNotifications">
                                                {{ localize('Allow Desktop Notifications') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="enableNotifications">
                                            <label class="form-check-label" for="enableNotifications">
                                                {{ localize('Enable Notifications') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="getOwnActivity">
                                            <label class="form-check-label" for="getOwnActivity">
                                                {{ localize('Get notification for my own activity') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="receiveOffers">
                                            <label class="form-check-label" for="receiveOffers">
                                                {{ localize('Receive offers from our partners') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deactivate Account Section -->
                            <div class="col-md-6">
                                <div class="settings-section">
                                    <h4 class="mb-3">{{ localize('Deactivate account') }}</h4>
                                    <div class="settings-options">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="deactivateReason" id="privacyConcern" checked>
                                            <label class="form-check-label" for="privacyConcern">
                                                {{ localize('I have a privacy concern') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="deactivateReason" id="temporary">
                                            <label class="form-check-label" for="temporary">
                                                {{ localize('This is temporary') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="deactivateReason" id="deactivateOther">
                                            <label class="form-check-label" for="deactivateOther">
                                                {{ localize('Other') }}
                                            </label>
                                        </div>
                                        <div class="mt-4">
                                            <button type="button" class="btn btn-success" id="deactivateAccountBtn">
                                                {{ localize('DEACTIVATE ACCOUNT') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Account Section -->
                            <div class="col-md-6 mt-4">
                                <div class="settings-section">
                                    <h4 class="mb-3">{{ localize('Delete account') }}</h4>
                                    <div class="settings-options">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="deleteReason" id="noLongerUsable" checked>
                                            <label class="form-check-label" for="noLongerUsable">
                                                {{ localize('No longer usable') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="deleteReason" id="switchAccount">
                                            <label class="form-check-label" for="switchAccount">
                                                {{ localize('Want to switch on other account') }}
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="deleteReason" id="deleteOther">
                                            <label class="form-check-label" for="deleteOther">
                                                {{ localize('Other') }}
                                            </label>
                                        </div>
                                        <div class="mt-4">
                                            <button type="button" class="btn btn-success" id="deleteAccountBtn">
                                                {{ localize('DELETE ACCOUNT') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Dashboard Content -->
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<style>
    /* Settings Page Styling */
    .settings-section {
        margin-bottom: 30px;
    }

    .settings-section h4 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .settings-options {
        padding-left: 10px;
    }

    .form-check {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 0.25em;
        border: 1px solid #adb5bd;
        cursor: pointer;
    }

    .form-check-input[type="radio"] {
        border-radius: 50%;
    }

    .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }

    .form-check-label {
        font-size: 15px;
        padding-left: 8px;
        color: #333;
        cursor: pointer;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 4px;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* Dashboard Container Styling */
    .dashboard-container {
        display: flex;
        gap: 30px;
    }

    .dashboard-sidebar {
        width: 280px;
        flex-shrink: 0;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding-bottom: 20px;
    }

    .dashboard-content {
        flex-grow: 1;
    }

    .profile-section {
        padding: 25px 20px;
        text-align: center;
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
    }

    .profile-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 15px;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .profile-email {
        font-size: 14px;
        color: #666;
    }

    .dashboard-nav {
        list-style: none;
        padding: 0 20px;
        margin: 0;
    }

    .dashboard-nav li {
        margin-bottom: 10px;
    }

    .dashboard-nav a {
        display: block;
        padding: 10px 15px;
        color: #333;
        border-radius: 4px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .dashboard-nav a:hover, .dashboard-nav a.active {
        background-color: #f8f9fa;
        color: #28a745;
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

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .dashboard-container {
            flex-direction: column;
        }

        .dashboard-sidebar {
            width: 100%;
            margin-bottom: 30px;
        }
    }

    @media (max-width: 767px) {
        .settings-section h4 {
            font-size: 16px;
        }

        .form-check-label {
            font-size: 14px;
        }

        .profile-details-section {
            padding: 20px;
        }
    }
</style>

<script>
    "use strict";

    // Handle deactivate account button click
    $('#deactivateAccountBtn').on('click', function() {
        var reason = $('input[name="deactivateReason"]:checked').attr('id');

        if (confirm("{{ localize('Are you sure you want to deactivate your account? This action will log you out.') }}")) {
            // Create a form and submit it
            var form = $('<form></form>');
            form.attr('method', 'post');
            form.attr('action', '{{ route("customers.deactivateAccount") }}');

            // Add CSRF token
            form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');

            // Add reason
            form.append('<input type="hidden" name="reason" value="' + reason + '">');

            // Append to body and submit
            form.appendTo('body').submit();
        }
    });

    // Handle delete account button click
    $('#deleteAccountBtn').on('click', function() {
        var reason = $('input[name="deleteReason"]:checked').attr('id');

        if (confirm("{{ localize('Are you sure you want to permanently delete your account? This action cannot be undone.') }}")) {
            // Create a form and submit it
            var form = $('<form></form>');
            form.attr('method', 'post');
            form.attr('action', '{{ route("customers.deleteAccount") }}');

            // Add CSRF token
            form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');

            // Add reason
            form.append('<input type="hidden" name="reason" value="' + reason + '">');

            // Append to body and submit
            form.appendTo('body').submit();
        }
    });
</script>
@endsection
