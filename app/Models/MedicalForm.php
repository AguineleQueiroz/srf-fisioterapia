<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MedicalForm extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'medical_forms';

    protected $appends = [ 'formatted_registered', 'formatted_cpf' ];

    protected $fillable = [
        'user_id',
        'basic_medical_form_id',
        'primary_medical_form_id',
        'secondary_medical_form_id',
        'referral',
        'city',
    ];

    /**
     * @return LengthAwarePaginator
     */
    public function medicalForms(): LengthAwarePaginator
    {
        return self::query()
            ->leftJoin('basic_medical_forms', 'basic_medical_forms.id', '=', 'medical_forms.basic_medical_form_id')
            ->leftJoin('primary_medical_forms', 'primary_medical_forms.id', '=', 'medical_forms.primary_medical_form_id')
            ->leftJoin('secondary_medical_forms', 'secondary_medical_forms.id', '=', 'medical_forms.secondary_medical_form_id')
            ->select([
                'medical_forms.*',
                'basic_medical_forms.*',
                'primary_medical_forms.*',
                'secondary_medical_forms.*'
            ])
            ->paginate(7);
    }

    /**
     * @return string
     */
    public function getFormattedRegisteredAttribute(): string
    {
        return Carbon::parse($this->attributes['registered'])->format('d/m/Y');
    }

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

}
