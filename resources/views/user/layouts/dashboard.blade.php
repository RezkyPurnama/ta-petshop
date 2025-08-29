@extends('user.layouts.main')
@section('content')


{{--  <!-- Hero Section -->
<div class="container-fluid bg-primary hero-header py-4">
</div>

<!-- Hero Section Start -->
<section class="hero-section d-flex align-items-center"
    style="background-image: url('{{ asset('user/assets/img/Hero_Section_Petshop.png') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-white hero-content">
                <h1 class="fw-bold text-white">Selamat Datang di <br>PetShop</h1>
                <p class="mb-4">
                    Temukan semua kebutuhan hewan peliharaan Anda dengan kualitas terbaik dan harga terjangkau.
                    Kami menyediakan produk dan layanan lengkap untuk anjing, kucing, dan burung kesayangan Anda.
                </p>
                <a href="{{ url('/product') }}" class="btn btn-outline-primary rounded-pill px-4">
                    Belanja Sekarang →
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->  --}}

<!-- Hero Start -->
<div class="container-fluid hero-header py-7 mb-5" data-aos="fade-down">
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- Left Content -->
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-4 fw-bold text-dark mb-3">
                    Because <em>Your Pet Deserves the Best</em>
                </h1>
                <p class="fs-5 text-dark mb-4">
                    Kami adalah pecinta hewan yang berkomitmen untuk memberikan produk dan layanan terbaik
                    demi kesehatan, kebahagiaan, dan kenyamanan sahabat berbulu Anda.
                </p>
                <a href="{{ url('product') }}" class="btn btn-dark py-2 px-4 me-3 animated slideInRight">Shop Now</a>
                <a href="{{ url('https://api.whatsapp.com/send?phone=628116666604&text=Nama%20:%0ANo%20HP%20:%0AAlamat%20:%0AHalo,%20mimin%20saya%20mau%20beli&fbclid=PAZXh0bgNhZW0CMTEAAae8P9Pla9ZD_SpifyEDq2fmI3247l1oYCKpr4vhNBVjLdU4ta1fph78xTA7EQ_aem_wWt83jtuQq5TR_ycCGUFcg') }}"
                class="btn btn-outline-dark py-2 px-4 animated slideInRight">Contact Us</a>
            </div>

            <!-- Right Image -->
            <div class="col-lg-6 text-center">
                <img src="{{ asset('user/assets/img/banner1.png') }}" alt="Happy Dog" class="img-fluid" style="max-height: 500px;">
            </div>

        </div>
    </div>
</div>
<!-- Hero End -->




<section class="services-section py-5" >
    <div class="container" data-aos="fade-up">
        <h2 class="text-center fw-bold mb-2">Layanan Kami</h2>
        <p class="text-center text-muted mb-5">
            Kami menyediakan berbagai layanan profesional untuk hewan peliharaan Anda
        </p>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4" >
                <div class="card service-card h-100">
                    <img src="{{asset('user/assets/img/Layanan_Grooming.png')}}" class="card-img-top rounded-top-4" alt="Grooming">
                    <div class="card-body">
                        <h5 class="fw-bold">Grooming</h5>
                        <p class="text-muted">
                            Layanan perawatan dan pemandian untuk hewan peliharaan Anda oleh tenaga profesional
                        </p>
                        <a href="/grooming" class="btn btn-outline-primary rounded-pill px-4">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <img src="{{asset('user/assets/img/Konsultasi_Dokter_Hewan.png')}}" class="card-img-top rounded-top-4" alt="Konsultasi Dokter Hewan">
                    <div class="card-body">
                        <h5 class="fw-bold">Konsultasi Dokter Hewan</h5>
                        <p class="text-muted">
                            Konsultasi kesehatan dengan dokter hewan berpengalaman untuk peliharaan Anda
                        </p>
                        <a href="#" class="btn btn-outline-primary rounded-pill px-4">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <img src="{{asset('user/assets/img/PenitipanHewan.png')}}" class="card-img-top rounded-top-4" alt="Penitipan Hewan">
                    <div class="card-body">
                        <h5 class="fw-bold">Penitipan Hewan</h5>
                        <p class="text-muted">
                            Layanan penitipan hewan dengan fasilitas nyaman dan perawatan terbaik
                        </p>
                        <a href="/pet-hotel" class="btn btn-outline-primary rounded-pill px-4">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Start -->
