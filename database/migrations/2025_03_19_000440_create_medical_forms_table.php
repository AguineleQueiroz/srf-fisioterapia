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
        if (!Schema::hasTable('medical_forms')) {
            Schema::create('medical_forms', function (Blueprint $table) {
                $table->id();

                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('basic_medical_form_id')->constrained('basic_medical_forms')->cascadeOnDelete();
                $table->foreignId('primary_medical_form_id')->constrained('primary_medical_forms')->cascadeOnDelete();
                $table->foreignId('secondary_medical_form_id')->constrained('secondary_medical_forms')->cascadeOnDelete();

                $table->string('referral')->nullable();
                $table->string('city')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('medical_forms')){
            Schema::dropIfExists('medical_forms');
        }
    }
};
