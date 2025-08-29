<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PesananController;
use App\Http\Controllers\admin\PembayaranController;

Route::post('/midtrans/callback', [PembayaranController::class, 'callback'])
->name('midtrans.callback');

// Route::get('/api/cities/{provinceId}', [PesananController::class, 'getCities']);

// // AJAX: Ambil kecamatan berdasarkan kota
// Route::get('/api/districts/{cityId}', [PesananController::class, 'getDistricts']);

// Route::post('/cekout/check-ongkir', [PesananController::class, 'checkOngkir']);
