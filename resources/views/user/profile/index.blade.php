@extends('user.layouts.main')

@section('content')

<style>
  .profile-card {
    max-width: 750px;
    margin: 0 auto;
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0,0,0,0.06);
  }

  .profile-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    background: #f0f0f0;
  }

  .btn-upload {
    background-color: #3b1b1b;
    color: white;
    font-weight: 600;
  }

  .btn-upload:hover {
    background-color: #111426;
    color: #fff;
  }

  .btn-cancel {
    background-color: #f0f0f0;
    color: #000;
  }

  .btn-cancel:hover {
    background-color: #ddd;
  }

  .form-label {
    font-weight: 600;
  }

  .form-control {
    border-radius: 0.5rem;
  }

  .input-group-text {
    border-radius: 0.5rem 0 0 0.5rem;
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
  <!-- Avatar Side - SEBELAH KIRI -->
  <div class="col-md-4 text-center mb-4 mb-md-0">
    <img src="{{ $user->foto_profile ? asset('storage/profil/' . $user->foto_profile) : asset('img/avatar-placeholder.png') }}"
         class="profile-img mb-3" alt="Foto Profil">

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="file" name="foto_profile" class="form-control mb-2 @error('foto_profile') is-invalid @enderror">
      @error('foto_profile') <div class="invalid-feedback">{{ $message }}</div> @enderror
      <button class="btn btn-upload w-100 mt-2" type="submit">Upload a picture</button>
    </form>
  </div>

  <!-- Form Side - SEBELAH KANAN -->
  <div class="col-md-8">


    {{-- Alert jika ada --}}
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

      <div class="mb-4">
        <a href="#" class="text-danger small d-block">Delete Your Account</a>
        <small class="text-muted d-block">You will receive an email to confirm your decision.<br>All data will be permanently erased.</small>
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
