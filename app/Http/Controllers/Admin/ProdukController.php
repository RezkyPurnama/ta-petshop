<?php

namespace App\Http\Controllers\admin;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('nama_produk', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // biar query search tetap ikut ke pagination link
        $produks->appends(['search' => $search]);

        return view('admin.produk.index', compact('produks', 'search'));
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
            'berat' => 'required|integer|min:1',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $data = $request->only(['kategori_id', 'kode_produk', 'nama_produk', 'harga', 'berat', 'deskripsi']);

        if ($request->hasFile('gambar_produk')) {
            $data['gambar_produk'] = $request->file('gambar_produk')->store('gambar_produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
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
            'berat' => 'required|integer|min:1',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['kategori_id', 'kode_produk', 'nama_produk', 'harga','berat', 'deskripsi']);

        // Hapus gambar lama jika ada dan upload baru
        if ($request->hasFile('gambar_produk')) {
            $this->deleteImage($produk->gambar_produk);
            $data['gambar_produk'] = $request->file('gambar_produk')->store('gambar_produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $this->deleteImage($produk->gambar_produk); // Hapus gambar dari storage

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Fungsi bantu untuk menghapus gambar dari storage/public.
     */
    private function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
