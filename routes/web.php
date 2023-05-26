<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('auth/login', [LoginController::class, 'login'])->name('login');
Route::post('auth/login', [LoginController::class, 'check'])->name('login.check');

Route::get('register', [RegisterController::class, 'registerForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.save');

Route::get('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware'=>['AuthCheck']],function () {
    Route::get('/employer/dashboard', [LoginController::class, 'dashboard'])->name('employer.dashboard');
    // Add other authenticated routes here
});
