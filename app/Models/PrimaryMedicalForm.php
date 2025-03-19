<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PrimaryMedicalForm extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'primary_medical_forms';

    protected $fillable = [
        'pain',
        'pain_description',
        'disability',
        'disability_description',
        'musculoskeletal',
        'musculoskeletal_description',
        'neurological',
        'neurological_description',
        'urogynaecological',
        'urogynaecological_description',
        'cardiovascular',
        'cardiovascular_description',
        'respiratory',
        'respiratory_description',
        'oncological',
        'oncological_description',
        'pediatric',
        'pediatric_description',
        'multiple_conditions',
        'multiple_conditions_description',

        // Text areas
        'complaint',
        'physical_exam_findings',
        'standardized_tests',
        'functional_condition',
        'environmental_factors',
        'physiotherapeutic_diagnosis',

        // Activities the patient participates in
        'walking',
        'pilates_weight_training_functional',
        'sports_activity',
        'never_participated',
        'other_activities',
        'other_activities_description',

        // Previous activities the patient participated in (prefix: prev)
        'prev_walking',
        'prev_pilates_weight_training_functional',
        'prev_sports_activity',
        'prev_never_participated',
        'prev_other_activities',
        'prev_other_activities_description',
    ];
}
