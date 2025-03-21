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
        if (!Schema::hasTable('basic_medical_forms')) {
            Schema::create('basic_medical_forms', function (Blueprint $table) {
                $table->id();
                $table->string('patient_name');
                $table->string('cpf')->unique()->nullable();
                $table->date('birth_date');
                $table->enum('gender', ['male', 'female']);
                $table->string('phone')->nullable();
                $table->string('card_sus')->unique();
                $table->string('address');
                $table->string('primary_care_clinic');
                $table->string('community_health_worker');
                $table->text('diagnosis')->nullable();
                $table->text('comorbidity')->nullable();
                $table->date('last_hospitalization')->nullable();
                $table->string('registered_by');
                $table->string('doctor_name');
                $table->enum('priority', ['low', 'medium', 'high']);
                $table->date('registered')->index();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('basic_medical_forms')) {
            Schema::dropIfExists('basic_medical_forms');
        }
    }
};
