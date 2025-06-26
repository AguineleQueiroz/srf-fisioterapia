<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    ];

    protected $appends = [
        'formatted_cpf',
        'formatted_gender',
        'formatted_birthdate'
    ];

    /**
     * @return morphMany
     */
    public function address(): morphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * @return HasMany
     */
    public function forms(): HasMany
    {
        return $this->hasMany(BasicMedicalForm::class, 'patient_id');
    }

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getFormattedGenderAttribute(): string
    {
        return $this->attributes['gender'] === 'male' ? 'Masculino' : 'Feminino';
    }

    /**
     * @return string
     */
    public function getFormattedBirthdateAttribute(): string
    {
        return Carbon::parse($this->attributes['birth_date'])->format('d/m/Y');
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
