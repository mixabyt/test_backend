<?php

use App\Http\Controllers\Admin\DeleteArticleController;
use App\Http\Controllers\Admin\ShowArticleController;
use App\Http\Controllers\Admin\StoreArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\EditArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
//use App\Http\Controllers\Admin\UpdateArticleController;
use App\Http\Controllers\Admin\ArticleController;

Route::middleware('auth')->prefix('myarticles')->group(function () {
        Route::get('/', ShowArticleController::class)->name('dashboard');
        Route::view('/create', 'admin.article.create')->name('article.create');
        Route::post("/create", [ArticleController::class, 'store'])->name('article.store');
        Route::get('/update/{id}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/update/{id}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
});

// при видаленні поста видаляти фотку на пк
Route::view('/login', 'Auth.login')->name('login')->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest')->name('login.in');
Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');


Route::view('/register', 'Auth.register')->name('register')->middleware('guest');
Route::post('/register', RegisterController::class)->middleware('guest')->name('register.in');


Route::get('/', [NewsController::class, 'index'])->name('news');
Route::get('/{id}', [NewsController::class, 'indexpage'])->name('new.page');
