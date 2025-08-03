<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tenant = Tenant::factory()->create();
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'cpf' => fake()->randomElement(['30131642472', '01726687783', '22178571930', '71214113346', '83591083070', '31851336095', '26448670025']),
            'phone' => fake()->phoneNumber(),
            'professional_type' => fake()->randomElement(['primary', 'secondary']),
            'document' => fake()->unique()->regexify('[0-9]{4}-[A-Z]{1}'),
            'tenant_id' => $tenant->id, // Datas and Presidente Kubitschek
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
