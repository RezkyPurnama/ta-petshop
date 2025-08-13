<?php

namespace App\Http\Controllers\admin;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class DataPetHotelController
{
    public function index()
    {
        $pethotels = PetHotel::latest()->paginate(10);
        return view('admin.pet-hotel.index', compact('pethotels'));
    }

    public function edit($id)
    {
        $pethotels = PetHotel::findOrFail($id);
        return view('admin.pet-hotel.edit', compact('pethotels'));
    }

    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemilik'      => 'required|string|max:255',
            'nama_hewan'        => 'required|string|max:255',
            'jenis_hewan'       => 'required|string|max:255',
            'check_in'          => 'required|date',
            'check_out'         => 'required|date|after_or_equal:check_in',
            'harga'             => 'required|numeric',
            'keterangan'        => 'nullable|string',
            'status_vaksin'     => 'nullable|string|in:Sudah,Belum',
            'sertifikat_hewan'  => 'nullable|string|in:Ada,Tidak',
        ]);

        $pethotel = PetHotel::findOrFail($id);
        $pethotel->update($request->only([
            'nama_pemilik',
            'nama_hewan',
            'jenis_hewan',
            'check_in',
            'check_out',
            'harga',
            'keterangan',
            'status_vaksin',
            'sertifikat_hewan',
        ]));

        return redirect()->route('data-pethotel.index')
            ->with('success', 'Data Pet Hotel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pethotel = PetHotel::findOrFail($id);
        $pethotel->delete();

        return redirect()->route('data-pethotel.index')
            ->with('success', 'Data Pet Hotel berhasil dihapus.');
    }
}
