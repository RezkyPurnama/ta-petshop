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
use Midtrans\Config;
use Midtrans\Snap;

class PesananController
{
    public function index()
    {
        $userId = Auth::id();
        // dd($userId);
        $keranjangs = Keranjang::with('produk')->where('user_id', $userId)->get();
        $total = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);
        // $total = Pesanan::where('user_id', $userId)
        // ->where('status', 'belum_bayar')
        // ->latest()->firstOrFail();
        // dd($total);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . strtoupper(uniqid()),
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name ?? 'Guest',
                'email' => Auth::user()->email ?? 'guest@example.com',
                'phone' => Auth::user()->no_telepon ?? '08123456789',
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('user.cekout.index', compact('keranjangs', 'total', 'snapToken'));
    }

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

            foreach ($keranjangs as $item) {
                if ($item->jumlah > $item->produk->stockproduk->stock) {
                    return redirect()->route('pesanan.index')
                        ->with('error', 'Stok tidak cukup untuk ' . $item->produk->nama_produk);
                }
            }
            // Buat transaksi ID unik
            $trx_id = 'TRX-' . strtoupper(uniqid());
            $totalHarga = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);
            $jumlahTotal = $keranjangs->sum('jumlah');

            $pesanan = Pesanan::create([
                'user_id' => $userId,
                'trx_id' => $trx_id,
                'nama_penerima' => $request->nama_penerima,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'jumlah' => $jumlahTotal,
                'totalharga' => $totalHarga,
                'status' => 'sedang_diproses',
                'tgl_pesanan' => Carbon::now()->toDateString(),
            ]);

            foreach ($keranjangs as $item) {
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                    'total_harga' => $item->produk->harga * $item->jumlah,
                ]);

                $item->produk->stockproduk->decrement('stock', $item->jumlah);
            }

            Keranjang::where('user_id', $userId)->delete();

            DB::commit();
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pesanan.index')->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash(
            "sha512",
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Pesanan::find($request->order_id);
                if ($order) {
                    $order->update(['status' => 'Paid']);
                }
            }
        }
    }
}
