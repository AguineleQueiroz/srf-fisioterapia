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

                $table->foreignId('user_id');
                $table->foreignId('medical_form_id');
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->foreign('medical_form_id')->references('id')->on('medical_forms')->cascadeOnDelete();

                $table->string('referral');

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
