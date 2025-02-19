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
        Schema::create('others_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->boolean('is_in_hostel');
            $table->boolean('is_residing_in_kolkata');
            $table->string('travel_time');
            $table->string('prelims_mode');
            $table->text('prelims_mode_reason');
            $table->string('mentoring_mode');
            $table->text('mentoring_mode_reason');
            $table->boolean('is_full_time_preparation');
            $table->string('work_schedule');
            $table->integer('daily_preparation_hours');
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
