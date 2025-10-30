@extends('user.layouts.main')

@section('content')
    <!-- Hero Section -->
    {{--  <div class="container-fluid bg-primary hero-header py-5 mb-5"></div>  --}}


    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header mb-5">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Detail Produk</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                    <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="/product">Product</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Detail Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Hero End -->


    <div class="container py-5">
        <div class="row g-5 align-items-center">
            {{-- Gambar Produk --}}
            <div class="col-lg-6">
                <div class="position-relative border rounded shadow-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                        class="img-fluid rounded w-100">
                    <div class="position-absolute top-0 end-0 m-3">
                        <i class="fas fa-search-plus fa-lg text-secondary"></i>
                    </div>
                </div>
            </div>

            {{-- Informasi Produk --}}
            <div class="col-lg-6">
                <h2 class="fw-bold mb-2 text-dark">{{ $produk->nama_produk }}</h2>
                <h4 class="text-danger fw-bold mb-3">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>

                {{-- Berat Produk --}}
                <p class="mb-3">
                    <span class="fw-semibold">Berat:</span>
                    <strong class="bold">{{ $produk->berat ?? 0 }} gr</strong>
                </p>
                {{-- Stok --}}
                <p class="mb-3">
                    <span class="fw-semibold">Stok Tersedia:</span>
                    <span class="badge bg-success text-white">{{ $produk->stockproduk->stock ?? 0 }}
                        {{ $produk->satuan ?? 'item' }}</span>
                </p>


                {{-- Deskripsi Produk --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Deskripsi Produk:</h6>
                    <ul class="list-unstyled ps-1">
                        @foreach (explode("\n", $produk->deskripsi) as $item)
                            <li class="mb-2">
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Form Tambah ke Keranjang --}}
                <form action="{{ route('keranjang.store') }}" method="POST"
                    class="d-flex align-items-center gap-3 flex-wrap">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <input type="number" name="jumlah" value="1" min="1"
                        max="{{ $produk->stockproduk->stock ?? 0 }}"
                        class="form-control w-25 text-center border-dark rounded" style="max-width: 80px;"
                        {{ ($produk->stockproduk->stock ?? 0) < 1 ? 'disabled' : '' }}>

                    <button type="submit"
                        class="btn btn-outline-danger  text-dark fw-semibold d-flex align-items-center gap-2"
                        {{ ($produk->stockproduk->stock ?? 0) < 1 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </form>

                {{-- Share --}}
                <div class="mt-4 pt-4 border-top">
                    <strong class="d-block mb-2">Bagikan:</strong>
                    <div class="d-flex gap-4">
                        <a href="#" class="text-dark"><i class="fab fa-facebook fa-xl"></i></a>
                        <a href="#" class="text-dark"><i class="far fa-envelope fa-xl"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-whatsapp fa-xl"></i></a>
                        <a href="#" class="text-dark"><i class="fas fa-print fa-xl"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
