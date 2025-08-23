@extends('user.layouts.main')

@section('content')


<style>
  .object-fit-cover { object-fit: cover; }
  .clinic-card {
    position: relative;
    transition: transform .25s ease, box-shadow .25s ease;
  }
  .clinic-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 1.25rem 2.5rem rgba(0,0,0,.12);
  }
  .clinic-accent {
    position: absolute;
    inset: 0 auto 0 0;
    width: 38%;
    background: radial-gradient(120% 100% at 0% 50%, rgba(205,32,2,.12), transparent 60%);
    pointer-events: none;
  }
  /* Utilities untuk badge Bootstrap 5.3+ fallback */
  .bg-danger-subtle { background-color: rgba(205,32,2,.12) !important; }
  .text-danger-emphasis { color: #cd2002 !important; }

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

<div class="container-fluid bg-primary hero-header py-5 mb-5"></div>

<!-- Klinik Card -->
<section class="clinic-section py-5">
  <div class="container">
    <div class="card clinic-card border-0 shadow-lg overflow-hidden rounded-4">
      <div class="row g-0 align-items-center">
        <!-- Gambar -->
        <div class="col-lg-6 order-lg-2">
          <div class="ratio ratio-4x3">
            <img
              src="{{ asset('user/assets/img/pet-klinik.png') }}"
              alt="Layanan Pet Klinik Q Petcare"
              class="w-60 h-100 object-fit-cover"
              loading="lazy">
          </div>
        </div>

        <!-- Konten -->
        <div class="col-lg-6 order-lg-1">
          <div class="p-4 p-lg-5">
            <h2 class="display-6 fw-bold mb-3">Pet Klinik</h2>
            <p class="text-muted mb-4 text-justify">
              Di Q Petcare, kesehatan anabul adalah prioritas utama.
              Klinik hewan kami dilengkapi dengan dokter hewan profesional
              dan fasilitas modern untuk pemeriksaan, vaksinasi, perawatan penyakit,
              hingga tindakan medis darurat.
            </p>
          </div>
        </div>
      </div>

      <!-- Aksen gradient -->
      <div class="clinic-accent d-none d-lg-block"></div>
    </div>
  </div>
</section>

<section class="premium-services mb-5" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="mb-2">Layanan Pet Klinik</h2>
    <p class="section-subtitle">
      Layanan klinik profesional Q Petcare membantu menjaga kesehatan anabul Anda dengan perawatan penuh kasih sayang dan ditangani tenaga medis berpengalaman.
    </p>
    <div class="row g-4 mt-4">
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-heart-pulse"></i></div>
          <h5>Pemeriksaan Umum</h5>
          <p>Konsultasi kesehatan rutin untuk memastikan kondisi anabul tetap prima.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-syringe"></i></div>
          <h5>Vaksinasi</h5>
          <p>Vaksin lengkap untuk mencegah berbagai penyakit berbahaya pada hewan peliharaan.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-capsule"></i></div>
          <h5>Perawatan Penyakit</h5>
          <p>Diagnosa dan pengobatan berbagai penyakit dengan obat dan metode terpercaya.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="service-card">
          <div class="service-icon"><i class="bi bi-scissors"></i></div>
          <h5>Tindakan Medis</h5>
          <p>Penanganan darurat & operasi ringan sesuai kebutuhan medis anabul Anda.</p>
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
                <img src="{{ asset('user/assets/img/catdog1.png') }}" class="img-fluid" alt="Pet Klinik Q Petcare">
            </div>
            <div class="col-md-8 p-4">
                <h4 class="fw-bold">Jaga Kesehatan Anabul di Q PetCare Pet Klinik!</h4>
                <p>
                    Kami siap membantu menjaga kesehatan hewan kesayangan Anda dengan layanan medis profesional.
                    Yuk, isi form booking di bawah untuk jadwalkan kunjungan klinik anabul Anda!
                </p>
            </div>
        </div>
    </div>
</div>




<div class="container mb-5" data-aos="zoom-in">
    <h3 class="text-center fw-bold">Form Booking</h3>
    <hr class="mx-auto" style="width: 60px; border: 2px solid #f1c40f;">

<form id="petKlinikForm" action="{{ route('pet-klinik.store') }}" method="POST" class="mt-4">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

    <div class="mb-3">
        <label class="form-label">Nama Hewan</label>
        <input type="text" name="nama_hewan" class="form-control" required>
    </div>

<div class="mb-3">
    <label class="form-label">Jenis Hewan</label>
    <select name="jenis_hewan" class="form-select" required>
        <option value="">-- Pilih Jenis Hewan --</option>
        <option value="Kucing" {{ old('jenis_hewan', $grooming->jenis_hewan ?? '') == 'Kucing' ? 'selected' : '' }}>Kucing</option>
        <option value="Anjing" {{ old('jenis_hewan', $grooming->jenis_hewan ?? '') == 'Anjing' ? 'selected' : '' }}>Anjing</option>
        <option value="Anjing" {{ old('lainnya', $grooming->jenis_hewan ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Vaksinasi Hewan</label>
    <select name="vaksinasi" class="form-select" required>
        <option value="">-- Vaksinasi Hewan --</option>
        <option value="Ya" {{ old('vaksinasi', $grooming->vaksinasi ?? '') == 'Ya' ? 'selected' : '' }}>Ya</option>
        <option value="Tidak" {{ old('vaksinasi', $grooming->vaksinasi ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
    </select>
</div>
    <div class="mb-3">
        <label class="form-label">Umur Hewan</label>
        <input type="number" name="umur_hewan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Berat Hewan</label>
        <input type="number" step="0.01" name="berat" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" class="form-control" required min="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Keluhan Anabul</label>
        <textarea name="keluhan" rows="4" class="form-control" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Booking</button>
</form>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfirmasi sebelum submit
    document.getElementById("petKlinikForm").addEventListener("submit", function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Konfirmasi Booking",
            text: "Apakah Anda yakin ingin booking ke Klinik?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Booking!"
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
@endpush


@endsection
