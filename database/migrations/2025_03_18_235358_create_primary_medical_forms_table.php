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
        if(!Schema::hasTable('primary_medical_form')){
            Schema::create('primary_medical_form', function (Blueprint $table) {
                $table->id();

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
                $table->boolean('walking')->default(false);
                $table->boolean('pilates_weight_training_functional')->default(false);
                $table->boolean('sports_activity')->default(false);
                $table->boolean('never_participated')->default(false);
                $table->boolean('other_activities')->default(false);
                $table->boolean('other_activities_description')->default(false);

                /* previous activities the patient participated in - prefix: prev (previous) */
                $table->boolean('prev_walking')->default(false);
                $table->boolean('prev_pilates_weight_training_functional')->default(false);
                $table->boolean('prev_sports_activity')->default(false);
                $table->boolean('prev_never_participated')->default(false);
                $table->boolean('prev_other_activities')->default(false);
                $table->boolean('prev_other_activities_description')->default(false);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('primary_medical_form')){
            Schema::dropIfExists('primary_medical_form');
        }
    }
};
