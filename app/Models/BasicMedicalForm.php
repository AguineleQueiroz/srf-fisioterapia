<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class BasicMedicalForm extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'basic_medical_forms';

    protected $fillable = [
        'patient_name',
        'cpf',
        'birth_date',
        'gender',
        'phone',
        'card_sus',
        'address',
        'primary_care_clinic',
        'community_health_worker',
        'diagnosis',
        'comorbidity',
        'last_hospitalization',
        'registered_by',
        'doctor_name',
        'priority',
        'registered',
        'tenant_id'
    ];

    protected $appends = [
        'formatted_registered',
        'formatted_cpf',
        'formatted_gender',
        'formatted_birthdate',
        'formatted_last_hospitalization'
    ];

    /**
     * @return LengthAwarePaginator
     */
    public function basicMedicalForms(): LengthAwarePaginator
    {
        return self::query()
            ->with(['primaryMedicalForms', 'secondaryMedicalForms'])
            ->orderByDesc('created_at')
            ->paginate(7);
    }

    public function create(array $data)
    {
        return self::query()->create($data);
    }

    public function primaryMedicalForms(): HasMany {
        return $this->hasMany(PrimaryMedicalForm::class, 'basic_medical_form_id');
    }

    public function secondaryMedicalForms(): HasMany
    {
        return $this->hasMany(SecondaryMedicalForm::class, 'basic_medical_form_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return string
     */
    public function getFormattedRegisteredAttribute(): string
    {
        return Carbon::parse($this->attributes['registered'])->format('d/m/Y');
    }

    public function getFormattedCpfAttribute(): string
    {
        if($this->attributes['cpf']) {
            $cpf = preg_replace('/\D/', '', $this->attributes['cpf']);
            return substr($cpf, 0, 3) . '.'
                . substr($cpf, 3, 3) . '.'
                . substr($cpf, 6, 3) . '-'
                . substr($cpf, 9, 2);
        }
        return '---';
    }

    public function getFormattedGenderAttribute(): string
    {
        return $this->attributes['gender'] === 'male' ? 'Masculino' : 'Feminino';
    }

    public function getFormattedBirthdateAttribute(): string
    {
        return Carbon::parse($this->attributes['birth_date'])->format('d/m/Y');
    }

    public function getFormattedLastHospitalizationAttribute(): string
    {
        return Carbon::parse($this->attributes['last_hospitalization'])->format('d/m/Y');
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
