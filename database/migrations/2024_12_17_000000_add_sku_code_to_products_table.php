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
        Schema::table('products', function (Blueprint $table) {
            if(!Schema::hasColumn($table->getTable(), 'sku')) {
                $table->string('sku')->nullable()->after('stock_qty');
            }
            if(!Schema::hasColumn($table->getTable(), 'code')) {
                $table->string('code')->nullable()->after('sku');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if(Schema::hasColumn($table->getTable(), 'sku')) {
                $table->dropColumn('sku');
            }
            if(Schema::hasColumn($table->getTable(), 'code')) {
                $table->dropColumn('code');
            }
        });
    }
};
