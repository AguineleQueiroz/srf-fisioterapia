<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tenant extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tenants';

    protected $fillable = [
        'name',
        'state_code',
        'status'
    ];

    public function tenants(): array
    {
        return self::query()->get()->toArray();
    }

    public function city($id) {
        return self::query()->find($id)?->name;
    }
}
