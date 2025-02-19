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
        Schema::create('personality_details', function (Blueprint $table) {
            $table->id(); // PersonalityID
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->text('reason_for_civil_services')->nullable();
            $table->text('essential_values_for_topping')->nullable();
            $table->text('motivation_for_daily_effort')->nullable();
            $table->text('strengths_in_clearing_exams')->nullable();
            $table->text('areas_for_improvement')->nullable();
            $table->text('obstacles_to_success')->nullable();
            $table->text('current_challenges')->nullable();
            $table->text('overcoming_challenges_plan')->nullable();
            $table->text('strategies_for_success')->nullable();
            $table->text('major_distractions')->nullable();
            $table->text('distraction_overcoming_plan')->nullable();
            $table->text('distraction_timeline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personality_details');
    }
};
