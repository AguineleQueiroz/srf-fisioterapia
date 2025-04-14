<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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
        'mova_se',
        'menos_dor_mais_saude',
        'peso_saudavel',
        'geracao_esporte',
        'none_alternatives',

        // Previous activities the patient participated in (prefix: prev)
        'ra_mova_se',
        'ra_menos_dor_mais_saude',
        'ra_peso_saudavel',
        'ra_geracao_esporte',
        'ra_none_alternatives',
        'tenant_id'
    ];

    public function basicMedicalForms(): BelongsTo
    {
        return $this->belongsTo(BasicMedicalForm::class, 'basic_medical_form_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->ulid = (string) Str::ulid();
        });
        static::addGlobalScope(new TenantScope);
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }
}
