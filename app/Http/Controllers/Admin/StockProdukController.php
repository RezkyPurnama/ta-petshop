<?php

namespace App\Http\Controllers\admin;

use App\Models\Produk;
use App\Models\StockProduk;
use Illuminate\Http\Request;

class StockProdukController
{
    // Menampilkan Daftar Stok Produk
    public function index()
    {
        $stock_produk = StockProduk::with('produk')->paginate(10);
        return view('admin.stock-produk.index', compact('stock_produk'));
    }

    public function create()
    {
        // Ambil ID produk yang sudah ada di tabel stock
        $produkSudahAdaStock = StockProduk::pluck('produk_id')->toArray();

        // Ambil hanya produk yang belum punya stok
        $produks = Produk::whereNotIn('id', $produkSudahAdaStock)->get();

        return view('admin.stock-produk.create', compact('produks'));
    }


    // Menyimpan data stok produk baru
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id|unique:stock_produk,produk_id',
            'stock' => 'required|integer|min:0',
        ], [
            'produk_id.unique' => 'Produk sudah ada, tidak bisa ditambahkan lagi.',
        ]);

        StockProduk::create($request->all());

        return redirect()->route('stock-produk.index')->with('success', 'Stok produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit stok produk
    public function edit($id)
    {
        $stockProduk = StockProduk::findOrFail($id);
        $produks = Produk::all();
        return view('admin.stock-produk.edit', compact('stockProduk', 'produks'));
    }

    // Memperbarui data stok produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id|unique:stock_produk,produk_id,' . $id,
            'stock' => 'required|integer|min:0',
        ], [
            'produk_id.unique' => 'Produk sudah ada, tidak bisa ditambahkan lagi.',
        ]);

        $stockProduk = StockProduk::findOrFail($id);
        $stockProduk->update($request->all());

        return redirect()->route('stock-produk.index')->with('success', 'Stok produk berhasil diperbarui.');
    }

    // Menghapus data stok produk
    public function destroy($id)
    {
        $stockProduk = StockProduk::findOrFail($id);
        $stockProduk->delete();

        return redirect()->route('stock-produk.index')->with('success', 'Stok produk berhasil dihapus.');
    }
}
