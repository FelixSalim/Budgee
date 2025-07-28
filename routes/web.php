<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/dashboard', [PageController::class, 'index'])->middleware('auth')->name('home');

Route::get('/transactions', [PageController::class, 'transactions'])->middleware('auth')->name('transactions');

Route::get('/newtransaction', [PageController::class, 'newtransaction'])->middleware('auth')->name('newtransaction');

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [PageController::class, 'categories'])->name('categories');
    Route::get('/categories/new', [PageController::class, 'newcategory'])->name('newcategory');
    Route::post('/categories/store', [PageController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{id}/delete', [PageController::class, 'deleteCategory'])->name('categories.delete');
});
Route::get('/regularpayment', [PageController::class, 'regularpayment'])->middleware('auth')->name('regularpayment');

Route::get('/newregularpayment', [PageController::class, 'newregularpayment'])->middleware('auth')->name('newregularpayment');

Route::get('/goalslist', [PageController::class, 'goalslist'])->middleware('auth')->name('goalslist');

Route::get('/newgoals', [PageController::class, 'newgoals'])->middleware('auth')->name('newgoals');

// jalankan logic register, login, logout, dan profile (POST)
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');


Route::get('/', [PageController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');


Route::get('/profile', [PageController::class, 'profile'])->middleware('auth')->name('profile');
Route::put('/profile', [AuthController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/update-profile-picture', [AuthController::class, 'updateProfilePicture'])->middleware('auth')->name('user.updateProfilePicture');

// Auth::routes(); --> harus install laravel UI dlu
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


