<?php

namespace App\Http\Controllers\admin;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class DataPesananController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        $pesanans = Pesanan::with('user')
            ->whereYear('tgl_pesanan', $tahun)
            ->whereMonth('tgl_pesanan', $bulan)
            ->orderBy('tgl_pesanan', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.data-pesanan.index', compact('pesanans', 'bulan', 'tahun'));
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

    public function laporanPDF(Request $request)
    {
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        // Ambil data pesanan sesuai bulan dan tahun
        $pesanans = Pesanan::with('user')
            ->whereYear('tgl_pesanan', $tahun)
            ->whereMonth('tgl_pesanan', $bulan)
            ->orderBy('tgl_pesanan', 'desc')
            ->get();

        $bulanNama = \Carbon\Carbon::parse("$tahun-$bulan-01")->format('F');

        // Generate PDF
        $pdf = Pdf::loadView('admin.data-pesanan.laporan', compact('pesanans', 'bulanNama', 'tahun'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream("laporan_pesanan_{$bulanNama}_{$tahun}.pdf");
    }
}
