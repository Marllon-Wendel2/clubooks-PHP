<?php

use Illuminate\Support\Facades\Route;

Route::get('/env-test', function () {
    return [
        'DB_DATABASE_env' => config('database.connections.mysql.database'),
        'DB_USERNAME_env' => config('database.connections.mysql.username'),
    ];
});


