<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create(['name' => 'Composite Course', 'description' => 'A comprehensive program']);
        Program::create(['name' => 'Crash Course', 'description' => 'Short-term program']);
        Program::create(['name' => 'Special Focus Group', 'description' => 'Specialized program for focus groups']);
    }
}
