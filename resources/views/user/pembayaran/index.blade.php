@extends('user.layouts.main')

@section('content')
<style>
  body {
    background-color: #f9fafb;
  }

  .card-custom {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    transition: transform .2s ease;
  }
  .card-custom:hover {
    transform: translateY(-3px);
  }

  .section-title {
    font-weight: 700;
    font-size: 1.15rem;
    margin-bottom: 1.2rem;
    border-left: 4px solid #4CAF50;
    padding-left: .6rem;
    color: #333;
  }

  .product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .7rem 0;
    border-bottom: 1px dashed #e5e5e5;
  }
  .product-item:last-child {
    border-bottom: none;
  }
  .product-item img {
    max-width: 70px;
    height: auto;
    border-radius: .5rem;
}


  .product-item img:hover {
    transform: scale(1.05);
  }

  .product-info {
    flex: 1;
    margin-left: .9rem;
  }
  .product-info strong {
    display: block;
    font-size: 1rem;
    color: #222;
  }
  .product-info small {
    color: #888;
  }

  .product-price {
    font-weight: 600;
    color: #e63946;
    font-size: .95rem;
    white-space: nowrap;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: .6rem;
    font-size: .95rem;
  }
  .summary-row.total {
    font-weight: 700;
    font-size: 1.25rem;
    border-top: 2px solid #f0f0f0;
    padding-top: .8rem;
    margin-top: 1rem;
    color: #e63946;
  }

  .btn-confirm {
    background: linear-gradient(135deg, #4CAF50, #2e7d32);
    border: none;
    font-weight: 600;
    padding: .9rem;
    border-radius: 50px;
    color: #fff;
    width: 100%;
    transition: all .3s;
    box-shadow: 0 4px 12px rgba(76,175,80,.3);
  }
  .btn-confirm:hover {
    background: linear-gradient(135deg, #43a047, #1b5e20);
    transform: translateY(-2px);
  }

  .btn-cancel {
    background: #fff;
    border: 2px solid #e0e0e0;
    font-weight: 600;
    padding: .9rem;
    border-radius: 50px;
    width: 100%;
    margin-top: .7rem;
    transition: all .3s;
    color: #444;
  }
  .btn-cancel:hover {
    background: #f8f9fa;
    border-color: #d5d5d5;
  }

  /* Badge Payment Method */
  .badge-payment {
    display: inline-block;
    padding: .4rem .8rem;
    border-radius: 20px;
    font-size: .8rem;
    background: #e8f5e9;
    color: #2e7d32;
    font-weight: 600;
  }
</style>

<!-- Hero -->
<div class="container-fluid bg-primary hero-header py-5 mb-5"></div>

<div class="container pb-5">
  <h1 class="text-center mb-5 fw-bold">Konfirmasi Pembayaran</h1>

  <div class="row g-4 justify-content-center">
    <!-- Left: Customer Info -->
    <div class="col-lg-7">
      <div class="card card-custom p-4">
        <h5 class="section-title">Customer Information</h5>
        <p class="mb-2"><strong>{{ $pesanan->nama_penerima }}</strong></p>
        <p class="mb-1"><i class="bi bi-telephone text-primary me-2"></i>{{ $pesanan->telepon ?? '-' }}</p>
        <p class="mb-3"><i class="bi bi-geo-alt text-danger me-2"></i>{{ $pesanan->alamat ?? '-' }}</p>
        <p class="mt-2">
          <i class="bi bi-credit-card text-success me-2"></i>
          Metode Pembayaran: <span class="badge-payment">Midtrans</span>
        </p>
      </div>
    </div>

    <!-- Right: Order Summary -->
    <div class="col-lg-5">
      <div class="card card-custom p-4">
        <h5 class="section-title">Pesanan Anda</h5>

        @foreach($pesanan->pesanandetail as $detail)
          <div class="product-item">
            <div class="d-flex align-items-center">
              <img src="{{ asset('storage/' . $detail->produk->gambar_produk) }}" alt="{{ $detail->produk->nama_produk }}">
              <div class="product-info">
                <strong>{{ $detail->produk->nama_produk }}</strong>
                <small>x {{ $detail->jumlah }}</small>
              </div>
            </div>
            <div class="product-price">
              Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}
            </div>
          </div>
        @endforeach

        <div class="summary-row total">
          <span>Total</span>
          <span>Rp{{ number_format($pesanan->totalharga, 0, ',', '.') }}</span>
        </div>

        <div class="mt-4">
          {{-- Confirm pakai Midtrans --}}
          <button id="pay-button" class="btn-confirm">✅ Bayar Sekarang</button>

          {{-- Cancel --}}
          <form action="{{ route('pembayaran.batal', $pesanan->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-cancel">❌ Cancel Order</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
  document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        console.log(result);
        window.location.href = "{{ route('pembayaran.success', $pesanan->id) }}";
      },
      onPending: function(result){
        console.log(result);
        // cukup kasih alert saja, jangan redirect
        alert("Pembayaran sedang diproses, silakan cek status di riwayat pesanan.");
      },
      onError: function(result){
        console.log(result);
        alert("Pembayaran gagal, coba lagi.");
      },
      onClose: function(){
        alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
      }
    })
  });
</script>

@endsection
