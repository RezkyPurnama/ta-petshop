@extends('user.layouts.main')
@section('content')



    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header py-5 mb-3">
    </div>

    <!-- Feature Start -->
<div class="container-fluid py-5 mb-3"  style="background-color: #fff9f0;" data-aos="fade-right">
    <div class="container text-center">
        <!-- Heading -->
        <p class="text-uppercase text-secondary mb-2" style="letter-spacing: 2px;">
            Welcome to Q PetCare Padang!
        </p>
        <h2 class="mb-5">
            Kami mengkhususkan diri dalam menawarkan berbagai macam produk hewan peliharaan, mulai dari makanan hingga aksesoris
        </h2>

        <!-- Feature Items -->
        <div class="row g-4 justify-content-center mb-3">
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


    <section class="about-section py-5 mb-5" style="background-color: #fff9f0;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Teks -->
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-bold mb-4">Tentang Q Petcare Padang</h2>
                <p class="text-muted">
                    PetShop adalah toko hewan peliharaan terlengkap yang telah melayani kebutuhan hewan peliharaan sejak 2010. Kami berkomitmen untuk menyediakan produk berkualitas tinggi dan layanan profesional untuk semua jenis hewan peliharaan.
                </p>
                <p class="text-muted">
                    Dengan tim yang berpengalaman dan berdedikasi, kami selalu berusaha memberikan pengalaman berbelanja terbaik dan solusi perawatan terbaik untuk hewan kesayangan Anda.
                </p>
                <p class="text-muted">
                    Visi kami adalah menjadi toko hewan peliharaan terpercaya yang membantu meningkatkan kualitas hidup hewan peliharaan dan memperkuat ikatan antara pemilik dan hewan kesayangannya.
                </p>
            </div>

            <!-- Gambar -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('user/assets/img/blog-3.jpg') }}" alt="Tentang PetShop" class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</section>




<!-- Section Start -->
<div class="container-fluid py-5 mb-3" style="background-color: #fff9f0;" data-aos="zoom-in">
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
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
