<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\LessonContent;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'lesson_content_id' => 'required|exists:lesson_contents,id',
            'answers' => 'required|array', // Array of question_id => answer
        ]);

        $lessonContent = LessonContent::findOrFail($validated['lesson_content_id']);

        if ($lessonContent->type !== 'quiz') {
            return response()->json(['message' => 'Not a quiz'], 400);
        }

        $questions = $lessonContent->quizQuestions()->orderBy('order')->get();
        $totalQuestions = $questions->count();
        $correctAnswers = 0;
        $userAnswers = [];

        foreach ($questions as $question) {
            $questionId = $question->id;
            $userAnswer = $validated['answers'][$questionId] ?? null;
            $isCorrect = $userAnswer === $question->correct_answer;

            if ($isCorrect) {
                $correctAnswers++;
            }

            $userAnswers[$questionId] = [
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'explanation' => $question->explanation,
            ];
        }

        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;

        // Save quiz attempt
        $attempt = QuizAttempt::create([
            'user_id' => $request->user()->id,
            'lesson_content_id' => $validated['lesson_content_id'],
            'score' => $score,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'answers' => $userAnswers,
        ]);

        return response()->json([
            'message' => 'Quiz submitted successfully',
            'attempt_id' => $attempt->id,
            'score' => $score,
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'answers' => $userAnswers,
        ], 201);
    }

    public function getAttempt($attemptId)
    {
        $attempt = QuizAttempt::where('user_id', auth()->id())
            ->findOrFail($attemptId);

        return response()->json([
            'attempt' => [
                'id' => $attempt->id,
                'score' => $attempt->score,
                'correct_answers' => $attempt->correct_answers,
                'total_questions' => $attempt->total_questions,
                'submitted_at' => $attempt->created_at,
                'answers' => $attempt->answers,
            ],
        ]);
    }
}
