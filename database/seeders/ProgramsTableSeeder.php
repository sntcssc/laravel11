<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserting the programs data
        DB::table('programs')->insert([
            [
                'name' => 'Composite Course',
                'description' => 'A comprehensive program combining all aspects of preparation.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prelims Crash Course (PCC)',
                'description' => 'A short and intensive course for prelims exam preparation.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prelims Test Series',
                'description' => 'A series of mock tests to help students evaluate their readiness.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mains Guidance Programme (MGP)',
                'description' => 'Focused program for mains exam preparation.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Interview Training Programme (ITP)',
                'description' => 'Focused program for Personality Test preparation.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
