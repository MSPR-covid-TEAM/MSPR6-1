<?php

use App\Http\Controllers\Api\StatsPandemieController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\dashboardController;
use App\Models\Pandemie;
use App\Models\Pays;
use Illuminate\Support\Facades\Route;

Route::get('/', [dashboardController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/pays', function () {
    return response()->json(Pays::all());
});

Route::get('/pandemie', function () {
    return response()->json(Pandemie::all());
});

Route::post('/stats', [ChartController::class, 'statsPandemie']);
