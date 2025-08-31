<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ localize('Preview') }}: {{ $campaign->name }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div class="preview-container" style="max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
        <!-- Preview Header -->
        <div class="preview-header" style="background: #2c3e50; color: white; padding: 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">{{ localize('Email Campaign Preview') }}</h1>
        </div>

        <!-- Campaign Info -->
        <div class="preview-info" style="background: #ecf0f1; padding: 15px 20px; border-bottom: 1px solid #bdc3c7;">
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Campaign Name') }}:</strong> {{ $campaign->name }}</p>
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Subject') }}:</strong> {{ $campaign->subject }}</p>
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Status') }}:</strong> 
                <span class="status-badge status-{{ $campaign->status }}" style="display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500; text-transform: uppercase; background: {{ $campaign->status === 'draft' ? '#6c757d' : ($campaign->status === 'scheduled' ? '#ffc107' : ($campaign->status === 'sending' ? '#17a2b8' : ($campaign->status === 'sent' ? '#28a745' : '#dc3545'))) }}; color: {{ $campaign->status === 'scheduled' ? '#212529' : 'white' }};">{{ $campaign->status }}</span>
            </p>
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Audience') }}:</strong> {{ ucfirst(str_replace('_', ' ', $campaign->audience_type)) }}</p>
            @if($campaign->template)
                <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Template') }}:</strong> {{ $campaign->template->name }}</p>
            @endif
            @if($campaign->scheduled_at)
                <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Scheduled At') }}:</strong> {{ $campaign->scheduled_at->format('M d, Y \a\t g:i A') }}</p>
            @endif
        </div>

        <!-- Email Preview -->
        <div class="email-container" style="max-width: 600px; margin: 20px auto; background: white; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
            <!-- Email Header -->
            <div class="email-header" style="background: linear-gradient(135deg,rgb(36, 150, 55) 0%,rgb(46, 108, 46) 100%); color: white; padding: 30px 20px; text-align: center;">
                <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) ?? staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" 
                     alt="{{ getSetting('system_title') ?? env('APP_NAME') }}" style="max-height: 60px; width: auto; margin-bottom: 15px;">
                <h1 style="margin: 0; font-size: 28px; font-weight: 300;">{{ getSetting('system_title') ?? env('APP_NAME') }}</h1>
            </div>

            <!-- Email Content -->
            <div class="email-content" style="padding: 30px 20px; color: #333; line-height: 1.8;">
                {!! nl2br($content) !!}
            </div>

            <!-- Email Footer -->
            <div class="email-footer" style="background:rgb(35, 94, 32); color: white; padding: 20px; text-align: center; font-size: 14px;">
                <p style="margin: 5px 0;">{{ getSetting('system_title') ?? env('APP_NAME') }}</p>
                <p style="margin: 5px 0;">{{ getSetting('topbar_location') ?? 'Your Business Address' }}</p>
                <p style="margin: 5px 0;">{{ getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS') }}</p>
                <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
                    {{ localize('This is a preview of your email campaign.') }}
                </p>
            </div>
        </div>

        <!-- Preview Actions -->
        <div class="preview-actions" style="padding: 20px; text-align: center; background: #f8f9fa;">
            <a href="javascript:window.close()" class="btn btn-secondary" style="display: inline-block; padding: 10px 20px; margin: 0 5px; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease; background: #95a5a6; color: white;">
                {{ localize('Close Preview') }}
            </a>
            @if($campaign->status === 'draft')
                <a href="{{ route('admin.email-marketing.campaigns.edit', $campaign) }}" class="btn btn-primary" style="display: inline-block; padding: 10px 20px; margin: 0 5px; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease; background:rgb(38, 242, 61); color: white;">
                    {{ localize('Edit Campaign') }}
                </a>
                <a href="{{ route('admin.email-marketing.campaigns.show', $campaign) }}" class="btn btn-success" style="display: inline-block; padding: 10px 20px; margin: 0 5px; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease; background: #27ae60; color: white;">
                    {{ localize('Send Campaign') }}
                </a>
            @else
                <a href="{{ route('admin.email-marketing.campaigns.show', $campaign) }}" class="btn btn-primary" style="display: inline-block; padding: 10px 20px; margin: 0 5px; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease; background:rgb(38, 242, 61); color: white;">
                    {{ localize('View Campaign') }}
                </a>
            @endif
        </div>
    </div>
        <!-- Preview Header -->
        <div class="preview-header">
            <h1>{{ localize('Email Campaign Preview') }}</h1>
        </div>

        <!-- Campaign Info -->
        <div class="preview-info">
            <p><strong>{{ localize('Campaign Name') }}:</strong> {{ $campaign->name }}</p>
            <p><strong>{{ localize('Subject') }}:</strong> {{ $campaign->subject }}</p>
            <p><strong>{{ localize('Status') }}:</strong> 
                <span class="status-badge status-{{ $campaign->status }}">{{ $campaign->status }}</span>
            </p>
            <p><strong>{{ localize('Audience') }}:</strong> {{ ucfirst(str_replace('_', ' ', $campaign->audience_type)) }}</p>
            @if($campaign->template)
                <p><strong>{{ localize('Template') }}:</strong> {{ $campaign->template->name }}</p>
            @endif
            @if($campaign->scheduled_at)
                <p><strong>{{ localize('Scheduled At') }}:</strong> {{ $campaign->scheduled_at->format('M d, Y \a\t g:i A') }}</p>
            @endif
        </div>

        <!-- Email Preview -->
        <div class="email-container">
            <!-- Email Header -->
            <div class="email-header">
                <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) ?? staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" 
                     alt="{{ getSetting('system_title') ?? env('APP_NAME') }}">
                <h1>{{ getSetting('system_title') ?? env('APP_NAME') }}</h1>
            </div>

            <!-- Email Content -->
            <div class="email-content">
                {!! nl2br($content) !!}
            </div>

            <!-- Email Footer -->
            <div class="email-footer">
                <p>{{ getSetting('system_title') ?? env('APP_NAME') }}</p>
                <p>{{ getSetting('topbar_location') ?? 'Your Business Address' }}</p>
                <p>{{ getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS') }}</p>
                <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
                    {{ localize('This is a preview of your email campaign.') }}
                </p>
            </div>
        </div>

        <!-- Preview Actions -->
        <div class="preview-actions">
            <a href="javascript:window.close()" class="btn btn-secondary">
                {{ localize('Close Preview') }}
            </a>
            @if($campaign->status === 'draft')
                <a href="{{ route('admin.email-marketing.campaigns.edit', $campaign) }}" class="btn btn-primary">
                    {{ localize('Edit Campaign') }}
                </a>
                <a href="{{ route('admin.email-marketing.campaigns.show', $campaign) }}" class="btn btn-success">
                    {{ localize('Send Campaign') }}
                </a>
            @else
                <a href="{{ route('admin.email-marketing.campaigns.show', $campaign) }}" class="btn btn-primary">
                    {{ localize('View Campaign') }}
                </a>
            @endif
        </div>
    </div>

    <script>
        // Auto-close if opened in popup
        if (window.opener) {
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.close();
                }
            });
        }
    </script>
</body>
</html>
