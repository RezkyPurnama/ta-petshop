@extends('auth.layouts.main')
@section('content')

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
           <div class="app-brand justify-content-center">
            <a class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <img src="{{ asset('admin/assets/img/avatars/logo 2.png') }}" alt="Logo" style="height: 40px;">
                </span>

            </a>
         </div>
          <!-- /Logo -->

          <h4 class="mb-4 text-center">Ayo Melakukan Register Disini</h4>

          {{-- 🔴 Notifikasi Error Global --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Username</label>
              <input type="text"
                     class="form-control @error('name') is-invalid @enderror"
                     id="name"
                     name="name"
                     placeholder="Enter your username"
                     value="{{ old('name') }}"
                     autocomplete="username"
                     autofocus />
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text"
                     class="form-control @error('email') is-invalid @enderror"
                     id="email"
                     name="email"
                     placeholder="Enter your email"
                     value="{{ old('email') }}" />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text"
                     class="form-control @error('alamat') is-invalid @enderror"
                     id="alamat"
                     name="alamat"
                     placeholder="Enter your alamat"
                     value="{{ old('alamat') }}" />
              @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="no_telepon" class="form-label">Nomor Telepon</label>
              <input type="text"
                     class="form-control @error('no_telepon') is-invalid @enderror"
                     id="no_telepon"
                     name="no_telepon"
                     placeholder="Masukkan No Telpon"
                     value="{{ old('no_telepon') }}" />
              @error('no_telepon')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password"
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="••••••••••••"
                       autocomplete="new-password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password"
                       id="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       name="password_confirmation"
                       placeholder="••••••••••••"
                       autocomplete="new-password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                <label class="form-check-label" for="terms-conditions">
                  I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
              </div>
              @error('terms')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            <button class="btn btn-primary d-grid w-100">Sign up</button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>

@endsection
