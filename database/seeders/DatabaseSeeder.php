<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TenantSeeder::class,
            MainUserSeeder::class,
            AddressSeeder::class,
            UserTypeSeeder::class,
            MedicalFormsSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
