@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Shipping & Delivery Policy') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('page-title')
{{ localize('Shipping & Delivery Policy') }}
@endsection

@section('breadcrumb')
    @include('frontend.default.inc.shop-breadcrumb')
@endsection

@section('contents')
    <div id="page-content">
        <!--Main Content-->
        <div class="container">
            <!-- CMS Content -->
            <div class="text-content">
                <h3 style="color: #006633;">{{ localize('Shipping Information') }}</h3>
                <p>{{ localize('We have put a lot of focus on making sure the items get delivered to our customers as quickly as possible. You will receive your order in 6-17 business days from the date that it is placed.') }}</p>
                <p>{{ localize('A confirmation email will be sent to you once the order is authorized and verified. We begin preparing your order immediately after it is verified. With this sort of time frame, it makes it difficult for us to change or cancel your order, however, we will do our best to support your request.') }}</p>
                <p>{{ localize('It normally takes 3-7 business days for us to process your order. Please note that this does not include holidays and weekends.') }}</p>

                <h3 style="color: #006633;">{{ localize('To track your order') }}</h3>
                <ul class="checkmark-info">
                    <li class="mb-1">{{ localize('Click') }} <a href="{{ route('login') }}" class="text-primary">{{ localize('here') }}</a> {{ localize('and login to your account.') }}</li>
                    <li class="mb-1">{{ localize('Once you\'re logged in, choose "Order History".') }}</li>
                    <li>{{ localize('Click "Track Package" to retrieve your tracking information.') }}</li>
                </ul>

                <h3 style="color: #006633;">{{ localize('Delivery Areas') }}</h3>
                <p>{{ localize('We currently deliver to all major cities in Nepal. Delivery to remote areas may take additional time and may incur extra charges. Please check the delivery options available for your location during checkout.') }}</p>

                <h3 style="color: #006633;">{{ localize('Delivery Timeframes') }}</h3>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Kathmandu Valley: 1-3 business days') }}</li>
                    <li class="mb-1">{{ localize('Major Cities: 3-5 business days') }}</li>
                    <li class="mb-1">{{ localize('Other Areas: 5-10 business days') }}</li>
                    <li>{{ localize('Remote Areas: 10-17 business days') }}</li>
                </ul>

                <h3 style="color: #006633;">{{ localize('Shipping Costs') }}</h3>
                <p>{{ localize('Shipping costs are calculated based on the delivery location, package weight, and dimensions. The exact shipping cost will be displayed during checkout before you complete your purchase.') }}</p>

                <h3 style="color: #006633;">{{ localize('Free Shipping') }}</h3>
                <p>{{ localize('We offer free shipping on orders above Rs. 2,000 for deliveries within Kathmandu Valley. For other areas, free shipping is available on orders above Rs. 5,000.') }}</p>

                <h3 style="color: #006633;">{{ localize('Delivery Issues') }}</h3>
                <p>{{ localize('If you encounter any issues with your delivery, such as damaged items, incomplete orders, or significant delays, please contact our customer service team immediately at uliaamart@gmail.com or call us at +977 9876543210.') }}</p>

                <h3 style="color: #006633;">{{ localize('International Shipping') }}</h3>
                <p>{{ localize('Currently, we do not offer international shipping. Our services are limited to deliveries within Nepal only.') }}</p>
            </div>
            <!-- End CMS Content -->
        </div>
        <!--End Main Content-->
    </div>
@endsection
