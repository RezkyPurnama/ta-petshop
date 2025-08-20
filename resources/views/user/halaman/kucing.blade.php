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

    <!-- Grooming Card -->
    <section class="grooming-section py-5">
        <div class="container">
            <div class="card grooming-card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="row g-0 align-items-center">
                    <!-- Gambar (kanan di desktop, atas di mobile) -->
                    <div class="col-lg-6 order-lg-2">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('user/assets/img/grooming1.png') }}" alt="Layanan Grooming Q Petcare"
                                class="w-60 h-100 object-fit-cover" loading="lazy">
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-4 p-lg-5">
                            <h2 class="display-6 fw-bold mb-3">Grooming</h2>
                            <p class="text-muted mb-4 text-justify">
                                Di Q Petcare, kami memahami bahwa hewan peliharaan bukan sekadar teman, tapi bagian dari
                                keluarga.
                                Layanan grooming kami dirancang untuk menjaga kebersihan, kesehatan, dan penampilan anabul
                                Anda—mulai
                                dari mandi menyegarkan, pemangkasan kuku, penyisiran bulu, hingga perawatan khusus kulit &
                                rambut.
                            </p>

                            <!-- Badge kecil di bawah -->
                        </div>
                    </div>
                </div>

                <!-- Aksen gradient dekoratif -->
                <div class="grooming-accent d-none d-lg-block"></div>
            </div>
        </div>
    </section>


@endsection
