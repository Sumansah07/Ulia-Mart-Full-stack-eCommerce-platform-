<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order_groups', function (Blueprint $table) {
            $table->string('guest_shipping_name')->nullable();
            $table->string('guest_shipping_phone')->nullable();
            $table->string('guest_shipping_address')->nullable();
            $table->string('guest_shipping_city')->nullable();
            $table->string('guest_billing_name')->nullable();
            $table->string('guest_billing_phone')->nullable();
            $table->string('guest_billing_address')->nullable();
            $table->string('guest_billing_city')->nullable();
        });
    }

    public function down()
    {
        Schema::table('order_groups', function (Blueprint $table) {
            $table->dropColumn('guest_shipping_name');
            $table->dropColumn('guest_shipping_phone');
            $table->dropColumn('guest_shipping_address');
            $table->dropColumn('guest_shipping_city');
            $table->dropColumn('guest_billing_name');
            $table->dropColumn('guest_billing_phone');
            $table->dropColumn('guest_billing_address');
            $table->dropColumn('guest_billing_city');
        });
    }
};
