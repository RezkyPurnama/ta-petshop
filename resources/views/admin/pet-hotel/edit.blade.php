@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header">Edit Data Pet Hotel</h3>
    <div class="card-body">
      <form action="{{ route('data-pethotel.update', $pethotels->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Pemilik --}}
        <div class="mb-3">
          <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
          <input type="text" name="nama_pemilik" id="nama_pemilik"
                 class="form-control @error('nama_pemilik') is-invalid @enderror"
                 value="{{ old('nama_pemilik', $pethotels->nama_pemilik) }}" required>
          @error('nama_pemilik')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Nomor Telepon --}}
        <div class="mb-3">
          <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
          <input type="text" name="nomor_telepon" id="nomor_telepon"
                 class="form-control @error('nomor_telepon') is-invalid @enderror"
                 value="{{ old('nomor_telepon', $pethotels->nomor_telepon) }}" required>
          @error('nomor_telepon')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Nama Hewan --}}
        <div class="mb-3">
          <label for="nama_hewan" class="form-label">Nama Hewan</label>
          <input type="text" name="nama_hewan" id="nama_hewan"
                 class="form-control @error('nama_hewan') is-invalid @enderror"
                 value="{{ old('nama_hewan', $pethotels->nama_hewan) }}" required>
          @error('nama_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Jenis Hewan --}}
        <div class="mb-3">
          <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
          <input type="text" name="jenis_hewan" id="jenis_hewan"
                 class="form-control @error('jenis_hewan') is-invalid @enderror"
                 value="{{ old('jenis_hewan', $pethotels->jenis_hewan) }}" required>
          @error('jenis_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Jumlah Hewan --}}
        <div class="mb-3">
          <label for="jumlah_hewan" class="form-label">Jumlah Hewan</label>
          <input type="number" name="jumlah_hewan" id="jumlah_hewan"
                 class="form-control @error('jumlah_hewan') is-invalid @enderror"
                 value="{{ old('jumlah_hewan', $pethotels->jumlah_hewan) }}" required>
          @error('jumlah_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Ras Hewan --}}
        <div class="mb-3">
          <label for="ras_hewan" class="form-label">Ras Hewan</label>
          <input type="text" name="ras_hewan" id="ras_hewan"
                 class="form-control @error('ras_hewan') is-invalid @enderror"
                 value="{{ old('ras_hewan', $pethotels->ras_hewan) }}">
          @error('ras_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Status Vaksin --}}
        <div class="mb-3">
          <label for="status_vaksin" class="form-label">Status Vaksin</label>
          <select name="status_vaksin" id="status_vaksin"
                  class="form-control @error('status_vaksin') is-invalid @enderror">
            <option value="Sudah" {{ old('status_vaksin', $pethotels->status_vaksin) === 'Sudah' ? 'selected' : '' }}>Sudah</option>
            <option value="Belum" {{ old('status_vaksin', $pethotels->status_vaksin) === 'Belum' ? 'selected' : '' }}>Belum</option>
          </select>
          @error('status_vaksin')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Sertifikat Hewan --}}
        <div class="mb-3">
          <label for="sertifikat_hewan" class="form-label">Sertifikat Hewan</label>
          <select name="sertifikat_hewan" id="sertifikat_hewan"
                  class="form-control @error('sertifikat_hewan') is-invalid @enderror">
            <option value="Ada" {{ old('sertifikat_hewan', $pethotels->sertifikat_hewan) === 'Ada' ? 'selected' : '' }}>Ada</option>
            <option value="Tidak" {{ old('sertifikat_hewan', $pethotels->sertifikat_hewan) === 'Tidak' ? 'selected' : '' }}>Tidak</option>
          </select>
          @error('sertifikat_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Check In --}}
        <div class="mb-3">
          <label for="check_in" class="form-label">Check-In</label>
          <input type="date" name="check_in" id="check_in"
                 class="form-control @error('check_in') is-invalid @enderror"
                 value="{{ old('check_in', $pethotels->check_in) }}" required>
          @error('check_in')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Check Out --}}
        <div class="mb-3">
          <label for="check_out" class="form-label">Check-Out</label>
          <input type="date" name="check_out" id="check_out"
                 class="form-control @error('check_out') is-invalid @enderror"
                 value="{{ old('check_out', $pethotels->check_out) }}" required>
          @error('check_out')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" id="keterangan"
                    class="form-control @error('keterangan') is-invalid @enderror"
                    rows="3">{{ old('keterangan', $pethotels->keterangan) }}</textarea>
          @error('keterangan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <a href="{{ route('data-pethotel.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </form>
    </div>
  </div>
</div>
@endsection
