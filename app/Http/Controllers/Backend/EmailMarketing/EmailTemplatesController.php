<?php

namespace App\Http\Controllers\Backend\EmailMarketing;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailTemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:email_marketing'])->except(['preview']);
    }

    /**
     * Display a listing of email templates
     */
    public function index(Request $request)
    {
        $query = EmailTemplate::with('creator')->latest();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $templates = $query->paginate(15);
        $types = EmailTemplate::distinct()->pluck('type');

        return view('backend.pages.email-marketing.templates.index', compact('templates', 'types'));
    }

    /**
     * Show the form for creating a new template
     */
    public function create()
    {
        $availableVariables = EmailTemplate::getAvailableVariables();
        return view('backend.pages.email-marketing.templates.create', compact('availableVariables'));
    }

    /**
     * Store a newly created template
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:email_templates,name',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:marketing,promotional,announcement',
            'is_active' => 'boolean'
        ]);

        $template = EmailTemplate::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content,
            'type' => $request->type,
            'is_active' => $request->boolean('is_active', true),
            'created_by' => Auth::id()
        ]);

        flash(localize('Email template created successfully'))->success();
        return redirect()->route('admin.email-marketing.templates.index');
    }

    /**
     * Display the specified template
     */
    public function show(EmailTemplate $template)
    {
        $template->load('creator', 'campaigns');
        return view('backend.pages.email-marketing.templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified template
     */
    public function edit(EmailTemplate $template)
    {
        $availableVariables = EmailTemplate::getAvailableVariables();
        return view('backend.pages.email-marketing.templates.edit', compact('template', 'availableVariables'));
    }

    /**
     * Update the specified template
     */
    public function update(Request $request, EmailTemplate $template)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:email_templates,name,' . $template->id,
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:marketing,promotional,announcement',
            'is_active' => 'boolean'
        ]);

        $template->update([
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content,
            'type' => $request->type,
            'is_active' => $request->boolean('is_active', true)
        ]);

        flash(localize('Email template updated successfully'))->success();
        return redirect()->route('admin.email-marketing.templates.index');
    }

    /**
     * Remove the specified template
     */
    public function destroy(EmailTemplate $template)
    {
        // Check if template is being used in any campaigns
        if ($template->campaigns()->exists()) {
            flash(localize('Cannot delete template that is being used in campaigns'))->error();
            return back();
        }

        $template->delete();
        flash(localize('Email template deleted successfully'))->success();
        return back();
    }

    /**
     * Toggle template status
     */
    public function toggleStatus(EmailTemplate $template)
    {
        $template->update(['is_active' => !$template->is_active]);

        $status = $template->is_active ? 'activated' : 'deactivated';
        flash(localize("Email template {$status} successfully"))->success();

        return back();
    }

    /**
     * Preview template with sample data
     */
    public function preview(EmailTemplate $template, Request $request)
    {
        // Sample variables for preview
        $sampleVariables = [
            '{{CUSTOMER_NAME}}' => 'Dear Customer',
            '{{CUSTOMER_EMAIL}}' => 'customer@example.com',
            '{{OFFER_TITLE}}' => 'Summer Sale 2025',
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

        $renderedContent = $template->renderContent($sampleVariables);
        $renderedSubject = str_replace(array_keys($sampleVariables), array_values($sampleVariables), $template->subject);

        if ($request->ajax()) {
            return response()->json([
                'subject' => $renderedSubject,
                'content' => $renderedContent
            ]);
        }

        return view('backend.pages.email-marketing.templates.preview', compact('template', 'renderedContent', 'renderedSubject'));
    }

    /**
     * Duplicate an existing template
     */
    public function duplicate(EmailTemplate $template)
    {
        $newTemplate = $template->replicate();
        $newTemplate->name = $template->name . ' (Copy)';
        $newTemplate->created_by = Auth::id();
        $newTemplate->save();

        flash(localize('Email template duplicated successfully'))->success();
        return redirect()->route('admin.email-marketing.templates.edit', $newTemplate);
    }

    /**
     * Create default templates
     */
    public function createDefaults()
    {
        EmailTemplate::createDefaultTemplates();
        flash(localize('Default email templates created successfully'))->success();
        return back();
    }

    /**
     * Show the form for editing sample variables for preview
     */
    public function editSampleVariables()
    {
        // Load from storage or fallback to defaults
        $file = storage_path('app/email_template_sample_variables.json');
        if (file_exists($file)) {
            $sampleVariables = json_decode(file_get_contents($file), true);
        } else {
            $sampleVariables = [
                '{{CUSTOMER_NAME}}' => 'Dear Customer',
                '{{CUSTOMER_EMAIL}}' => 'customer@example.com',
                '{{OFFER_TITLE}}' => 'Summer Sale 2025',
                '{{OFFER_DESCRIPTION}}' => 'Get amazing discounts on all summer collection items.',
                '{{DISCOUNT_PERCENTAGE}}' => '50',
                '{{PROMO_CODE}}' => 'SUMMER50',
                '{{VALID_UNTIL}}' => 'December 31, 2024',
            ];

            // Attempt to fetch a customer for dynamic population
            $customer = User::where('user_type', 'customer')->first();
            if ($customer) {
                $sampleVariables['{{CUSTOMER_NAME}}'] = $customer->name;
                $sampleVariables['{{CUSTOMER_EMAIL}}'] = $customer->email;
            }
        }
        return view('backend.pages.email-marketing.templates.sample_variables', compact('sampleVariables'));
    }

    /**
     * Update and save sample variables for preview
     */
    public function updateSampleVariables(Request $request)
    {
        $variables = $request->input('variables', []);
        $sampleVariables = [];
        foreach ($variables as $key => $value) {
            $sampleVariables['{{' . strtoupper($key) . '}}'] = $value;
        }
        file_put_contents(storage_path('app/email_template_sample_variables.json'), json_encode($sampleVariables, JSON_PRETTY_PRINT));
        flash(localize('Sample variables updated successfully'))->success();
        return back();
    }
}
