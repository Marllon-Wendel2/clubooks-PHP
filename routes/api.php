<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->group(function () {
    Route::post('/create', [UserController::class, 'createUser']);
    Route::get('', [UserController::class, 'getAllUsers']);
    Route::get('/{id}', [UserController::class, 'getUserById']);
});
