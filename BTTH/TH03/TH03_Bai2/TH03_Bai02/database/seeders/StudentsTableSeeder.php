<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;
use App\Models\Class1; // Import model Class1

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Sinh 20 bản ghi dữ liệu cho bảng students
        for ($i = 0; $i < 20; $i++) {
            Student::create([  // Sử dụng model Student để tạo bản ghi
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'date_of_birth' => $faker->date(),
                'parent_phone' => $faker->phoneNumber(),
                'class_id' => $faker->numberBetween(1, 2),  // Giả sử bạn có 2 lớp
            ]);
        }
    }
}
