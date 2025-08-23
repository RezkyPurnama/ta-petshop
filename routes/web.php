<?php

use App\Http\Controllers\user\GrommingController;
use App\Http\Controllers\user\KlinikController;
use App\Http\Controllers\user\KucingController;
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
use App\Http\Controllers\admin\DataKlinikController;
use App\Http\Controllers\admin\DataPesananController;
use App\Http\Controllers\Admin\GroomingController;
use App\Http\Controllers\admin\PembayaranController;
use App\Http\Controllers\user\PetHotelController;
use App\Http\Controllers\user\RiwayatPesananController;
use App\Http\Controllers\user\UserGroomingController;

Route::get('/', [LandingPageContoller::class, 'user'])->name('landing');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('/setting-user', UserController::class);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/stock-produk', StockProdukController::class);
    Route::resource('/data-grooming', GroomingController::class);
    Route::resource('/data-pethotel', DataPetHotelController::class);
    Route::resource('/data-klinik', DataKlinikController::class);
    Route::resource('/data-pesanan', DataPesananController::class);

    // laporan
    Route::get('laporan-klinik/pdf', [DataKlinikController::class, 'laporanPDF'])->name('data-klinik.laporan.pdf');
    Route::get('laporan-pethotel/pdf', [DataPetHotelController::class, 'laporanPDF'])->name('data-pethotel.laporan.pdf');
    Route::get('laporan-grooming/pdf', [GroomingController::class, 'laporanPDF'])->name('data-grooming.laporan.pdf');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/cart', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/cart', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('/cart/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::patch('/cart/{id}/update-jumlah', [KeranjangController::class, 'updateJumlah'])->name('keranjang.updateJumlah');

    Route::get('/checkout', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/checkout', [PesananController::class, 'store'])->name('pesanan.store');

    Route::get('/pembayaran/{pesanan_id}', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{pesanan}/confirm', [PembayaranController::class, 'confirm'])->name('pembayaran.confirm');
    Route::post('/pembayaran/batal/{pesanan}', [PembayaranController::class, 'batal'])->name('pembayaran.batal');
    Route::get('/pembayaran/{pesanan}/success', [PembayaranController::class, 'success'])->name('pembayaran.success');

    // Route::post('/midtrans/callback', [PembayaranController::class, 'callback'])->name('midtrans.callback');



    Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat-pesanan/{id}/detail', [RiwayatPesananController::class, 'detail'])->name('riwayat.detail');


    Route::post('/pet-klinik', [KlinikController::class, 'store'])->name('pet-klinik.store');
    Route::post('/grooming', [UserGroomingController::class, 'store'])->name('grooming.store');
    Route::post('/pet-hotel', [PetHotelController::class, 'store'])->name('pet-hotel.store');

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

Route::get('/pet-hotel', [PetHotelController::class, 'index'])->name('pet-hotel.index');
Route::get('/grooming', [UserGroomingController::class, 'index'])->name('grooming.index');
Route::get('/pet-klinik', [KlinikController::class, 'index'])->name('pet-klinik.index');

Route::get('/cat', [KucingController::class, 'index'])->name('cat.index');

