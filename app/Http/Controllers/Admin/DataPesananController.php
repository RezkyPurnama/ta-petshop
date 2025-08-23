<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DataPesananController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pesanan terbaru
        $pesanans = Pesanan::with('user')->orderBy('tgl_pesanan', 'desc')->paginate(10);

        return view('admin.data-pesanan.index', compact('pesanans'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil pesanan beserta detail produk
        $pesanan = Pesanan::with(['pesanandetail.produk', 'user'])->findOrFail($id);

        return view('admin.data-pesanan.detail', compact('pesanan'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.data-pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Validasi hanya untuk status pesanan
        $request->validate([
            'status' => 'required|in:tunggu_pembayaran,sedang_diproses,dalam_perjalanan,selesai,cancel',
        ]);

        // Update status pesanan
        $pesanan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('data-pesanan.index')->with('success', 'Status pesanan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('data-pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
