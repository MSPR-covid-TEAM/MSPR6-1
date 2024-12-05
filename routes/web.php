<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [dashboardController::class, 'index']);
