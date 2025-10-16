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
.icon-primary { background-color: rgba(13, 110, 253, 0.15); color: #0d6efd; }
.icon-success { background-color: rgba(25, 135, 84, 0.15); color: #198754; }
.icon-info { background-color: rgba(13, 202, 240, 0.15); color: #0dcaf0; }
.icon-warning { background-color: rgba(255, 193, 7, 0.2); color: #ffc107; }
.card-stats { margin-bottom: 20px; }
</style>

<div class="container-fluid mt-3">
    <div class="row">


        <!-- Pesanan Masuk -->
<div class="col-md-3">
    <div class="card card-stats shadow-sm border-0 rounded-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-muted mb-1">Pesanan Sedang Proses</h6>
                <h3 class="fw-bold mb-0">{{ $pesananInProgress }}</h3>
            </div>
            <div class="icon-wrapper icon-warning">
                <i class="bi bi-bag-check fs-4"></i>
            </div>
        </div>
    </div>
</div>



        <!-- Pet Hotel -->
        <div class="col-md-3">
            <div class="card card-stats shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pet Hotel Bookings</h6>
                        <h3 class="fw-bold mb-0">{{ $petHotelBookings }}</h3>
                    </div>
                    <div class="icon-wrapper icon-primary">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grooming -->
        <div class="col-md-3">
            <div class="card card-stats shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Grooming Bookings</h6>
                        <h3 class="fw-bold mb-0">{{ $groomingBookings }}</h3>
                    </div>
                    <div class="icon-wrapper icon-info">
                        <i class="bi bi-scissors fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Klinik -->
        <div class="col-md-3">
            <div class="card card-stats shadow-sm border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pet Klinik Bookings</h6>
                        <h3 class="fw-bold mb-0">{{ $petklinikBookings }}</h3>
                    </div>
                    <div class="icon-wrapper icon-warning">
                        <i class="bi bi-hospital fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



<canvas id="salesMonthlyChart" height="100"></canvas>

<!-- Grafik Penjualan Tahunan -->
<canvas id="salesYearlyChart" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthlyCtx = document.getElementById('salesMonthlyChart').getContext('2d');
    const salesMonthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Penjualan Bulanan (Paid)',
                data: @json($totals),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const yearlyCtx = document.getElementById('salesYearlyChart').getContext('2d');
    const salesYearlyChart = new Chart(yearlyCtx, {
        type: 'line',
        data: {
            labels: @json($years),
            datasets: [{
                label: 'Penjualan Tahunan (Paid)',
                data: @json($totalsYearly),
                backgroundColor: 'rgba(255, 99, 132, 0.4)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>



@endsection
