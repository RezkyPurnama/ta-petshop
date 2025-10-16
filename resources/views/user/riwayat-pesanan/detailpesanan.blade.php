@extends('user.layouts.main')

@section('content')
<style>
    .card-custom {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        background: #fff;
    }
    .card-header {
        background: #f8f9fa;
        font-weight: 600;
        font-size: 1.1rem;
    }
    .order-info p {
        margin-bottom: 0.4rem;
        font-size: 0.95rem;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
        border-radius: 8px;
    }
    .table th {
        background: #f8f9fa;
        font-weight: 600;
    }
    .table tfoot td {
        background: #fdfdfd;
        font-size: 1rem;
    }
</style>

<!-- Hero -->
<div class="container-fluid bg-primary hero-header py-5 mb-5"></div>

<div class="container py-4">
    <h3 class="fw-bold mb-4 text-secondary">
        🛒 Detail Pesanan <span class="text-dark">#{{ $pesanan->trx_id }}</span>
    </h3>

    <!-- Info Pesanan -->
    <div class="card card-custom mb-4">
        <div class="card-body order-info">
            <p><strong>📅 Tanggal Pesanan:</strong> {{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->format('d M Y') }}</p>
            <p><strong>👤 Penerima:</strong> {{ $pesanan->nama_penerima }}</p>
            <p><strong>📌 Status:</strong>
                @if($pesanan->status == 'tunggu_pembayaran')
                    <span class="badge bg-warning text-dark">💳 Menunggu Pembayaran</span>
                @elseif($pesanan->status == 'sedang_diproses')
                    <span class="badge bg-info text-dark">⏳ Diproses</span>
                @elseif($pesanan->status == 'dalam_perjalanan')
                    <span class="badge bg-primary">🚚 Dikirim</span>
                @elseif($pesanan->status == 'selesai')
                    <span class="badge bg-success">✔ Selesai</span>
                @else
                    <span class="badge bg-danger">❌ Dibatalkan</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="card card-custom">
        <div class="card-header">📦 Produk dalam Pesanan</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->pesanandetail as $detail)
                        <tr>
                            <td>{{ $detail->produk->nama_produk ?? '❌ Produk dihapus' }}</td>
                            <td class="text-center">{{ $detail->jumlah }}</td>
                            <td class="text-end">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end"><strong>Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                            <tr>
        <td colspan="3" class="text-end"><strong>Ongkos Kirim</strong></td>
        <td class="text-end">
            Rp {{ number_format($pesanan->ongkir ?? 0, 0, ',', '.') }}
        </td>
    </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total Harga</strong></td>
                            <td class="text-end text-success fw-bold fs-5">
                                Rp {{ number_format($pesanan->totalharga, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
