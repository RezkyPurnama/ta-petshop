<?php

namespace App\Http\Controllers\user;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class PetHotelController
{

    public function index()
    {
        return view('user.pet-hotel.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemilik'     => 'required|string|max:255',
            'nomor_telepon'    => 'required|string|max:15',
            'nama_hewan'       => 'required|string|max:255',
            'jenis_hewan'      => 'required|string',
            'jumlah_hewan'     => 'required|integer',
            'ras_hewan'        => 'nullable|string|max:255',
            'riwayat_sakit'    => 'nullable|string|max:255',
            'status_vaksin'    => 'nullable|string',
            'umur_hewan'       => 'nullable|string|max:50',
            'berat_hewan'      => 'nullable|string|max:50',
            'sertifikat_hewan' => 'required|string',
            'check_in'         => 'required|date',
            'check_out'        => 'required|date|after_or_equal:check_in',
            'keterangan'       => 'nullable|string',
        ]);

        PetHotel::create($validated);

        return redirect()->route('pet-hotel.index')
            ->with('success', 'Booking Pet Hotel berhasil dibuat!');
    }
}
