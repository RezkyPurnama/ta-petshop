<?php

namespace App\Http\Controllers\user;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProductKatalogController
{
    public function index()
    {
        $produks = Produk::latest()->take(6)->get();
        return view('user.product-katalog.index', compact('produks'));
    }
}
