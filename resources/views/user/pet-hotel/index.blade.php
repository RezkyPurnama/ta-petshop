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
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-heart-pulse"></i></div>
          <h5>Daily Health Check</h5>
          <p>Pemeriksaan kesehatan ringan setiap hari untuk memastikan kondisi anabul tetap prima.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-flower1"></i></div>
          <h5>Aromatherapy Rooms</h5>
          <p>Ruang beraroma menenangkan untuk membantu anabul rileks selama menginap.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-camera"></i></div>
          <h5>Photo & Video Updates</h5>
          <p>Kirimkan momen menggemaskan anabul Anda setiap hari melalui WhatsApp atau email.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-truck"></i></div>
          <h5>Pick-up & Drop-off</h5>
          <p>Layanan antar-jemput aman dan nyaman dengan kendaraan khusus hewan peliharaan.</p>
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

    <form action="#" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Pemilik </label>
            <input type="text" name="nama_pemilik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Hewan Peliharaan</label>
            <input type="text" name="nama_hewan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Hewan</label>
            <select name="jenis_hewan" class="form-select" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                <option value="Kucing">Kucing</option>
                <option value="Anjing">Anjing</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Hewan</label>
            <input type="number" name="jumlah_hewan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ras Hewan</label>
            <input type="text" name="ras_hewan" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Riwayat Sakit</label>
            <input type="text" name="riwayat_sakit" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Status Vaksin</label>
            <select name="status_vaksin" class="form-select">
                <option value="">-- Pilih Status Vaksin --</option>
                <option value="Sudah">Sudah</option>
                <option value="Belum">Belum</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur Hewan</label>
            <input type="text" name="umur_hewan" class="form-control" placeholder="contoh: 2 tahun">
        </div>

        <div class="mb-3">
            <label class="form-label">Berat Hewan</label>
            <input type="text" name="berat_hewan" class="form-control" placeholder="contoh: 5 kg">
        </div>

        <div class="mb-3">
            <label class="form-label">Sertifikat Hewan</label>
            <select name="sertifikat_hewan" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Ada">Ada</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Check-In</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Check-Out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Booking</button>
    </form>
</div>
@endsection
