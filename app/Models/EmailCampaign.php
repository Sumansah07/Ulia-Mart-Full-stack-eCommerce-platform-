<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailCampaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subject',
        'content',
        'template_id',
        'status',
        'audience_type',
        'audience_filters',
        'scheduled_at',
        'sent_at',
        'total_recipients',
        'emails_sent',
        'emails_failed',
        'send_statistics',
        'created_by'
    ];

    protected $casts = [
        'audience_filters' => 'array',
        'send_statistics' => 'array',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    /**
     * Get the template used for this campaign
     */
    public function template()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }

    /**
     * Get the user who created this campaign
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope for draft campaigns
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope for scheduled campaigns
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope for sent campaigns
     */
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    /**
     * Get recipients based on audience type
     */
    public function getRecipients()
    {
        switch ($this->audience_type) {
            case 'all_subscribers':
                return $this->getAllSubscribers();
            case 'customers_only':
                return $this->getCustomersOnly();
            case 'customers_with_orders':
                return $this->getCustomersWithOrders();
            case 'custom':
                return $this->getCustomAudience();
            default:
                return collect();
        }
    }

    /**
     * Get all subscribers
     */
    private function getAllSubscribers()
    {
        $subscribers = SubscribedUser::pluck('email');
        $customers = User::where('user_type', 'customer')
                        ->whereNotNull('email')
                        ->pluck('email');

        return $subscribers->merge($customers)->unique();
    }

    /**
     * Get customers only (all customers regardless of orders)
     */
    private function getCustomersOnly()
    {
        return User::where('user_type', 'customer')
                   ->whereNotNull('email')
                   ->pluck('email');
    }

    /**
     * Get customers who have made purchases
     */
    private function getCustomersWithOrders()
    {
        return User::where('user_type', 'customer')
                   ->whereNotNull('email')
                   ->whereHas('orders')
                   ->pluck('email');
    }

    /**
     * Get custom audience based on filters
     */
    private function getCustomAudience()
    {
        $query = User::where('user_type', 'customer')->whereNotNull('email');

        if (!empty($this->audience_filters)) {
            $filters = $this->audience_filters;

            // Filter by order count
            if (isset($filters['min_orders'])) {
                $query->has('orders', '>=', $filters['min_orders']);
            }

            // Filter by registration date
            if (isset($filters['registered_after'])) {
                $query->where('created_at', '>=', $filters['registered_after']);
            }

            // Filter by location
            if (isset($filters['location_id'])) {
                $query->where('location_id', $filters['location_id']);
            }
        }

        $customers = $query->pluck('email');

        // Also include subscribers if specified
        if (isset($this->audience_filters['include_subscribers']) && $this->audience_filters['include_subscribers']) {
            $subscribers = SubscribedUser::pluck('email');
            $customers = $customers->merge($subscribers);
        }

        return $customers->unique();
    }

    /**
     * Calculate success rate
     */
    public function getSuccessRateAttribute()
    {
        if ($this->total_recipients == 0) {
            return 0;
        }

        return round(($this->emails_sent / $this->total_recipients) * 100, 2);
    }

    /**
     * Calculate failure rate
     */
    public function getFailureRateAttribute()
    {
        if ($this->total_recipients == 0) {
            return 0;
        }

        return round(($this->emails_failed / $this->total_recipients) * 100, 2);
    }

    /**
     * Check if campaign can be sent
     */
    public function canBeSent()
    {
        return in_array($this->status, ['draft', 'scheduled']);
    }

    /**
     * Mark campaign as sending
     */
    public function markAsSending()
    {
        $this->update([
            'status' => 'sending',
            'total_recipients' => $this->getRecipients()->count()
        ]);
    }

    /**
     * Mark campaign as sent
     */
    public function markAsSent()
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);
    }

    /**
     * Update sending statistics
     */
    public function updateSendingStats($sent, $failed)
    {
        $this->increment('emails_sent', $sent);
        $this->increment('emails_failed', $failed);

        // Update detailed statistics
        $stats = $this->send_statistics ?? [];
        $stats['last_batch_sent'] = $sent;
        $stats['last_batch_failed'] = $failed;
        $stats['last_batch_time'] = now()->toISOString();

        $this->update(['send_statistics' => $stats]);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor()
    {
        switch ($this->status) {
            case 'draft':
                return 'secondary';
            case 'scheduled':
                return 'warning';
            case 'sending':
                return 'info';
            case 'sent':
                return 'success';
            case 'cancelled':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    /**
     * Get audience type label
     */
    public function getAudienceTypeLabel()
    {
        switch ($this->audience_type) {
            case 'all_subscribers':
                return 'All Subscribers';
            case 'customers_only':
                return 'Customers Only';
            case 'custom':
                return 'Custom Audience';
            default:
                return 'Unknown';
        }
    }
}
