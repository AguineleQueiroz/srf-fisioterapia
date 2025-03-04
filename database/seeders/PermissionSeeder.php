<?php

namespace Database\Seeders;

use App\Helpers\Functions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Functions::truncateTable('user_permissions');
        DB::table('user_permissions')->insert([
            [
                'permission' => 'full_access',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'permission' => 'access_to_professionals',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'permission' => 'basic_access',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'permission' => 'primary_access',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'permission' => 'secondary_access',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
