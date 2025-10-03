<?php

namespace App\Http\Requests\Srf;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HealthRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',

            'pain' => 'boolean',
            'pain_description' => 'nullable|required_if:pain,true|string|max:200',

            'disability' => 'boolean',
            'disability_description' => 'nullable|required_if:disability,true|string|max:200',

            'musculoskeletal' => 'boolean',
            'musculoskeletal_description' => 'nullable|required_if:musculoskeletal,true|string|max:200',

            'neurological' => 'boolean',
            'neurological_description' => 'nullable|required_if:neurological,true|string|max:200',

            'urogynaecological' => 'boolean',
            'urogynaecological_description' => 'nullable|required_if:urogynaecological,true|string|max:200',

            'cardiovascular' => 'boolean',
            'cardiovascular_description' => 'nullable|required_if:cardiovascular,true|string|max:200',

            'respiratory' => 'boolean',
            'respiratory_description' => 'nullable|required_if:respiratory,true|string|max:200',

            'oncological' => 'boolean',
            'oncological_description' => 'nullable|required_if:oncological,true|string|max:200',

            'pediatric' => 'boolean',
            'pediatric_description' => 'nullable|required_if:pediatric,true|string|max:200',

            'multiple_conditions' => 'boolean',
            'multiple_conditions_description' => 'nullable|required_if:multiple_conditions,true|string|max:200',

            'complaint' => 'nullable|string|max:200',
            'physical_exam_findings' => 'nullable|string|max:200',
            'standardized_tests' => 'nullable|string|max:200',
            'functional_condition' => 'nullable|string|max:200',
            'environmental_factors' => 'nullable|string|max:200',
            'physiotherapeutic_diagnosis' => 'nullable|string|max:200',

            'mova_se' => 'boolean',
            'menos_dor_mais_saude' => 'boolean',
            'peso_saudavel' => 'boolean',
            'geracao_esporte' => 'boolean',
            'none_alternatives' => 'boolean',

            'ra_mova_se' => 'boolean',
            'ra_menos_dor_mais_saude' => 'boolean',
            'ra_peso_saudavel' => 'boolean',
            'ra_geracao_esporte' => 'boolean',
            'ra_none_alternatives' => 'boolean',

            'basic_medical_form_id' => 'required|integer|exists:basic_medical_forms,id',
            'tenant_id' => 'required|integer|exists:tenants,id',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'pain_description.required_if' => 'A descrição é obrigatória quando "Dores" está selecionado.',
            'disability_description.required_if' => 'A descrição é obrigatória quando "Incapacidades" está selecionado.',
            'musculoskeletal_description.required_if' => 'A descrição é obrigatória quando "Osteomusculares" está selecionado.',
            'neurological_description.required_if' => 'A descrição é obrigatória quando "Neurológicas" está selecionado.',
            'urogynaecological_description.required_if' => 'A descrição é obrigatória quando "Uroginecológicas" está selecionado.',
            'cardiovascular_description.required_if' => 'A descrição é obrigatória quando "Cardiovasculares" está selecionado.',
            'respiratory_description.required_if' => 'A descrição é obrigatória quando "Respiratórias" está selecionado.',
            'oncological_description.required_if' => 'A descrição é obrigatória quando "Oncológicas" está selecionado.',
            'pediatric_description.required_if' => 'A descrição é obrigatória quando "Pediatria" está selecionado.',
            'multiple_conditions_description.required_if' => 'A descrição é obrigatória quando "Múltiplas Condições" está selecionado.',

            'basic_medical_form_id.required' => 'O ID do formulário médico básico é obrigatório.',
            'basic_medical_form_id.exists' => 'O formulário médico básico informado não existe.',
            'tenant_id.required' => 'O ID do tenant é obrigatório.',
            'tenant_id.exists' => 'O tenant informado não existe.',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validate that at least one current activity is selected
            $currentActivities = [
                $this->input('mova_se'),
                $this->input('menos_dor_mais_saude'),
                $this->input('peso_saudavel'),
                $this->input('geracao_esporte'),
                $this->input('none_alternatives')
            ];

            if (!in_array(true, $currentActivities)) {
                $validator->errors()->add('current_activities', 'A marcação de pelo menos um item é obrigatório para o cadastro');
            }

            // Validate that at least one previous activity is selected
            $previousActivities = [
                $this->input('ra_mova_se'),
                $this->input('ra_menos_dor_mais_saude'),
                $this->input('ra_peso_saudavel'),
                $this->input('ra_geracao_esporte'),
                $this->input('ra_none_alternatives')
            ];

            if (!in_array(true, $previousActivities)) {
                $validator->errors()->add('previous_activities', 'A marcação de pelo menos um item é obrigatório para o cadastro');
            }
        });
    }
}
