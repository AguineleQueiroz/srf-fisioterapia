<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'addressable_id' => 1,
            'addressable_type' => 'App\Models\User',
            'address' => 'Middle Street, 123',
            'city' => 'Datas',
        ]);
    }
}
