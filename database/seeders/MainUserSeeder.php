<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MainUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Developer',
            'email' => 'developer@admin.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'cpf' => '588.938.460-04',
            'phone' => '38998427814',
            'professional_type' => 'admin',
            'document' => '000000-A',
            'address' => 'Middle Street, 123',
            'city' => 'Datas',
            'remember_token' => Str::random(10),
        ]);
    }
}
