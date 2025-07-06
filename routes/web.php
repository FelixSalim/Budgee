<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/newcategory', [PageController::class, 'newcategory'])->name('newcategory');
Route::get('/regularpayment', [PageController::class, 'regularpayment'])->name('regularpayment');
Route::get('/newregularpayment', [PageController::class, 'newregularpayment'])->name('newregularpayment');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/log-in', [PageController::class, 'login'])->name('login');


Route::get('/goalist', function () {
    return view('goalslist');
});

Route::get('/newgoals', function () {
    return view('newgoals');
});
