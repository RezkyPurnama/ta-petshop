@extends('user.layouts.main')

@section('content')
<div class="container-fluid bg-primary hero-header py-5 mb-5"></div>


<!-- Grooming Description -->
<div class="container mb-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('img/grooming1.jpg') }}" class="img-fluid rounded" alt="Grooming">
        </div>
        <div class="col-md-6">
            <h2>Grooming</h2>
            <p>
                HalloPets Lovers, mau bikin anabul kamu tampil cantik dan wangi?
                HalloPets Grooming siap memberikan perawatan terbaik mulai dari mandi, potong kuku, sisir bulu,
                hingga perawatan ekstra untuk kesehatan kulit dan bulunya!
            </p>
        </div>
    </div>
</div>

<!-- Info Card -->
<div class="container mb-5">
    <div class="card shadow-lg border-0">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 text-center p-4">
                <img src="{{ asset('img/grooming-cat-dog.png') }}" class="img-fluid" alt="Dog and Cat Grooming">
            </div>
            <div class="col-md-8 p-4">
                <h4 class="fw-bold">Buat Anabul Makin Cantik dan Sehat di HalloPets Grooming!</h4>
                <p>
                    Kami menyediakan layanan grooming lengkap untuk anabul kesayanganmu.
                    Yuk, isi form di bawah dan pastikan mereka tampil mempesona!
                </p>
            </div>
        </div>
    </div>
</div>



<div class="container mb-5">
    <h3 class="text-center fw-bold">Form Booking Grooming</h3>
    <hr class="mx-auto" style="width: 60px; border: 2px solid #f1c40f;">

    <form action="" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Hewan</label>
            <input type="text" name="nama_hewan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Hewan</label>
            <select name="jenis_hewan" class="form-select" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                <option value="Kucing">Kucing</option>
                <option value="Anjing">Anjing</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur Hewan</label>
            <input type="number" name="umur_hewan" class="form-control" placeholder="dalam tahun" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Berat Hewan (kg)</label>
            <input type="number" step="0.01" name="berat_hewan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Hewan</label>
            <input type="number" name="jumlah_hewan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Riwayat Kejang</label>
            <select name="riwayat_kejang" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Ada">Ada</option>
                <option value="Tidak Ada">Tidak Ada</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Layanan Grooming</label>
            <input type="text" name="layanan_grooming" class="form-control" placeholder="Contoh: Basic Grooming, Full Grooming" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Booking</label>
            <input type="date" name="tanggal_booking" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Booking</label>
            <input type="time" name="jam_booking" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Layanan</label>
            <select name="jenis_layanan" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Ke Toko">Ke Toko</option>
                <option value="Home Service">Home Service</option>
                <option value="Pickup">Pickup</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Booking</button>
    </form>
</div>
@endsection
