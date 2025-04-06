<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/cadastrar');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/cadastrar', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'cpf' => '529.686.670-33',
            'professional_type' => null,
            'document' => '000000-A',
            'phone' => '36998333810',
            'address' => 'Middle Street, 123',
            'city' => 'Los Angeles'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
