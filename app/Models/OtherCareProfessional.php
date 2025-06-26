<?php

namespace App\Models;

use App\Models\Scopes\OnlyOtherScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class OtherCareProfessional extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        // crefito - Conselho Regional de Fisioterapia e Terapia Ocupacional
        'document',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new OnlyOtherScope());
    }

    public function rules($id = null): array
    {
        return array_merge(parent::rules($id), [
            'document' => [
                'required',
                'string',
                'min:6',
                // CRM, CRN etc.
            ],
        ]);
    }
}
