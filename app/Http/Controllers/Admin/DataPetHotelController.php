<?php

namespace App\Http\Controllers\admin;

use App\Models\PetHotel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPetHotelController
{
    // Tampilkan daftar pet hotel
    public function index()
    {
        $pethotels = PetHotel::with('user')->latest()->paginate(10);
        return view('admin.pet-hotel.index', compact('pethotels'));
    }

    // Tampilkan halaman edit
    public function edit($id)
    {
        $pethotel = PetHotel::findOrFail($id);
        return view('admin.pet-hotel.edit', compact('pethotel'));
    }

    // Tampilkan detail (show)
    public function show($id)
    {
        $pethotel = PetHotel::with('user')->findOrFail($id);
        return view('admin.pet-hotel.detail', compact('pethotel'));
    }

    // Update data pet hotel
    public function update(Request $request, $id)
    {
        $pethotel = PetHotel::findOrFail($id);

        // Jika form update status saja
        if ($request->has('status')) {
            $request->validate([
                'status' => 'required|in:booking,checkin,selesai,cancel',
            ]);
            $pethotel->update(['status' => $request->status]);
        } else {
            // Update full data (dari halaman edit)
            $request->validate([
                'nama_hewan'    => 'required|string|max:255',
                'jenis_hewan'   => 'required|string|max:255',
                'umur_hewan'    => 'nullable|string|max:50',
                'berat_hewan'   => 'nullable|string|max:10',
                'check_in'      => 'required|date',
                'check_out'     => 'required|date|after_or_equal:check_in',
                'riwayat_sakit' => 'nullable|string',
                'keterangan'    => 'nullable|string',
            ]);

            $pethotel->update($request->only([
                'nama_hewan',
                'jenis_hewan',
                'umur_hewan',
                'berat_hewan',
                'check_in',
                'check_out',
                'riwayat_sakit',
                'keterangan',
            ]));
        }

        return redirect()->route('data-pethotel.index')
            ->with('success', 'Data Pet Hotel berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $pethotel = PetHotel::findOrFail($id);
        $pethotel->delete();

        return redirect()->route('data-pethotel.index')
            ->with('success', 'Data Pet Hotel berhasil dihapus.');
    }

    public function laporanPDF()
    {
        $pethotels = PetHotel::with('user')->latest()->get();

        // Load view dan generate PDF
        $pdf = Pdf::loadView('admin.pet-hotel.laporan', compact('pethotels'))
        ->setPaper('A4', 'landscape');
        // ada dua opsi
        // Download PDF
        // return $pdf->download('laporan_pet_hotel.pdf');

        // Atau tampil langsung di browser:
        return $pdf->stream('laporan-grooming.pdf');
    }
}
