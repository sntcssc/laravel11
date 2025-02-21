To generate a Laravel seeder with 5 sample student records for testing, you can create a seeder class and populate it with fake data using Laravel's Faker package.

Here's a step-by-step guide:

1. **Create Seeder Class:**

   Run the following Artisan command to generate a seeder class:
   
   ```bash
   php artisan make:seeder StudentsTableSeeder
   ```

2. **Populate Seeder with Sample Data:**

   Now, open the generated seeder file located at `database/seeders/StudentsTableSeeder.php` and modify it as follows to insert 5 fake student records into the `students` table.

   ```php
   <?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use Illuminate\Support\Facades\DB;
   use Faker\Factory as Faker;

   class StudentsTableSeeder extends Seeder
   {
       public function run()
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
   ```

3. **Run the Seeder:**

   After setting up the seeder file, run the seeder to insert data into your `students` table:

   ```bash
   php artisan db:seed --class=StudentsTableSeeder
   ```

This will insert 5 fake records into your `students` table for testing purposes. If you need more or specific data, you can adjust the Faker data or add additional fields as needed.