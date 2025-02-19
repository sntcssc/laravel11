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
        Schema::create('additional_preparations', function (Blueprint $table) {
            $table->id(); // PrepID
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->text('youtube_channels_followed')->nullable();
            $table->string('other_coaching_programs', 10)->nullable();
            $table->string('coaching_name')->nullable();
            $table->text('coaching_program_details')->nullable();
            $table->integer('revision_before_prelims_count');
            $table->text('experience_stress_anxiety')->nullable();
            $table->text('positive_takeaways_from_mock_tests')->nullable();
            $table->text('mistakes_after_mock_tests')->nullable();
            $table->text('specific_strategy_for_tests')->nullable();
            $table->integer('daily_study_hours')->nullable();
            $table->text('study_schedule')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_preparation');
    }
};
