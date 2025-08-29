<?php

namespace App\Http\Controllers\user;

use App\Models\Produk;
use Illuminate\Http\Request;

class AkesesorisController
{
    public function index()
    {
        $produks = Produk::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'aksesoris');
        })->paginate(10);
        return view('user.halaman.aksesoris',compact('produks'));
    }
}
