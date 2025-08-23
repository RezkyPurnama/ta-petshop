<?php

namespace App\Http\Controllers\user;

use App\Models\PetHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetHotelController
{
    public function index()
    {
        // Ambil data pemilik hewan sesuai user yang login, jika ingin menampilkan data user tertentu
        $petHotels = PetHotel::where('user_id', Auth::id())->latest()->get();

        return view('user.pet-hotel.index', compact('petHotels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hewan'     => 'required|string|max:255',
            'jenis_hewan'      => 'required|in:Anjing,Kucing',
            'riwayat_sakit'  => 'nullable|string',
            'umur_hewan'     => 'nullable|string|max:50',
            'berat_hewan'    => 'nullable|string|max:50',
            'tipe_room'      => 'required|in:Standard,Gabung'.'VIP',
            'check_in'       => 'required|date|after_or_equal:today',
            'check_out'      => 'required|date|after_or_equal:check_in',
            'keterangan'     => 'nullable|string',
        ]);

        // Tambahkan user_id secara otomatis
        PetHotel::create([
            'user_id' => Auth::id(),
            'nama_pemilik' => Auth::user()->name,
            'nomor_telepon' => Auth::user()->no_telepon ?? '-',
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan,
            'riwayat_sakit' => $request->riwayat_sakit,
            'umur_hewan' => $request->umur_hewan,
            'berat_hewan' => $request->berat_hewan ?? '-',
            'tipe_room' => $request->tipe_room,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('pet-hotel.index')
            ->with('success', 'Booking Pet Hotel berhasil dibuat!');
    }
}
