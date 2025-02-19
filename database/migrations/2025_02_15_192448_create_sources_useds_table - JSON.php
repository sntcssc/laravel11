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
        Schema::create('sources_useds', function (Blueprint $table) {
            $table->id(); // SourceID
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('unique_id'); // StudentID
            $table->json('subjects_materials'); // This will store subjects and source materials in JSON format
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sources_useds');
    }
};
