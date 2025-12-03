<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'type',
        'title',
        'content',
        'url',
        'file_path',
        'order',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
