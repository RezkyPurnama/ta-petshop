<?php

namespace App\Http\Controllers\user;

use App\Models\Grooming;
use Illuminate\Http\Request;

class GrommingController
{
    public function index()
    {
        return view('user.grooming.index');
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'nama_hewan' => 'required|string|max:255',
            'jenis_hewan' => 'required|string',
            'umur_hewan' => 'required|numeric|min:0',
            'berat_hewan' => 'required|numeric|min:0',
            'jumlah_hewan' => 'required|integer|min:1',
            'riwayat_kejang' => 'required|string',
            'layanan_grooming' => 'required|string|max:255',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required',
            'jenis_layanan' => 'required|string',
        ]);

        // Simpan data ke database
        Grooming::create($request->all());

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Booking grooming berhasil dikirim!');
    }
}
