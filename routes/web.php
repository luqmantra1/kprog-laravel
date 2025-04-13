<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\QuotationController;

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

Route::prefix('panel/proposal')->group(function () {
    Route::get('/', [ProposalController::class, 'list']);
    Route::get('add', [ProposalController::class, 'add']);
    Route::post('insert', [ProposalController::class, 'insert']);
    Route::get('edit/{id}', [ProposalController::class, 'edit']);
    Route::post('update/{id}', [ProposalController::class, 'update']);
    Route::get('delete/{id}', [ProposalController::class, 'delete']);
});

// Quotation Routes
Route::prefix('panel/quotation')->group(function() {
    // List all quotations
    Route::get('/', [QuotationController::class, 'list'])->name('quotation.list');
    
    // Add a new quotation
    Route::get('add', [QuotationController::class, 'add'])->name('quotation.add');
    Route::post('add', [QuotationController::class, 'insert'])->name('quotation.insert');

    // Edit a quotation
    Route::get('edit/{id}', [QuotationController::class, 'edit'])->name('quotation.edit');
    Route::post('edit/{id}', [QuotationController::class, 'update'])->name('quotation.update');
    
    // Delete a quotation
    Route::get('delete/{id}', [QuotationController::class, 'delete'])->name('quotation.delete');
});

    //Policies
    // Route::get('panel/policy', [PolicyController::class, 'list']);
    // Route::get('panel/policy/add', [PolicyController::class, 'add']);
    // Route::post('panel/policy/add', [PolicyController::class, 'insert']);
    // Route::get('panel/policy/edit/{id}', [PolicyController::class, 'edit']);
    // Route::post('panel/policy/edit/{id}', [PolicyController::class, 'update']);
    // Route::get('panel/policy/delete/{id}', [PolicyController::class, 'delete']);
    

    


    //Documents
//     Route::get('panel/document', [DocumentController::class, 'list']);
//     Route::get('panel/document/add', [DocumentController::class, 'add']);
//     Route::post('panel/document/add', [DocumentController::class, 'insert']);
//     Route::get('panel/document/edit/{id}', [DocumentController::class, 'edit']);
//     Route::post('panel/document/edit/{id}', [DocumentController::class, 'update']);
//     Route::get('panel/document/delete/{id}', [DocumentController::class, 'delete']);
// });



