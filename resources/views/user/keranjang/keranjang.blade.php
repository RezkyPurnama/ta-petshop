@extends('user.layouts.main')

@section('content')
<style>




  .card-custom {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
  }

  .product-img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 0.75rem;
  }

  .btn-remove {
    transition: all 0.2s ease;
  }

  .btn-remove:hover {
    transform: scale(1.1);
    background-color: #dc3545;
    color: #fff;
  }

  .summary-box .label {
    font-weight: 500;
    color: #6c757d;
  }

  .summary-box .value {
    font-weight: 700;
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

  .table th,
  .table td {
    vertical-align: middle;
  }

  /* Responsive adjustments for mobile */
  @media (max-width: 768px) {
      .mycart-title {
    text-align: center !important;
    display: block;
    margin: 0 auto;
    margin-bottom: 3rem;

  }
    .product-img {
      width: 48px;
      height: 48px;
    }

    .table-responsive {
      overflow-x: auto;
    }

    .table thead {
      display: none;
    }

    .table tbody,
    .table tr,
    .table td {
      display: block;
      width: 100%;
    }

    .table tr {
      margin-bottom: 1rem;
      border-bottom: 1px solid #eee;
    }

    .table td {
      text-align: right;
      padding-left: 50%;
      position: relative;
    }

    .table td::before {
      content: attr(data-label);
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      font-weight: 600;
      text-align: left;
    }

    .text-end,
    .text-center {
      text-align: right !important;
    }

    .btn-checkout {
      font-size: 1rem;
    }
  }
</style>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header py-5 mb-3">
    </div>

<!-- Cart Section -->
<div class="container pb-5 my-4">
<h1 class="mycart-title text-center">My Cart</h1>


  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($keranjangs->isEmpty())
    <div class="alert alert-info text-center">
      <i class="fa fa-info-circle me-2"></i> Keranjang kamu kosong.
    </div>
  @else
    <div class="row g-4" style="margin-top: 4rem;">
      <!-- Cart Items -->
      <div class="col-lg-8">
        <div class="card card-custom p-4">
          <div class="table-responsive">
            <table class="table">
              <thead class="table-light d-none d-md-table-header-group">
                <tr>
                  <th>Produk</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-end">Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($keranjangs as $keranjang)
                  <tr>
                    <td data-label="Produk">
                      <div class="d-flex align-items-center">
                        <img src="{{ $keranjang->produk->gambar_produk ? asset('storage/' . $keranjang->produk->gambar_produk) : asset('img/no-image.png') }}" class="product-img me-3">
                        <div>
                          <strong>{{ $keranjang->produk->nama_produk }}</strong>
                        </div>
                      </div>
                    </td>
                    <td class="text-center" data-label="Harga">
                      Rp{{ number_format($keranjang->produk->harga, 0, ',', '.') }}
                    </td>
                        <td class="text-center" data-label="Jumlah">
                        <form id="form-keranjang-{{ $keranjang->id }}" action="{{ route('keranjang.updateJumlah', $keranjang->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                            @csrf
                            @method('PATCH')

                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                    id="btn-minus-{{ $keranjang->id }}"
                                    {{ $keranjang->jumlah <= 1 ? 'disabled' : '' }}>-</button>

                            <input type="hidden" name="jumlah" id="jumlah-{{ $keranjang->id }}" value="{{ $keranjang->jumlah }}">
                            <span class="px-2" id="jumlah-text-{{ $keranjang->id }}">{{ $keranjang->jumlah }}</span>

                            <button type="button" class="btn btn-sm btn-success"
                                    id="btn-plus-{{ $keranjang->id }}"
                                    {{ $keranjang->jumlah >= ($keranjang->produk->stockproduk->stock ?? 0) ? 'disabled' : '' }}>+</button>
                        </form>
                        </td>
                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const id = {{ $keranjang->id }};
                            const stockTersedia = {{ $keranjang->produk->stockproduk->stock ?? 0 }};
                            const inputJumlah = document.getElementById(`jumlah-${id}`);
                            const spanJumlah = document.getElementById(`jumlah-text-${id}`);
                            const btnMinus = document.getElementById(`btn-minus-${id}`);
                            const btnPlus = document.getElementById(`btn-plus-${id}`);
                            const form = document.getElementById(`form-keranjang-${id}`);

                            btnMinus.addEventListener('click', function () {
                                let jumlah = parseInt(inputJumlah.value);
                                if (jumlah > 1) {
                                    jumlah -= 1;
                                    inputJumlah.value = jumlah;
                                    spanJumlah.innerText = jumlah;
                                    form.submit();
                                }
                            });

                            btnPlus.addEventListener('click', function () {
                                let jumlah = parseInt(inputJumlah.value);
                                if (jumlah < stockTersedia) {
                                    jumlah += 1;
                                    inputJumlah.value = jumlah;
                                    spanJumlah.innerText = jumlah;
                                    form.submit();
                                }
                            });
                        });
                        </script>
                    <td class="text-end" data-label="Subtotal">
                      Rp{{ number_format($keranjang->totalharga, 0, ',', '.') }}
                    </td>
                    <td class="text-end" data-label="Aksi">
                      <form action="{{ route('keranjang.destroy', $keranjang->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-remove ">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="col-lg-4">
        <div class="card card-custom p-4 summary-box">
          <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>

          <div class="d-flex justify-content-between mb-2">
            <span class="label">Subtotal</span>
            <span class="value">Rp{{ number_format($total, 0, ',', '.') }}</span>
          </div>

          <div class="d-flex justify-content-between border-top pt-3 mb-4">
            <span class="label">Total</span>
            <span class="value text-primary fs-5">Rp{{ number_format($total, 0, ',', '.') }}</span>
          </div>

          <a href="{{ url('checkout') }}" class="btn btn-primary w-100 rounded-pill py-2">Lanjut ke Cekout </a>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
