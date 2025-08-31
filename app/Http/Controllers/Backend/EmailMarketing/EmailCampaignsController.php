<?php

namespace App\Http\Controllers\Backend\EmailMarketing;

use App\Http\Controllers\Controller;
use App\Models\EmailCampaign;
use App\Models\EmailTemplate;
use App\Models\SubscribedUser;
use App\Models\User;
use App\Models\Location;
use App\Mail\EmailManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class EmailCampaignsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:email_marketing']);
    }

    /**
     * Display a listing of campaigns
     */
    public function index(Request $request)
    {
        $query = EmailCampaign::with(['template', 'creator'])->latest();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by audience type
        if ($request->filled('audience_type')) {
            $query->where('audience_type', $request->audience_type);
        }

        $campaigns = $query->paginate(15);
        $statuses = EmailCampaign::distinct()->pluck('status');
        $audienceTypes = EmailCampaign::distinct()->pluck('audience_type');

        return view('backend.pages.email-marketing.campaigns.index', compact('campaigns', 'statuses', 'audienceTypes'));
    }

    /**
     * Show the form for creating a new campaign
     */
    public function create()
    {
        $templates = EmailTemplate::active()->get();
        $locations = Location::where('is_published', 1)->get();

        // Get audience statistics
        $subscribersCount = SubscribedUser::count();
        $customersCount = User::where('user_type', 'customer')->whereNotNull('email')->count();
        $customersWithOrdersCount = User::where('user_type', 'customer')
                                       ->whereNotNull('email')
                                       ->whereHas('orders')
                                       ->count();

        $audienceStats = [
            'subscribers' => $subscribersCount,
            'customers' => $customersCount,
            'customers_with_orders' => $customersWithOrdersCount,
            'total_unique' => collect([
                SubscribedUser::pluck('email'),
                User::where('user_type', 'customer')->whereNotNull('email')->pluck('email')
            ])->flatten()->unique()->count()
        ];

        return view('backend.pages.email-marketing.campaigns.create', compact('templates', 'locations', 'audienceStats'));
    }

    /**
     * Store a newly created campaign
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'template_id' => 'nullable|exists:email_templates,id',
            'audience_type' => 'required|in:all_subscribers,customers_only,customers_with_orders,custom',
            'scheduled_at' => 'nullable|date|after:now',
            'audience_filters' => 'nullable|array',
            'audience_filters.offer_title' => 'nullable|string|max:255',
            'audience_filters.offer_description' => 'nullable|string',
            'audience_filters.discount_percentage' => 'nullable|numeric',
            'audience_filters.promo_code' => 'nullable|string|max:255',
            'audience_filters.valid_until' => 'nullable|date'
        ]);

        $campaign = EmailCampaign::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content,
            'template_id' => $request->template_id,
            'audience_type' => $request->audience_type,
            'audience_filters' => $request->audience_filters ?? [],
            'scheduled_at' => $request->scheduled_at,
            'status' => $request->scheduled_at ? 'scheduled' : 'draft',
            'created_by' => Auth::id()
        ]);

        flash(localize('Email campaign created successfully'))->success();
        return redirect()->route('admin.email-marketing.campaigns.show', $campaign);
    }

    /**
     * Display the specified campaign
     */
    public function show(EmailCampaign $campaign)
    {
        $campaign->load(['template', 'creator']);
        $recipients = $campaign->getRecipients();
        $recipientCount = $recipients->count();

        return view('backend.pages.email-marketing.campaigns.show', compact('campaign', 'recipientCount'));
    }

    /**
     * Show the form for editing the specified campaign
     */
    public function edit(EmailCampaign $campaign)
    {
        if (!$campaign->canBeSent()) {
            flash(localize('Cannot edit campaign that has already been sent'))->error();
            return redirect()->route('admin.email-marketing.campaigns.show', $campaign);
        }

        $templates = EmailTemplate::active()->get();
        $locations = Location::where('is_published', 1)->get();

        return view('backend.pages.email-marketing.campaigns.edit', compact('campaign', 'templates', 'locations'));
    }

    /**
     * Update the specified campaign
     */
    public function update(Request $request, EmailCampaign $campaign)
    {
        if (!$campaign->canBeSent()) {
            flash(localize('Cannot update campaign that has already been sent'))->error();
            return back();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'template_id' => 'nullable|exists:email_templates,id',
            'audience_type' => 'required|in:all_subscribers,customers_only,customers_with_orders,custom',
            'scheduled_at' => 'nullable|date|after:now',
            'audience_filters' => 'nullable|array',
            'audience_filters.offer_title' => 'nullable|string|max:255',
            'audience_filters.offer_description' => 'nullable|string',
            'audience_filters.discount_percentage' => 'nullable|numeric',
            'audience_filters.promo_code' => 'nullable|string|max:255',
            'audience_filters.valid_until' => 'nullable|date'
        ]);

        $campaign->update([
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content,
            'template_id' => $request->template_id,
            'audience_type' => $request->audience_type,
            'audience_filters' => $request->audience_filters ?? [],
            'scheduled_at' => $request->scheduled_at,
            'status' => $request->scheduled_at ? 'scheduled' : 'draft'
        ]);

        flash(localize('Email campaign updated successfully'))->success();
        return redirect()->route('admin.email-marketing.campaigns.show', $campaign);
    }

    /**
     * Remove the specified campaign
     */
    public function destroy(EmailCampaign $campaign)
    {
        if ($campaign->status === 'sending') {
            flash(localize('Cannot delete campaign that is currently being sent'))->error();
            return back();
        }

        $campaign->delete();
        flash(localize('Email campaign deleted successfully'))->success();
        return redirect()->route('admin.email-marketing.campaigns.index');
    }

    /**
     * Send campaign immediately
     */
    public function send(EmailCampaign $campaign)
    {
        if (!$campaign->canBeSent()) {
            flash(localize('Campaign cannot be sent in its current state'))->error();
            return back();
        }

        if (env('MAIL_USERNAME') == null) {
            flash(localize('Please configure SMTP settings first'))->error();
            return back();
        }

        // Mark campaign as sending
        $campaign->markAsSending();

        // Get recipients
        $recipients = $campaign->getRecipients();

        if ($recipients->isEmpty()) {
            $campaign->update(['status' => 'draft']);
            flash(localize('No recipients found for this campaign'))->error();
            return back();
        }

        // Send emails in batches
        $this->sendCampaignEmails($campaign, $recipients);

        flash(localize('Campaign is being sent. You will be notified when complete.'))->success();
        return back();
    }

    /**
     * Send campaign emails in batches
     */
    private function sendCampaignEmails(EmailCampaign $campaign, $recipients)
    {
        $batchSize = 50; // Send 50 emails at a time
        $batches = $recipients->chunk($batchSize);
        $totalSent = 0;
        $totalFailed = 0;

        foreach ($batches as $batch) {
            $batchSent = 0;
            $batchFailed = 0;

            foreach ($batch as $email) {
                try {
                    // Prepare email data with variables
                    // Get customer name if available
                    $customerName = 'Valued Customer';
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $customer = User::where('email', $email)->first();
                        if ($customer) {
                            $customerName = $customer->name;
                        }
                    }
                    
                    // Prepare variables for template
                    $variables = [
                        '{{CUSTOMER_NAME}}' => $customerName,
                        '{{CUSTOMER_EMAIL}}' => $email,
                        '{{OFFER_TITLE}}' => $campaign->audience_filters['offer_title'] ?? 'Special Offer',
                        '{{OFFER_DESCRIPTION}}' => $campaign->audience_filters['offer_description'] ?? 'Check out our latest products and offers',
                        '{{DISCOUNT_PERCENTAGE}}' => $campaign->audience_filters['discount_percentage'] ?? '10',
                        '{{PROMO_CODE}}' => $campaign->audience_filters['promo_code'] ?? 'SPECIAL10',
                        '{{VALID_UNTIL}}' => $campaign->audience_filters['valid_until'] ?? date('F j, Y', strtotime('+30 days')),
                    ];
                    
                    // Render content with variables
                    $content = $campaign->content;
                    if ($campaign->template) {
                        $content = $campaign->template->renderContent($variables);
                    } else {
                        // Replace variables in content if no template is used
                        foreach ($variables as $placeholder => $value) {
                            $content = str_replace($placeholder, $value, $content);
                        }
                    }
                    
                    // Also replace variables in subject
                    $subject = $campaign->subject;
                    foreach ($variables as $placeholder => $value) {
                        $subject = str_replace($placeholder, $value, $subject);
                    }
                    
                    $emailData = [
                        'view' => 'emails.marketing.campaign',
                        'subject' => $subject,
                        'from' => env('MAIL_FROM_ADDRESS'),
                        'content' => $content,
                        'campaign' => $campaign
                    ];

                    // Send email
                    Mail::to($email)->queue(new EmailManager($emailData));
                    $batchSent++;
                } catch (\Exception $e) {
                    $batchFailed++;
                    \Log::error('Campaign email failed: ' . $e->getMessage(), [
                        'campaign_id' => $campaign->id,
                        'email' => $email
                    ]);
                }
            }

            $totalSent += $batchSent;
            $totalFailed += $batchFailed;

            // Update campaign statistics
            $campaign->updateSendingStats($batchSent, $batchFailed);

            // Small delay between batches to avoid overwhelming the mail server
            if ($batches->count() > 1) {
                sleep(2);
            }
        }

        // Mark campaign as sent
        $campaign->markAsSent();

        return [
            'sent' => $totalSent,
            'failed' => $totalFailed
        ];
    }

    /**
     * Preview campaign
     */
    public function preview(EmailCampaign $campaign, Request $request)
    {
        // Sample variables for preview
        $sampleVariables = [
            '{{CUSTOMER_NAME}}' => 'John Doe',
            '{{CUSTOMER_EMAIL}}' => 'john@example.com',
            '{{OFFER_TITLE}}' => 'Summer Sale 2024',
            '{{OFFER_DESCRIPTION}}' => 'Get amazing discounts on all summer collection items.',
            '{{DISCOUNT_PERCENTAGE}}' => '50',
            '{{PROMO_CODE}}' => 'SUMMER50',
            '{{VALID_UNTIL}}' => 'December 31, 2024',
        ];

        // Merge with any custom variables from request
        if ($request->filled('variables')) {
            $customVariables = $request->variables;
            foreach ($customVariables as $key => $value) {
                $sampleVariables["{{" . strtoupper($key) . "}}"] = $value;
            }
        }

        // Use template if available, otherwise use campaign content
        if ($campaign->template) {
            $content = $campaign->template->renderContent($sampleVariables);
        } else {
            $content = $campaign->content;
            // Replace variables in content if no template is used
            foreach ($sampleVariables as $placeholder => $value) {
                $content = str_replace($placeholder, $value, $content);
            }
        }

        // Also replace variables in subject
        $subject = $campaign->subject;
        foreach ($sampleVariables as $placeholder => $value) {
            $subject = str_replace($placeholder, $value, $subject);
        }

        return view('backend.pages.email-marketing.campaigns.preview', compact('campaign', 'content', 'subject', 'sampleVariables'));
    }

    /**
     * Get audience count for given filters
     */
    public function getAudienceCount(Request $request)
    {
        $audienceType = $request->audience_type;
        $filters = $request->audience_filters ?? [];

        // Create a temporary campaign to use the getRecipients method
        $tempCampaign = new EmailCampaign([
            'audience_type' => $audienceType,
            'audience_filters' => $filters
        ]);

        $count = $tempCampaign->getRecipients()->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Duplicate campaign
     */
    public function duplicate(EmailCampaign $campaign)
    {
        $newCampaign = $campaign->replicate();
        $newCampaign->name = $campaign->name . ' (Copy)';
        $newCampaign->status = 'draft';
        $newCampaign->scheduled_at = null;
        $newCampaign->sent_at = null;
        $newCampaign->total_recipients = 0;
        $newCampaign->emails_sent = 0;
        $newCampaign->emails_failed = 0;
        $newCampaign->send_statistics = null;
        $newCampaign->created_by = Auth::id();
        $newCampaign->save();

        flash(localize('Campaign duplicated successfully'))->success();
        return redirect()->route('admin.email-marketing.campaigns.edit', $newCampaign);
    }
}
