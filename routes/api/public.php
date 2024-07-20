<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UsersController::class)
    ->only('index', 'show')
    ->parameter('users', 'user:username');
