@extends('user.layouts.main')

@section('content')
    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .grooming-card {
            position: relative;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .grooming-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1.25rem 2.5rem rgba(0, 0, 0, .12);
        }

        .grooming-accent {
            position: absolute;
            inset: 0 auto 0 0;
            width: 38%;
            background: radial-gradient(120% 100% at 0% 50%, rgba(205, 32, 2, .12), transparent 60%);
            pointer-events: none;
        }

        /* Utilities untuk badge Bootstrap 5.3+ fallback */
        .bg-danger-subtle {
            background-color: rgba(205, 32, 2, .12) !important;
        }

        .text-danger-emphasis {
            color: #cd2002 !important;
        }

        .premium-services {
            background-color: #fff9f0;
            padding: 60px 0;
        }

        .premium-services h2 {
            color: #f09a52;
            font-weight: bold;
        }

        .premium-services .section-subtitle {
            color: #555;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        .service-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .service-icon {
            background-color: #fff9f0;
            color: #f09a52;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin: 0 auto 20px;
        }

        .service-card h5 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .service-card p {
            color: #555;
            font-size: 0.95rem;
        }
    </style>

    <div class="container-fluid bg-primary hero-header py-5 mb-5"></div>



<div class="container mb-5" data-aos="fade-right">
    <div class="card shadow-lg border-0">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 text-center p-4">
                <img src="{{ asset('user/assets/img/catdog1.png') }}" class="img-fluid" alt="Aksesoris Hewan Q Petcare">
            </div>
            <div class="col-md-8 p-4">
                <h4 class="fw-bold">Percantik & Lengkapi Anabul dengan Aksesoris Lucu!</h4>
                <p>
                    Q PetCare menyediakan berbagai aksesoris hewan peliharaan seperti kalung, baju, mainan,
                    hingga perlengkapan harian yang nyaman dan aman.
                    Bikin anabul makin kece dan happy bersama produk pilihan terbaik dari Q PetCare!
                </p>
            </div>
        </div>
    </div>
</div>


      <!-- Product Start -->
<div class="container-fluid py-5" data-aos="fade-up">
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
                    <a href=""class="h6 d-inline-block mb-2 text-dark" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; min-height: 48px; max-height: 48px; line-height: 24px;"> {{ $produk->nama_produk }}</a>


                    <h5 class="text-primary mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>
                    <form action="{{ route('keranjang.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <input type="hidden" name="jumlah" value="1"> <!-- default 1, bisa diubah kalau mau pakai input jumlah -->
                    <button type="submit" class="btn btn-outline-danger px-3">
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


@endsection
