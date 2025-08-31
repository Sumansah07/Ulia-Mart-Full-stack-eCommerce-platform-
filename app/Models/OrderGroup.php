<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Guest checkout fields
    protected $casts = [
        'guest_shipping_name' => 'string',
        'guest_shipping_phone' => 'string',
        'guest_shipping_email' => 'string',
        'guest_shipping_address' => 'string',
        'guest_billing_name' => 'string',
        'guest_billing_phone' => 'string',
        'guest_billing_email' => 'string',
        'guest_billing_address' => 'string',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (OrderGroup::first() == null) {
                $model->order_code = getSetting('order_code_start') != null ? (int) getSetting('order_code_start') : 1;
            } else {
                $model->order_code = (int) OrderGroup::max('order_code') + 1;
            }
        });
    }

    # for single vendor hasOne todo::[update version] handle for multiple orders
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'shipping_address_id', 'id');
    }

    public function billingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'billing_address_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get shipping address information (handles both logged-in users and guests)
     */
    public function getShippingAddressInfo()
    {
        if ($this->user_id && $this->shippingAddress) {
            // For logged-in users, use the relationship
            return [
                'name' => $this->shippingAddress->name ?? '',
                'phone' => $this->shippingAddress->phone ?? '',
                'email' => $this->user->email ?? '',
                'address' => $this->shippingAddress->address ?? '',
                'city' => optional($this->shippingAddress->city)->name ?? '',
                'state' => optional($this->shippingAddress->state)->name ?? '',
                'country' => optional($this->shippingAddress->country)->name ?? '',
                'postal_code' => $this->shippingAddress->postal_code ?? '',
            ];
        } else {
            // For guests, use the guest fields
            return [
                'name' => $this->guest_shipping_name ?? '',
                'phone' => $this->guest_shipping_phone ?? '',
                'email' => $this->guest_shipping_email ?? '',
                'address' => $this->guest_shipping_address ?? '',
                'city' => $this->guest_shipping_city ?? '',
                'state' => '',
                'country' => '',
                'postal_code' => '',
            ];
        }
    }

    /**
     * Get billing address information (handles both logged-in users and guests)
     */
    public function getBillingAddressInfo()
    {
        if ($this->user_id && $this->billingAddress) {
            // For logged-in users, use the relationship
            return [
                'name' => $this->billingAddress->name ?? '',
                'phone' => $this->billingAddress->phone ?? '',
                'email' => $this->user->email ?? '',
                'address' => $this->billingAddress->address ?? '',
                'city' => optional($this->billingAddress->city)->name ?? '',
                'state' => optional($this->billingAddress->state)->name ?? '',
                'country' => optional($this->billingAddress->country)->name ?? '',
                'postal_code' => $this->billingAddress->postal_code ?? '',
            ];
        } else {
            // For guests, use the guest fields
            return [
                'name' => $this->guest_billing_name ?? '',
                'phone' => $this->guest_billing_phone ?? '',
                'email' => $this->guest_billing_email ?? '',
                'address' => $this->guest_billing_address ?? '',
                'city' => $this->guest_billing_city ?? '',
                'state' => '',
                'country' => '',
                'postal_code' => '',
            ];
        }
    }

    /**
     * Get customer information (handles both logged-in users and guests)
     */
    public function getCustomerInfo()
    {
        if ($this->user_id && $this->user) {
            // For logged-in users
            return [
                'name' => $this->user->name ?? '',
                'email' => $this->user->email ?? '',
                'phone' => $this->phone_no ?? '',
            ];
        } else {
            // For guests, use guest shipping email or billing email as fallback
            return [
                'name' => $this->guest_shipping_name ?? $this->guest_billing_name ?? '',
                'email' => $this->guest_shipping_email ?? $this->guest_billing_email ?? '',
                'phone' => $this->phone_no ?? $this->guest_shipping_phone ?? $this->guest_billing_phone ?? '',
            ];
        }
    }
}
