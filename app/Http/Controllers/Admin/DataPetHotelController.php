<?php

namespace App\Http\Controllers\admin;

use App\Models\PetHotel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPetHotelController
{
    // Tampilkan daftar pet hotel
    public function index(Request $request)
{
    // Ambil bulan & tahun dari request, default ke bulan & tahun sekarang
    $bulan = (int) $request->input('bulan', date('m'));
    $tahun = (int) $request->input('tahun', date('Y'));

    // Query data Pet Hotel berdasarkan bulan & tahun
    $pethotels = PetHotel::with('user')
        ->whereYear('check_in', $tahun)
        ->whereMonth('check_in', $bulan)
        ->latest()
        ->paginate(10);

    return view('admin.pet-hotel.index', compact('pethotels', 'bulan', 'tahun'));
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
                'jenis_hewan'      => 'required|in:Anjing,Kucing',
                'umur_hewan'    => 'nullable|string|max:50',
                'berat_hewan'   => 'nullable|string|max:10',
                'tipe_room'      => 'required|in:Standard,Gabung,VIP',
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
                'tipe_room',
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

    public function laporanPDF(Request $request)
    {
        // Ambil bulan dan tahun dari request, default ke bulan & tahun sekarang
        $bulan = (int)  $request->input('bulan', date('m'));
        $tahun = (int)  $request->input('tahun', date('Y'));

        // Query data Pet Hotel berdasarkan bulan & tahun check_in
        $pethotels = PetHotel::with('user')
            ->whereYear('check_in', $tahun)
            ->whereMonth('check_in', $bulan)
            ->latest()
            ->get();

        $bulanNama = \Carbon\Carbon::parse("$tahun-$bulan-01")->format('F');


        // Load view dan generate PDF
        $pdf = Pdf::loadView('admin.pet-hotel.laporan', compact('pethotels', 'bulanNama', 'tahun'))
            ->setPaper('A4', 'landscape');

        // Tampilkan langsung di browser
        return $pdf->stream("laporan_PetHotel_{$bulanNama}_{$tahun}.pdf");
    }
}
