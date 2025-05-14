<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::all();
        if ($cities->count() < 3) {
            throw new \Exception("Not enough cities found. Please seed at least 3 cities first.");
        }
        Barangay::insert([
            [
                'name' => 'Barangay 1',
                'city_id' => $cities[0]->id,
            ],
            [
                'name' => 'Barangay 2',
                'city_id' => $cities[1]->id,
            ],
            [
                'name' => 'Barangay 3',
                'city_id' => $cities[2]->id,
            ],
        ]);
    }
}
