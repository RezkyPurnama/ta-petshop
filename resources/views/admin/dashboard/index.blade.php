@extends('admin.layouts.main')
@section('content')



<style>
    .icon-wrapper {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .icon-primary {
        background-color: rgba(13, 110, 253, 0.15); /* biru lembut */
        color: #0d6efd;
    }
    .icon-success {
        background-color: rgba(25, 135, 84, 0.15); /* hijau lembut */
        color: #198754;
    }
    .icon-info {
        background-color: rgba(13, 202, 240, 0.15); /* biru muda lembut */
        color: #0dcaf0;
    }
    .icon-warning {
        background-color: rgba(255, 193, 7, 0.2); /* kuning lembut */
        color: #ffc107;
    }
</style>


<div class="container-fluid mt-3">

  {{-- Notifikasi sukses/error/warning --}}
  @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif

  @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif

  @if(session('warning'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('warning') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif



<!-- Stats Cards -->
<div class="container-fluid py-5"> <!-- pastikan sama dengan search bar -->
    <div class="row mb-5">
        <!-- Total Appointments -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Appointments</h6>
                        <h3 class="fw-bold mb-0">248</h3>
                        <small class="text-success">↑ 12% from last month</small>
                    </div>
                    <div class="icon-wrapper icon-primary">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pet Hotel Bookings -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pet Hotel Bookings</h6>
                        <h3 class="fw-bold mb-0">{{ $petHotelBookings }}</h3>
                        <small class="text-success">↑ 8% from last month</small>
                    </div>
                    <div class="icon-wrapper icon-success">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grooming Sessions -->
        <div class="col-md-3 mb-4">
              <a href="{{ url('/data-grooming') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Grooming Bookings</h6>
                        <h3 class="fw-bold mb-0">{{ $groomingBookings }}</h3>
                        <small class="text-success">↑ 15% from last month</small>

                    </div>
                    <div class="icon-wrapper icon-info">
                        <i class="bi bi-scissors fs-4"></i>
                    </div>

                </div>

            </div>

        </div>

        <!-- Clinic Visits -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pet Klinik Bookings</h6>
                        <h3 class="fw-bold mb-0">{{ $petklinikBookings }}</h3>
                        <small class="text-danger">↓ 3% from last month</small>
                    </div>
                    <div class="icon-wrapper icon-warning">
                        <i class="bi bi-hospital fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
