<?php

namespace App\Http\Requests\Srf;

use Illuminate\Foundation\Http\FormRequest;

class SecondaryMedicalFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'functional_condition' => 'nullable|string',
            'offered_treatment' => 'nullable|string',
            'functional_progress' => 'nullable|string',
            'sessions' => 'nullable|string',
            'attendance' => 'nullable|string',
            'personal_environmental_condition' => 'nullable|string',
            'physiotherapeutic_diagnosis' => 'nullable|string',
            'criteria' => 'nullable|string',
            'justification' => 'nullable|string',
            'basic_medical_form_id' => 'required|exists:basic_medical_forms,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'functional_condition.string' => 'A condição funcional deve ser um texto.',
            'offered_treatment.string' => 'O tratamento oferecido deve ser um texto.',
            'functional_progress.string' => 'O progresso funcional deve ser um texto.',
            'sessions.string' => 'O campo sessões deve ser um texto.',
            'attendance.string' => 'O campo presença deve ser um texto.',
            'personal_environmental_condition.string' => 'A condição ambiental pessoal deve ser um texto.',
            'physiotherapeutic_diagnosis.string' => 'O diagnóstico fisioterapêutico deve ser um texto.',
            'criteria.string' => 'Os critérios devem ser um texto.',
            'justification.string' => 'A justificativa deve ser um texto.',
            'basic_medical_form_id.required' => 'O ID do formulário médico básico é obrigatório.',
            'basic_medical_form_id.exists' => 'O formulário médico básico informado não existe.',
        ];
    }
}
