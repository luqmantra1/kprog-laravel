<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login page (GET)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

// Handle login (POST)
Route::post('/login', [AuthController::class, 'auth_login'])->name('login.submit');

// Protected routes
Route::group(['middleware' => 'useradmin'], function () {
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
