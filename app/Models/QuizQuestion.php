<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_content_id',
        'question',
        'options',
        'correct_answer',
        'explanation',
        'order',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function lessonContent()
    {
        return $this->belongsTo(LessonContent::class);
    }
}
