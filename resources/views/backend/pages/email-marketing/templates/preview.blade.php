<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ localize('Preview') }}: {{ $template->name }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div class="preview-container" style="max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
        <!-- Preview Header -->
        <div class="preview-header" style="background: #2c3e50; color: white; padding: 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">{{ localize('Email Template Preview') }}</h1>
        </div>

        <!-- Template Info -->
        <div class="preview-info" style="background: #ecf0f1; padding: 15px 20px; border-bottom: 1px solid #bdc3c7;">
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Template Name') }}:</strong> {{ $template->name }}</p>
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Subject') }}:</strong> {{ $renderedSubject }}</p>
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Type') }}:</strong> {{ ucfirst($template->type) }}</p>
            <p style="margin-bottom: 15px;"><strong style="color: #2c3e50;">{{ localize('Status') }}:</strong> 
                <span style="color: {{ $template->is_active ? '#27ae60' : '#e74c3c' }}">
                    {{ $template->is_active ? localize('Active') : localize('Inactive') }}
                </span>
            </p>
        </div>

        <!-- Email Preview -->
        <div class="email-container" style="max-width: 600px; margin: 20px auto; background: white; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
            <!-- Email Header -->
            <div class="email-header" style="background: #2c3e50; color: white; padding: 30px 20px; text-align: center;">
                <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) ?? staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" 
                     alt="{{ getSetting('system_title') ?? env('APP_NAME') }}" style="max-height: 60px; width: auto; margin-bottom: 15px;">
                <h1 style="margin: 0; font-size: 28px; font-weight: 300;">{{ getSetting('system_title') ?? env('APP_NAME') }}</h1>
            </div>

            <!-- Email Content -->
            <div class="email-content" style="padding: 30px 20px; color: #333; line-height: 1.8;">
                {!! nl2br($renderedContent) !!}
            </div>

            <!-- Email Footer -->
            <div class="email-footer" style="background: #2c3e50; color: white; padding: 20px; text-align: center; font-size: 14px;">
                <p style="margin: 5px 0;">{{ getSetting('system_title') ?? env('APP_NAME') }}</p>
                <p style="margin: 5px 0;">{{ getSetting('topbar_location') ?? 'Your Business Address' }}</p>
                <p style="margin: 5px 0;">{{ getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS') }}</p>
                <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
                    {{ localize('This is a preview of your email template. Variables have been replaced with sample data.') }}
                </p>
            </div>
        </div>

        <!-- Preview Actions -->
        <div class="preview-actions" style="padding: 20px; text-align: center; background: #f8f9fa;">
            <a href="javascript:window.close()" class="btn btn-secondary" style="display: inline-block; padding: 10px 20px; margin: 0 5px; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease; background: #95a5a6; color: white;">
                {{ localize('Close Preview') }}
            </a>
            <a href="{{ route('admin.email-marketing.templates.edit', $template) }}" class="btn btn-primary" style="display: inline-block; padding: 10px 20px; margin: 0 5px; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease; background: #3498db; color: white;">
                {{ localize('Edit Template') }}
            </a>
        </div>
    </div>
        <!-- Preview Header -->
        <!-- <div class="preview-header">
            <h1>{{ localize('Email Template Preview') }}</h1>
        </div> -->

        <!-- Template Info -->
        <!-- <div class="preview-info">
            <p><strong>{{ localize('Template Name') }}:</strong> {{ $template->name }}</p>
            <p><strong>{{ localize('Subject') }}:</strong> {{ $renderedSubject }}</p>
            <p><strong>{{ localize('Type') }}:</strong> {{ ucfirst($template->type) }}</p>
            <p><strong>{{ localize('Status') }}:</strong> 
                <span style="color: {{ $template->is_active ? '#27ae60' : '#e74c3c' }}">
                    {{ $template->is_active ? localize('Active') : localize('Inactive') }}
                </span>
            </p>
        </div> -->

        <!-- Email Preview -->
        <!-- <div class="email-container"> -->
            <!-- Email Header -->
            <!-- <div class="email-header">
                <img src="{{ uploadedAsset(getSetting('admin_panel_logo')) ?? staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg') }}" 
                     alt="{{ getSetting('system_title') ?? env('APP_NAME') }}">
                <h1>{{ getSetting('system_title') ?? env('APP_NAME') }}</h1>
            </div> -->

            <!-- Email Content -->
            <!-- <div class="email-content">
                {!! nl2br($renderedContent) !!}
            </div> -->

            <!-- Email Footer -->
            <!-- <div class="email-footer">
                <p>{{ getSetting('system_title') ?? env('APP_NAME') }}</p>
                <p>{{ getSetting('topbar_location') ?? 'Your Business Address' }}</p>
                <p>{{ getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS') }}</p>
                <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
                    {{ localize('This is a preview of your email template. Variables have been replaced with sample data.') }}
                </p>
            </div>
        </div> -->

        <!-- Preview Actions -->
        <!-- <div class="preview-actions">
            <a href="javascript:window.close()" class="btn btn-secondary">
                {{ localize('Close Preview') }}
            </a>
            <a href="{{ route('admin.email-marketing.templates.edit', $template) }}" class="btn btn-primary">
                {{ localize('Edit Template') }}
            </a>
        </div> -->
    <!-- </div> -->

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
