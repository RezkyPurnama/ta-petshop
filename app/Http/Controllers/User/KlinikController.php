<?php

namespace App\Http\Controllers\user;

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
            'jenis_hewan'      => 'required|in:Anjing,Kucing','lainnya',
            'vaksinasi'      => 'required|in:Ya,Tidak',
            'umur_hewan' => 'required|integer',
            'berat' => 'required|numeric',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'keluhan' => 'required|string',
        ]);

        Klinik::create([
            'user_id' => Auth::id(),
            'nama_pemilik' => Auth::user()->name, // otomatis ambil dari user login
            // 'nomor_telepon' => Auth::user()->phone ?? '-', // ambil dari kolom phone user (kalau ada)
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan,
            'vaksinasi' => $request->vaksinasi,
            'umur_hewan' => $request->umur_hewan,
            'berat' => $request->berat,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()->back()->with('success', 'Booking klinik berhasil dikirim!');
    }
}
