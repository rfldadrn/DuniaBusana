<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\monitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', [dashboardController::class, 'view'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users', [usersController::class, 'view'])->name('users.view');
    Route::get('/users/{id}', [usersController::class, 'detail'])->name('users.detail');
    Route::patch('/users', [usersController::class, 'update'])->name('users.update');
    Route::post('/users', [usersController::class, 'store'])->name('users.store');
    Route::get('/usersDelete/{id}', [usersController::class, 'destroy'])->name('users.destroy');

    // Transaction
    Route::get('/downloadInvoice/{id}', [transactionController::class, 'downloadInvoice'])->name('invoice.download');
    Route::get('/transaction', [transactionController::class, 'view'])->name('transaction.view');
    Route::get('/transaction/create', [transactionController::class, 'create'])->name('transaction.create');
    Route::get('/transaction/detail/{id}', [transactionController::class, 'edit'])->name('transaction.edit');
    Route::delete('/transaction/delete/{id}', [transactionController::class, 'destroy'])->name('transaction.delete');
    Route::patch('/transaction', [transactionController::class, 'update'])->name('transaction.update');
    Route::post('/transaction/store', [transactionController::class, 'store'])->name('transaction.store');
    Route::post('/transaction', [transactionController::class, 'viewWithFilter'])->name('transaction.filter');

    // Customer
    Route::get('/search-customer', [customerController::class, 'searchByPhone'])->name('search.customer');

    // Monitoring
    Route::get('/monitoring', [monitoringController::class, 'view'])->name('monitoring.view');

});

require __DIR__.'/auth.php';
