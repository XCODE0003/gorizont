<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'post'], function () {
        Route::get('/new', [PostController::class, 'new'])->name('post.new');
        Route::post('/new', [PostController::class, 'store'])->name('post.store');
        Route::get('/{id}', [PostController::class, 'index'])->name('post.index');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/{id}/edit', [PostController::class, 'update'])->name('post.update');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'get']);
        Route::post('/new', [CategoryController::class, 'store'])->name('category.store');
    });
});
