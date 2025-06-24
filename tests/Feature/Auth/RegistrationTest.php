<?php

namespace Tests\Feature\Auth;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
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
        Role::create(['name' => 'primary', 'guard_name' => 'web']);
        $tenant = Tenant::factory()->create();
        $response = $this->post('/cadastrar', [
            'name' => 'Dummy User',
            'email' => 'test@example.com.br',
            'password' => 'password',
            'password_confirmation' => 'password',
            'cpf' => '529.686.670-33',
            'phone' => '36998333810',
            'professional_type' => 'primary',
            'document' => '000001-A',
            'address' => 'Middle Street, 123',
            'city' => 'Los Angeles',
            'tenant_id' => $tenant->id
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('forms.index', absolute: false));
    }
}
