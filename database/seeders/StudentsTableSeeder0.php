<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('students')->insert([
                'unique_id' => $faker->unique()->numerify('S#####'),
                'batch_id' => $faker->word,
                'program_id' => $faker->word,
                'section_id' => $faker->word,
                'admission_date' => $faker->date(),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'father_name' => $faker->name,
                'father_occupation' => $faker->word,
                'mother_name' => $faker->name,
                'mother_occupation' => $faker->word,
                'dob' => $faker->date(),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'category' => $faker->randomElement(['SC', 'ST', 'General']),
                'mobile_number' => $faker->phoneNumber,
                'whatsapp_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // You can set a default password
                'password_text' => 'password',
                'present_state' => $faker->state,
                'present_district' => $faker->city,
                'present_address' => $faker->address,
                'present_pin' => $faker->postcode,
                'permanent_state' => $faker->state,
                'permanent_district' => $faker->city,
                'permanent_address' => $faker->address,
                'permanent_pin' => $faker->postcode,
                'photo' => $faker->imageUrl,
                'status' => '0',
                'is_update' => '0',
                'login' => '0',
                'current_step' => '1',
                'remember_token' => $faker->uuid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
