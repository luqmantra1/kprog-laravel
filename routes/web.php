<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;

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
// web.php

Route::group(['middleware' => 'useradmin'], function () {
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('panel/role', [RoleController::class, 'list']);
    Route::get('panel/role/add', [RoleController::class, 'add']);
    Route::post('panel/role/add', [RoleController::class, 'insert']);

    // ✅ Correct edit and update
    Route::get('panel/role/edit/{id}', [RoleController::class, 'edit']);
    Route::post('panel/role/edit/{id}', [RoleController::class, 'update']);

    Route::get('panel/role/delete/{id}', [RoleController::class, 'delete']);
});


