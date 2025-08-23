<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PembayaranController;

Route::post('/midtrans/callback', [PembayaranController::class, 'callback'])
->name('midtrans.callback');
