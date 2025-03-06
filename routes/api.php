<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api'], function ($router) {
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
    Route::get('/user', [AuthenticatedSessionController::class, 'show'])->middleware('auth:sanctum'); 
    Route::post('/user/update-profile', [AuthenticatedSessionController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/user/update-password', [AuthenticatedSessionController::class, 'updatePassword'])->middleware('auth:sanctum');
});

