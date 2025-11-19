<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/myarticles', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::view('/login', 'Auth.login')->name('login')->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest')->name('login.in');
Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');


Route::view('/register', 'Auth.register')->name('register')->middleware('guest');
Route::post('/register', RegisterController::class)->middleware('guest')->name('register.in');


