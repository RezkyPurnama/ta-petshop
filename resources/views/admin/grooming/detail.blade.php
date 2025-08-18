@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h4>Detail Booking Grooming</h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Nama Pemilik</th>
                    <td>{{ $grooming->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Hewan</th>
                    <td>{{ $grooming->nama_hewan }}</td>
                </tr>
                <tr>
                    <th>Jenis Hewan</th>
                    <td>{{ $grooming->jenis_hewan }}</td>
                </tr>
                <tr>
                    <th>Umur Hewan</th>
                    <td>{{ $grooming->umur_hewan }} tahun</td>
                </tr>
                <tr>
                    <th>Berat Hewan</th>
                    <td>{{ $grooming->berat_hewan }} kg</td>
                </tr>
                <tr>
                    <th>Riwayat Sakit</th>
                    <td>{{ $grooming->riwayat_sakit ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Layanan Grooming</th>
                    <td>{{ $grooming->layanan_grooming }}</td>
                </tr>
                <tr>
                    <th>Tanggal Booking</th>
                    <td>{{ \Carbon\Carbon::parse($grooming->tanggal_booking)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Jam Booking</th>
                    <td>{{ $grooming->jam_booking }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @php
                            $statusClass = [
                                'booking' => 'badge bg-primary',
                                'progres'  => 'badge bg-warning text-dark',
                                'selesai'  => 'badge bg-success',
                                'cancel'   => 'badge bg-danger'
                            ];
                        @endphp
                        <span class="{{ $statusClass[$grooming->status] ?? 'badge bg-secondary' }}">
                            {{ ucfirst($grooming->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            <a href="{{ route('data-grooming.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
