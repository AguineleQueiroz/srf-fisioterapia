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
        if(!Schema::hasTable('primary_medical_forms')){
            Schema::create('primary_medical_forms', function (Blueprint $table) {
                $table->id();
                $table->ulid()->unique();
                // checkbox and textareas related
                $table->boolean('pain')->default(false);
                $table->text('pain_description')->nullable();

                $table->boolean('disability')->default(false);
                $table->text('disability_description')->nullable();

                $table->boolean('musculoskeletal')->default(false);
                $table->text('musculoskeletal_description')->nullable();

                $table->boolean('neurological')->default(false);
                $table->text('neurological_description')->nullable();

                $table->boolean('urogynaecological')->default(false);
                $table->text('urogynaecological_description')->nullable();

                $table->boolean('cardiovascular')->default(false);
                $table->text('cardiovascular_description')->nullable();

                $table->boolean('respiratory')->default(false);
                $table->text('respiratory_description')->nullable();

                $table->boolean('oncological')->default(false);
                $table->text('oncological_description')->nullable();

                $table->boolean('pediatric')->default(false);
                $table->text('pediatric_description')->nullable();

                $table->boolean('multiple_conditions')->default(false);
                $table->text('multiple_conditions_description')->nullable();

                /* text areas */
                $table->text('complaint')->nullable();
                $table->text('physical_exam_findings')->nullable();
                $table->text('standardized_tests')->nullable();
                $table->text('functional_condition')->nullable();
                $table->text('environmental_factors')->nullable();
                $table->text('physiotherapeutic_diagnosis')->nullable();

                /* activities the patient participates in */
                $table->boolean('mova_se')->default(false);
                $table->boolean('menos_dor_mais_saude')->default(false);
                $table->boolean('peso_saudavel')->default(false);
                $table->boolean('geracao_esporte')->default(false);
                $table->boolean('none_alternatives')->default(false);

                /* previous activities the patient participated in - prefix: prev (previous) */
                $table->boolean('ra_mova_se')->default(false);
                $table->boolean('ra_menos_dor_mais_saude')->default(false);
                $table->boolean('ra_peso_saudavel')->default(false);
                $table->boolean('ra_geracao_esporte')->default(false);
                $table->boolean('ra_none_alternatives')->default(false);

                /* foreign key to basic medical form related */
                $table->foreignId('basic_medical_form_id')
                    ->constrained('basic_medical_forms')
                    ->cascadeOnDelete();

                $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('primary_medical_forms')){
            Schema::dropIfExists('primary_medical_forms');
        }
    }
};
