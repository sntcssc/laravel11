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
        Schema::create('preparation_details', function (Blueprint $table) {
            $table->id(); // PreparationID
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->string('highest_education_qualification');
            $table->string('graduation_subject');
            $table->string('optional_subject');
            $table->integer('start_year');
            $table->string('has_coaching', 10)->nullable();
            $table->string('coaching_institute')->nullable();
            $table->integer('coaching_year')->nullable();
            $table->integer('attempt_count');
            $table->string('cleared_prelims', 10)->nullable();
            $table->string('cleared_prelims_year')->nullable();
            $table->string('cleared_mains', 10)->nullable();
            $table->string('cleared_mains_year')->nullable();
            $table->text('marks_in_attempts')->nullable();
            $table->integer('revision_count')->nullable();
            $table->string('strong_subjects')->nullable();
            $table->string('challenging_subjects')->nullable();
            $table->string('comfortable_prelims_subjects')->nullable();
            $table->string('struggle_prelims_subjects')->nullable();
            $table->string('primary_current_affairs_source')->nullable();
            $table->integer('current_affairs_study_hours')->nullable();
            $table->string('full_prelims_reading_completed', 10)->nullable();
            $table->string('revision_before_prelims')->nullable();
            $table->integer('revision_time_per_day')->nullable();
            $table->text('revision_method')->nullable();
            $table->text('avoid_past_mistakes')->nullable();
            $table->string('review_pyq_frequency')->nullable();
            $table->string('upsc_pyq_analysis_completed')->nullable();
            $table->string('solved_practice_questions_after_each_chapter', 10)->nullable();
            $table->string('note_preparation_for_pyqs')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preparation_details');
    }
};
