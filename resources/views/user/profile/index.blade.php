@extends('user.layouts.main')

@section('content')

<style>
  .profile-card {
    max-width: 750px;
    margin: 0 auto;
    border: none;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  }

  .profile-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    background: #f0f0f0;
    border: 4px solid #f8a339; /* Border oranye */
  }

  .btn-upload {
    background-color: #f8a339; /* Oranye Q Petcare */
    color: white;
    font-weight: 600;
    border-radius: 0.5rem;
  }

  .btn-upload:hover {
    background-color: #e68b21; /* Oranye lebih gelap */
    color: #fff;
  }

  .btn-cancel {
    background-color: #f0f0f0;
    color: #3b1b1b;
    border-radius: 0.5rem;
  }

  .btn-cancel:hover {
    background-color: #ddd;
    color: #111;
  }

  .btn-dark {
    background-color: #3b1b1b; /* Hijau tua Q Petcare */
    border: none;
    border-radius: 0.5rem;
  }

  .btn-dark:hover {
    background-color: #111426; /* Lebih gelap */
  }

  .form-label {
    font-weight: 600;
    color: #3b1b1b;
  }

  .form-control {
    border-radius: 0.5rem;
    border: 1px solid #ccc;
  }

  .form-control:focus {
    border-color: #f8a339;
    box-shadow: 0 0 0 0.25rem rgba(248, 163, 57, 0.25);
  }

  .alert-success {
    background-color: #dff7e1;
    color: #2e7d32;
    border: none;
    border-radius: 0.5rem;
  }

  @media (max-width: 768px) {
    .profile-img {
      width: 100px;
      height: 100px;
    }
  }
</style>

<!-- Hero Section -->
<div class="container-fluid bg-primary hero-header py-5 mb-5"></div>

<!-- Profile Section -->
<div class="container py-5">
  <div class="card profile-card">
    <div class="card-body px-4 py-5">

      <div class="row">
        <h4 class="text-dark mb-5 text-center">Account Settings</h4>

 <!-- Avatar -->
<div class="col-md-4 text-center mb-4 mb-md-0">

  <div class="text-center mb-3">
    @if ($user->foto_profile)
        {{-- Kalau ada foto profil --}}
        <img src="{{ asset('storage/profil/' . $user->foto_profile) }}"
             class="profile-img mb-3 shadow-sm border"
             alt="Foto Profil">
    @else
        {{-- Kalau belum ada foto profil --}}
        <div class="d-flex align-items-center justify-content-center mb-3"
             style="width:120px; height:120px; border-radius:50%; background:#f5f5f5; margin:0 auto; border:2px dashed #ccc;">
            <i class="fas fa-user text-muted" style="font-size:48px;"></i>
        </div>
        <small class="text-muted d-block">Belum ada foto profil</small>
    @endif
  </div>

  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="file" name="foto_profile"
           class="form-control mb-2 @error('foto_profile') is-invalid @enderror">
    @error('foto_profile')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <button class="btn btn-upload w-100 mt-2" type="submit">Upload a picture</button>
  </form>

</div>

        <!-- Form -->
        <div class="col-md-8">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fa fa-check-circle me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $user->name) }}" required>
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email', $user->email) }}" required>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Nomor Telepon</label>
              <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
                     value="{{ old('no_telepon', $user->no_telepon) }}" required>
              @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                     value="{{ old('alamat', $user->alamat) }}" required>
              @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                     placeholder="Masukkan Password Baru">
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="d-flex justify-content-between gap-2">
              <a href="/" class="btn btn-cancel w-50">Cancel</a>
              <button type="submit" class="btn btn-dark w-50">Save</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
