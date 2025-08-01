<?php

namespace App\Http\Controllers\admin;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController
{
    public function index()
    {
        $produks = Produk::with('kategori')
            ->latest() // order by created_at desc
            ->take(10) // ambil hanya 10 data
            ->get();

        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks,kode_produk',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'gambar_produk' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['kategori_id', 'kode_produk', 'nama_produk', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar_produk')) {
            $data['gambar_produk'] = $request->file('gambar_produk')->store('gambar_produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'kode_produk' => 'required|unique:produks,kode_produk,' . $produk->id,
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'gambar_produk' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['kategori_id', 'kode_produk', 'nama_produk', 'harga', 'deskripsi']);

        if ($request->hasFile('gambar_produk')) {
            if ($produk->gambar_produk && Storage::disk('public')->exists($produk->gambar_produk)) {
                Storage::disk('public')->delete($produk->gambar_produk);
            }
            $data['gambar_produk'] = $request->file('gambar_produk')->store('gambar_produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar_produk && Storage::disk('public')->exists($produk->gambar_produk)) {
            Storage::disk('public')->delete($produk->gambar_produk);
        }

        $produk->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
