<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_types')->insert([
            [
                'type' => 'Administrator do Sistema',
                'code' => 'admin',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Gerente do Sistema',
                'code' => 'manager',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Atendimento/Recepção',
                'code' => 'basic',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Atenção Primária',
                'code' => 'primary',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Atenção Secundária',
                'code' => 'secondary',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Não Sou Fisioterapeuta',
                'code' => 'other',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
