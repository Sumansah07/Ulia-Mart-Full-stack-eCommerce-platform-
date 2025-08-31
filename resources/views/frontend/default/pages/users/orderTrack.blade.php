@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Order Tracking') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="my-account pt-6 pb-120 account-page">
        <div class="container">
            @include('frontend.default.inc.dashboard-breadcrumb', ['title' => localize('ORDERS TRACKING')])

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
                    <div class="tracking-section">
                        <h3>{{ localize('Orders tracking') }}</h3>

                        <form class="orderstracking-from mb-4" action="{{ route('customers.trackOrder') }}">
    <p class="mb-3">
        {{ localize('To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.') }}
    </p>

    <div class="row align-items-center">
        <!-- Order ID Input with Prefix -->
        <div class="form-group col-md-4">
            <div class="input-group">
                @if (getSetting('order_code_prefix') != null)
                    <span class="input-group-text border border-medium-dark-grey rounded-start bg-white py-2 px-3">
                        {{ getSetting('order_code_prefix') }}
                    </span>
                @endif
                <input name="code"
                    placeholder="{{ localize('Order ID') }}"
                    value="{{ $searchCode ?? '' }}"
                    id="orderId"
                    type="text"
                    class="form-control border border-medium-dark-grey rounded-end"
                    required>
            </div>
        </div>

        <!-- Email Input -->
        <div class="form-group col-md-5">
            <input name="email"
                placeholder="{{ localize('Billing email') }}"
                value="{{ auth()->user()->email ?? '' }}"
                id="billingEmail"
                type="email"
                class="form-control border border-medium-dark-grey"
                required>
        </div>

        <!-- Submit Button -->
        <div class="form-group col-md-3">
            <button type="submit" class="btn btn-track w-100">
                <span>{{ localize('Track') }}</span>
            </button>
        </div>
    </div>
