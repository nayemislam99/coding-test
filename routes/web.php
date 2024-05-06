<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'authenticate')->name('login');
        Route::get('/logout', 'logout')->name('logout');
    });
});

Route::prefix('/')->name('dashboard.')->middleware(['auth.check'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/signup', 'signup')->name('signup');
        Route::post('/signup', 'createUser')->name('create.user');
        Route::get('/deposite', 'depositeTrans')->name('deposite.trans');
        Route::get('/withdrawl', 'withdrawlTrans')->name('withdrawl.trans');
        Route::get('/deposite-amount', 'depositeAmountIndex')->name('deposite.amount.index');
        Route::post('/deposite-amount', 'depositeAmount')->name('deposite.amount');
        Route::get('/withdrawl-amount', 'withdrawlAmountIndex')->name('withdrawl.amount.index');
        Route::post('/withdrawl-amount', 'withdrawlAmount')->name('withdrawl.amount');
    });
});
