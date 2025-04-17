<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\DocumentController;

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
    Route::get('/panel/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::get('panel/client/export', [ClientController::class, 'exportClientReport'])->name('client.export');
});

Route::prefix('panel/proposal')->group(function () {
    Route::get('/', [ProposalController::class, 'list']);
    Route::get('add', [ProposalController::class, 'add']);
    Route::post('insert', [ProposalController::class, 'insert']);
    Route::get('edit/{id}', [ProposalController::class, 'edit']);
    Route::post('update/{id}', [ProposalController::class, 'update']);
    Route::get('delete/{id}', [ProposalController::class, 'delete']);
});
Route::get('panel/proposal/export', [ProposalController::class, 'exportProposalReport'])->name('proposal.export');

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
    Route::get('panel/quotation/export', [QuotationController::class, 'exportQuotationReport'])->name('quotation.export');
});

    //Policies
    Route::get('panel/policy', [PolicyController::class, 'list'])->name('policy.list');
    Route::get('panel/policy/add', [PolicyController::class, 'add'])->name('policy.add');
    Route::post('panel/policy/add', [PolicyController::class, 'insert'])->name('policy.insert');
    Route::get('panel/policy/edit/{id}', [PolicyController::class, 'edit'])->name('policy.edit');
    Route::post('panel/policy/edit/{id}', [PolicyController::class, 'update'])->name('policy.update');
    Route::get('panel/policy/delete/{id}', [PolicyController::class, 'delete'])->name('policy.delete');
    Route::get('panel/policy/export', [PolicyController::class, 'exportPolicyReport'])->name('policy.export');
    
//Documents
Route::get('panel/document', [DocumentController::class, 'index'])->name('document.index');
Route::get('panel/document/create', [DocumentController::class, 'create'])->name('document.create');
Route::post('panel/document', [DocumentController::class, 'store'])->name('document.store');
Route::get('panel/document/download/{id}', [DocumentController::class, 'download'])->name('document.download');
Route::get('panel/document/download/proposal/{id}', [DocumentController::class, 'downloadProposal'])->name('document.download.proposal');
Route::get('panel/document/download/quotation/{id}', [DocumentController::class, 'downloadQuotation'])->name('document.download.quotation');
Route::get('panel/document/download/policy/{id}', [DocumentController::class, 'downloadPolicy'])->name('document.download.policy');
    

    


    
    



