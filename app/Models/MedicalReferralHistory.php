<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MedicalReferralHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'referral_id',
        'referral_details',
        'referral_date',
        'city',
        'tenant_id'
    ];


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
}
