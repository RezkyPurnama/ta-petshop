@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h4>Detail Kunjungan Pet Klinik</h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Nama Pemilik</th>
                    <td>{{ $petKlinik->nama_pemilik }}</td>
                </tr>
                <tr>
                    <th>Nama Hewan</th>
                    <td>{{ $petKlinik->nama_hewan }}</td>
                </tr>
                <tr>
                    <th>Jenis Hewan</th>
                    <td>{{ $petKlinik->jenis_hewan }}</td>
                </tr>
                <tr>
                    <th>Umur Hewan</th>
                    <td>{{ $petKlinik->umur_hewan }} tahun</td>
                </tr>
                <tr>
                    <th>Berat</th>
                    <td>{{ $petKlinik->berat }} kg</td>
                </tr>
                <tr>
                    <th>Tanggal Kunjungan</th>
                    <td>{{ \Carbon\Carbon::parse($petKlinik->tanggal_kunjungan)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Keluhan</th>
                    <td>{{ $petKlinik->keluhan }}</td>
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
                        <span class="{{ $statusClass[$petKlinik->status] ?? 'badge bg-secondary' }}">
                            {{ ucfirst($petKlinik->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            <a href="{{ route('data-klinik.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
