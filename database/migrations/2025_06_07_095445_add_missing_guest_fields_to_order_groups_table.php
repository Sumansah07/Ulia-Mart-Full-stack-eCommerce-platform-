<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_groups', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('order_groups', 'guest_shipping_name')) {
                $table->string('guest_shipping_name')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_shipping_phone')) {
                $table->string('guest_shipping_phone')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_shipping_address')) {
                $table->string('guest_shipping_address')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_shipping_city')) {
                $table->string('guest_shipping_city')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_billing_name')) {
                $table->string('guest_billing_name')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_billing_phone')) {
                $table->string('guest_billing_phone')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_billing_address')) {
                $table->string('guest_billing_address')->nullable();
            }
            if (!Schema::hasColumn('order_groups', 'guest_billing_city')) {
                $table->string('guest_billing_city')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_groups', function (Blueprint $table) {
            $table->dropColumn([
                'guest_shipping_name',
                'guest_shipping_phone',
                'guest_shipping_address',
                'guest_shipping_city',
                'guest_billing_name',
                'guest_billing_phone',
                'guest_billing_address',
                'guest_billing_city'
            ]);
        });
    }
};
