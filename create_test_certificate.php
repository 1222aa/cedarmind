<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Certificate;
use App\Models\Course;

// Get or create a test user
$user = User::firstOrCreate(
    ['email' => 'test@example.com'],
    [
        'name' => 'Test User',
        'password' => bcrypt('password123')
    ]
);

// Get a course
$course = Course::first();

if ($course) {
    // Create a test certificate
    $cert = Certificate::firstOrCreate(
        ['user_id' => $user->id, 'course_id' => $course->id],
        [
            'earned_at' => now(),
            'certificate_number' => 'CERT-' . $user->id . '-' . $course->id . '-' . now()->format('Ymd') . '-TEST'
        ]
    );
    
    echo "Certificate created/found:\n";
    echo "User: " . $user->name . "\n";
    echo "Course: " . $course->title . "\n";
    echo "Certificate Number: " . $cert->certificate_number . "\n";
} else {
    echo "No courses found. Please seed the database first.\n";
}
