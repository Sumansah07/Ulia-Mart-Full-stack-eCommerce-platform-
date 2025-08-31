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
        Schema::table('users', function (Blueprint $table) {
            // Add unique constraint to email column (if not already exists)
            try {
                $table->unique('email');
            } catch (\Exception $e) {
                // Email unique constraint might already exist
            }

            // Add unique constraint to phone column (if not already exists)
            try {
                $table->unique('phone');
            } catch (\Exception $e) {
                // Phone unique constraint might already exist
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop unique constraints
            try {
                $table->dropUnique(['email']);
            } catch (\Exception $e) {
                // Constraint might not exist
            }

            try {
                $table->dropUnique(['phone']);
            } catch (\Exception $e) {
                // Constraint might not exist
            }
        });
    }
};
