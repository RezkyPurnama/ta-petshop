@extends('auth.layouts.main')
@section('content')


<style>

</style>


<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Login Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
            <div class="app-brand justify-content-center mb-2">
                <a class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                    <img src="{{ asset('admin/assets/img/avatars/logopetcare2.png') }}"
                        alt="Logo"
                        style="height: 80px;">
                    </span>
                </a>
                </div>

                <h4 class="text-center mb-2">Welcome to Q PetCare</h4>



          {{-- Alert error --}}
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          {{-- Form login --}}
          <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="text"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                placeholder="Enter your email "
                value="{{ old('email') }}"
                autofocus
                autocomplete="email"
              />
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>

              </div>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  name="password"
                  placeholder="************"
                  autocomplete="current-password"
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

          

            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

          <p class="text-center">
            <span>{{"Don't have an account?"}}</span>
            <a href="{{ route('register') }}">
              <span>Sign Up Here</span>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
