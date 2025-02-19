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
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->integer('self_study_hours')->nullable(); // Storing the number of hours as an integer
            $table->string('has_separate_study_room', 10)->nullable();
            $table->string('is_in_hostel', 10)->nullable();
            $table->string('is_residing_in_kolkata', 10)->nullable();
            $table->string('travel_time')->nullable();
            $table->string('prelims_mode')->nullable();
            $table->text('prelims_mode_reason')->nullable();
            $table->string('mentoring_mode')->nullable();
            $table->text('mentoring_mode_reason')->nullable();
            $table->string('is_full_time_preparation', 10)->nullable();
            $table->string('work_schedule')->nullable();
            $table->integer('daily_preparation_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('others_details');
    }
};
