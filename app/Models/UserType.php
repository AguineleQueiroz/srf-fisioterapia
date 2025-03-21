<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    use HasFactory;

    protected $table = 'user_types';
    protected $fillable = [
        'type',
        'code',
        'active',
    ];

    public function types(): array
    {
        return self::query()->get()->toArray();
    }
}
