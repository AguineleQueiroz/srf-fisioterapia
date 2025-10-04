<?php

namespace Tests\Feature\Srf;

use App\Models\BasicMedicalForm;
use App\Models\Tenant;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Assert;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as AssertInertia;

class MedicalFormTest extends TestCase
{
    use RefreshDatabase;
    protected Tenant $tenant;
    protected User $user;
    protected BasicMedicalForm $form1;
    protected BasicMedicalForm $form2;
    protected array $basicMedicalFormData;
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        session()->flush();
        $this->basicMedicalFormModel = new BasicMedicalForm();
        $this->tenant = Tenant::factory()->create();
        $this->user = User::factory()->create(['tenant_id' => $this->tenant->id]);
        $this->form1 = $this->basicMedicalFormModel->create([
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
            'tenant_id' => $this->tenant->id,
            'user_id' => $this->user->id
        ]);
        $this->form2 = $this->basicMedicalFormModel->create([
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
            'tenant_id' => $this->tenant->id,
            'user_id' => $this->user->id
        ]);

        $faker = Faker::create('pt_BR');
        $this->basicMedicalFormData = [
            'patient_name' => $faker->name,
            'cpf' => '587.733.900-11',
            'birth_date' => $faker->date(),
            'gender' => $faker->randomElement(['male', 'female']),
            'phone' => $faker->phoneNumber,
            'card_sus' => Str::random(15),
            'address' => $faker->address,
            'primary_care_clinic' => $faker->company,
            'community_health_worker' => $faker->name,
            'diagnosis' => $faker->text(85),
            'comorbidity' => $faker->text(59),
            'last_hospitalization' => $faker->date(),
            'registered_by' => $faker->name,
            'doctor_name' => $faker->name,
            'priority' => $faker->randomElement(['low', 'medium', 'high']),
            'registered' => $faker->date(),
            'tenant_id' => $this->tenant->id,
            'user_id' => $this->user->id
        ];
    }

    /**
     * Verifica se a página Dashboard com formulários médicos é carregada corretamente.
     */
    public function test_index_loads_dashboard_with_medical_forms(): void
    {
        $this->actingAs($this->user)
            ->get(route('forms.index'))
            ->assertOk()
            ->assertInertia(fn ($assert) => $assert
                ->component('Dashboard')
                ->has('medicalForms.data')
                ->has('medicalForms.data', fn ($forms) => $forms->etc())
                ->where('searchParam', '')
            );
    }

    /**
     * Verifica se a busca de formulários por termos parciais ou completos funciona corretamente.
     */
    public function test_index_searches_medical_forms_correctly(): void
    {
        $search = 'Costa';

        $this->actingAs($this->user)
            ->get(route('forms.index', ['search' => $search]))
            ->assertOk()
            ->assertInertia(fn ($assert) => $assert
                ->component('Dashboard')
                ->has('medicalForms.data')
                ->where('medicalForms.data.0.patient.patient_name', fn ($name) =>
                str_contains($name, $search)
                )
                ->where('searchParam', $search)
            );
    }

    /**
     * Verifica o comportamento quando nenhum formulário é encontrado.
     */
    public function test_index_with_no_matching_results(): void
    {
        $search = 'TermNonexistent';

        $this->actingAs($this->user)
            ->get(route('forms.index', ['search' => $search]))
            ->assertOk()
            ->assertInertia(fn ($assert) => $assert
                ->component('Dashboard')
                ->has('medicalForms.data', 0)
                ->where('searchParam', $search)
            );
    }

    public function test_valid_basic_medical_form_is_stored_with_success_flash(): void
    {
        $this->actingAs($this->user)
            ->post(route('forms.store'), $this->basicMedicalFormData)
            ->assertRedirect(route('forms.index'))
            ->assertSessionHas('success', 'Atendimento cadastrado.');
    }

    public function test_invalid_basic_medical_form_is_not_stored_and_user_is_redirected_with_errors(): void
    {
        $this->basicMedicalFormData['cpf'] = '000.456.789-09';

        $this->actingAs($this->user)
            ->post(route('forms.store'), $this->basicMedicalFormData)
            ->assertRedirect(route('home'))
            ->assertSessionHasErrors(['cpf']);
    }

    public function test_basic_medical_form_can_be_updated_success_flash(): void
    {
        $data = array_merge(
            $this->form1->toArray(),
            $this->form1->patient->only(['ulid', 'patient_name', 'gender', 'tenant_id']),
            [
                'phone' => '(38) 90000-0000',
                'birth_date' => '1980-08-24',
                'card_sus' => '123456789000000',
                'address' => 'Rua Editada, 1000',
            ]
        );
        $this->actingAs($this->user)
            ->put(route('forms.update'), $data)
            ->assertRedirect(route('forms.index'))
            ->assertSessionHas('success', 'Atendimento atualizado com sucesso.');
    }
}
