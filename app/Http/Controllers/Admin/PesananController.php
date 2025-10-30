<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PesananController
{
    public function index()
    {
        $userId = Auth::id();
        $keranjangs = Keranjang::with('produk')
            ->where('user_id', $userId)
            ->get();


        $total = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);

        $totalBerat = $keranjangs->sum(fn($k) => ($k->berat ?? 0) * $k->jumlah);

        // Ambil data provinsi dari RajaOngkir
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        $provinces = $response->successful() ? $response->json()['data'] ?? [] : [];


        // Tambahkan daftar kurir yang umum digunakan
        $couriers = [
            'jne'       => 'JNE',
            'tiki'      => 'TIKI',
            'pos'       => 'POS Indonesia',
            'jnt'       => 'J&T Express',
            'sicepat'   => 'SiCepat',
            'wahana'    => 'Wahana',
            'lion'      => 'Lion Parcel',
            'ninja'     => 'Ninja Xpress',
            'idexpress' => 'ID Express',
            'anteraja'  => 'AnterAja',
        ];

        return view('user.cekout.index', compact('keranjangs', 'total', 'totalBerat', 'provinces', 'couriers'));
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
            $keranjangs = Keranjang::with('produk.stockproduk')
                ->where('user_id', $userId)
                ->get();

            if ($keranjangs->isEmpty()) {
                return redirect()->route('pesanan.index')->with('error', 'Keranjang anda kosong.');
            }

            // Cek stok
            foreach ($keranjangs as $item) {
                if ($item->jumlah > $item->produk->stockproduk->stock) {
                    return redirect()->route('pesanan.index')
                        ->with('error', 'Stok tidak cukup untuk ' . $item->produk->nama_produk);
                }
            }

            // Generate trx_id sesuai format
            $trx_id = $this->generateTrxId();

            $totalHarga = $keranjangs->sum(fn($k) => $k->produk->harga * $k->jumlah);
            $jumlahTotal = $keranjangs->sum('jumlah');
            $totalBerat = $keranjangs->sum(fn($k) => ($k->berat ?? 0) * $k->jumlah);

            // Simpan pesanan
            $pesanan = Pesanan::create([
                'user_id' => $userId,
                'trx_id' => $trx_id,
                'nama_penerima' => $request->nama_penerima,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'jumlah' => $jumlahTotal,
                'totalharga' => $totalHarga ,
                'total_berat'   => $totalBerat,
                'ongkir' => $request->ongkir, // Tambahkan ini
                'status' => 'tunggu_pembayaran',
                'status_pembayaran' => 'unpaid',
                'tgl_pesanan' => Carbon::now()->toDateString(),
            ]);
            // dd($pesanan);

            // Simpan detail pesanan & update stok
            foreach ($keranjangs as $item) {
                PesananDetail::create([
                    'pesanan_id'   => $pesanan->id,
                    'produk_id'    => $item->produk_id,
                    'jumlah'       => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                    'total_harga'  => $item->produk->harga * $item->jumlah,
                ]);

                $item->produk->stockproduk->decrement('stock', $item->jumlah);
            }

            // Kosongkan keranjang
            Keranjang::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('pembayaran.index', ['pesanan_id' => $pesanan->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pesanan.index')->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Generate kode transaksi dengan format:
     * TRX-ddmmyyyyNNN (NNN = nomor urut 3 digit)
     */
    private function generateTrxId()
    {
        $tanggal = date("dmY");

        // ambil nomor urut terakhir untuk hari ini
        $id = Pesanan::selectRaw('RIGHT(trx_id,3) as id')
            ->whereDate('tgl_pesanan', Carbon::today())
            ->orderByRaw('RIGHT(trx_id,3) DESC')
            ->lockForUpdate()
            ->limit(1)
            ->value('id');

        if ($id) {
            do {
                $id++;
                $no = str_pad($id, 3, '0', STR_PAD_LEFT);

                $new_id = "TRX-" . $tanggal . $no;
                $exists = Pesanan::where('trx_id', $new_id)->exists();
            } while ($exists);

            return $new_id;
        } else {
            return "TRX-" . $tanggal . "001";
        }
    }
    // =================== RajaOngkir Methods ===================

    /**
     * Ambil daftar kota berdasarkan provinceId
     */
    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        return response()->json($response->successful() ? $response->json()['data'] ?? [] : []);
    }

    /**
     * Ambil daftar kecamatan berdasarkan cityId
     */
    public function getDistricts($cityId)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        return response()->json($response->successful() ? $response->json()['data'] ?? [] : []);
    }
    public function checkOngkir(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|integer',
            'weight'         => 'required|integer|min:1',
            'courier'        => 'required|string',
        ]);

        try {
            $response = Http::asForm()->withHeaders([
                'Accept' => 'application/json',
                'key'    => config('rajaongkir.api_key'),
            ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin'      => $request->input('origin_id', 4029), // fallback asal
                'destination' => $request->destination_id,
                'weight'      => $request->weight,
                'courier'     => $request->courier,
            ]);

            if ($response->successful()) {
                return response()->json([
                    'status' => true,
                    'data'   => $response->json()['data'] ?? [],
                ]);
            }

            return response()->json(['status' => false, 'data' => []], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat menghitung ongkos kirim',
            ], 500);
        }
    }
}
