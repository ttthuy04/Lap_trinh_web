<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Class1;
use Faker\Factory as Faker;

class Class1TableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo 20 bản ghi dữ liệu cho bảng class1
        for ($i = 0; $i < 20; $i++) {
            Class1::create([
                'grade_level' => $faker->randomElement(['Pre-K', 'Kindergarten']),
                'room_number' => 'VH' . $faker->randomDigit(),
            ]);
        }
    }
}
