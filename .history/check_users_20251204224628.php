<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Certificate;
use App\Models\Course;

// List all users
$users = User::all();
echo "All users in database:\n";
foreach ($users as $u) {
    echo "ID: " . $u->id . " | Email: " . $u->email . " | Name: " . $u->name . "\n";
}
