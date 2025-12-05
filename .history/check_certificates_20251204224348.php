<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Certificate;
use App\Models\User;

$user = User::find(1);
if ($user) {
    echo "User: " . $user->name . " (ID: " . $user->id . ")\n";
    echo "Email: " . $user->email . "\n\n";
    
    $certs = $user->certificates()->with('course')->get();
    echo "Certificates count: " . $certs->count() . "\n\n";
    
    foreach ($certs as $cert) {
        echo "ID: " . $cert->id . "\n";
        echo "Course: " . ($cert->course ? $cert->course->title : 'N/A') . "\n";
        echo "Certificate #: " . $cert->certificate_number . "\n";
        echo "Earned: " . $cert->earned_at . "\n\n";
    }
} else {
    echo "User not found\n";
}
