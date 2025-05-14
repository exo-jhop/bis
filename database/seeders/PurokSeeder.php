<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\Purok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purok::insert([
            [
                'name' => 'Malipayon',
                'barangay_id' => Barangay::first()->id
            ],
            [
                'name' => 'Dalawidaw',
                'barangay_id' => Barangay::skip(1)->first()->id
            ],
            [
                'name' => 'Baganihan A',
                'barangay_id' => Barangay::skip(2)->first()->id
            ],
        ]);
    }
}
