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

// API routes for /stats
Route::post('/stats', [ChartController::class, 'statsPandemie']); // Create
Route::get('/stats', [ChartController::class, 'getStatsPandemie']); // Read all
Route::get('/stats/{id}', [ChartController::class, 'getStatsPandemieById']); // Read one
Route::put('/stats/{id}', [ChartController::class, 'updateStatsPandemie']); // Update
Route::delete('/stats/{id}', [ChartController::class, 'destroyStatsPandemie']); // Delete
