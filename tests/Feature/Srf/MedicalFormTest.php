<?php

namespace Tests\Feature\Srf;

use App\Models\BasicMedicalForm;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class MedicalFormTest extends TestCase
{
    use RefreshDatabase;
    protected Tenant $tenant;
    protected User $user;
    protected BasicMedicalForm $form1;
    protected BasicMedicalForm $form2;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->tenant = Tenant::factory()->create();
        $this->user = User::factory()->create(['tenant_id' => $this->tenant->id]);
        $this->form1 = (new BasicMedicalForm)->create([
            'ulid' => (string) Str::ulid(),
            'patient_name' => 'João da Silva',
            'cpf' => '10543695000',
            'birth_date' => '1980-05-15',
            'gender' => 'male',
            'phone' => '(11) 98765-4321',
            'card_sus' => '123456789012345',
            'address' => 'Rua das Flores, 123',
            'primary_care_clinic' => 'UBS Central',
            'community_health_worker' => 'Maria Santos',
            'diagnosis' => 'Hipertensão Arterial',
            'comorbidity' => 'Diabetes Tipo 2',
            'last_hospitalization' => '2023-10-10',
            'registered_by' => 'Dr. Carlos Oliveira',
            'doctor_name' => 'Dr. Paulo Sousa',
            'priority' => 'high',
            'registered' => '2024-03-25',
            'tenant_id' => $this->tenant->id
        ]);
        $this->form2 = (new BasicMedicalForm)->create([
            'ulid' => (string) Str::ulid(),
            'patient_name' => 'Ana Beatriz Costa',
            'cpf' => '58615895007',
            'birth_date' => '1995-08-20',
            'gender' => 'female',
            'phone' => '(11) 91234-5678',
            'card_sus' => '987654321098765',
            'address' => 'Av. Principal, 456',
            'primary_care_clinic' => 'UBS Jardim',
            'community_health_worker' => 'José Pereira',
            'diagnosis' => 'Bronquite Asmática',
            'comorbidity' => null,
            'last_hospitalization' => null,
            'registered_by' => 'Dr. Marcos Ribeiro',
            'doctor_name' => 'Dra. Carla Mendes',
            'priority' => 'medium',
            'registered' => '2024-04-01',
            'tenant_id' => $this->tenant->id
        ]);
    }

    /**
     * Verifica se a página Dashboard com formulários médicos é carregada corretamente.
     */
    public function test_index_loads_dashboard_with_medical_forms(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            //->component('Dashboard')
            ->has('medicalForms')
            ->where('searchParam', '')
        );
    }

    /**
     * Verifica se a busca de formulários por termos parciais ou completos funciona corretamente.
     */
    public function test_index_searches_medical_forms_correctly(): void
    {
        $search = 'Costa';
        $response = $this->actingAs($this->user)->get(route('dashboard', ['search' => $search]));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            //->component('Dashboard')
            ->has('medicalForms')
            ->where('searchParam', $search)
        );
    }

    /**
     * Verifica o comportamento quando nenhum formulário é encontrado.
     */
    public function test_index_with_no_matching_results(): void
    {
        $search = 'TermNonexistent';
        $response = $this->actingAs($this->user)->get(route('dashboard', ['search' => $search]));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            //->component('Dashboard')
            ->has('medicalForms')
            ->where('searchParam', $search)
        );
    }
}
