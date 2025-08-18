@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Daftar Kunjungan Pet Klinik</h4>
      <a href="{{ route('data-klinik.laporan.pdf') }}" class="btn btn-primary">
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
            <th>Tanggal Kunjungan</th>
            <th>Keluhan</th>
            <th width="20%">Status</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($petkliniks as $klinik)
          <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $klinik->user->name }}</td>
            <td>{{ $klinik->user->no_telepon }}</td>
            <td>{{ $klinik->nama_hewan }}</td>
            <td>{{ $klinik->jenis_hewan }}</td>
            <td>{{ $klinik->umur_hewan ?? '-' }}</td>
            <td>{{ $klinik->berat }}</td>
            <td>{{ \Carbon\Carbon::parse($klinik->tanggal_kunjungan)->format('d/m/Y') }}</td>
            <td>{{ Str::limit($klinik->keluhan, 20, '...') }}</td>
            <td>
              @if(in_array($klinik->status, ['selesai', 'cancel']))
                  @php
                      $statusClass = [
                          'booking' => 'badge bg-primary',
                          'progres'  => 'badge bg-warning text-dark',
                          'selesai'  => 'badge bg-success',
                          'cancel'   => 'badge bg-danger'
                      ];
                  @endphp
                  <span class="{{ $statusClass[$klinik->status] ?? 'badge bg-secondary' }}">
                      {{ ucfirst($klinik->status) }}
                  </span>
              @else
                  <form action="{{ route('data-klinik.update', $klinik->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                          @if($klinik->status == 'booking')
                              <option value="booking" selected>Booking</option>
                              <option value="progres">Progres</option>
                              <option value="cancel">Cancel</option>
                          @elseif($klinik->status == 'progres')
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
                    <a class="dropdown-item" href="{{ route('data-klinik.show', $klinik->id) }}">
                      <i class="bx bx-show-alt me-1"></i> Detail
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('data-klinik.edit', $klinik->id) }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                  </li>
                  <li>
                    <form action="{{ route('data-klinik.destroy', $klinik->id) }}" method="POST" onsubmit="return confirm('Hapus data kunjungan ini?')">
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
            <td colspan="10" class="text-center">Tidak ada data kunjungan klinik.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {{ $petkliniks->onEachSide(1)->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>
</div>
@endsection
