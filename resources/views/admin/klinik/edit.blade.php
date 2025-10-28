@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header">Edit Data Kunjungan Klinik</h3>
    <div class="card-body">
      <form action="{{ route('data-klinik.update', $klinik->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Hewan --}}
        <div class="mb-3">
          <label for="nama_hewan" class="form-label">Nama Hewan</label>
          <input type="text" name="nama_hewan" id="nama_hewan"
            class="form-control @error('nama_hewan') is-invalid @enderror"
            value="{{ old('nama_hewan', $klinik->nama_hewan) }}" required>
          @error('nama_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Jenis Hewan --}}
       <div class="mb-3">
          <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
          <select name="jenis_hewan" id="jenis_hewan" class="form-select @error('jenis_hewan') is-invalid @enderror" required>
            <option value="">-- Pilih Jenis Hewan --</option>
            <option value="Kucing" {{ old('jenis_hewan', $klinik->jenis_hewan) == 'Kucing' ? 'selected' : '' }}>Kucing</option>
            <option value="Anjing" {{ old('jenis_hewan', $klinik->jenis_hewan) == 'Anjing' ? 'selected' : '' }}>Anjing</option>
            <option value="lainnya" {{ old('jenis_hewan', $klinik->jenis_hewan) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
          </select>
          @error('jenis_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="vaksinasi" class="form-label">Vaksinasi</label>
          <select name="vaksinasi" id="vaksinasi" class="form-select @error('vaksinasi') is-invalid @enderror" required>
            <option value="">-- Pilih Vaksinasi --</option>
            <option value="Ya" {{ old('vaksinasi', $klinik->vaksinasi) == 'Ya' ? 'selected' : '' }}>Ya</option>
            <option value="Tidak" {{ old('vaksinasi', $klinik->vaksinasi) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
          </select>
          @error('vaksinasi')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Umur Hewan --}}
        <div class="mb-3">
          <label for="umur_hewan" class="form-label">Umur Hewan (tahun)</label>
          <input type="number" name="umur_hewan" id="umur_hewan"
            class="form-control @error('umur_hewan') is-invalid @enderror"
            value="{{ old('umur_hewan', $klinik->umur_hewan) }}">
          @error('umur_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Berat --}}
        <div class="mb-3">
          <label for="berat" class="form-label">Berat (kg)</label>
          <input type="number" step="0.01" name="berat" id="berat"
            class="form-control @error('berat') is-invalid @enderror"
            value="{{ old('berat', $klinik->berat) }}" required>
          @error('berat')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Tanggal Kunjungan --}}
        <div class="mb-3">
          <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
          <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan"
            class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
            value="{{ old('tanggal_kunjungan', $klinik->tanggal_kunjungan) }}" required>
          @error('tanggal_kunjungan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

             {{-- Waktu Kunjungan --}}
        <div class="mb-3">
          <label for="waktu_kunjungan" class="form-label">Waktu Kunjungan</label>
          <input type="time" name="waktu_kunjungan" id="waktu_kunjungan"
            class="form-control @error('waktu_kunjungan') is-invalid @enderror"
            value="{{ old('waktu_kunjungan', $klinik->waktu_kunjungan) }}" required>
          @error('waktu_kunjungan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Keluhan --}}
        <div class="mb-3">
          <label for="keluhan" class="form-label">Keluhan</label>
          <textarea name="keluhan" id="keluhan" rows="3"
            class="form-control @error('keluhan') is-invalid @enderror"
            required>{{ old('keluhan', $klinik->keluhan) }}</textarea>
          @error('keluhan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>



        <a href="{{ route('data-klinik.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </form>
    </div>
  </div>
</div>
@endsection
