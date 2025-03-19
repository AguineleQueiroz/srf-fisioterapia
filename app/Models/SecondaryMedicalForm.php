<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SecondaryMedicalForm extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'secondary_medical_forms';

    protected $fillable = [
        'functional_condition',
        'offered_treatment',
        'functional_progress',
        'sessions',
        'attendance', // Taxa de presença ou frequência nas sessões de tratamento.
        'personal_environmental_condition',
        'physiotherapeutic_diagnosis',
        'criteria',
        'justification',
    ];
}
