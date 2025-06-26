<?php

namespace App\Models;

use App\Models\Scopes\OnlyPrimaryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class PrimaryCareProfessional extends User
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        // crefito - Conselho Regional de Fisioterapia e Terapia Ocupacional
        'document',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new OnlyPrimaryScope());
    }

    public function rules($id = null): array
    {
        return array_merge(parent::rules($id), [
            'document' => [
                'required', 'crefito'
            ],
        ]);
    }
}
