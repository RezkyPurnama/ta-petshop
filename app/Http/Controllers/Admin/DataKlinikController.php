<?php

namespace App\Http\Controllers\admin;

use App\Models\Klinik;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataKlinikController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petkliniks = Klinik::with('user')->latest()->paginate(10);
        return view('admin.klinik.index', compact('petkliniks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $petKlinik = Klinik::findOrFail($id);
        return view('admin.klinik.detail', compact('petKlinik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $klinik = Klinik::findOrFail($id);
        return view('admin.klinik.edit', compact('klinik'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $klinik = Klinik::findOrFail($id);

        // **1. Update status dari index table**
        if ($request->has('status')) {
            $newStatus = $request->status;

            // Cek jika status sudah 'selesai', tidak bisa diubah
            if ($klinik->status == 'selesai') {
                return redirect()->back()->with('error', 'Status sudah selesai dan tidak bisa diubah lagi.');
            }

            // Validasi status baru
            $request->validate([
                'status' => 'required|in:booking,progres,selesai,cancel',
            ]);

            $klinik->status = $newStatus;
            $klinik->save();

            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        }

        // **2. Update lengkap dari form edit**
        $request->validate([
            'nama_hewan' => 'required|string|max:100',
            'jenis_hewan' => 'required|string|max:100',
            'umur_hewan' => 'nullable|integer',
            'berat' => 'required|string|max:50',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        $klinik->update($request->only([
            'nama_hewan',
            'jenis_hewan',
            'umur_hewan',
            'berat',
            'tanggal_kunjungan',
            'keluhan'
        ]));

        return redirect()->route('data-klinik.index')->with('success', 'Data klinik berhasil diperbarui.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $klinik = Klinik::findOrFail($id);
        $klinik->delete();

        return redirect()->route('data-klinik.index')->with('success', 'Data klinik berhasil dihapus.');
    }

    public function laporanPDF()
    {
        $petkliniks = Klinik::with('user')->latest()->get();

        // Load view dan generate PDF
        $pdf = Pdf::loadView('admin.klinik.laporan', compact('petkliniks'))
            ->setPaper('A4', 'landscape');
        // ada dua opsi
        // Download PDF
        // return $pdf->download('laporan_pet_klinik.pdf');

        // Atau tampil langsung di browser:
        return $pdf->stream('laporan-klinik.pdf');
    }
}
