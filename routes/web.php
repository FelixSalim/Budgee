<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/dashboard', [PageController::class, 'index'])->middleware('auth')->name('home');

Route::get('/transactions', [PageController::class, 'transactions'])->middleware('auth')->name('transactions');

Route::get('/newtransaction', [PageController::class, 'newtransaction'])->middleware('auth')->name('newtransaction');

Route::get('/categories', [PageController::class, 'categories'])->middleware('auth')->name('categories');

Route::get('/newcategory', [PageController::class, 'newcategory'])->middleware('auth')->name('newcategory');

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
Route::put('/profile', [PageController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::post('/update-profile-picture', [AuthController::class, 'updateProfilePicture'])->name('user.updateProfilePicture');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


