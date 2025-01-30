<?php

use App\Http\Controllers\Api\StatsPandemieController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [dashboardController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
});

Route::post('/stats', [ChartController::class, 'statsPandemie']);
