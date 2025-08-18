<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grooming;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GroomingController
{
    // Tampilkan daftar booking grooming
    public function index()
    {
        $groomings = Grooming::with('user')->latest()->paginate(10);
        return view('admin.grooming.index', compact('groomings'));
    }

    // Tampilkan halaman edit
    public function edit($id)
    {
        $grooming = Grooming::findOrFail($id);
        return view('admin.grooming.edit', compact('grooming'));
    }

    // Tampilkan detail booking grooming
    public function show($id)
    {
        $grooming = Grooming::with('user')->findOrFail($id);
        return view('admin.grooming.detail', compact('grooming'));
    }

    // Update data booking grooming
    public function update(Request $request, $id)
    {
        $grooming = Grooming::findOrFail($id);

        // Jika hanya update status
        if ($request->has('status')) {
            $request->validate([
                'status' => 'required|in:booking,progres,selesai,cancel',
            ]);
            $grooming->update(['status' => $request->status]);
        } else {
            // Update semua data (edit form)
            $request->validate([
                'nama_hewan'       => 'required|string|max:255',
                'jenis_hewan'      => 'required|string|max:50',
                'umur_hewan'       => 'required|integer',
                'berat_hewan'      => 'required|numeric',
                'riwayat_sakit'    => 'nullable|string',
                'layanan_grooming' => 'required|string|max:100',
                'tanggal_booking'  => 'required|date',
                'jam_booking'      => 'required',
            ]);

            $grooming->update($request->only([
                'nama_hewan',
                'jenis_hewan',
                'umur_hewan',
                'berat_hewan',
                'riwayat_sakit',
                'layanan_grooming',
                'tanggal_booking',
                'jam_booking',
            ]));
        }

        return redirect()->route('data-grooming.index')
            ->with('success', 'Data grooming berhasil diperbarui.');
    }

    // Hapus data booking grooming
    public function destroy($id)
    {
        $grooming = Grooming::findOrFail($id);
        $grooming->delete();

        return redirect()->route('data-grooming.index')
            ->with('success', 'Data grooming berhasil dihapus.');
    }

    // Cetak laporan grooming PDF
    public function laporanPDF()
    {
        $groomings = Grooming::with('user')->latest()->get();

        $pdf = Pdf::loadView('admin.grooming.laporan', compact('groomings'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-grooming.pdf');
    }
}
