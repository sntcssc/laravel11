<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the batch IDs (assuming you have batches for 2020, 2021, etc.)
        $batches = DB::table('batches')->pluck('id')->toArray();

        // Inserting the sections data for each batch
        foreach ($batches as $batchId) {
            DB::table('sections')->insert([
                [
                    'name' => 'A',
                    'batch_id' => $batchId,
                    'seat' => 30, // You can adjust the number of seats per section
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'B',
                    'batch_id' => $batchId,
                    'seat' => 30, // You can adjust the number of seats per section
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'NA',
                    'batch_id' => $batchId,
                    'seat' => 0, // Section 'NA' might not have any seats, adjust as needed
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
