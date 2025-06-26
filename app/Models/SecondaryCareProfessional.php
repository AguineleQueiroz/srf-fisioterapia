<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class SecondaryCareProfessional extends User
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        // crefito - Conselho Regional de Fisioterapia e Terapia Ocupacional
        'document',
    ];

    public function rules($id = null): array
    {
        return array_merge(parent::rules($id), [
            'document' => [
                'required', 'crefito'
            ],
        ]);
    }
}
