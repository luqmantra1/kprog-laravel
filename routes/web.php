<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

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
    //Dashboard
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //Role
    Route::get('panel/role', [RoleController::class, 'list']);
    Route::get('panel/role/add', [RoleController::class, 'add']);
    Route::post('panel/role/add', [RoleController::class, 'insert']);
    Route::get('panel/role/edit/{id}', [RoleController::class, 'edit']);
    Route::post('panel/role/edit/{id}', [RoleController::class, 'update']);
    Route::get('panel/role/delete/{id}', [RoleController::class, 'delete']);

    //User
    Route::get('panel/user', [UserController::class, 'list']);
    Route::get('panel/user/add', [UserController::class, 'add']);
    Route::post('panel/user/add', [UserController::class, 'insert']);
    Route::get('panel/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('panel/user/edit/{id}', [UserController::class, 'update']);
    Route::get('panel/user/delete/{id}', [UserController::class, 'delete']);

});
    // CLIENT ROUTES
    Route::prefix('panel/client')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('add', [ClientController::class, 'add']);
    Route::post('add', [ClientController::class, 'insert']);
    Route::get('edit/{id}', [ClientController::class, 'edit']);
    Route::post('edit/{id}', [ClientController::class, 'update']);
    Route::get('delete/{id}', [ClientController::class, 'delete']);
});

    //Policies
    // Route::get('panel/policy', [PolicyController::class, 'list']);
    // Route::get('panel/policy/add', [PolicyController::class, 'add']);
    // Route::post('panel/policy/add', [PolicyController::class, 'insert']);
    // Route::get('panel/policy/edit/{id}', [PolicyController::class, 'edit']);
    // Route::post('panel/policy/edit/{id}', [PolicyController::class, 'update']);
    // Route::get('panel/policy/delete/{id}', [PolicyController::class, 'delete']);

    //Proposal
    // Route::get('panel/proposal', [ProposalController::class, 'list']);
    // Route::get('panel/proposal/add', [ProposalController::class, 'add']);
    // Route::post('panel/proposal/add', [ProposalController::class, 'insert']);
    // Route::get('panel/proposal/edit/{id}', [ProposalController::class, 'edit']);
    // Route::post('panel/proposal/edit/{id}', [ProposalController::class, 'update']);
    // Route::get('panel/proposal/delete/{id}', [ProposalController::class, 'delete']);

    //Quotation
    // Route::get('panel/quotation', [QuotationController::class, 'list']);
    // Route::get('panel/quotation/add', [QuotationController::class, 'add']);
    // Route::post('panel/quotation/add', [QuotationController::class, 'insert']);
    // Route::get('panel/quotation/edit/{id}', [QuotationController::class, 'edit']);
    // Route::post('panel/quotation/edit/{id}', [QuotationController::class, 'update']);
    // Route::get('panel/quotation/delete/{id}', [QuotationController::class, 'delete']);

    //Documents
//     Route::get('panel/document', [DocumentController::class, 'list']);
//     Route::get('panel/document/add', [DocumentController::class, 'add']);
//     Route::post('panel/document/add', [DocumentController::class, 'insert']);
//     Route::get('panel/document/edit/{id}', [DocumentController::class, 'edit']);
//     Route::post('panel/document/edit/{id}', [DocumentController::class, 'update']);
//     Route::get('panel/document/delete/{id}', [DocumentController::class, 'delete']);
// });



