@extends('user.layouts.main')

@section('content')

<div class="container-fluid bg-primary hero-header py-5 mb-5"></div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="fw-bold text-success mb-3">Pembayaran Berhasil!</h2>
                    <p class="text-muted mb-4">
                        Terima kasih, pesanan dengan kode <strong>{{ $pesanan->trx_id }}</strong>
                        telah berhasil dibayar.
                    </p>
                    <a href="{{ route('landing') }}" class="btn btn-primary px-4">Kembali ke Beranda</a>
                    <a href="{{ route('pembayaran.index', $pesanan->id) }}" class="btn btn-outline-success px-4">Lihat Detail Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
