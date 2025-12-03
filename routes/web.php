<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lmscontroller;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[App\Http\Controllers\lmscontroller::class,'index']);

// Contact page (simple view)
Route::get('/contact', function () {
    return view('frontend.contact');
});

// Auth pages (web-based for admin access)
Route::get('/login', function () {
    return view('frontend.login');
});

Route::post('/login', [App\Http\Controllers\WebAuthController::class, 'loginSubmit']);

Route::get('/signup', function () {
    return view('frontend.signup');
});

Route::post('/signup', [App\Http\Controllers\WebAuthController::class, 'signupSubmit']);

Route::post('/logout', [App\Http\Controllers\WebAuthController::class, 'logout'])->name('logout');

Route::get('/courses', function () {
    return view('frontend.courses');
});

Route::get('/courses/{id}', function ($id) {
    return view('frontend.course-detail', ['courseId' => $id]);
})->name('course.detail');

// Admin login (web form-based)
Route::get('/admin-login', function () {
    if (auth()->check()) {
        return redirect('/admin');
    }
    return view('frontend.admin_login');
})->name('admin.login');

// Admin dashboard (protected with auth and admin middleware)
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'admin']);

// Admin course management
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{id}/edit', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/courses/{id}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/courses/{id}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('admin.courses.destroy');
    Route::post('/courses/{id}/content', [App\Http\Controllers\Admin\CourseController::class, 'addContent'])->name('admin.courses.content.add');
});
