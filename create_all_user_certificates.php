<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Certificate;
use App\Models\Course;

$users = User::all();
$courses = Course::all();

echo "Creating certificates for ALL users...\n\n";

foreach ($users as $user) {
    echo "User: " . $user->name . " (" . $user->email . ")\n";
    
    foreach ($courses as $course) {
        $cert = Certificate::firstOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            [
                'earned_at' => now(),
                'certificate_number' => 'CERT-' . $user->id . '-' . $course->id . '-' . now()->format('Ymd') . '-' . uniqid()
            ]
        );
        
        echo "  ✓ " . $course->title . "\n";
    }
    echo "\n";
}

echo "All certificates created!\n";
