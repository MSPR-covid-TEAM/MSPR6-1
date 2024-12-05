<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [dashboardController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
});