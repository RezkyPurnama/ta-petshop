<?php

namespace App\Http\Controllers\user;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProductKatalogController
{
    public function index()
    {
        $produks = Produk::orderBy('created_at', 'desc')->paginate(8);

        return view('user.product-katalog.index', compact('produks'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = 8;

        $produks = Produk::latest()
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        // return hanya card produk (partial view)
        return view('user.product-katalog.partials', compact('produks'))->render();
    }
}

