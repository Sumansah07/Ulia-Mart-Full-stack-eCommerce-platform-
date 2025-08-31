<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subject',
        'content',
        'type',
        'is_active',
        'variables',
        'preview_image',
        'created_by'
    ];

    protected $casts = [
        'variables' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user who created this template
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get campaigns using this template
     */
    public function campaigns()
    {
        return $this->hasMany(EmailCampaign::class, 'template_id');
    }

    /**
     * Scope for active templates
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Replace template variables with actual values
     */
    public function renderContent($variables = [])
    {
        $content = $this->content;
        
        // Default variables
        $defaultVariables = [
            '{{COMPANY_NAME}}' => getSetting('system_title') ?? env('APP_NAME'),
            '{{COMPANY_EMAIL}}' => getSetting('topbar_email') ?? env('MAIL_FROM_ADDRESS'),
            '{{COMPANY_PHONE}}' => getSetting('navbar_contact_number') ?? '',
            '{{COMPANY_ADDRESS}}' => getSetting('topbar_location') ?? '',
            '{{WEBSITE_URL}}' => env('APP_URL'),
            '{{CURRENT_YEAR}}' => date('Y'),
            '{{CURRENT_DATE}}' => date('F j, Y'),
        ];

        // Merge with provided variables
        $allVariables = array_merge($defaultVariables, $variables);

        // Replace variables in content
        foreach ($allVariables as $placeholder => $value) {
            $content = str_replace($placeholder, $value, $content);
        }

        return $content;
    }

    /**
     * Get available template variables
     */
    public static function getAvailableVariables()
    {
        return [
            'company' => [
                '{{CUSTOMER_NAME}}' => 'Customer Name',
                '{{CUSTOMER_EMAIL}}' => 'Customer Email',
                '{{OFFER_TITLE}}' => 'Offer Title',
                '{{OFFER_DESCRIPTION}}' => 'Offer Description',
                '{{DISCOUNT_PERCENTAGE}}' => 'Discount Percentage',
                '{{PROMO_CODE}}' => 'Promo Code',
                '{{VALID_UNTIL}}' => 'Valid Until',
                '{{COMPANY_NAME}}' => 'Company Name',
                '{{COMPANY_EMAIL}}' => 'Company Email',
                '{{COMPANY_PHONE}}' => 'Company Phone',
                '{{COMPANY_ADDRESS}}' => 'Company Address',
                '{{WEBSITE_URL}}' => 'Website URL',
            ],
            'date' => [
                '{{CURRENT_YEAR}}' => 'Current Year',
                '{{CURRENT_DATE}}' => 'Current Date',
            ],
            'customer' => [
                '{{CUSTOMER_NAME}}' => 'Customer Name',
                '{{CUSTOMER_EMAIL}}' => 'Customer Email',
            ],
            'marketing' => [
                '{{OFFER_TITLE}}' => 'Offer Title',
                '{{OFFER_DESCRIPTION}}' => 'Offer Description',
                '{{DISCOUNT_PERCENTAGE}}' => 'Discount Percentage',
                '{{PROMO_CODE}}' => 'Promo Code',
                '{{VALID_UNTIL}}' => 'Valid Until Date',
            ]
        ];
    }

    /**
     * Create default templates
     */
    public static function createDefaultTemplates()
    {
        $templates = [
            [
                'name' => 'Welcome Newsletter',
                'subject' => 'Welcome to {{COMPANY_NAME}}!',
                'type' => 'marketing',
                'content' => self::getWelcomeTemplate(),
            ],
            [
                'name' => 'Promotional Offer',
                'subject' => 'Special Offer: {{OFFER_TITLE}}',
                'type' => 'promotional',
                'content' => self::getPromotionalTemplate(),
            ],
            [
                'name' => 'New Arrivals',
                'subject' => 'New Arrivals at {{COMPANY_NAME}}',
                'type' => 'announcement',
                'content' => self::getNewArrivalsTemplate(),
            ]
        ];

        foreach ($templates as $template) {
            self::firstOrCreate(
                ['name' => $template['name']],
                $template
            );
        }
    }

    private static function getWelcomeTemplate()
    {
        return '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #f8f9fa;">
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; text-align: center;">
                <h1 style="color: white; margin: 0; font-size: 28px;">Welcome to {{COMPANY_NAME}}!</h1>
            </div>
            <div style="padding: 40px 20px; background: white;">
                <h2 style="color: #333; margin-bottom: 20px;">Hello {{CUSTOMER_NAME}},</h2>
                <p style="color: #666; line-height: 1.6; font-size: 16px;">
                    Thank you for subscribing to our newsletter! We\'re excited to have you as part of our community.
                </p>
                <p style="color: #666; line-height: 1.6; font-size: 16px;">
                    You\'ll be the first to know about our latest products, exclusive offers, and special discounts.
                </p>
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{WEBSITE_URL}}" style="background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        Start Shopping
                    </a>
                </div>
            </div>
            <div style="background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px;">
                <p>© {{CURRENT_YEAR}} {{COMPANY_NAME}}. All rights reserved.</p>
                <p>{{COMPANY_ADDRESS}} | {{COMPANY_EMAIL}} | {{COMPANY_PHONE}}</p>
            </div>
        </div>';
    }

    private static function getPromotionalTemplate()
    {
        return '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #f8f9fa;">
            <div style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); padding: 40px 20px; text-align: center;">
                <h1 style="color: white; margin: 0; font-size: 32px;">{{OFFER_TITLE}}</h1>
                <p style="color: white; font-size: 18px; margin: 10px 0 0 0;">Limited Time Offer!</p>
            </div>
            <div style="padding: 40px 20px; background: white;">
                <h2 style="color: #333; margin-bottom: 20px;">Don\'t Miss Out!</h2>
                <p style="color: #666; line-height: 1.6; font-size: 16px;">
                    {{OFFER_DESCRIPTION}}
                </p>
                <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 20px; margin: 20px 0; border-radius: 5px; text-align: center;">
                    <h3 style="color: #856404; margin: 0 0 10px 0;">Use Promo Code:</h3>
                    <div style="background: #28a745; color: white; padding: 10px 20px; display: inline-block; border-radius: 5px; font-weight: bold; font-size: 18px;">
                        {{PROMO_CODE}}
                    </div>
                </div>
                <p style="color: #dc3545; font-weight: bold; text-align: center;">
                    Valid until: {{VALID_UNTIL}}
                </p>
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{WEBSITE_URL}}" style="background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">
                        Shop Now & Save {{DISCOUNT_PERCENTAGE}}%
                    </a>
                </div>
            </div>
            <div style="background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px;">
                <p>© {{CURRENT_YEAR}} {{COMPANY_NAME}}. All rights reserved.</p>
                <p>{{COMPANY_ADDRESS}} | {{COMPANY_EMAIL}} | {{COMPANY_PHONE}}</p>
            </div>
        </div>';
    }

    private static function getNewArrivalsTemplate()
    {
        return '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #f8f9fa;">
            <div style="background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); padding: 40px 20px; text-align: center;">
                <h1 style="color: white; margin: 0; font-size: 28px;">New Arrivals at {{COMPANY_NAME}}</h1>
                <p style="color: white; font-size: 16px; margin: 10px 0 0 0;">Fresh products just for you!</p>
            </div>
            <div style="padding: 40px 20px; background: white;">
                <h2 style="color: #333; margin-bottom: 20px;">Hello {{CUSTOMER_NAME}},</h2>
                <p style="color: #666; line-height: 1.6; font-size: 16px;">
                    We\'re excited to share our latest collection with you! Check out these amazing new products that just arrived.
                </p>
                <p style="color: #666; line-height: 1.6; font-size: 16px;">
                    Be among the first to explore and purchase these exclusive items before they sell out.
                </p>
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{WEBSITE_URL}}" style="background: #0984e3; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        View New Arrivals
                    </a>
                </div>
            </div>
            <div style="background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px;">
                <p>© {{CURRENT_YEAR}} {{COMPANY_NAME}}. All rights reserved.</p>
                <p>{{COMPANY_ADDRESS}} | {{COMPANY_EMAIL}} | {{COMPANY_PHONE}}</p>
            </div>
        </div>';
    }
}
