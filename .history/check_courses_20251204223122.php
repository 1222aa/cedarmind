<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Course;

$courses = Course::all();
foreach($courses as $c) {
    echo $c->id . ': ' . $c->title . "\n";
}
