<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

class RiwayatPesananController
{
    public function index()
    {
        return view('user.riwayat-pesanan.index');
    }
}
