<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\BasicMedicalForm;
use App\Models\PrimaryMedicalForm;
use App\Models\SecondaryMedicalForm;
use App\Models\MedicalForm;

class MedicalFormsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            // Basic Medical Form
            $cpf = rand(0, 1) ? $this->generateValidCPF() : null;
            $basicForm = BasicMedicalForm::create([
                'patient_name' => $faker->name,
                'cpf' => $cpf,
                'birth_date' => $faker->date(),
                'gender' => $faker->randomElement(['male', 'female']),
                'phone' => $faker->phoneNumber,
                'card_sus' => Str::random(15),
                'address' => $faker->address,
                'primary_care_clinic' => $faker->company,
                'community_health_worker' => $faker->name,
                'diagnosis' => $faker->optional()->text(200),
                'comorbidity' => $faker->optional()->text(200),
                'last_hospitalization' => $faker->optional()->date(),
                'registered_by' => $faker->name,
                'doctor_name' => $faker->name,
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
                'registered' => $faker->date()
            ]);

            // Primary Medical Form
            $primaryData = [
                'pain', 'disability', 'musculoskeletal', 'neurological', 'urogynaecological',
                'cardiovascular', 'respiratory', 'oncological', 'pediatric', 'multiple_conditions'
            ];

            $primaryAttributes = [];
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
            ];

            $primaryForm = PrimaryMedicalForm::create($primaryAttributes);

            // Secondary Medical Form
            $secondaryForm = SecondaryMedicalForm::create([
                'functional_condition' => $faker->optional()->text(200),
                'offered_treatment' => $faker->optional()->text(200),
                'functional_progress' => $faker->optional()->text(200),
                'sessions' => (string)rand(1, 50),
                'attendance' => (string)rand(1, 50),
                'personal_environmental_condition' => $faker->optional()->text(200),
                'physiotherapeutic_diagnosis' => $faker->optional()->text(200),
                'criteria' => $faker->optional()->text(200),
                'justification' => $faker->optional()->text(200),
            ]);

            // Medical Form
            MedicalForm::create([
                'user_id' => 1,
                'basic_medical_form_id' => $basicForm->id,
                'primary_medical_form_id' => $primaryForm->id,
                'secondary_medical_form_id' => $secondaryForm->id,
                'referral' => $faker->optional()->text(50),
                'city' => $faker->city
            ]);
        }
    }

    private function generateValidCPF()
    {
        $n = [];
        for ($i = 0; $i < 9; $i++) {
            $n[] = rand(0, 9);
        }
        $n[9] = $this->calculateCPFCheckDigit($n);
        $n[10] = $this->calculateCPFCheckDigit($n);
        return implode('', $n);
    }

    private function calculateCPFCheckDigit($digits)
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
