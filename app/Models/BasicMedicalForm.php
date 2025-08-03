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
        return self::query()
            ->with(['patient', 'patient.address', 'primaryMedicalForms', 'secondaryMedicalForms'])
            ->when(
                $search,
                fn($query) =>
                    $query->select('*')->whereHas('patient', function($q) use ($search) {
                        $q->where('patient_name', 'like', '%' . $search . '%')
                            ->orWhere('cpf', 'like', '%' . $search . '%')
                            ->orWhere('card_sus', 'like', '%' . $search . '%');
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
     * @param array $data
     * @return BasicMedicalForm|null
     */
    public function create(array $data): ?BasicMedicalForm
    {
        try {
            return self::query()->create($data);
        } catch (Exception $exception) {
            logger()->error(
                'Error trying to save medical form record: '.$exception->getMessage(),
                [ 'exception' => $exception ]
            );
            return null;
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function edit(array $data): bool
    {
        try {
            if(!isset($data['id'])) {
                return false;
            }
            $basicMedicalForm = self::query()->find($data['id']);
            if(!$basicMedicalForm) {
                return false;
            }
            return $basicMedicalForm->update($data);
        } catch (Exception $exception) {
            logger()->error(
                'Error trying to update medical form record: '.$exception->getMessage(),
                [ 'exception' => $exception ]
            );
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
