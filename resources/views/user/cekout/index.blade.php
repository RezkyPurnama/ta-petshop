@extends('user.layouts.main')

@section('content')
<style>
  .hero-header {
    min-height: 100px;
    background: linear-gradient(135deg, #cd2002, #cd2002);
  }

  .card-custom {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
  }

  .form-label {
    font-weight: 600;
  }

  .btn-checkout {
    background-color: #ffc107;
    color: #000;
    font-weight: 600;
    transition: 0.3s ease;
  }

  .btn-checkout:hover {
    background-color: #e0a800;
    color: #fff;
  }

  .summary-box .label {
    font-weight: 500;
    color: #6c757d;
  }

  .summary-box .value {
    font-weight: 700;
  }
</style>

<!-- Hero -->
<div class="container-fluid hero-header py-3 mb-4"></div>

<!-- Checkout Section -->
<div class="container pb-5">
  <h1 class="text-center mb-5">Checkout</h1>

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <form action="{{ route('pesanan.store') }}" method="POST">
    @csrf
    <div class="row g-4">
      <!-- Form Billing Details -->
      <div class="col-lg-7">
        <div class="card card-custom p-4">
          <h5 class="fw-bold mb-4">Detail Pembayaran</h5>

          <!-- Nama Penerima -->
          <div class="mb-3">
            <label for="nama_penerima" class="form-label">Nama Penerima</label>
            <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
          </div>

          <!-- Alamat Pengiriman -->
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Pengiriman</label>
            <input type="text" name="alamat" id="alamat" class="form-control" required>
          </div>

          <!-- Nomor Telepon -->
          <div class="mb-3">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" required>
          </div>
        </div>
      </div>

      <!-- Ringkasan Pesanan -->
      <div class="col-lg-5">
        <div class="card card-custom p-4 summary-box">
          <h5 class="fw-bold mb-4">Pesanan Anda</h5>

          @foreach($keranjangs as $item)
          <div class="d-flex justify-content-between mb-2">
            <span class="label text-truncate d-inline-block" style="max-width: 200px;" title="{{ $item->produk->nama_produk }}">
              {{ $item->produk->nama_produk }} × {{ $item->jumlah }}
            </span>
            <span class="value">Rp{{ number_format($item->totalharga, 0, ',', '.') }}</span>
          </div>
          @endforeach

          <hr>

          <div class="d-flex justify-content-between mb-2">
            <span class="label">Subtotal</span>
            <span class="value">Rp{{ number_format($total, 0, ',', '.') }}</span>
          </div>

          <hr>

          <div class="d-flex justify-content-between mb-4">
            <strong>Total</strong>
            <strong class="text-primary fs-5">Rp{{ number_format($total, 0, ',', '.') }}</strong>
          </div>

          <button type="submit" class="btn btn-checkout w-100 rounded-pill py-2">Buat Pesanan</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
