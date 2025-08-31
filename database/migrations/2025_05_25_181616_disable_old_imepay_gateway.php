<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\PaymentGateway\Entities\PaymentGateway;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable the old IMEPay gateway entry to prevent duplicates
        PaymentGateway::where('gateway', 'imepay')->update([
            'is_active' => 0,
            'is_show' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-enable the old IMEPay gateway entry
        PaymentGateway::where('gateway', 'imepay')->update([
            'is_active' => 1,
            'is_show' => 1
        ]);
    }
};
