<?php

namespace App\Http\Controllers\user;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController
{
    // Menampilkan isi keranjang
    public function index()
    {
        $keranjangs = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        $total = $keranjangs->sum('totalharga');

        return view('user.keranjang.keranjang', compact('keranjangs', 'total'));
    }

    // Menambahkan produk ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga * $request->jumlah;

        // Cek jika produk sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $produk->id)
            ->first();

        if ($keranjang) {
            $keranjang->jumlah += $request->jumlah;
            $keranjang->totalharga += $totalHarga;
            $keranjang->save();
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $produk->id,
                'jumlah' => $request->jumlah,
                'totalharga' => $totalHarga,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $item = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $item->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
