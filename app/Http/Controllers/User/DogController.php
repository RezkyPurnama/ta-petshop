<?php

namespace App\Http\Controllers\user;

use App\Models\Produk;
use Illuminate\Http\Request;

class DogController
{
    public function index()
    {
        $produks = Produk::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'dog');
        })->paginate(10); 



        return view('user.halaman.dog', compact('produks'));
    }
}
