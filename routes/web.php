<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RegularPaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'index'])->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [PageController::class, 'transactions'])->name('transactions');

    Route::get('/newtransaction', [PageController::class, 'newtransaction'])->name('newtransaction');

    Route::post('/store-transaction', [TransactionController::class, 'storeTransaction'])->name('transaction.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/regularpayment/new', [RegularPaymentController::class, 'create'])->name('regularpayment.create');
    
    Route::post('/regularpayment/store', [RegularPaymentController::class, 'store'])->name('regularpayment.store');
    
    Route::get('/regularpayment', [RegularPaymentController::class, 'index'])->name('regularpayment');
    
    Route::put('/regularpayment/update/{id}', [RegularPaymentController::class, 'update'])->name('regularpayment.update');
    
    Route::delete('/regularpayment/{id}', [RegularPaymentController::class, 'destroy'])->name('regularpayment.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [PageController::class, 'categories'])->name('categories');
    Route::get('/categories/new', [PageController::class, 'newcategory'])->name('newcategory');
    Route::post('/categories/store', [PageController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{category}/edit', [PageController::class, 'editCategory'])->name('categories.edit'); // New edit route
    Route::put('/categories/{category}', [PageController::class, 'updateCategory'])->name('categories.update'); // New update route
    Route::delete('/categories/{id}/delete', [PageController::class, 'deleteCategory'])->name('categories.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/goalslist', [PageController::class, 'goalslist'])->name('goalslist');

    Route::get('/newgoals', [PageController::class, 'newgoals'])->name('newgoals');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    
    Route::put('/profile', [AuthController::class, 'update'])->name('profile.update');
    
    Route::post('/update-profile-picture', [AuthController::class, 'updateProfilePicture'])->name('user.updateProfilePicture');
});

// Auth::routes(); --> harus install laravel UI dlu
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/', [PageController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');