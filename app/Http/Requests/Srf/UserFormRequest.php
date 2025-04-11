<?php

namespace App\Http\Requests\Srf;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'cpf' => 'required|string|size:11|unique:users,cpf',
            'phone' => 'nullable|string|max:16',
            'professional_type' => 'nullable|string|in:admin,manager,basic,primary,secondary,other',
            'document' => 'nullable|string|max:35|unique:users,document',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $userId = $this->route('user');

            $rules['email'] = "required|string|email|max:255|unique:users,email,{$userId}";
            $rules['cpf'] = "required|string|size:11|unique:users,cpf,{$userId}";
            $rules['document'] = "nullable|string|max:35|unique:users,document,{$userId}";
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.max' => 'O e-mail não pode ter mais que 255 caracteres.',
            'email.unique' => 'Este e-mail já está sendo utilizado.',

            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter 11 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',

            'phone.max' => 'O telefone não pode ter mais que 16 caracteres.',

            'professional_type.in' => 'O tipo profissional deve ser admin, manager, basic, primary, secondary ou other.',

            'document.max' => 'O documento profissional não pode ter mais que 35 caracteres.',
            'document.unique' => 'Este documento já está cadastrado no sistema.',

            'address.max' => 'O endereço não pode ter mais que 255 caracteres.',

            'city.max' => 'A cidade não pode ter mais que 255 caracteres.',
        ];
    }
}
