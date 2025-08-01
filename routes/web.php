<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\LandingPageContoller;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\admin\DashboardAdminController;

Route::get('/', [LandingPageContoller::class, 'user']);

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('/setting-user', UserController::class);
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'proses_register']);
