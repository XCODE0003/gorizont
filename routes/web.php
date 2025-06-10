<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Articles;

Route::get('/', [IndexController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('/subscribe/toggle', [SubscribeController::class, 'toggle']);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/post.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/comment.php';