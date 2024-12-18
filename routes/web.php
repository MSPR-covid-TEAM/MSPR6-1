<?php

use App\Http\Controllers\Api\StatsPandemieController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [dashboardController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
});

Route::get('posts', [StatsPandemieController::class, 'index']);
Route::get('posts/{id}', [StatsPandemieController::class, 'show']);
Route::post('posts', [StatsPandemieController::class, 'store']);
Route::put('posts/{id}', [StatsPandemieController::class, 'update']);
Route::delete('posts/{id}', [StatsPandemieController::class, 'destroy']);