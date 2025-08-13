@extends('user.layouts.main')

@section('content')

<!-- Hero Section -->
<div class="container-fluid bg-primary hero-header py-5 mb-5">
</div>



<!-- Pets Hotel Description -->
<div class="container mb-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('img/hotel1.jpg') }}" class="img-fluid rounded" alt="Pets Hotel">
        </div>
        <div class="col-md-6">
            <h2>Pets Hotel</h2>
            <p>
                HalloPets Lovers, buat kamu yang mau liburan atau sedang ada keperluan mendadak tidak perlu khawatir
                meninggalkan hewan kesayangan. HalloPets Hotel siap memberikan kamar terbaik untuk teman berbulu
                kesayanganmu!
            </p>
        </div>
    </div>
</div>

<!-- Info Card -->
<div class="container mb-5">
    <div class="card shadow-lg border-0">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 text-center p-4">
                <img src="{{ asset('img/dog-cat.png') }}" class="img-fluid" alt="Dog and Cat">
            </div>
            <div class="col-md-8 p-4">
                <h4 class="fw-bold">Titipkan Anabul dengan Tenang di HalloPets Hotel!</h4>
                <p>Kami siap menyediakan kamar terbaik untuk hewan kesayanganmu! Isi form di bawah dan pastikan liburanmu bebas khawatir.</p>
            </div>
        </div>
    </div>
</div>

<!-- Booking Form -->
<div class="container mb-5">
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
