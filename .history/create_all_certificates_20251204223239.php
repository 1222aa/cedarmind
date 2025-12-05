<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Certificate;
use App\Models\Course;

// Get or create test user
$user = User::firstOrCreate(
    ['email' => 'test@example.com'],
    [
        'name' => 'Test User',
        'password' => bcrypt('password123')
    ]
);

// Get all courses
$courses = Course::all();

foreach ($courses as $course) {
    // Create certificate for each course
    $cert = Certificate::firstOrCreate(
        ['user_id' => $user->id, 'course_id' => $course->id],
        [
            'earned_at' => now(),
            'certificate_number' => 'CERT-' . $user->id . '-' . $course->id . '-' . now()->format('Ymd') . '-' . uniqid()
        ]
    );
    
    echo "Certificate for: " . $course->title . "\n";
    echo "Certificate Number: " . $cert->certificate_number . "\n\n";
}
