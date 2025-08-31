<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->longText('content');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->enum('status', ['draft', 'scheduled', 'sending', 'sent', 'cancelled'])->default('draft');
            $table->enum('audience_type', ['all_subscribers', 'customers_only', 'custom'])->default('all_subscribers');
            $table->json('audience_filters')->nullable(); // Custom audience filters
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->integer('total_recipients')->default(0);
            $table->integer('emails_sent')->default(0);
            $table->integer('emails_failed')->default(0);
            $table->json('send_statistics')->nullable(); // Detailed sending stats
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('template_id')->references('id')->on('email_templates')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'scheduled_at']);
            $table->index(['audience_type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_campaigns');
    }
}
