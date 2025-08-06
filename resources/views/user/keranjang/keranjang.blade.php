@extends('user.layouts.main')

@section('content')
<!-- Hero Section -->
<div class="container-fluid bg-primary hero-header mb-5"></div>

<!-- Keranjang Belanja -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body px-4 py-5">
          <h4 class="mb-4 text-primary fw-bold text-center">Keranjang Belanja</h4>

          {{-- Success Alert --}}
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if($keranjangs->isEmpty())
            <div class="alert alert-info text-center">
              <i class="fa fa-info-circle me-2"></i> Keranjang kamu kosong.
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                  <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col" class="text-end">Harga</th>
                    <th scope="col" class="text-end">Subtotal</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($keranjangs as $keranjang)
                  <tr>
                    <td>
                      @if($keranjang->produk->gambar_produk)
                        <img src="{{ asset('storage/' . $keranjang->produk->gambar_produk) }}" class="rounded-3 shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                      @else
                        <img src="{{ asset('img/no-image.png') }}" class="rounded-3 shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                      @endif
                    </td>
                    <td class="text-start">
                      <div class="text-truncate" style="max-width: 180px;">
                        <strong>{{ $keranjang->produk->nama_produk }}</strong>
                      </div>
                    </td>
                    <td>{{ $keranjang->jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($keranjang->produk->harga, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($keranjang->totalharga, 0, ',', '.') }}</td>
                    <td>
                      <form action="{{ route('keranjang.destroy', $keranjang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                          <i class="fa fa-trash me-1"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
              <h5 class="mb-0">
                Total Belanja: <strong class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</strong>
              </h5>
              <a href="#" class="btn btn-lg btn-success px-4">
                <i class="fa fa-shopping-bag me-2"></i> Checkout
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
