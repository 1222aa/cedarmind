<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Certificate;
use App\Models\Course;

// Get your user
$user = User::find(2); // Antoine Harfouche

if ($user) {
    echo "Creating certificates for: " . $user->name . " (" . $user->email . ")\n\n";
    
    $courses = Course::all();
    foreach ($courses as $course) {
        $cert = Certificate::firstOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            [
                'earned_at' => now(),
                'certificate_number' => 'CERT-' . $user->id . '-' . $course->id . '-' . now()->format('Ymd') . '-' . uniqid()
            ]
        );
        
        echo "✓ Certificate created for: " . $course->title . "\n";
        echo "  Certificate #: " . $cert->certificate_number . "\n\n";
    }
} else {
    echo "User not found\n";
}
