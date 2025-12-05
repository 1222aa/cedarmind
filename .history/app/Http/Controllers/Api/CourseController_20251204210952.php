<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Return courses from database with lesson count
        $courses = Course::withCount('lessons')
            ->get()
            ->map(fn($course) => [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'instructor' => $course->instructor,
                'level' => $course->level,
                'duration_hours' => $course->duration_hours,
                'lesson_count' => $course->lessons_count,
            ]);

        if ($courses->isEmpty()) {
            return response()->json(['courses' => []]);
        }

        return response()->json(['courses' => $courses]);
    }

    public function show($id)
    {
        $course = Course::with('lessons.contents.quizQuestions')->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json([
            'course' => [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'long_description' => $course->long_description,
                'instructor' => $course->instructor,
                'level' => $course->level,
                'duration_hours' => $course->duration_hours,
                'image_url' => $course->image_url,
                'learning_outcomes' => $course->learning_outcomes,
                'lessons' => $course->lessons->map(fn($lesson) => [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                    'order' => $lesson->order,
                    'contents' => $lesson->contents->map(fn($content) => [
                        'id' => $content->id,
                        'type' => $content->type,
                        'title' => $content->title,
                        'content' => $content->content,
                        'url' => $content->url,
                        'file_path' => $content->file_path,
                        'order' => $content->order,
                        'quiz_questions' => $content->type === 'quiz' 
                            ? $content->quizQuestions->map(fn($q) => [
                                'id' => $q->id,
                                'question' => $q->question,
                                'options' => is_array($q->options) ? $q->options : json_decode($q->options, true),
                                'correct_answer' => $q->correct_answer,
                                'explanation' => $q->explanation,
                                'order' => $q->order,
                            ])
                            : [],
                    ]),
                ]),
            ],
        ]);
    }
}
