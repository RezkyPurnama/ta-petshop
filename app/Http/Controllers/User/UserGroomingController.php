<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Grooming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGroomingController
{
    public function index()
    {
        $groomings = Grooming::where('user_id', Auth::id())->latest()->get();

        return view('user.grooming.index', compact('groomings'));
    }
    public function store(Request $request)
    {
        // Validasi input sesuai tabel grooming
        $request->validate([
            'nama_hewan'       => 'required|string|max:255',
            'jenis_hewan'      => 'required|string|max:100',
            'umur_hewan'       => 'required|numeric|min:0',
            'berat_hewan'      => 'required|numeric|min:0',
            'riwayat_sakit'    => 'nullable|string',
            'layanan_grooming' => 'required|string|max:255',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required|date_format:H:i|after_or_equal:10:00|before_or_equal:19:00',
        ], [
            'jam_booking.required' => 'Jam booking wajib diisi.',
            'jam_booking.date_format' => 'Format jam tidak valid.',
            'jam_booking.after_or_equal' => 'Jam booking minimal pukul 10:00.',
            'jam_booking.before_or_equal' => 'Jam booking maksimal pukul 19:00.',
        ]);

        // Simpan data ke database dengan user_id & status default booking
        Grooming::create([
            'user_id'          => Auth::id(),
            'nama_pemilik' => Auth::user()->name,
            'nomor_telepon' => Auth::user()->no_telepon ?? '-',
            'nama_hewan'       => $request->nama_hewan,
            'jenis_hewan'      => $request->jenis_hewan,
            'umur_hewan'       => $request->umur_hewan,
            'berat_hewan'      => $request->berat_hewan,
            'riwayat_sakit'    => $request->riwayat_sakit,
            'layanan_grooming' => $request->layanan_grooming,
            'tanggal_booking'  => $request->tanggal_booking,
            'jam_booking'      => $request->jam_booking,
        ]);


        return redirect()->route('grooming.index')->with('success', 'Booking berhasil dibuat!');
    }
}
