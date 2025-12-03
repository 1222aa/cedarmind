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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_content_id')->constrained('lesson_contents')->onDelete('cascade');
            $table->string('question');
            $table->json('options'); // JSON array of answer options
            $table->string('correct_answer'); // Correct option key or text
            $table->text('explanation')->nullable(); // Explanation for the answer
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
