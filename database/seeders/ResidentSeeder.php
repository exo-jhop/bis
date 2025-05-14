<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\Resident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $barangayIds = Barangay::pluck('id')->toArray();

        // Create 20 residents
        for ($i = 0; $i < 20; $i++) {
            Resident::create([
                'first_name' => $faker->firstName,
                'middle_name' => $faker->optional()->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'birth_date' => $faker->date('Y-m-d', '2005-01-01'),
                'civil_status' => $faker->randomElement(['Single', 'Married', 'Widowed', 'Divorced']),
                'occupation' => $faker->optional()->jobTitle,
                'is_voter' => $faker->boolean,
                'email' => $faker->optional()->safeEmail,
                'phone_number' => $faker->optional()->numerify('09#########'),
                'barangay_id' => $faker->randomElement($barangayIds),
                'street' => $faker->streetAddress,
            ]);
        }
    }
}
