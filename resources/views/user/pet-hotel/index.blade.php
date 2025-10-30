@extends('user.layouts.main')

@section('content')


<style>
  .object-fit-cover { object-fit: cover; }
  .pet-hotel-card {
    position: relative;
    transition: transform .25s ease, box-shadow .25s ease;
  }
  .pet-hotel-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 1.25rem 2.5rem rgba(0,0,0,.12);
  }
  .pet-hotel-accent {
    position: absolute;
    inset: 0 auto 0 0;
    width: 38%;
    background: radial-gradient(120% 100% at 0% 50%, rgba(205,32,2,.12), transparent 60%);
    pointer-events: none;
  }
  /* Utilities untuk badge Bootstrap 5.3+ fallback */
  .bg-danger-subtle { background-color: rgba(205,32,2,.12) !important; }
  .text-danger-emphasis { color: #fff9f0 !important; }



    {{--  section .premium-services  --}}
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
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  }
  .service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.12);
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

<!-- Hero Section -->
<div class="container-fluid bg-primary hero-header py-5 mb-5">
</div>


<section class="pet-hotel-section mb-5 py-5">
  <div class="container">
    <div class="card pet-hotel-card border-0 shadow-lg overflow-hidden rounded-4">
      <div class="row g-0 align-items-center">
        <!-- Gambar (kanan di desktop, atas di mobile) -->
        <div class="col-lg-6 order-lg-2">
          <div class="ratio ratio-4x3">
            <img
              src="{{ asset('user/assets/img/pet_hotel.png') }}"
              alt="Layanan Pet Hotel Q Petcare"
              class="w-60 h-100 object-fit-cover"
              loading="lazy">
          </div>
        </div>

        <!-- Konten -->
        <div class="col-lg-6 order-lg-1">
          <div class="p-4 p-lg-5">
            <h2 class="display-6 fw-bold mb-3">Pet Hotel</h2>
            <p class="text-muted mb-4 text-justify">
              Di Q Petcare, kami menyediakan layanan <strong>Pet Hotel</strong> yang aman, nyaman, dan penuh perhatian
              untuk anabul kesayangan Anda. Setiap kamar dilengkapi tempat tidur empuk, area bermain, serta pengawasan
              24/7 dari tim berpengalaman. Cocok untuk menitipkan hewan peliharaan ketika Anda bepergian, memastikan
              mereka tetap bahagia, sehat, dan terawat.
            </p>
          </div>
        </div>
      </div>

      <!-- Aksen gradient dekoratif -->
      <div class="pet-hotel-accent d-none d-lg-block"></div>
    </div>
  </div>
</section>




<section class="premium-services mb-5" data-aos="fade-up">
  <div class="container text-center" >
    <h2 class="mb-2">Pet Hotel Services</h2>
    <p class="section-subtitle">
      Kami menyediakan berbagai layanan eksklusif di Pet Hotel Q Petcare untuk memastikan anabul Anda merasa nyaman, aman, dan bahagia selama menginap.
    </p>
    <div class="row g-4 mt-4">
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-house-door"></i></div>
          <h5>Private Suites</h5>
          <p>Kamar pribadi yang nyaman dengan fasilitas lengkap untuk memberikan rasa aman seperti di rumah.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-camera-video"></i></div>
          <h5>CCTV Access</h5>
          <p>Akses live streaming 24 jam agar Anda bisa memantau aktivitas anabul kapan saja.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-egg-fried"></i></div>
          <h5>Custom Meals</h5>
          <p>Menu makanan khusus sesuai kebutuhan gizi dan preferensi anabul, disiapkan setiap hari.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-balloon-heart-fill"></i></div>
          <h5>Play & Social Time</h5>
          <p>Waktu bermain dan sosialisasi terjadwal untuk menjaga mood dan kebahagiaan anabul.</p>
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
                <img src="{{ asset('user/assets/img/catdog1.png') }}" class="img-fluid" alt="Dog and Cat">
            </div>
            <div class="col-md-8 p-4">
                <h4 class="fw-bold">Titipkan Anabul dengan Tenang di Q Petcare Hotel!</h4>
                <p>Kami siap menyediakan kamar terbaik untuk hewan kesayanganmu! Isi form di bawah dan pastikan liburanmu bebas khawatir.</p>
            </div>
        </div>
    </div>
</div>


<!-- Booking Form -->
<div class="container mb-5" data-aos="zoom-in">
    <h3 class="text-center fw-bold">Form Booking Pet Hotel</h3>
    <hr class="mx-auto" style="width: 60px; border: 2px solid #f1c40f;">

    <form id="petHotelForm" action="{{ route('pet-hotel.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Hewan Peliharaan</label>
            <input type="text" name="nama_hewan" class="form-control" required>
        </div>
<div class="mb-3">
    <label class="form-label">Jenis Hewan</label>
    <select name="jenis_hewan" class="form-select" required>
        <option value="">-- Pilih Jenis Hewan --</option>
        <option value="Kucing" {{ old('jenis_hewan', $pethotels->jenis_hewan ?? '') == 'Kucing' ? 'selected' : '' }}>Kucing</option>
        <option value="Anjing" {{ old('jenis_hewan', $pethotels->jenis_hewan ?? '') == 'Anjing' ? 'selected' : '' }}>Anjing</option>
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Riwayat Sakit</label>
            <textarea type="text"  rows="4" name="riwayat_sakit" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur Hewan</label>
            <input type="number" name="umur_hewan" class="form-control" >
        </div>

        <div class="mb-3">
            <label class="form-label">Berat Hewan (kg)</label>
            <input type="text" name="berat_hewan" class="form-control" placeholder="dalam bentuk KG">
        </div>

<div class="mb-3">
    <label class="form-label">Tipe Ruangan</label>
    <select name="tipe_room" class="form-select" required>
        <option value="">-- Tipe Ruangan --</option>
        <option value="Standard" {{ old('tipe_room', $pethotels->tipe_room ?? '') == 'Standard' ? 'selected' : '' }}>Standard -- RP.30.000/Malam</option>
        <option value="Gabung" {{ old('tipe_room', $pethotels->tipe_room ?? '') == 'Gabung' ? 'selected' : '' }}>Gabung-- RP.20.000/Malam</option>
        <option value="VIP" {{ old('tipe_room', $pethotels->tipe_room ?? '') == 'VIP' ? 'selected' : '' }}>VIP -- RP.60.000/Malam</option>
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Check-In</label>
            <input type="date" name="check_in" class="form-control" required
                   min="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Check-Out</label>
            <input type="date" name="check_out" class="form-control" required
                  min="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Booking</button>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Set min check-out berdasarkan check-in
    const checkIn = document.querySelector('input[name="check_in"]');
    const checkOut = document.querySelector('input[name="check_out"]');

    checkIn.addEventListener('change', function() {
        checkOut.min = this.value;
        if (checkOut.value < this.value) {
            checkOut.value = this.value;
        }
    });

    // Konfirmasi sebelum submit
    document.getElementById("petHotelForm").addEventListener("submit", function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Konfirmasi Booking",
            text: "Apakah Anda yakin ingin mengirim booking Pet Hotel?",
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
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session("error") }}',
        showConfirmButton: true,
    });
</script>
@endif
@endpush


@endsection
