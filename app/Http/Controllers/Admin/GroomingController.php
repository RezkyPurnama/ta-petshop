<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grooming;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GroomingController
{
    // Tampilkan daftar booking grooming
    public function index(Request $request)
    {
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        $groomings = Grooming::with('user')
            ->whereYear('tanggal_booking', $tahun)
            ->whereMonth('tanggal_booking', $bulan)
            ->orderByRaw("CASE WHEN status = 'selesai' THEN 1 ELSE 0 END")
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.grooming.index', compact('groomings', 'bulan', 'tahun'));
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
                'jenis_hewan'      => 'required|in:Anjing,Kucing',
                'umur_hewan'       => 'required|integer',
                'berat_hewan'      => 'required|numeric',
                'riwayat_sakit'    => 'nullable|string',
                'layanan_grooming' => 'required|in:Basic Grooming,Full Grooming',
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
    public function laporanPDF(Request $request)
    {
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        $groomings = Grooming::with('user')
            ->whereYear('tanggal_booking', $tahun)
            ->whereMonth('tanggal_booking', $bulan)
            ->latest()
            ->get();

        $bulanNama = \Carbon\Carbon::parse("$tahun-$bulan-01")->format('F');

        $pdf = Pdf::loadView('admin.grooming.laporan', compact('groomings', 'bulanNama', 'tahun'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream("laporan_grooming_{$bulanNama}_{$tahun}.pdf");
    }
}
