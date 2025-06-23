<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('auth')-> group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/create', [UserController::class, 'createUser']);
        Route::get('', [UserController::class, 'getAllUsers']);
        Route::get('/{id}', [UserController::class, 'getUserById']);
        Route::patch('/{id}', [UserController::class, 'updateUserById']);
        Route::delete('/{id}', [UserController::class, 'deleteUserById']);
    });
});
