<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MedicalForm extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'medical_forms';

    protected $fillable = [
        'user_id',
        'basic_medical_form_id',
        'primary_medical_form_id',
        'secondary_medical_form_id',
        'referral',
        'city',
    ];

    public function medicalForms(): array
    {
        return self::query()
            ->leftJoin('basic_medical_forms', 'basic_medical_forms.id', '=', 'medical_forms.basic_medical_form_id')
            ->leftJoin('primary_medical_forms', 'primary_medical_forms.id', '=', 'medical_forms.primary_medical_form_id')
            ->leftJoin('secondary_medical_forms', 'secondary_medical_forms.id', '=', 'medical_forms.secondary_medical_form_id')
            ->select([
                'medical_forms.*',
                'basic_medical_forms.*',
                'primary_medical_forms.*',
                'secondary_medical_forms.*'
            ])
            ->get()
            ->toArray();
    }
}
