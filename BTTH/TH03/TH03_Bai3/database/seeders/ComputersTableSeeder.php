<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('computers')->insert([
                'computer_name' => 'Computer-' . $i,
                'model' => 'Model-' . $i,
                'operating_system' => 'Windows 10',
                'processor' => 'Intel Core i5-' . rand(8000, 12000),
                'memory' => rand(8, 64),
                'available' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
