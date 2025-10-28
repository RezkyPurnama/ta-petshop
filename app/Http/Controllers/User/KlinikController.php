<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Klinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlinikController
{
    public function index()
    {
        return view('user.pet-klinik.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:100',
            'jenis_hewan' => 'required|in:Anjing,Kucing,lainnya',
            'vaksinasi' => 'required|in:Ya,Tidak',
            'umur_hewan' => 'required|integer',
            'berat' => 'required|numeric',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'waktu_kunjungan' => 'required|date_format:H:i',
            'keluhan' => 'required|string',
        ]);

        $tanggal = $request->tanggal_kunjungan;
        $waktu = Carbon::parse($request->waktu_kunjungan);

        $buka = Carbon::createFromTime(11, 0, 0);
        $tutup = Carbon::createFromTime(21, 0, 0);

        if ($waktu->lt($buka) || $waktu->gt($tutup)) {
            return redirect()->back()
                ->withErrors(['waktu_kunjungan' => 'Waktu kunjungan hanya tersedia antara pukul 11:00 hingga 21:00.'])
                ->withInput();
        }

        $jamKunjungan = $waktu->format('H');

        $jumlahBooking = Klinik::whereDate('tanggal_kunjungan', $tanggal)
            ->whereRaw('EXTRACT(HOUR FROM waktu_kunjungan) = ?', [$jamKunjungan])
            ->count();

        if ($jumlahBooking >= 3) {
            return redirect()->back()
                ->withErrors(['waktu_kunjungan' => 'Kuota klinik untuk jam ini sudah penuh, Silahkan booking pada jam berikutnya.'])
                ->withInput();
        }

        Klinik::create([
            'user_id' => Auth::id(),
            'nama_pemilik' => Auth::user()->name,
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan,
            'vaksinasi' => $request->vaksinasi,
            'umur_hewan' => $request->umur_hewan,
            'berat' => $request->berat,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'waktu_kunjungan' => $request->waktu_kunjungan,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()->back()->with('success', 'Booking klinik berhasil dikirim!');
    }
}
