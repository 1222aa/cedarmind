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
        Schema::create('lesson_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->enum('type', ['video', 'presentation', 'written', 'quiz']); // Content type
            $table->string('title');
            $table->text('content')->nullable(); // For written content
            $table->string('url')->nullable(); // For videos (YouTube embed URL or direct video URL)
            $table->string('file_path')->nullable(); // For presentations or documents
            $table->integer('order')->default(0); // Order within lesson
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_contents');
    }
};
