<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grooming;
use Illuminate\Http\Request;

class GroomingController
{
    // Menampilkan semua booking grooming
    public function index()
    {
        $groomings = Grooming::latest()->paginate(10);
        return view('admin.grooming.index', compact('groomings'));
    }

    // Menampilkan form tambah booking grooming
    public function create()
    {
    //
    }

    // Simpan data booking grooming
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'nama_hewan' => 'required|string|max:255',
            'jenis_hewan' => 'required|string|max:50',
            'umur_hewan' => 'required|integer',
            'berat_hewan' => 'required|numeric',
            'jumlah_hewan' => 'required|integer',
            'riwayat_kejang' => 'required|in:Ada,Tidak Ada',
            'layanan_grooming' => 'required|string|max:100',
            'tanggal_booking' => 'required|date',
            'jam_booking' => 'required',
            'jenis_layanan' => 'required|in:Ke Toko,Home Service,Pickup',
        ]);

        Grooming::create($request->all());

        return redirect()->route('data-grooming.index')->with('success', 'Booking grooming berhasil ditambahkan.');
    }

    // Menampilkan form edit booking grooming
    public function edit($id)
    {
        $grooming = Grooming::findOrFail($id);
        return view('admin.grooming.edit', compact('grooming'));
    }

    // Update data booking grooming
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'nama_hewan' => 'required|string|max:255',
            'jenis_hewan' => 'required|string|max:50',
            'umur_hewan' => 'required|integer',
            'berat_hewan' => 'required|numeric',
            'jumlah_hewan' => 'required|integer',
            'riwayat_kejang' => 'required|in:Ada,Tidak Ada',
            'layanan_grooming' => 'required|string|max:100',
            'tanggal_booking' => 'required|date',
            'jam_booking' => 'required',
            'jenis_layanan' => 'required|in:Ke Toko,Home Service,Pickup',
        ]);

        $grooming = Grooming::findOrFail($id);
        $grooming->update($request->all());

        return redirect()->route('data-grooming.index')->with('success', 'Booking grooming berhasil diperbarui.');
    }

    // Hapus data booking grooming
    public function destroy($id)
    {
        $grooming = Grooming::findOrFail($id);
        $grooming->delete();

        return redirect()->route('data-grooming.index')->with('success', 'Booking grooming berhasil dihapus.');
    }
}
