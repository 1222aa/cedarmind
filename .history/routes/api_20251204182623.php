<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\QuizController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public contact endpoint (accepts JSON)
Route::post('/contact', [ContactController::class, 'store']);
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::post('/quiz/submit', [QuizController::class, 'submit']);
    Route::get('/quiz/attempt/{id}', [QuizController::class, 'getAttempt']);
    // Progress endpoints
    Route::post('/progress/complete', [App\Http\Controllers\Api\ProgressController::class, 'complete']);
    Route::get('/courses/{id}/progress', [App\Http\Controllers\Api\ProgressController::class, 'courseProgress']);
});
