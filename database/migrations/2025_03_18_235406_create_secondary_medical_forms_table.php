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
        if(!Schema::hasTable('secondary_medical_forms')){
            Schema::create('secondary_medical_forms', function (Blueprint $table) {
                $table->id();
                $table->ulid()->unique();

                $table->text('functional_condition')->nullable();
                $table->text('offered_treatment')->nullable();
                $table->text('functional_progress')->nullable();
                $table->string('sessions')->nullable();
                $table->string('attendance')->nullable();
                $table->text('personal_environmental_condition')->nullable();
                $table->text('physiotherapeutic_diagnosis')->nullable();
                $table->text('criteria')->nullable();
                $table->text('justification')->nullable();

                /* foreign key to basic medical form related */
                $table->foreignId('basic_medical_form_id')
                    ->constrained('basic_medical_forms')
                    ->cascadeOnDelete();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('secondary_medical_forms')){
            Schema::dropIfExists('secondary_medical_forms');
        }
    }
};
