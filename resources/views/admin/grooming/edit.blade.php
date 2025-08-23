@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header">Edit Booking Grooming</h3>
    <div class="card-body">
      <form action="{{ route('data-grooming.update', $grooming->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="mb-3">
          <label for="nama_hewan" class="form-label">Nama Hewan</label>
          <input type="text" name="nama_hewan" id="nama_hewan"
            class="form-control @error('nama_hewan') is-invalid @enderror"
            value="{{ old('nama_hewan', $grooming->nama_hewan) }}" required>
          @error('nama_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
          <select name="jenis_hewan" id="jenis_hewan" class="form-select @error('jenis_hewan') is-invalid @enderror" required>
            <option value="">-- Pilih Jenis Hewan --</option>
            <option value="Kucing" {{ old('jenis_hewan', $grooming->jenis_hewan) == 'Kucing' ? 'selected' : '' }}>Kucing</option>
            <option value="Anjing" {{ old('jenis_hewan', $grooming->jenis_hewan) == 'Anjing' ? 'selected' : '' }}>Anjing</option>
          </select>
          @error('jenis_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="umur_hewan" class="form-label">Umur Hewan (tahun)</label>
          <input type="number" name="umur_hewan" id="umur_hewan"
            class="form-control @error('umur_hewan') is-invalid @enderror"
            value="{{ old('umur_hewan', $grooming->umur_hewan) }}" required>
          @error('umur_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="berat_hewan" class="form-label">Berat Hewan (kg)</label>
          <input type="number" step="0.01" name="berat_hewan" id="berat_hewan"
            class="form-control @error('berat_hewan') is-invalid @enderror"
            value="{{ old('berat_hewan', $grooming->berat_hewan) }}" required>
          @error('berat_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="riwayat_sakit" class="form-label">Riwayat Sakit</label>
          <textarea name="riwayat_sakit" id="riwayat_sakit" class="form-control @error('riwayat_sakit') is-invalid @enderror">{{ old('riwayat_sakit', $grooming->riwayat_sakit) }}</textarea>
          @error('riwayat_sakit')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

<div class="mb-3">
    <label for="layanan_grooming" class="form-label">Layanan Grooming</label>
    <select name="layanan_grooming" id="layanan_grooming"
        class="form-select @error('layanan_grooming') is-invalid @enderror" required>
        <option value="">-- Pilih Layanan Grooming --</option>
        <option value="Basic Grooming" {{ old('layanan_grooming', $grooming->layanan_grooming ?? '') == 'Basic Grooming' ? 'selected' : '' }}>Basic Grooming</option>
        <option value="Full Grooming" {{ old('layanan_grooming', $grooming->layanan_grooming ?? '') == 'Full Grooming' ? 'selected' : '' }}>Full Grooming</option>
    </select>
    @error('layanan_grooming')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


        <div class="mb-3">
          <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
          <input type="date" name="tanggal_booking" id="tanggal_booking"
            class="form-control @error('tanggal_booking') is-invalid @enderror"
            value="{{ old('tanggal_booking', $grooming->tanggal_booking) }}" required>
          @error('tanggal_booking')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="jam_booking" class="form-label">Jam Booking</label>
          <input type="time" name="jam_booking" id="jam_booking"
            class="form-control @error('jam_booking') is-invalid @enderror"
            value="{{ old('jam_booking', $grooming->jam_booking) }}" required>
          @error('jam_booking')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <a href="{{ route('data-grooming.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </form>
    </div>
  </div>
</div>
@endsection
