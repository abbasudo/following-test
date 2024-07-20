<?php

use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

Route::post('/users/{user:username}/follow', [FollowController::class, 'store'])->name('users.follow');
Route::delete('/users/{user:username}/follow', [FollowController::class, 'destroy'])->name('users.unfollow');
