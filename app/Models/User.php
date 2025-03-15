<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'phone',
        'professional_type',
        'document',
        'address',
        'city',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the validation rules.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules($id = null): array
    {
        $base_rules = [
            'name' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|min:11|max:16',
            'professional_type' => 'required|string|in:admin,manager,basic,primary,secondary,other',
            // crefito or other professional registration document
            'document' => 'required|string|min:6',
            'address' => 'required|string|min:6',
            'city' => 'required|string|min:6',
        ];

        if($id) {
            return array_merge($base_rules, array(
                'email' => [
                    'required', 'string', 'email', 'max:255',
                    Rule::unique('users', 'email')->ignore($id)
                ],
                'cpf' => [
                    'required', 'cpf',
                    Rule::unique('users', 'document')->ignore($id)
                ],
            ));
        }

        return array_merge($base_rules, [
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'required|cpf|unique:users',
        ]);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
