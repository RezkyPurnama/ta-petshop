<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\LandingPageContoller;
use App\Http\Controllers\user\AboutController;
use App\Http\Controllers\user\DetailController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\admin\PesananController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\user\KeranjangController;
use App\Http\Controllers\admin\StockProdukController;
use App\Http\Controllers\admin\DataPetHotelController;
use App\Http\Controllers\user\ProductKatalogController;
use App\Http\Controllers\admin\DashboardAdminController;

Route::get('/', [LandingPageContoller::class, 'user']);

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('/setting-user', UserController::class);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/stock-produk', StockProdukController::class);

    Route::get('/data-pethotel', [DataPetHotelController::class, 'index'])->name('index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/cart', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/cart', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('/cart/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::patch('/cart/{id}/update-jumlah', [KeranjangController::class, 'updateJumlah'])->name('keranjang.updateJumlah');

    Route::get('/cekout', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/checkout', [PesananController::class, 'store'])->name('pesanan.store');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'proses_register']);

Route::get('/user', [LandingPageContoller::class, 'user']);

Route::get('/about', [AboutController::class, 'index']);
Route::get('/product', [ProductKatalogController::class, 'index']);

Route::get('/detail-produk/{nama_produk}', [DetailController::class, 'detail'])->name('detail-produk');
