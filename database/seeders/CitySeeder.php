<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([
            [
                'name' => 'Quezon City',
                'zip_code' => '1100',
            ],
            [
                'name' => 'Makati City',
                'zip_code' => '1200',
            ],
            [
                'name' => 'Manila',
                'zip_code' => '1000',
            ],
            [
                'name' => 'Caloocan City',
                'zip_code' => '1400',
            ],
            [
                'name' => 'Pasig City',
                'zip_code' => '1600',
            ]
        ]);
    }
}
