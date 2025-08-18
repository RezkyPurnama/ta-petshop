@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Daftar Kunjungan Grooming</h4>
      <a href="{{ route('data-grooming.laporan.pdf') }}" class="btn btn-primary">
        <i class="bx bx-printer"></i> Cetak Laporan PDF
      </a>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="text-center align-middle">
            <tr>
              <th>No</th>
              <th>Nama Pemilik</th>
              <th>Telepon</th>
              <th>Nama Hewan</th>
              <th>Jenis Hewan</th>
              <th>Umur Hewan</th>
              <th>Berat (kg)</th>
              <th>Layanan</th>
              <th>Tanggal Booking</th>
              <th>Jam Booking</th>
              <th>Riwayat Sakit</th>
              <th width="10%">Status</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($groomings as $grooming)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $grooming->nama_pemilik }}</td>
              <td>{{ $grooming->nomor_telepon }}</td>
              <td>{{ $grooming->nama_hewan }}</td>
              <td>{{ $grooming->jenis_hewan }}</td>
              <td>{{ $grooming->umur_hewan ?? '-' }}</td>
              <td>{{ $grooming->berat_hewan ?? '-' }}</td>
              <td>{{ $grooming->layanan_grooming }}</td>
              <td>{{ \Carbon\Carbon::parse($grooming->tanggal_booking)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($grooming->jam_booking)->format('H:i') }}</td>
              <td>{{ Str::limit($grooming->riwayat_sakit, 20, '...') ?? '-' }}</td>
              <td>
                @php
                    $statusClass = [
                        'booking' => 'badge bg-primary',
                        'progres' => 'badge bg-warning text-dark',
                        'selesai' => 'badge bg-success',
                        'cancel'  => 'badge bg-danger'
                    ];
                @endphp

                @if(in_array($grooming->status, ['selesai', 'cancel']))
                    <span class="{{ $statusClass[$grooming->status] ?? 'badge bg-secondary' }}">
                        {{ ucfirst($grooming->status) }}
                    </span>
                @else
                    <form action="{{ route('data-grooming.update', $grooming->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            @if($grooming->status == 'booking')
                                <option value="booking" selected>Booking</option>
                                <option value="progres">Progres</option>
                                <option value="cancel">Cancel</option>
                            @elseif($grooming->status == 'progres')
                                <option value="progres" selected>Progres</option>
                                <option value="selesai">Selesai</option>
                            @endif
                        </select>
                    </form>
                @endif
              </td>
              <td class="text-center">
                <div class="dropdown position-static">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="{{ route('data-grooming.show', $grooming->id) }}">
                        <i class="bx bx-show-alt me-1"></i> Detail
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('data-grooming.edit', $grooming->id) }}">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                      </a>
                    </li>
                    <li>
                      <form action="{{ route('data-grooming.destroy', $grooming->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                          <i class="bx bx-trash me-1"></i> Hapus
                        </button>
                      </form>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="13" class="text-center">Tidak ada data kunjungan grooming.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {{ $groomings->onEachSide(1)->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection
