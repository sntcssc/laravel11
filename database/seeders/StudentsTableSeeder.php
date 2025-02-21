<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'unique_id' => 'S1001',
                'batch_id' => '2020',
                'program_id' => 'Composite Course',
                'section_id' => 'A',
                'admission_date' => Carbon::create('2020', '06', '15'),
                'first_name' => 'John',
                'last_name' => 'Doe',
                'father_name' => 'Michael Doe',
                'father_occupation' => 'Engineer',
                'mother_name' => 'Jane Doe',
                'mother_occupation' => 'Teacher',
                'dob' => Carbon::create('2000', '01', '01'),
                'gender' => 'Male',
                'category' => 'General',
                'mobile_number' => '9876543210',
                'whatsapp_number' => '9876543210',
                'email' => 'johndoe@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'password_text' => 'password123',
                'present_state' => 'California',
                'present_district' => 'Los Angeles',
                'present_address' => '1234 Elm Street, LA',
                'present_pin' => '90001',
                'permanent_state' => 'California',
                'permanent_district' => 'San Francisco',
                'permanent_address' => '5678 Oak Avenue, SF',
                'permanent_pin' => '94101',
                'photo' => 'profile.jpg',
                'status' => '1',
                'is_update' => '0',
                'login' => true,
                'current_step' => 1,
            ],
            // Add more students similarly...
            [
                'unique_id' => 'S1002',
                'batch_id' => '2021',
                'program_id' => 'Mains Guidance Programme',
                'section_id' => 'B',
                'admission_date' => Carbon::create('2021', '07', '10'),
                'first_name' => 'Alice',
                'last_name' => 'Smith',
                'father_name' => 'John Smith',
                'father_occupation' => 'Doctor',
                'mother_name' => 'Sarah Smith',
                'mother_occupation' => 'Nurse',
                'dob' => Carbon::create('2001', '05', '15'),
                'gender' => 'Female',
                'category' => 'OBC',
                'mobile_number' => '9988776655',
                'whatsapp_number' => '9988776655',
                'email' => 'alicesmith@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('securepassword'),
                'password_text' => 'securepassword',
                'present_state' => 'Texas',
                'present_district' => 'Houston',
                'present_address' => '7890 Pine Road, Houston',
                'present_pin' => '77001',
                'permanent_state' => 'Texas',
                'permanent_district' => 'Dallas',
                'permanent_address' => '2345 Maple Street, Dallas',
                'permanent_pin' => '75201',
                'photo' => 'profile2.jpg',
                'status' => '1',
                'is_update' => '0',
                'login' => true,
                'current_step' => 1,
            ],
            // You can add more students in the same way...
        ];

        DB::table('students')->insert($students);
    }
}
