@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Detail Pesanan #{{ $pesanan->trx_id }}</h4>
        </div>
        <div class="card-body">

            {{-- Info Pemesan --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card p-3 mb-2 shadow-sm">
                        <p class="mb-1"><strong>Pemesan:</strong> {{ $pesanan->user->name }}</p>
                        <p class="mb-1"><strong>Telepon:</strong> {{ $pesanan->telepon ?? '-' }}</p>
                        <p class="mb-1"><strong>Penerima:</strong> {{ $pesanan->nama_penerima }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-3 mb-2 shadow-sm">
                        <p class="mb-1"><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                        <p class="mb-1"><strong>Tanggal Pesanan:</strong> {{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Status Pesanan:</strong>
                            <span class="badge
                                @if($pesanan->status == 'tunggu_pembayaran') bg-warning text-dark
                                @elseif($pesanan->status == 'sedang_diproses') bg-info text-dark
                                @elseif($pesanan->status == 'dalam_perjalanan') bg-primary
                                @elseif($pesanan->status == 'selesai') bg-success
                                @else bg-danger @endif">
                                {{ ucfirst($pesanan->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <hr>

            {{-- Daftar Produk --}}
            <h5 class="mb-3">Produk dalam Pesanan</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Gambar</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->pesanandetail as $detail)
                        <tr class="text-center">
                            <td>
                                @if($detail->produk && $detail->produk->gambar_produk)
                                    <img src="{{ asset('storage/' . $detail->produk->gambar_produk) }}" alt="{{ $detail->produk->nama_produk }}" class="img-thumbnail" width="80">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $detail->produk->nama_produk ?? 'Produk dihapus' }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total Harga</strong></td>
                            <td class="text-center">Rp {{ number_format($pesanan->totalharga, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('data-pesanan.index') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
