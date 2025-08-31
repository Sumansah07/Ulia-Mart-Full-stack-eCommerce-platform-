<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $array['subject'] }}</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f8f9fa;">
    <div class="email-container" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <div class="header" style="background: #2c3e50; color: white; padding: 30px 20px; text-align: center;">
            <div class="logo" style="margin-bottom: 15px;">
                <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) ?? staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}"
                     alt="{{ getSetting('system_title') ?? env('APP_NAME') }}"
                     style="max-height: 60px; width: auto;">
            </div>
            <h1 style="margin: 0; font-size: 28px; font-weight: 600;">{{ getSetting('system_title') ?? env('APP_NAME') }}</h1>
            <p style="margin: 0; font-size: 16px; opacity: 0.9;">Your trusted shopping destination</p>
        </div>

        <!-- Content -->
        <div class="content" style="padding: 40px 30px;">
            {!! $array['content'] !!}
        </div>

        <!-- Features Section -->
        <div class="features" style="background: #f8f9fa; padding: 30px; margin: 20px 0; border-radius: 8px;">
            <h3 style="color: #333; margin-bottom: 15px; font-size: 20px;">Why Choose {{ getSetting('system_title') ?? env('APP_NAME') }}?</h3>
            <ul class="feature-list" style="list-style: none; padding: 0;">
                <li style="padding: 8px 0; color: #666;">Wide range of quality products</li>
                <li style="padding: 8px 0; color: #666;">Competitive prices and exclusive deals</li>
                <li style="padding: 8px 0; color: #666;">Fast and reliable delivery</li>
                <li style="padding: 8px 0; color: #666;">Excellent customer service</li>
                <li style="padding: 8px 0; color: #666;">Secure payment options</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer" style="background: #2c3e50; color: white; padding: 30px 20px; text-align: center;">
            <p style="margin: 5px 0; font-size: 14px;"><strong>{{ getSetting('system_title') ?? env('APP_NAME') }}</strong></p>
            <p style="margin: 5px 0; font-size: 14px;">{{ getSetting('topbar_location') ?? 'Your trusted online store' }}</p>
            <p style="margin: 5px 0; font-size: 14px;">{{ localize('Email') }}: {{ getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS') }}</p>
            @if(getSetting('navbar_contact_number'))
                <p style="margin: 5px 0; font-size: 14px;">{{ localize('Phone') }}: {{ getSetting('navbar_contact_number') }}</p>
            @endif
            <p style="margin: 5px 0; font-size: 14px;">{{ localize('Website') }}: <a href="{{ env('APP_URL') }}" style="color: white;">{{ env('APP_URL') }}</a></p>

            <!-- Social Links -->
            <div class="social-links" style="margin: 20px 0;">
                @if(getSetting('facebook_link'))
                    <a href="{{ getSetting('facebook_link') }}" target="_blank" style="color: white; text-decoration: none; margin: 0 10px; font-size: 18px;">📘 Facebook</a>
                @endif
                @if(getSetting('instagram_link'))
                    <a href="{{ getSetting('instagram_link') }}" target="_blank" style="color: white; text-decoration: none; margin: 0 10px; font-size: 18px;">📷 Instagram</a>
                @endif
                @if(getSetting('youtube_link'))
                    <a href="{{ getSetting('youtube_link') }}" target="_blank" style="color: white; text-decoration: none; margin: 0 10px; font-size: 18px;">📺 YouTube</a>
                @endif
            </div>

            <div class="unsubscribe" style="font-size: 12px; color: #bdc3c7; margin-top: 20px;">
                <p>© {{ date('Y') }} {{ getSetting('system_title') ?? env('APP_NAME') }}. {{ localize('All rights reserved') }}.</p>
                <p>{{ localize('You received this email because you subscribed to our newsletter') }}.</p>
                <p><a href="{{ route('home') }}" style="color: #bdc3c7;">{{ localize('Visit our website') }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>
