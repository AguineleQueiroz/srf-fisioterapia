<?php

namespace Database\Seeders;

use App\Helpers\Functions;
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
        //Functions::truncateTable('usertypes');
        DB::table('usertypes')->insert([
            [
                'type' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'manager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'basic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'primary',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'secondary',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
