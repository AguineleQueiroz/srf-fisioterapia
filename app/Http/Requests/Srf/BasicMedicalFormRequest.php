<?php

namespace App\Http\Requests\Srf;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BasicMedicalFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => $this->cpf ? preg_replace('/\D/', '', $this->cpf) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public static function rules(): array
    {
        return [
            'id' => 'nullable|numeric|exists:basic_medical_forms,id',
            'patient_name' => 'required|string|max:255',
            'cpf' => request()->exists('id')
                ? 'nullable|cpf|string|size:11'
                : 'nullable|cpf|string|unique:basic_medical_forms,cpf|size:11',
            'birth_date' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|string',
            'card_sus' => request()->exists('id')
                ? 'required|string'
                : 'required|string|unique:basic_medical_forms,card_sus',
            'address' => 'required|string|max:255',
            'primary_care_clinic' => 'required|string|max:255',
            'community_health_worker' => 'required|string|max:255',
            'diagnosis' => 'nullable|string',
            'comorbidity' => 'nullable|string',
            'last_hospitalization' => 'nullable|date|before_or_equal:today',
            'registered_by' => 'required|string|max:255',
            'doctor_name' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'registered' => 'required|date|before_or_equal:today',
            'tenant_id' => 'required|exists:tenants,id',
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
            'patient_name.required' => 'O nome do paciente é obrigatório.',
            'patient_name.string' => 'O nome do paciente deve ser um texto.',
            'patient_name.max' => 'O nome do paciente não pode ter mais que 255 caracteres.',

            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
            'cpf.size' => 'O CPF deve conter 11 caracteres.',

            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'birth_date.before_or_equal' => 'A data de nascimento não pode ser futura.',

            'gender.required' => 'O gênero é obrigatório.',
            'gender.in' => 'O gênero deve ser masculino ou feminino.',

            'card_sus.required' => 'O número do cartão SUS é obrigatório.',
            'card_sus.unique' => 'Este número de cartão SUS já está cadastrado no sistema.',

            'address.required' => 'O endereço é obrigatório.',
            'address.max' => 'O endereço não pode ter mais que 255 caracteres.',

            'primary_care_clinic.required' => 'A clínica de atenção primária é obrigatória.',
            'primary_care_clinic.max' => 'O nome da clínica não pode ter mais que 255 caracteres.',

            'community_health_worker.required' => 'O nome do agente comunitário de saúde é obrigatório.',
            'community_health_worker.max' => 'O nome do agente não pode ter mais que 255 caracteres.',

            'last_hospitalization.date' => 'A data da última hospitalização deve ser uma data válida.',
            'last_hospitalization.before_or_equal' => 'A data da última hospitalização não pode ser futura.',

            'registered_by.required' => 'O nome do registrador é obrigatório.',
            'registered_by.max' => 'O nome do registrador não pode ter mais que 255 caracteres.',

            'doctor_name.required' => 'O nome do médico é obrigatório.',
            'doctor_name.max' => 'O nome do médico não pode ter mais que 255 caracteres.',

            'priority.required' => 'A prioridade é obrigatória.',
            'priority.in' => 'A prioridade deve ser baixa, média ou alta.',

            'registered.required' => 'A data de registro é obrigatória.',
            'registered.date' => 'A data de registro deve ser uma data válida.',
            'registered.before_or_equal' => 'A data de registro não pode ser futura.',
        ];
    }
}
