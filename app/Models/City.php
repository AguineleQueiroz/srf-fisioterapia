<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'state_code',
        'status'
    ];

    public function cities(): array
    {
        return self::query()->get()->toArray();
    }
}
