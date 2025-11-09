<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Carbon\Carbon;
use Exception;
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
        'primary_care_clinic',
        'community_health_worker',
        'diagnosis',
        'comorbidity',
        'last_hospitalization',
        'registered_by',
        'doctor_name',
        'priority',
        'registered',
        'user_id',
        'patient_id', // patient related to the form
    ];

    protected $appends = [
        'formatted_registered',
        'formatted_last_hospitalization'
    ];

    /**
     * @param null $search
     * @return LengthAwarePaginator
     */
    public function basicMedicalForms($search = null): LengthAwarePaginator
    {
        $search = str_replace(['-', '.'], '', $search);
        return self::query()
            ->with(['patient', 'patient.address', 'primaryMedicalForms', 'secondaryMedicalForms'])
            ->when(
                $search,
                fn($query) =>
                    $query->select('*')->whereHas('patient', function($q) use ($search) {
                        $q->whereAny(['patient_name', 'cpf', 'card_sus'], 'like', '%' . $search . '%');
                    })
            )
            ->orderByDesc('created_at')
            ->paginate(7)
            ->withQueryString();
    }

    /**
     * @param $userId
     * @return LengthAwarePaginator
     */
    public function basicMedicalFormsByUserId($userId): LengthAwarePaginator
    {
        return self::query()
            ->where('user_id', $userId)
            ->with(['patient', 'patient.address', 'primaryMedicalForms', 'secondaryMedicalForms'])
            ->orderByDesc('created_at')
            ->paginate(7)
            ->withQueryString();
    }

    /**
     * @param $id
     * @return LengthAwarePaginator
     */
    public function basicMedicalFormById($id): LengthAwarePaginator
    {
        return self::query()
            ->where('id', $id)
            ->with(['primaryMedicalForms', 'secondaryMedicalForms'])
            ->orderByDesc('created_at')
            ->paginate(7);
    }

    /**
     * @param array $data
     * @return BasicMedicalForm|null
     */
    public function create(array $data): ?BasicMedicalForm {
        try {
            $patientCreated = (new Patient)->create($data);
            if(!$patientCreated) {
                return null;
            }

            $data['city'] = (new Tenant)->city($patientCreated->tenant_id) ?? null;
            $patientCreated->address()->create($data);

            $data['patient_id'] = $patientCreated->id;
            $basicMedicalFormCreated = self::query()->create($data);

            return $basicMedicalFormCreated ?: null;
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @param array $data
     * @return BasicMedicalForm|null
     */
    public function edit(array $data): BasicMedicalForm | bool
    {
        try {
            if(!isset($data['id'])) {
                return false;
            }
            $basicMedicalForm = self::query()->find($data['id']);
            if(!$basicMedicalForm) {
                return false;
            }
            $data['city'] = (new Tenant)->city($basicMedicalForm->patient->tenant_id) ?? null;

            $patientUpdated = $basicMedicalForm->patient->update($data);

            $patientAddress = $basicMedicalForm->patient->address->first();
            $patientAddress->update($data);

            $basicMedicalFormUpdated = $basicMedicalForm->update($data);
            return $patientUpdated && $basicMedicalFormUpdated ? $basicMedicalFormUpdated : false;
        } catch (Exception $exception) {
            return false;
        }
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id')->withoutGlobalScopes();
    }

    /**
     * @return HasMany
     */
    public function primaryMedicalForms(): HasMany
    {
        return $this->hasMany(PrimaryMedicalForm::class, 'basic_medical_form_id');
    }

    /**
     * @return HasMany
     */
    public function secondaryMedicalForms(): HasMany
    {
        return $this->hasMany(SecondaryMedicalForm::class, 'basic_medical_form_id');
    }

    /**
     * @return string
     */
    public function getFormattedRegisteredAttribute(): string
    {
        return Carbon::parse($this->attributes['registered'])->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function getFormattedLastHospitalizationAttribute(): string
    {
        return Carbon::parse($this->attributes['last_hospitalization'])->format('d/m/Y');
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->ulid = (string) Str::ulid();
        });
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'ulid';
    }
}
