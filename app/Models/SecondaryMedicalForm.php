<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class SecondaryMedicalForm extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'secondary_medical_forms';

    protected $fillable = [
        'functional_condition',
        'offered_treatment',
        'functional_progress',
        'sessions',
        'attendance', // Rate of attendance or frequency in treatment sessions.
        'personal_environmental_condition',
        'physiotherapeutic_diagnosis',
        'criteria',
        'justification',
    ];

    public function basicMedicalForms(): BelongsTo
    {
        return $this->belongsTo(BasicMedicalForm::class, 'basic_medical_form_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->ulid = (string) Str::ulid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

}
