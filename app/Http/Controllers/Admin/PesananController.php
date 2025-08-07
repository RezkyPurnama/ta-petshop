<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PesananController
{
    // Menampilkan halaman checkout
    public function index()
    {
        $userId = Auth::id();
        $keranjangs = Keranjang::with('produk')->where('user_id', $userId)->get();
        $total = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);

        return view('user.cekout.index', compact('keranjangs', 'total'));
    }

    // Menyimpan pesanan
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            $userId = Auth::id();
            $keranjangs = Keranjang::with('produk.stockproduk')->where('user_id', $userId)->get();

            if ($keranjangs->isEmpty()) {
                return redirect()->route('pesanan.index')->with('error', 'Keranjang anda kosong.');
            }

            // Validasi stok
            foreach ($keranjangs as $item) {
                if (!$item->produk_id || !$item->produk || $item->jumlah > $item->produk->stockproduk->stock) {
                    return redirect()->route('pesanan.index')->with('error', 'Stok produk tidak mencukupi untuk "' . $item->produk->nama . '".');
                }
            }

            // Buat transaksi ID unik
            $trx_id = 'TRX-' . strtoupper(uniqid());
            $totalHarga = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);
            $jumlahTotal = $keranjangs->sum('jumlah');

            // Simpan ke tabel Pesanan
            $pesanan = Pesanan::create([
                'user_id' => $userId,
                'produk_id' => $item->produk_id,
                'trx_id' => $trx_id,
                'nama_penerima' => $request->nama_penerima,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'jumlah' => $jumlahTotal,
                'totalharga' => $totalHarga,
                'status' => 'sedang_diproses',
                'tgl_pesanan' => Carbon::now()->toDateString(),
            ]);

            // Simpan setiap produk sebagai detail
            foreach ($keranjangs as $item) {
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                    'total_harga' => $item->produk->harga * $item->jumlah,
                ]);

                // Kurangi stok
                $item->produk->stockproduk->decrement('stock', $item->jumlah);
            }

            // Hapus keranjang
            Keranjang::where('user_id', $userId)->delete();

            DB::commit();
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pesanan.index')->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}
