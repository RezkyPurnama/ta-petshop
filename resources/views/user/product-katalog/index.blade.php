@extends('user.layouts.main')
@section('content')


    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header mb-5">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animated slideInDown">Products</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                    <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Hero End -->


  <!-- Product Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="text-primary mb-3"><span class="fw-light text-dark">Produk Terbaik</span> Q Petcare</h1>
            <p class="mb-5">Kami menyediakan produk berkualitas untuk hewan kesayangan Anda.</p>
        </div>
        <div class="row g-4">
            @forelse ($produks as $produk)
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.{{ $loop->index + 1 }}s">
                <div class="product-item text-center border h-100 p-4">
                    <img class="img-fluid mb-4" src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" style="height: 120px; width: 100%; object-fit: contain;">

                    <div class="mb-2">
                        {{-- Bisa tambah rating kalau ada --}}
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small>(100)</small>
                    </div>
                    <a href=""class="h6 d-inline-block mb-2 text-dark"style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; min-height: 48px;"> {{ $produk->nama_produk }} </a>

                    <h5 class="text-primary mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>
                    <form action="{{ route('keranjang.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <input type="hidden" name="jumlah" value="1"> <!-- default 1, bisa diubah kalau mau pakai input jumlah -->
                    <button type="submit" class="btn btn-outline-primary px-3">
                        Add To Cart
                    </button>
                 </form>
                <div class="mt-2 btn btn-outline-primary px-3">
                    <a href="{{ route('detail-produk', $produk->id) }}" class="text-dark text-decoration-none">Lihat Detail</a>
                </div>

                </div>
            </div>
            @empty
            <div class="text-center">
                <p>Produk belum tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Product End -->



    <!-- Newsletter Start -->
    <div class="container-fluid newsletter bg-primary py-5 my-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark">Let's Subscribe</span> The Newsletter</h1>
                <p class="text-white mb-4">Subscribe now to get 30% discount on any of our products</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 wow fadeIn" data-wow-delay="0.5s">
                    <div class="position-relative w-100 mt-3 mb-2">
                        <input class="form-control w-100 py-4 ps-4 pe-5" type="text" placeholder="Enter Your Email"
                            style="height: 48px;">
                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i
                                class="fa fa-paper-plane text-white fs-4"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->

@endsection