<div class="container-fluid py-5"  style="background-color: #fff9f0;" data-aos="fade-right">
    <div class="container text-center">
        <!-- Heading -->
        <p class="text-uppercase text-secondary mb-2" style="letter-spacing: 2px;">
            Welcome to Q PetCare Padang!
        </p>
        <h2 class="mb-5">
            Kami mengkhususkan diri dalam menawarkan berbagai macam produk hewan peliharaan, mulai dari makanan hingga aksesoris
        </h2>

        <!-- Feature Items -->
        <div class="row g-4 justify-content-center">
            <!-- Pet Health -->
            <div class="col-md-4 col-sm-6">
                <div class="feature-card p-4 h-100 text-center shadow-sm border-0 rounded-4 bg-white">
                    <div class="icon-wrapper mb-3">
                        <img src="{{ asset('user/assets/img/cat2.png') }}" alt="Pet Health" class="img-fluid" style="max-width: 80px;">
                    </div>
                    <h5 class="fw-bold text-dark">Pet Health</h5>
                    <p class="text-muted mb-0">
                        Produk dan panduan terbaik untuk menjaga kesehatan dan kesejahteraan hewan kesayangan Anda.
                    </p>
                </div>
            </div>

            <!-- Grooming -->
            <div class="col-md-4 col-sm-6">
                <div class="feature-card p-4 h-100 text-center shadow-sm border-0 rounded-4 bg-white">
                    <div class="icon-wrapper mb-3">
                        <img src="{{ asset('user/assets/img/grooming.png') }}" alt="Grooming" class="img-fluid" style="max-width: 80px;">
                    </div>
                    <h5 class="fw-bold text-dark">Grooming</h5>
                    <p class="text-muted mb-0">
                        Layanan perawatan profesional agar hewan peliharaan Anda selalu tampil segar, bersih, dan bahagia.
                    </p>
                </div>
            </div>

            <!-- Pet Hotel -->
            <div class="col-md-4 col-sm-6">
                <div class="feature-card p-4 h-100 text-center shadow-sm border-0 rounded-4 bg-white">
                    <div class="icon-wrapper mb-3">
                        <img src="{{ asset('user/assets/img/pet-boarding.png') }}" alt="Pet Hotel" class="img-fluid" style="max-width: 80px;">
                    </div>
                    <h5 class="fw-bold text-dark">Pet Hotel</h5>
                    <p class="text-muted mb-0">
                        Tempat menginap yang aman, nyaman, dan penuh kasih sayang saat Anda harus bepergian.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->



<section class="keunggulan-section" >
  <div class="container" data-aos="fade-left" >
    <!-- Judul -->
    <div class="title">
      <h2>Keunggulan Q PetCare Padang</h2>
      <p><strong>Q PetCare Padang</strong> adalah Pilihan Tepat untuk Kebutuhan Hewan Peliharaan Anda dengan
        <strong>Harga yang Bersaing</strong> dan <strong>Layanan Terpercaya!</strong>
      </p>
    </div>

    <div class="content">
      <!-- Keunggulan -->
      <div class="advantages">
        <div class="card text">
          <img src="{{ asset('user/assets/img/money.png') }}" alt="Harga Terjangkau">
          <h3>Harga Terjangkau</h3>
          <p>Menawarkan harga bersahabat untuk produk dan layanan berkualitas.</p>
        </div>
        <div class="card">
          <img src="{{ asset('user/assets/img/trust.png') }}" alt="Terpercaya">
          <h3>Terpercaya</h3>
          <p>Didukung oleh tim profesional yang berpengalaman.</p>
        </div>
        <div class="card">
          <img src="{{ asset('user/assets/img/quality.png') }}" alt="Berkualitas">
          <h3>Berkualitas</h3>
          <p>Memastikan kesehatan dan kebahagiaan hewan peliharaan Anda dengan standar terbaik.</p>
        </div>
        <div class="card">
          <img src="{{ asset('user/assets/img/shopping-basket.png') }}" alt="Terlengkap">
          <h3>Terlengkap</h3>
          <p>Petshop terlengkap, menawarkan segala kebutuhan hewan peliharaan Anda.</p>
        </div>
      </div>

      <!-- Gambar kucing -->
      <div class="cat-image">
        <img src="{{ asset('user/assets/img/gambar3.png') }}" alt="anjing">
      </div>
    </div>
  </div>
</section>

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


