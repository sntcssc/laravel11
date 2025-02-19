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
        Schema::create('csat_preparations', function (Blueprint $table) {
            $table->id(); // CSATID
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->string('isever_failed_csat', 10)->nullable();
            $table->integer('failed_csat_count')->nullable();
            $table->text('difficult_csat_section')->nullable();
            $table->string('took_csat_coaching', 10)->nullable();
            $table->string('mock_test_for_csat', 10)->nullable();
            $table->string('practicing_csat_every_day', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csat_preparation');
    }
};
