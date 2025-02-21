<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserting the batches data
        DB::table('batches')->insert([
            [
                'name' => '2020',
                'start_date' => Carbon::create('2020', '01', '01')->toDateString(),
                'end_date' => Carbon::create('2020', '12', '31')->toDateString(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2021',
                'start_date' => Carbon::create('2021', '01', '01')->toDateString(),
                'end_date' => Carbon::create('2021', '12', '31')->toDateString(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2022',
                'start_date' => Carbon::create('2022', '01', '01')->toDateString(),
                'end_date' => Carbon::create('2022', '12', '31')->toDateString(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2023',
                'start_date' => Carbon::create('2023', '01', '01')->toDateString(),
                'end_date' => Carbon::create('2023', '12', '31')->toDateString(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2024',
                'start_date' => Carbon::create('2024', '01', '01')->toDateString(),
                'end_date' => Carbon::create('2024', '12', '31')->toDateString(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2025',
                'start_date' => Carbon::create('2025', '01', '01')->toDateString(),
                'end_date' => Carbon::create('2025', '12', '31')->toDateString(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
