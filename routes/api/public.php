<?php

use App\Http\Controllers\CommonFollowersController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UsersController::class)
    ->only('index', 'show')
    ->parameter('users', 'user:username');

Route::get('users/{user}/common-followers/{comparedUser}', CommonFollowersController::class)
    ->name('users.common-followers');