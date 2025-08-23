<?php

namespace App\Http\Controllers\user;

use App\Models\Klinik;
use App\Models\Pesanan;
use App\Models\Grooming;
use App\Models\PetHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPesananController
{
    public function index(Request $request)
    {
        $kategori = request('kategori') ?? 'pesanan';
        $search   = $request->search;

        // default semua data
        $pesanans = Pesanan::where('user_id', Auth::id());
        $pethotels = PetHotel::where('user_id', Auth::id());
        $groomings = Grooming::where('user_id', Auth::id());
        $petkliniks = Klinik::where('user_id', Auth::id());

        // filter kategori
        if ($kategori == 'pethotel') {
            $pethotels = $pethotels->when($search, function ($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%$search%");
            })->orderBy('check_in', 'desc')->get();

            $groomings = collect();
            $petkliniks = collect();
            $pesanans = collect();
        } elseif ($kategori == 'grooming') {
            $groomings = $groomings->when($search, function ($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%$search%");
            })->orderBy('tanggal_booking', 'desc')->get();

            $pethotels = collect();
            $petkliniks = collect();
            $pesanans = collect();
        } elseif ($kategori == 'petklinik') {
            $petkliniks = $petkliniks->when($search, function ($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%$search%");
            })->orderBy('tanggal_kunjungan', 'desc')->get();

        } elseif ($kategori == 'pesanan') {
            $pesanans = $pesanans->when($search, function ($q) use ($search) {
                $q->where('nama_penerima', 'like', "%$search%");
            })->orderBy('tgl_pesanan', 'desc')->get();

            $pethotels = collect();
            $groomings = collect();
        } else {
            // jika pilih "Semua"
            $pesanans = $pesanans->when($search, function ($q) use ($search) {
                $q->where('nama_penerima', 'like', "%$search%");
            })->orderBy('tgl_pesanan', 'desc')->get();

            $pethotels = $pethotels->when($search, function ($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%$search%");
            })->orderBy('check_in', 'desc')->get();

            $groomings = $groomings->when($search, function ($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%$search%");
            })->orderBy('tanggal_booking', 'desc')->get();

            $petkliniks = $petkliniks->when($search, function ($q) use ($search) {
                $q->where('nama_pemilik', 'like', "%$search%");
            })->orderBy('tanggal_kunjungan', 'desc')->get();
        }

        return view('user.riwayat-pesanan.index', compact('pesanans', 'pethotels', 'groomings', 'petkliniks'));
    }



public function detail($id)
{
        $pesanan = Pesanan::with(['pesanandetail.produk'])->findOrFail($id);
        return view('user.riwayat-pesanan.detailpesanan', compact('pesanan'));

}

}
