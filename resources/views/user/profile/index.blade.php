@extends('user.layouts.main')
@section('content')

<!-- Hero Section -->
<div class="container-fluid bg-primary hero-header mb-5"></div>

<!-- Profile Page -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body px-4 py-5">
          <div class="text-center mb-4">
            {{-- Tampilkan gambar profil jika ada, jika tidak pakai placeholder --}}
            <img
              src="{{ $user->foto_profile ? asset('storage/profil/' . $user->foto_profile) : asset('img/avatar-placeholder.png') }}"
              class="rounded-circle shadow" width="100" height="100" style="object-fit: cover;"
              alt="Foto Profil">
            <h4 class="mt-3 text-primary fw-bold">Profil Saya</h4>
            <p class="text-muted mb-0">Kelola informasi akun Anda</p>
          </div>

          {{-- Success Alert --}}
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

              <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fa fa-user"></i></span>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" required>
                  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" required>
                  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">No. Telepon</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fa fa-phone"></i></span>
                  <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
                    value="{{ old('no_telepon', $user->no_telepon) }}">
                  @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Alamat</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fa fa-map-marker"></i></span>
                  <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                    value="{{ old('alamat', $user->alamat) }}">
                  @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Password Baru</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fa fa-lock"></i></span>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="******">
                  @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-light"><i class="fa fa-lock"></i></span>
                  <input type="password" name="password_confirmation" class="form-control"
                    placeholder="******">
                </div>
              </div>

              <div class="col-md-12">
                <label class="form-label fw-semibold">Foto Profil</label>
                <input type="file" name="foto_profile" class="form-control @error('foto_profile') is-invalid @enderror">
                @error('foto_profile') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary py-2">
                <i class="fa fa-save me-2"></i>Simpan Perubahan
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