</form>


                        @isset($order)
                            <div class="order-tracking-details mt-4">
                                <h4 class="status-title">{{ localize('Status for order no:') }} {{ $order->orderGroup->order_code }}</h4>
                                <!-- Status Order -->
                                <div class="row mt-3">
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        @php
                                            $orderItem = $order->orderItems()->first();
                                            $productImage = staticAsset('frontend/default/assets/img/placeholder.png');
                                            $productName = localize('Product');

                                            if ($orderItem && $orderItem->product_variation && $orderItem->product_variation->product) {
                                                $product = $orderItem->product_variation->product;
                                                $productImage = uploadedAsset($product->thumbnail_image) ?: staticAsset('frontend/default/assets/img/placeholder.png');
                                                $productName = $product->collectLocalization('name') ?: localize('Product');
                                            } elseif ($orderItem && $orderItem->product) {
                                                $productImage = uploadedAsset($orderItem->product->thumbnail_image) ?: staticAsset('frontend/default/assets/img/placeholder.png');
                                                $productName = $orderItem->product->name ?: localize('Product');
                                            }
                                        @endphp
                                        <div class="product-img mb-3 mb-sm-0">
                                            <img class="rounded-0 blur-up lazyload" src="{{ $productImage }}" alt="product" title="" width="100%" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-9 col-sm-8">
                                        <div class="tracking-detail d-flex-center">
                                            <ul>
                                                <li>
                                                    <div class="left"><span>{{ localize('Order Name') }}</span></div>
                                                    <div class="right"><span>{{ $productName }}</span></div>
                                                </li>
                                                <li>
                                                    <div class="left"><span>{{ localize('Customer Number') }}</span></div>
                                                    <div class="right"><span>{{ $order->orderGroup->order_code }}</span></div>
                                                </li>
                                                <li>
                                                    <div class="left"><span>{{ localize('Order Date') }}</span></div>
                                                    <div class="right"><span>{{ date('d M Y', strtotime($order->created_at)) }}</span></div>
                                                </li>
                                                <li>
                                                    <div class="left"><span>{{ localize('Payment Status') }}</span></div>
                                                    <div class="right">
                                                        @if($order->orderGroup->payment_status == paidPaymentStatus())
                                                            <span class="badge bg-success text-white px-2 py-1" style="font-size: 10px;">
                                                                <i class="fas fa-check-circle me-1"></i>{{ localize('Paid') }}
                                                            </span>
                                                        @elseif($order->orderGroup->payment_status == unpaidPaymentStatus())
                                                            <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 10px;">
                                                                <i class="fas fa-clock me-1"></i>{{ localize('Unpaid') }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-info text-white px-2 py-1" style="font-size: 10px;">
                                                                <i class="fas fa-info-circle me-1"></i>{{ ucwords(str_replace('_', ' ', $order->orderGroup->payment_status)) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </li>
                                                @if($order->delivery_status == orderDeliveredStatus())
                                                <li>
                                                    <div class="left"><span>{{ localize('Ship Date') }}</span></div>
                                                    <div class="right"><span>{{ date('d M Y', strtotime($order->updated_at)) }}</span></div>
                                                </li>
                                                @endif
                                                <li>
                                                    <div class="left"><span>{{ localize('Shipping Address') }}</span></div>
                                                    <div class="right">
                                                        <span>
                                                            @if($order->shipping_address)
                                                                {{ $order->shipping_address->address ?? '' }}
                                                                {{ $order->shipping_address->city ? ', '.$order->shipping_address->city : '' }}
                                                                {{ $order->shipping_address->state ? ', '.$order->shipping_address->state : '' }}
                                                                {{ $order->shipping_address->country ? ', '.$order->shipping_address->country : '' }}
                                                            @else
                                                                {{ localize('No shipping address available') }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </li>
                                                @if($order->logistic_name)
                                                <li>
                                                    <div class="left"><span>{{ localize('Carrier') }}</span></div>
                                                    <div class="right"><span>{{ $order->logistic_name }}</span></div>
                                                </li>
                                                @endif
                                                @if($order->tracking_number)
                                                <li>
                                                    <div class="left"><span>{{ localize('Carrier Tracking Number') }}</span></div>
                                                    <div class="right"><span>{{ $order->tracking_number }}</span></div>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12 mt-4 mt-lg-0">
                                        <div class="tracking-map map-section ratio ratio-16x9 h-100">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.4430467219584!2d85.33529507504224!3d27.70496247620633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb199a06c2eaf9%3A0xc5670a9173e161de!2sNew%20Baneshwor%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1683877428359!5m2!1sen!2snp" allowfullscreen="" height="650"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Status Order -->
                                <!-- Tracking Steps -->
                                <div class="tracking-steps nav mt-5 mb-4 clearfix">
                                    @php
                                        // Define the current step based on delivery status
                                        $currentStep = 1; // Default to Order Placed

                                        if ($order->delivery_status == orderPendingStatus()) {
                                            $currentStep = 2; // Preparing To Ship
                                        } elseif ($order->delivery_status == orderProcessingStatus() || $order->delivery_status == 'picked_up') {
                                            $currentStep = 3; // Shipped (also for picked_up status)
                                        } elseif ($order->delivery_status == 'out_for_delivery') {
                                            $currentStep = 4; // Out for Delivery
                                        } elseif ($order->delivery_status == orderDeliveredStatus()) {
                                            $currentStep = 5; // Delivered
                                        }
                                    @endphp

                                    <div class="step @if ($currentStep >= 1) done @endif @if ($currentStep == 1) current @endif">
                                        <span>{{ localize('Order Placed') }}</span>
                                    </div>
                                    <div class="step @if ($currentStep > 2) done @elseif ($currentStep == 2) current @endif">
                                        <span>{{ localize('Preparing To Ship') }}</span>
                                    </div>
                                    <div class="step @if ($currentStep > 3) done @elseif ($currentStep == 3) current @endif">
                                        <span>{{ localize('Shipped') }}</span>
                                    </div>
                                    <div class="step @if ($currentStep == 4) current @endif">
                                        <span>{{ localize('Delivered') }}</span>
                                    </div>
                                </div>
                                <!-- End Tracking Steps -->
                                <!-- Order Table -->
                                <div class="table-bottom-brd table-responsive">
                                    <table class="table align-middle text-center order-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ localize('DATE') }}</th>
                                                <th scope="col">{{ localize('TIME') }}</th>
                                                <th scope="col">{{ localize('DESCRIPTION') }}</th>
                                                <th scope="col">{{ localize('LOCATION') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($order->orderUpdates as $orderUpdate)
                                                <tr>
                                                    <td>{{ date('d M Y', strtotime($orderUpdate->created_at)) }}</td>
                                                    <td>{{ date('h:i A', strtotime($orderUpdate->created_at)) }}</td>
                                                    <td>
                                                        @if(isset($orderUpdate->note) && strpos($orderUpdate->note, 'picked_up') !== false)
                                                            {{ localize('Order has been shipped') }}
                                                        @else
                                                            {{ $orderUpdate->note ?? localize('Status updated') }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->shipping_address ? ($order->shipping_address->city ?? localize('N/A')) : localize('N/A') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">{{ localize('No updates available') }}</td>
                                                </tr>
                                            @endforelse
                                            <tr>
                                                <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                                                <td>{{ date('h:i A', strtotime($order->created_at)) }}</td>
                                                <td>{{ localize('Order has been placed') }}</td>
                                                <td>{{ $order->shipping_address ? ($order->shipping_address->city ?? localize('N/A')) : localize('N/A') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Order Table -->
                            </div>
                        @endisset
                    </div>
                </div>
                <!-- End Dashboard Content -->
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <style>
        /* Tracking section styling */
        .tracking-section {
            margin-bottom: 30px;
        }

        .tracking-section h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .status-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #555;
        }

        /* Form styling */
        .tracking-form-row {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 10px;
        }

        .orderstracking-from input {
            border: 1px solid #ddd;
            padding: 12px 15px;
            border-radius: 4px;
            width: 100%;
            height: 45px;
            font-size: 14px;
        }

        .btn-track {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            text-transform: uppercase;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-track:hover {
            background-color: #45a049;
            color: white;
        }

        /* Product image styling */
        .product-img img {
            border-radius: 8px;
            max-width: 100%;
            height: auto;
            border: 1px solid #eee;
        }

        .border-medium-dark-grey {
    border-color: #6c757d !important; /* Medium-dark grey, similar to Bootstrap's 'text-secondary' */
}

        /* Tracking details styling */
        .order-tracking-details {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }

        .tracking-detail ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tracking-detail ul li {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 10px;
        }

        .tracking-detail ul li .left {
            width: 40%;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        .tracking-detail ul li .right {
            width: 60%;
            font-size: 14px;
        }

        /* Map styling */
        .tracking-map {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        /* Tracking steps styling */
        .tracking-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 30px 0;
            overflow: visible;
            background: none;
        }

        .tracking-steps:before {
            display: none;
        }

        .tracking-steps .step {
            position: relative;
            width: 24%;
            text-align: center;
            padding: 15px 5px;
            background-color: #e8e8e8;
            color: #333;
            margin-right: 1%;
            clip-path: polygon(90% 0%, 100% 50%, 90% 100%, 0% 100%, 10% 50%, 0% 0%);
            z-index: 1;
        }

        .tracking-steps .step:before {
            display: none;
        }

        .tracking-steps .step.done {
            background-color: #28a745;
            color: white;
        }

        .tracking-steps .step.current {
            background-color: #e9546b;
            color: white;
        }

        .tracking-steps .step span {
            display: block;
            font-size: 14px;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }

        .tracking-steps .step span {
            color: inherit;
        }

        .tracking-steps .step.done span {
            color: white;
        }

        .tracking-steps .step.current span {
            color: white;
        }

        .tracking-steps .step:last-child {
            margin-right: 0;
            clip-path: polygon(100% 0%, 100% 100%, 0% 100%, 10% 50%, 0% 0%);
        }

        /* Table styling */
        .table-bottom-brd {
            border-bottom: 1px solid #dee2e6;
            margin-top: 30px;
        }

        .order-table {
            border-collapse: collapse;
            width: 100%;
        }

        .order-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            font-size: 13px;
        }

        .order-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        .order-table tr:hover {
            background-color: #f8f9fa;
        }

        /* Professional payment status badges */
        .tracking-detail .badge {
            font-size: 10px;
            font-weight: 600;
            border-radius: 4px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .tracking-detail .badge i {
            font-size: 9px;
        }

        .tracking-detail .badge.bg-success {
            background-color: #28a745 !important;
            border: 1px solid #1e7e34;
        }

        .tracking-detail .badge.bg-warning {
            background-color: #ffc107 !important;
            border: 1px solid #d39e00;
            color: #212529 !important;
        }

        .tracking-detail .badge.bg-info {
            background-color: #17a2b8 !important;
            border: 1px solid #117a8b;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .tracking-steps .step span {
                font-size: 12px;
            }

            .tracking-detail ul li .left,
            .tracking-detail ul li .right {
                width: 50%;
            }

            .tracking-form-row {
                flex-wrap: wrap;
            }

            .tracking-form-row .form-group {
                width: 100%;
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 10px;
            }

            .tracking-form-row .form-group:last-child {
                margin-bottom: 0;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .tracking-form-row {
                flex-wrap: nowrap;
            }

            .tracking-form-row .form-group.col-md-4 {
                width: 30%;
                flex: 0 0 30%;
                max-width: 30%;
            }

            .tracking-form-row .form-group.col-md-5 {
                width: 45%;
                flex: 0 0 45%;
                max-width: 45%;
            }

            .tracking-form-row .form-group.col-md-3 {
                width: 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }
        }
    </style>
@endsection
