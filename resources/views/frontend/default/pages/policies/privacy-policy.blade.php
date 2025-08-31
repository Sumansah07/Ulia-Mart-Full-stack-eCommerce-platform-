@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Privacy Policy') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('page-title')
{{ localize('Privacy Policy') }}
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
                <h3 style="color: #006633;">{{ localize('Privacy Policy') }}</h3>
                <p>{{ localize('At Uliaa Mart, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, store, and protect your information when you interact with us—whether in-store, through our website, or via our mobile app.') }}</p>

                <h4 style="color: #006633;">{{ localize('Information We Collect') }}</h4>
                <p>{{ localize('We collect information that you provide directly to us, such as when you create an account, make a purchase, sign up for our newsletter, or contact our customer service. This information may include:') }}</p>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Personal details (name, email address, phone number, etc.)') }}</li>
                    <li class="mb-1">{{ localize('Delivery address and billing information') }}</li>
                    <li class="mb-1">{{ localize('Payment information (we do not store complete credit card details)') }}</li>
                    <li class="mb-1">{{ localize('Purchase history and preferences') }}</li>
                    <li>{{ localize('Communications with our customer service team') }}</li>
                </ul>

                <h4 style="color: #006633;">{{ localize('How We Use Your Information') }}</h4>
                <p>{{ localize('We use your information for various purposes, including:') }}</p>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Processing and fulfilling your orders') }}</li>
                    <li class="mb-1">{{ localize('Managing your account and providing customer support') }}</li>
                    <li class="mb-1">{{ localize('Sending order confirmations and updates') }}</li>
                    <li class="mb-1">{{ localize('Personalizing your shopping experience') }}</li>
                    <li class="mb-1">{{ localize('Improving our products and services') }}</li>
                    <li>{{ localize('Marketing and promotional communications (with your consent)') }}</li>
                </ul>

                <h4 style="color: #006633;">{{ localize('Data Security') }}</h4>
                <p>{{ localize('We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.') }}</p>

                <h4 style="color: #006633;">{{ localize('Sharing Your Information') }}</h4>
                <p>{{ localize('We may share your information with:') }}</p>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Service providers who help us operate our business (payment processors, delivery services, etc.)') }}</li>
                    <li class="mb-1">{{ localize('Business partners with your consent') }}</li>
                    <li>{{ localize('Legal authorities when required by law') }}</li>
                </ul>

                <h4 style="color: #006633;">{{ localize('Your Rights') }}</h4>
                <p>{{ localize('You have the right to:') }}</p>
                <ul class="list-dot">
                    <li class="mb-1">{{ localize('Access the personal information we hold about you') }}</li>
                    <li class="mb-1">{{ localize('Correct inaccurate or incomplete information') }}</li>
                    <li class="mb-1">{{ localize('Request deletion of your personal information') }}</li>
                    <li class="mb-1">{{ localize('Withdraw consent for marketing communications') }}</li>
                    <li>{{ localize('Lodge a complaint with a supervisory authority') }}</li>
                </ul>

                <h4 style="color: #006633;">{{ localize('Cookies and Tracking Technologies') }}</h4>
                <p>{{ localize('We use cookies and similar technologies to enhance your browsing experience, analyze site traffic, and personalize content. You can manage your cookie preferences through your browser settings.') }}</p>

                <h4 style="color: #006633;">{{ localize('Changes to This Policy') }}</h4>
                <p>{{ localize('We may update this Privacy Policy from time to time. We will notify you of any significant changes by posting the new policy on our website or by other means of communication.') }}</p>

                <h4 style="color: #006633;">{{ localize('Contact Us') }}</h4>
                <p>{{ localize('If you have any questions or concerns about our Privacy Policy, please contact us at:') }}</p>
                <p>
                    {{ localize('Email') }}: uliaamart@gmail.com<br>
                    {{ localize('Phone') }}: +977 9876543210<br>
                    {{ localize('Address') }}: Tokha, Kathmandu
                </p>
            </div>
            <!-- End CMS Content -->
        </div>
        <!--End Main Content-->
    </div>
@endsection