<!-- Section Start -->
<div class="container-fluid py-5" style="background-color: #fff9f0;" data-aos="zoom-in">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kiri -->
            <div class="col-md-6 mb-4">
                <p class="section-subtitle">
                    Q Petcare Padang – Petshop Terlengkap!
                </p>
                <h2 class="section-title">
                    Butuh solusi untuk perawatan hewan peliharaan Anda?
                </h2>
                <p class="section-desc">
                    <strong>Q PetCare Padang</strong> siap membantu! Dengan produk berkualitas dan tenaga profesional berpengalaman,
                    kami menyediakan berbagai layanan mulai dari makanan, grooming, hingga penginapan hewan.
                </p>
                <a href="{{ url('https://api.whatsapp.com/send?phone=628116666604&text=Nama%20:%0ANo%20HP%20:%0AAlamat%20:%0AHalo,%20mimin%20saya%20mau%20beli&fbclid=PAZXh0bgNhZW0CMTEAAae8P9Pla9ZD_SpifyEDq2fmI3247l1oYCKpr4vhNBVjLdU4ta1fph78xTA7EQ_aem_wWt83jtuQq5TR_ycCGUFcg') }}" class="btn btn-outline-primary rounded-pill px-4">
                    Hubungi Kami!
                </a>
            </div>

            <!-- Kanan -->
            <div class="col-md-6 d-flex justify-content-center">
                <div class="info-card">
                    <h4 class="info-title">
                        <img src="{{ asset('user/assets/img/clock.png') }}" alt="Jam">
                        Jam Operasional
                    </h4>
                    <hr>
                    <p><strong>Pets Shop</strong><br> Senin – Minggu : 09:00 – 21:00</p>
                    <p><strong>Grooming</strong><br> Senin – Minggu : 09:00 – 19:00 WIB</p>
                    <p><strong>Pet Hotel</strong><br> Senin – Minggu : 12:00 – 18:00 WIB</p>
                    <p><strong>Pet Klinik</strong><br> Senin – Minggu : 11:00 – 21:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>







