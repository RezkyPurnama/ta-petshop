@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h4>Detail Kunjungan Pet Hotel</h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama Pemilik</th>
                        <td>{{ $pethotel->nama_pemilik }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>{{ $pethotel->nomor_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Nama Hewan</th>
                        <td>{{ $pethotel->nama_hewan }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Hewan</th>
                        <td>{{ $pethotel->jenis_hewan }}</td>
                    </tr>
                    <tr>
                        <th>Umur Hewan</th>
                        <td>{{ $pethotel->umur_hewan ?? '-' }} tahun</td>
                    </tr>
                    <tr>
                        <th>Berat Hewan</th>
                        <td>{{ $pethotel->berat_hewan ?? '-' }} kg</td>
                    </tr>
                     <tr>
                        <th>Tipe Ruangan</th>
                        <td>{{ $pethotel->tipe_room ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Check In</th>
                        <td>{{ \Carbon\Carbon::parse($pethotel->check_in)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Check Out</th>
                        <td>{{ \Carbon\Carbon::parse($pethotel->check_out)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Riwayat Sakit / Keterangan</th>
                        <td>{{ $pethotel->riwayat_sakit ?? ($pethotel->keterangan ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @php
                                $statusClass = [
                                    'booking' => 'badge bg-primary',
                                    'checkin' => 'badge bg-warning text-dark',
                                    'selesai' => 'badge bg-success',
                                    'cancel' => 'badge bg-danger',
                                ];
                            @endphp
                            <span class="{{ $statusClass[$pethotel->status] ?? 'badge bg-secondary' }}">
                                {{ ucfirst($pethotel->status) }}
                            </span>
                        </td>
                    </tr>
                </table>

                <a href="{{ route('data-pethotel.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
