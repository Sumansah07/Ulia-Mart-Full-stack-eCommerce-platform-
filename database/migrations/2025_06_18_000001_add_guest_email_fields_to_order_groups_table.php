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
            // Add guest email fields for shipping and billing
            if (!Schema::hasColumn('order_groups', 'guest_shipping_email')) {
                $table->string('guest_shipping_email')->nullable()->after('guest_shipping_phone');
            }
            if (!Schema::hasColumn('order_groups', 'guest_billing_email')) {
                $table->string('guest_billing_email')->nullable()->after('guest_billing_phone');
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
                'guest_shipping_email',
                'guest_billing_email'
            ]);
        });
    }
};
