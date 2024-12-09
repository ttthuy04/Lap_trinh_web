<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('issues')->insert([
                'computer_id' => rand(1, 10), // Giả sử có 10 máy tính
                'reported_by' => 'User-' . rand(1, 5),
                'reported_date' => now()->subDays(rand(1, 30)),
                'description' => 'This is a description for issue ' . $i,
                'urgency' => ['Low', 'Medium', 'High'][rand(0, 2)],
                'status' => ['Open', 'In Progress', 'Resolved'][rand(0, 2)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
