<?php

namespace App\Http\Requests\Srf;

use Illuminate\Foundation\Http\FormRequest;

class PrimaryMedicalFormRequest extends FormRequest
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
            'pain_description' => 'nullable|string',
            'disability_description' => 'nullable|string',
            'musculoskeletal_description' => 'nullable|string',
            'neurological_description' => 'nullable|string',
            'urogynaecological_description' => 'nullable|string',
            'cardiovascular_description' => 'nullable|string',
            'respiratory_description' => 'nullable|string',
            'oncological_description' => 'nullable|string',
            'pediatric_description' => 'nullable|string',
            'multiple_conditions_description' => 'nullable|string',

            'complaint' => 'nullable|string',
            'physical_exam_findings' => 'nullable|string',
            'standardized_tests' => 'nullable|string',
            'functional_condition' => 'nullable|string',
            'environmental_factors' => 'nullable|string',
            'physiotherapeutic_diagnosis' => 'nullable|string',

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

            'pain_description.string' => 'A descrição da dor deve ser um texto.',
            'disability_description.string' => 'A descrição da deficiência deve ser um texto.',
            'musculoskeletal_description.string' => 'A descrição musculoesquelética deve ser um texto.',
            'neurological_description.string' => 'A descrição neurológica deve ser um texto.',
            'urogynaecological_description.string' => 'A descrição uroginecológica deve ser um texto.',
            'cardiovascular_description.string' => 'A descrição cardiovascular deve ser um texto.',
            'respiratory_description.string' => 'A descrição respiratória deve ser um texto.',
            'oncological_description.string' => 'A descrição oncológica deve ser um texto.',
            'pediatric_description.string' => 'A descrição pediátrica deve ser um texto.',
            'multiple_conditions_description.string' => 'A descrição de condições múltiplas deve ser um texto.',

            'complaint.string' => 'A queixa deve ser um texto.',
            'physical_exam_findings.string' => 'Os achados do exame físico devem ser um texto.',
            'standardized_tests.string' => 'Os testes padronizados devem ser um texto.',
            'functional_condition.string' => 'A condição funcional deve ser um texto.',
            'environmental_factors.string' => 'Os fatores ambientais devem ser um texto.',
            'physiotherapeutic_diagnosis.string' => 'O diagnóstico fisioterapêutico deve ser um texto.',


            'basic_medical_form_id.required' => 'O ID do formulário médico básico é obrigatório.',
            'basic_medical_form_id.exists' => 'O formulário médico básico informado não existe.',
        ];
    }
}
