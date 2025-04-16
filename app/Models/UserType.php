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

    public static int $ADMIN = 1;
    public static int $MANAGER = 2;
    public static int $BASIC = 3;
    public static int $PRIMARY = 4;
    public static int $SECONDARY = 5;
    public static int $OTHER = 6;

    public function types(): array
    {
        return self::query()->get()->toArray();
    }
}
