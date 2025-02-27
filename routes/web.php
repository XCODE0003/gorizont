<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/post.php';