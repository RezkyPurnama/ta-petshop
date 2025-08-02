<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\LandingPageContoller;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\StockProdukController;

Route::get('/', [LandingPageContoller::class, 'user']);

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('/setting-user', UserController::class);
    Route::resource('/product', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/stock-produk', StockProdukController::class);
});

Route::middleware(['auth'])->group(function () {

});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'proses_register']);

Route::get('/user', [LandingPageContoller::class, 'user']);