{{--  <!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Gambar -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid animated pulse infinite" src="{{ asset('user/assets/img/pet-care.png') }}" alt="Pet Care">
            </div>

            <!-- Konten -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="text-primary mb-4">
                    Because <span class="fw-light text-dark">Your Pet Deserves the Best</span>
                </h1>
                <p class="mb-4">
                    Di <strong>Pawfect Pet Shop</strong>, setiap hewan peliharaan adalah bagian dari keluarga.
                    Kami menyediakan makanan sehat, perlengkapan berkualitas, serta layanan grooming dan hotel
                    hewan yang penuh perhatian.
                </p>
                <p class="mb-4">
                    Dengan tim yang berpengalaman dan penuh kasih sayang, kami selalu siap memberikan
                    pelayanan terbaik agar Anda merasa tenang saat mempercayakan sahabat berbulu Anda kepada kami.
                </p>
                <a class="btn btn-outline-primary rounded-pill px-4" href="{{ url('/shop') }}">Shop Now</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->  --}}



    {{--  <!-- Deal Start -->
    <div class="container-fluid deal bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid animated pulse infinite" src="img/shampoo-2.png">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white text-center p-4">
                        <div class="border p-4">
                            <p class="mb-2">Natural & Organic Shampoo</p>
                            <h2 class="fw-bold text-uppercase mb-4">Deals of the Day</h2>
                            <h1 class="display-4 text-primary mb-4">$99.99</h1>
                            <h5>Fresh Organic Shampoo</h5>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit. Etiam feugiat rutrum lectus sed auctor.</p>
                            <div class="row g-0 cdt mb-4">
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-days"></h1>
                                </div>
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-hours"></h1>
                                </div>
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-minutes"></h1>
                                </div>
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-seconds"></h1>
                                </div>
                            </div>
                            <a class="btn btn-primary py-2 px-4" href="">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal End -->  --}}


    {{--  <!-- Feature Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-primary mb-3"><span class="fw-light text-dark">Best Benefits Of Our</span> Natural Hair
                    Shampoo</h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="row g-5">
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0"
                                style="width: 80px; height: 80px;">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Natural & Organic</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0"
                                style="width: 80px; height: 80px;">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Anti Hair Fall</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0"
                                style="width: 80px; height: 80px;">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>Anti-dandruff</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid animated pulse infinite" src="img/shampoo.png">
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="row g-5">
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0"
                                style="width: 80px; height: 80px;">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>No Internal Side Effect</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0"
                                style="width: 80px; height: 80px;">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>No Skin Irritation</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="btn-square rounded-circle border flex-shrink-0"
                                style="width: 80px; height: 80px;">
                                <i class="fa fa-check fa-2x text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h5>No Artificial Smell</h5>
                                <hr class="w-25 bg-primary my-2">
                                <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->  --}}


    {{--  <!-- How To Use Start -->
    <div class="container-fluid how-to-use bg-primary my-5 py-5">
        <div class="container text-white py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark">How To Use Our</span> Natural & Organic
                    <span class="fw-light text-dark">Hair Shampoo</span></h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa fa-home fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-white">Wash Hair With Water</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</span>
                </div>
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.3s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa fa-home fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-white">Apply Shampoo On Hair</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</span>
                </div>
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.5s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa fa-home fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-white">Wait 5 Mins And Wash</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- How To Use End -->  --}}




    {{--  <!-- Testimonial Start -->
    <div class="container-fluid testimonial bg-primary my-5 py-5">
        <div class="container text-white py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3">Our Customer Said <span class="fw-light text-dark">About Our Natural Shampoo</span></h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                        <div class="testimonial-item text-center" data-dot="1">
                            <img class="img-fluid border p-2" src="img/testimonial-1.jpg" alt="">
                            <h5 class="fw-light lh-base text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus, vitae porttitor purus nisl vitae purus. Praesent tristique odio ut rutrum pellentesque. Fusce eget molestie est, at rutrum est. Nullam scelerisque libero nunc, vitae ullamcorper elit volutpat ut.</h5>
                            <h5 class="mb-1">Client Name</h5>
                            <h6 class="fw-light text-white fst-italic mb-0">Profession</h6>
                        </div>
                        <div class="testimonial-item text-center" data-dot="2">
                            <img class="img-fluid border p-2" src="img/testimonial-2.jpg" alt="">
                            <h5 class="fw-light lh-base text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus, vitae porttitor purus nisl vitae purus. Praesent tristique odio ut rutrum pellentesque. Fusce eget molestie est, at rutrum est. Nullam scelerisque libero nunc, vitae ullamcorper elit volutpat ut.</h5>
                            <h5 class="mb-1">Client Name</h5>
                            <h6 class="fw-light text-white fst-italic mb-0">Profession</h6>
                        </div>
                        <div class="testimonial-item text-center" data-dot="3">
                            <img class="img-fluid border p-2" src="img/testimonial-3.jpg" alt="">
                            <h5 class="fw-light lh-base text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus, vitae porttitor purus nisl vitae purus. Praesent tristique odio ut rutrum pellentesque. Fusce eget molestie est, at rutrum est. Nullam scelerisque libero nunc, vitae ullamcorper elit volutpat ut.</h5>
                            <h5 class="mb-1">Client Name</h5>
                            <h6 class="fw-light text-white fst-italic mb-0">Profession</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->  --}}


    {{--  <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-primary mb-3"><span class="fw-light text-dark">From Our</span> Blog Articles</h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="blog-item border h-100 p-4">
                        <img class="img-fluid mb-4" src="img/blog-1.jpg" alt="">
                        <a href="" class="h5 lh-base d-inline-block">Foods that are good for your hair growing</a>
                        <div class="d-flex text-black-50 mb-2">
                            <div class="pe-3">
                                <small class="fa fa-eye me-1"></small>
                                <small>9999 Views</small>
                            </div>
                            <div class="pe-3">
                                <small class="fa fa-comments me-1"></small>
                                <small>9999 Comments</small>
                            </div>
                        </div>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</p>
                        <a href="" class="btn btn-outline-primary px-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="blog-item border h-100 p-4">
                        <img class="img-fluid mb-4" src="img/blog-2.jpg" alt="">
                        <a href="" class="h5 lh-base d-inline-block">How to take care of hair naturally</a>
                        <div class="d-flex text-black-50 mb-2">
                            <div class="pe-3">
                                <small class="fa fa-eye me-1"></small>
                                <small>9999 Views</small>
                            </div>
                            <div class="pe-3">
                                <small class="fa fa-comments me-1"></small>
                                <small>9999 Comments</small>
                            </div>
                        </div>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</p>
                        <a href="" class="btn btn-outline-primary px-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="blog-item border h-100 p-4">
                        <img class="img-fluid mb-4" src="img/blog-3.jpg" alt="">
                        <a href="" class="h5 lh-base d-inline-block">How to use our natural & organic shampoo</a>
                        <div class="d-flex text-black-50 mb-2">
                            <div class="pe-3">
                                <small class="fa fa-eye me-1"></small>
                                <small>9999 Views</small>
                            </div>
                            <div class="pe-3">
                                <small class="fa fa-comments me-1"></small>
                                <small>9999 Comments</small>
                            </div>
                        </div>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</p>
                        <a href="" class="btn btn-outline-primary px-3">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->  --}}


    {{--  <!-- Newsletter Start -->
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
    <!-- Newsletter End -->  --}}

@endsection
