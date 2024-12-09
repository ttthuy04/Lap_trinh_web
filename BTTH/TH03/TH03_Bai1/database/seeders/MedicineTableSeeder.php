<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Medicine;

class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Seed 50 medicines
        for ($i = 0; $i < 50; $i++) {
            Medicine::create([
                'name' => $faker->word(),
                'brand' => $faker->company(),
                'dosage' => $faker->randomElement(['10mg', '20mg', '50mg']),
                'form' => $faker->randomElement(['viên nén', 'viên nang', 'xi-rô']),
                'price' => $faker->randomFloat(2, 1, 500), // Giá từ 1 đến 500
                'stock' => $faker->numberBetween(0, 1000), // Số lượng tồn từ 0 đến 1000
            ]);
        }
    }
}
