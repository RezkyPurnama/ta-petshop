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


<section class="premium-services mb-5" data-aos="fade-up">
    <div class="container text-center">
        <h2 class="mb-2">Grooming Services</h2>
        <p class="section-subtitle">
            Layanan grooming profesional dari Q Petcare untuk menjaga kebersihan, kesehatan, dan penampilan
            anabul Anda dengan penuh kasih sayang.
        </p>
        <div class="row g-4 mt-4">
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-droplet"></i></div>
                    <h5>Refreshing Bath</h5>
                    <p>Mandi menyegarkan dengan shampoo khusus yang aman dan sesuai jenis bulu anabul Anda.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-scissors"></i></div>
                    <h5>Hair Trimming</h5>
                    <p>Potong bulu dengan model rapi dan nyaman, sesuai gaya dan kebutuhan anabul.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-brush"></i></div>
                    <h5>Styling</h5>
                    <p>Grooming dengan gaya sesuai request agar anabul tampil menawan & unik.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-heart"></i></div>
                    <h5>Nail & Paw Care</h5>
                    <p>Perawatan kuku dan kaki agar tetap bersih, sehat, dan nyaman untuk anabul Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Info Card -->
    <div class="container mb-5" data-aos="fade-right">
        <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 text-center p-4">
                    <img src="{{ asset('user/assets/img/catdog1.png') }}" class="img-fluid" alt="Dog and Cat Grooming">
                </div>
                <div class="col-md-8 p-4">
                    <h4 class="fw-bold">Buat Anabul Makin Cantik dan Sehat di Q PetCare Grooming!</h4>
                    <p>
                        Kami menyediakan layanan grooming lengkap untuk anabul kesayanganmu.
                        Yuk, isi form di bawah dan pastikan mereka tampil mempesona!
                    </p>
                </div>
            </div>
        </div>
    </div>



    <div class="container mb-5" data-aos="zoom-in">
        <h3 class="text-center fw-bold">Form Booking Grooming</h3>
        <hr class="mx-auto" style="width: 60px; border: 2px solid #f1c40f;">

        <form id="bookingForm" action="{{ route('grooming.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <input type="text" name="nama_hewan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Hewan</label>
                <select name="jenis_hewan" class="form-select" required>
                    <option value="">-- Pilih Jenis Hewan --</option>
                    <option value="Kucing"
                        {{ old('jenis_hewan', $grooming->jenis_hewan ?? '') == 'Kucing' ? 'selected' : '' }}>Kucing</option>
                    <option value="Anjing"
                        {{ old('jenis_hewan', $grooming->jenis_hewan ?? '') == 'Anjing' ? 'selected' : '' }}>Anjing</option>
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">Umur Hewan (tahun)</label>
                <input type="number" name="umur_hewan" class="form-control" placeholder="Contoh : 8" required>

            </div>

            <div class="mb-3">
                <label class="form-label">Berat Hewan (kg)</label>
                <input type="number" step="0.01" name="berat_hewan" class="form-control" placeholder="kg" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Riwayat Sakit</label>
                <textarea name="riwayat_sakit" class="form-control" ></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Layanan Grooming</label>
                <select name="layanan_grooming" class="form-select" required>
                    <option value="">-- Pilih Layanan Grooming --</option>
                    <option value="Basic Grooming"
                        {{ old('layanan_grooming', $grooming->layanan_grooming ?? '') == 'Basic Grooming' ? 'selected' : '' }}>
                        Basic Grooming -- Rp.50.000</option>
                    <option value="Full Grooming"
                        {{ old('layanan_grooming', $grooming->layanan_grooming ?? '') == 'Full Grooming' ? 'selected' : '' }}>
                        Full Grooming -- Rp.80.000</option>
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">Tanggal Booking</label>
                <input type="date" name="tanggal_booking" class="form-control" required
                    min="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Booking</label>
                <input type="time" name="jam_booking" class="form-control" required min="10:00" max="19:00"
                    oninvalid="this.setCustomValidity('Silakan pilih jam antara 10:00 sampai 19:00')"
                    oninput="this.setCustomValidity('')">
            </div>


            <button type="submit" class="btn btn-primary">Kirim Booking</button>
        </form>

    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Konfirmasi sebelum submit
    document.getElementById("bookingForm").addEventListener("submit", function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Konfirmasi Booking",
            text: "Apakah Anda yakin ingin mengirim booking grooming?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Kirim!"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    // Notifikasi success
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // Notifikasi error kuota penuh
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
</script>
@endpush

