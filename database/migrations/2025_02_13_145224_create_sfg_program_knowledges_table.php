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
        Schema::create('sfg_program_knowledges', function (Blueprint $table) {
            $table->id(); // SFGID
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->text('key_features_of_sfg_program')->nullable();
            $table->text('ways_sfg_will_help_in_exam')->nullable();
            // $table->boolean('regular_analysis_of_prelims_performance');
            // $table->text('benefits_from_prelims_analysis');
            // $table->boolean('identifying_weak_areas_after_tests');
            // $table->text('working_to_eliminate_weak_areas');
            // $table->boolean('reading_test_explanations');
            // $table->boolean('taking_notes_from_explanations');
            // $table->boolean('regular_test_participation');
            // $table->text('test_participation_challenges');
            // $table->text('overcoming_test_challenges');
            // $table->integer('highest_test_score');
            // $table->integer('lowest_test_score');
            // $table->float('average_test_score');
            // $table->boolean('belief_in_clearing_prelims_this_year');
            $table->text('regular_analysis_of_prelims_performance')->nullable();
            $table->text('benefits_from_prelims_analysis')->nullable();
            $table->text('identifying_weak_areas_after_tests')->nullable();
            $table->text('working_to_eliminate_weak_areas')->nullable();
            $table->text('reading_test_explanations')->nullable();
            $table->text('taking_notes_from_explanations')->nullable();
            $table->text('regular_test_participation')->nullable();
            $table->text('test_participation_challenges')->nullable();
            $table->text('overcoming_test_challenges')->nullable();
            $table->integer('highest_test_score')->nullable();
            $table->integer('lowest_test_score')->nullable();
            $table->float('average_test_score')->nullable();
            $table->string('belief_in_clearing_prelims_this_year', 30)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfg_program_knowledge');
    }
};
