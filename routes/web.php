<?php

use App\Http\Controllers\Admin\DeleteArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\EditArticleController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->prefix('myarticles')->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');
        Route::view('/create', 'admin.article.create')->name('article.create');
        Route::get('/update/{id}', EditArticleController::class)->name('article.edit');
        Route::delete('/delete/{id}', DeleteArticleController::class)->name('article.destroy');

});


Route::view('/login', 'Auth.login')->name('login')->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest')->name('login.in');
Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');


Route::view('/register', 'Auth.register')->name('register')->middleware('guest');
Route::post('/register', RegisterController::class)->middleware('guest')->name('register.in');

Route::view('/', 'news')->name('news');

//Route::view('/')
