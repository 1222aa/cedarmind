<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'long_description',
        'instructor',
        'level',
        'duration_hours',
        'image_url',
        'learning_outcomes',
    ];

    protected $casts = [
        'learning_outcomes' => 'array',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }
}
