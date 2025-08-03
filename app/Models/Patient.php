<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'patients';

    protected $fillable = [
        'patient_name',
        'cpf',
        'birth_date',
        'gender',
        'phone',
        'card_sus',
        'tenant_id', // local/city
    ];

    protected $appends = [
        'formatted_cpf',
        'formatted_gender',
        'formatted_birthdate'
    ];

    /**
     * @param array $data
     * @return Patient|null
     */
    public function create(array $data): ?Patient
    {
        try {
            return self::query()->create($data);
        } catch (Exception $exception) {
            logger()->error(
                'Error trying to save patient: '.$exception->getMessage(),
                [ 'exception' => $exception ]
            );
            return null;
        }
    }

    /**
     * @return morphMany
     */
    public function address(): morphMany
    {
        return $this->morphMany(Address::class, 'addressable');
        //return $this->morphMany(Address::class, 'addressable_type', 'addressable_id');
    }

    /**
     * @return HasMany
     */
    public function BasicMedicalForm(): HasMany
    {
        return $this->hasMany(BasicMedicalForm::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return string
     */
    public function getFormattedCpfAttribute(): string
    {
        logger()->info($this->cpf);
        if($this->cpf) {
            $cpf = preg_replace('/\D/', '', $this->cpf);
            return substr($cpf, 0, 3) . '.'
                . substr($cpf, 3, 3) . '.'
                . substr($cpf, 6, 3) . '-'
                . substr($cpf, 9, 2);
        }
        return '---';
    }

    /**
     * @return string
     */
    public function getFormattedGenderAttribute(): string
    {
        return $this->gender === 'male' ? 'Masculino' : 'Feminino';
    }

    /**
     * @return string
     */
    public function getFormattedBirthdateAttribute(): string
    {
        return Carbon::parse($this->birth_date)->format('d/m/Y');
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
