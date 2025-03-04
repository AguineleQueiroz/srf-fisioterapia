<?php

namespace Database\Seeders;

use App\Helpers\Functions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usertype_permission')->insert([
            [
                'usertype_id' => 1,
                'user_permission_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 1,
                'user_permission_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 2,
                'user_permission_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 3,
                'user_permission_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 4,
                'user_permission_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 4,
                'user_permission_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 5,
                'user_permission_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usertype_id' => 5,
                'user_permission_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
