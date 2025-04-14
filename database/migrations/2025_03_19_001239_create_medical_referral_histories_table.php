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
        if(!Schema::hasTable('medical_referral_histories')){
            Schema::create('medical_referral_histories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('basic_medical_form_id')->constrained('basic_medical_forms')->cascadeOnDelete();
                $table->string('referral');

                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('medical_referral_histories')){
            Schema::dropIfExists('medical_referral_histories');
        }
    }
};
