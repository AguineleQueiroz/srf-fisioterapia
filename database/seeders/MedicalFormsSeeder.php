<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\BasicMedicalForm;
use App\Models\PrimaryMedicalForm;
use App\Models\SecondaryMedicalForm;

class MedicalFormsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        User::factory()->count(3)->create(); //Id's = 2, 3, 4
        for ($i = 0; $i < 10; $i++) {
            $cpf = rand(0, 1) ? $this->generateValidCPF() : null;
            $tenant = $faker->randomElement(['1', '2']);
            $user_id = $faker->randomElement([1, 2, 3, 4]);

            $patient = Patient::create([
                'patient_name' => $faker->name,
                'cpf' => $cpf,
                'birth_date' => $faker->date(),
                'gender' => $faker->randomElement(['male', 'female']),
                'phone' => $faker->phoneNumber,
                'card_sus' => Str::random(15),
            ]);

            Address::create([
                'addressable_id' => $patient->id,
                'addressable_type' => 'App\Models\Patient',
                'address' => $faker->address,
                'city' => $faker->city,
            ]);

            $basicForm = (new BasicMedicalForm)->create([
                'patient_id' => $patient->id,
                'primary_care_clinic' => $faker->company,
                'community_health_worker' => $faker->name,
                'diagnosis' => $faker->optional()->text(200),
                'comorbidity' => $faker->optional()->text(200),
                'last_hospitalization' => $faker->optional()->date(),
                'registered_by' => $faker->name,
                'doctor_name' => $faker->name,
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
                'registered' => $faker->date(),
                'tenant_id' => $tenant,
                'user_id' => $user_id
            ]);

            $primaryFormsCount = rand(1, 3);

            for ($j = 0; $j < $primaryFormsCount; $j++) {
                $primaryData = [
                    'pain', 'disability', 'musculoskeletal', 'neurological', 'urogynaecological',
                    'cardiovascular', 'respiratory', 'oncological', 'pediatric', 'multiple_conditions'
                ];

                $primaryAttributes = [
                    'basic_medical_form_id' => $basicForm->id
                ];

                foreach ($primaryData as $field) {
                    $primaryAttributes[$field] = (bool)rand(0, 1);
                    if ($primaryAttributes[$field]) {
                        $primaryAttributes[$field . '_description'] = $faker->text(145);
                    }
                }

                $activities = [
                    'mova_se', 'menos_dor_mais_saude', 'peso_saudavel', 'geracao_esporte', 'none_alternatives',
                    'ra_mova_se', 'ra_menos_dor_mais_saude', 'ra_peso_saudavel', 'ra_geracao_esporte', 'ra_none_alternatives'
                ];

                foreach ($activities as $activity) {
                    $primaryAttributes[$activity] = (bool)rand(0, 1);
                }

                $primaryAttributes += [
                    'complaint' => $faker->optional()->text(200),
                    'physical_exam_findings' => $faker->optional()->text(200),
                    'standardized_tests' => $faker->optional()->text(200),
                    'functional_condition' => $faker->optional()->text(200),
                    'environmental_factors' => $faker->optional()->text(200),
                    'physiotherapeutic_diagnosis' => $faker->optional()->text(200),
                    'tenant_id' => $tenant,
                    'user_id' => $user_id
                ];

                (new PrimaryMedicalForm)->create($primaryAttributes);
            }

            $secondaryFormsCount = rand(0, 2);

            for ($k = 0; $k < $secondaryFormsCount; $k++) {
                (new SecondaryMedicalForm)->create([
                    'basic_medical_form_id' => $basicForm->id, // Adiciona a chave estrangeira
                    'functional_condition' => $faker->optional()->text(200),
                    'offered_treatment' => $faker->optional()->text(200),
                    'functional_progress' => $faker->optional()->text(200),
                    'sessions' => (string)rand(1, 50),
                    'attendance' => (string)rand(1, 50),
                    'personal_environmental_condition' => $faker->optional()->text(200),
                    'physiotherapeutic_diagnosis' => $faker->optional()->text(200),
                    'criteria' => $faker->optional()->text(200),
                    'justification' => $faker->optional()->text(200),
                    'tenant_id' => $tenant,
                    'user_id' => $user_id
                ]);
            }
        }
    }

    private function generateValidCPF(): string
    {
        $n = [];
        for ($i = 0; $i < 9; $i++) {
            $n[] = rand(0, 9);
        }
        $n[9] = $this->calculateCPFCheckDigit($n);
        $n[10] = $this->calculateCPFCheckDigit($n);
        return implode('', $n);
    }

    private function calculateCPFCheckDigit($digits): int
    {
        $sum = 0;
        $weight = count($digits) + 1;
        foreach ($digits as $digit) {
            $sum += $digit * $weight--;
        }
        $remainder = $sum % 11;
        return ($remainder < 2) ? 0 : 11 - $remainder;
    }
}
