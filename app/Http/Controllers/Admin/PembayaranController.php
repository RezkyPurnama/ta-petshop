<?php

namespace App\Http\Controllers\admin;

use Midtrans\Config;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController
{
    public function index($pesanan_id)
    {
        $userId = Auth::id();

        // Ambil pesanan sesuai user dan ID
        $pesanan = Pesanan::with('pesanandetail.produk')
            ->where('user_id', $userId)
            ->findOrFail($pesanan_id);

        // Setup Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Param pembayaran
        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->trx_id, // gunakan trx_id dari database
                'gross_amount' => $pesanan->totalharga,
            ],
            'customer_details' => [
                'first_name' => $pesanan->nama_penerima,
                'phone'      => $pesanan->telepon,
            ],
        ];

        // Buat snap token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Kirim ke blade
        return view('user.pembayaran.index', compact('pesanan', 'snapToken'));
    }

    public function batal(Pesanan $pesanan)
    {
        $userId = Auth::id();

        // Pastikan pesanan milik user
        if ($pesanan->user_id !== $userId) {
            abort(403, 'Akses ditolak.');
        }

        // Update status pesanan menjadi 'cancel'
        $pesanan->update(['status' => 'cancel']);

        return redirect()->route('landing')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function success(Pesanan $pesanan)
    {
        $userId = Auth::id();

        // Pastikan pesanan milik user
        if ($pesanan->user_id !== $userId) {
            abort(403, 'Akses ditolak.');
        }

        // $pesanan->update([
        //     'status' => 'sedang_diproses',
        //     'status_pembayaran' => 'paid',
        // ]);

        return view('user.pembayaran.succes', compact('pesanan'));
    }


    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        // Validasi signature key dari Midtrans
        $hashed = hash(
            "sha512",
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // Cari pesanan sesuai order_id (sesuaikan dengan field kamu)
        $pesanan = Pesanan::where('trx_id', $request->order_id)->first();

        if (!$pesanan) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }

        $transaction = $request->transaction_status;
        $fraud = $request->fraud_status;

        if ($transaction == 'capture') {
            if ($fraud == 'accept') {
                $pesanan->update([
                    'status' => 'sedang_diproses',
                    'status_pembayaran' => 'paid',
                ]);
            }
        } elseif ($transaction == 'settlement') {
            $pesanan->update([
                'status' => 'sedang_diproses',
                'status_pembayaran' => 'paid',
            ]);
        } elseif ($transaction == 'pending') {
            $pesanan->update([
                'status' => 'pending',
                'status_pembayaran' => 'unpaid',
            ]);
        } else { // deny, expire, cancel
            $pesanan->update([
                'status' => 'cancel',
                'status_pembayaran' => 'cancel',
            ]);
        }

        return response()->json(['success' => true]);
    }
}
