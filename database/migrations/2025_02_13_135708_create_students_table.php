<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->nullable(); // StudentID
            $table->string('batch_id')->nullable();
            $table->string('program_id')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            // $table->integer('age')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('category')->nullable(); //SC ST
            $table->string('mobile_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->longText('password_text')->nullable();
            $table->string('present_state')->nullable();
            $table->string('present_district')->nullable();
            $table->text('present_address')->nullable();
            $table->text('present_pin')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_district')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('permanent_pin')->nullable();
            $table->text('photo')->nullable();
            $table->string('status')->default('0');
            $table->string('is_update')->default('0');
            $table->boolean('login')->default('0');
            $table->boolean('current_step')->default('1'); // this added for multi step form
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
