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
        // Add IMEPay/FonePay to payment gateways
        PaymentGateway::updateOrCreate([
            'gateway' => 'imepay'
        ], [
            'sandbox'    => 1,
            'is_active'  => 0,
            'type'       => 'sandbox',
            'is_virtual' => 1,
            'is_show'    => 1,
            'image'      => 'public/frontend/pg/imepay.png'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove IMEPay from payment gateways
        PaymentGateway::where('gateway', 'imepay')->delete();
    }
};
