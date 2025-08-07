<?php

namespace App\Http\Controllers\user;

use App\Models\Produk;
use Illuminate\Http\Request;

class DetailController
{

    public function detail($id)
    {
        $produk = Produk::with('stockproduk')->findOrFail($id);
        // dd($produk->stockproduk);

        return view('user.detail-produk.detail', compact('produk'));
    }
}
