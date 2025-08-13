@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header">Edit Data User</h3>
    <div class="card-body">
      <form action="{{ route('setting-user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $user->name) }}" required>
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email', $user->email) }}" required>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Password (Opsional) --}}
        <div class="mb-3">
          <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
          <input type="password" name="password" id="password"
                 class="form-control @error('password') is-invalid @enderror">
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- No Telepon --}}
        <div class="mb-3">
          <label for="no_telepon" class="form-label">No Telepon</label>
          <input type="text" name="no_telepon" id="no_telepon"
                 class="form-control @error('no_telepon') is-invalid @enderror"
                 value="{{ old('no_telepon', $user->no_telepon) }}">
          @error('no_telepon')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea name="alamat" id="alamat"
                    class="form-control @error('alamat') is-invalid @enderror"
                    rows="3">{{ old('alamat', $user->alamat) }}</textarea>
          @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Foto Profile --}}
        <div class="mb-3">
          <label for="foto_profile" class="form-label">Foto Profile</label>
          @if ($user->foto_profile)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $user->foto_profile) }}" alt="Foto Profile" width="100">
            </div>
          @endif
          <input type="file" name="foto_profile" id="foto_profile"
                 class="form-control @error('foto_profile') is-invalid @enderror">
          @error('foto_profile')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Tombol --}}
        <a href="{{ route('setting-user.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </form>
    </div>
  </div>
</div>
@endsection
