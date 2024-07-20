<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], __DIR__ . '/../routes/api/auth.php');
Route::group(['prefix' => 'client', 'middleware' => ['auth:sanctum']], __DIR__ . '/../routes/api/client.php');
Route::group([], __DIR__ . '/../routes/api/public.php');