<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Medicine;
use Faker\Factory as Faker;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Lấy tất cả các Medicine id để gán vào bảng sales
        $medicineIds = Medicine::pluck('medicine_id')->toArray(); // hoặc `id` nếu medicine_id là cột auto-increment

        // Tạo 20 bản ghi
        foreach (range(1, 20) as $index) {
            Sale::create([
                'medicine_id' => $faker->randomElement($medicineIds),
                'quantity' => $faker->numberBetween(1, 100), // Số lượng bán từ 1 đến 100
                'sale_date' => $faker->dateTimeThisYear(),  // Ngày bán trong năm nay
                'customer_phone' => $faker->phoneNumber(), // Số điện thoại khách hàng
            ]);
        }
    }
}
