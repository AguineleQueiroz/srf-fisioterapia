<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'address',
        'city',
    ];

    public function rules(): array
    {
        return [
            'addressable_id' => 'required|integer',
            'addressable_type' => 'required|string|in:\App\Models\User,\App\Models\Patient',
            'address' => 'required|string|min:6',
            'city' => 'required|string',
        ];
    }

    /**
     * @param array $data
     * @return Address|null
     */
    public function create(array $data): ?Address
    {
        try {
            return self::query()->create($data);
        } catch (Exception $exception) {
            logger()->error(
                'Error trying to save address: '.$exception->getMessage(),
                [ 'exception' => $exception ]
            );
            return null;
        }
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->ulid = (string) Str::ulid();
        });
        //static::addGlobalScope(new TenantScope);
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }
}
