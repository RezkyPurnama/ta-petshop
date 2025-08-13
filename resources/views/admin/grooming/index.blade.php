@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header d-flex justify-content-between align-items-center">
      <span>Daftar Booking Grooming</span>
    </h3>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <table class="table table-bordered table-sm">
        <thead class="text-center align-middle">
          <tr>
            <th>Nama Pemilik</th>
            <th>Nomor Telepon</th>
            <th>Nama Hewan</th>
            <th>Jenis Hewan</th>
            <th>Umur Hewan</th>
            <th>Berat Hewan (kg)</th>
            <th>Jumlah Hewan</th>
            <th>Riwayat Kejang</th>
            <th>Layanan Grooming</th>
            <th>Tanggal Booking</th>
            <th>Jam Booking</th>
            <th>Jenis Layanan</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($groomings as $grooming)
          <tr>
            <td>{{ $grooming->nama_pemilik }}</td>
            <td>{{ $grooming->nomor_telepon }}</td>
            <td>{{ $grooming->nama_hewan }}</td>
            <td>{{ $grooming->jenis_hewan }}</td>
            <td class="text-center">{{ $grooming->umur_hewan }}</td>
            <td class="text-center">{{ number_format($grooming->berat_hewan, 2) }}</td>
            <td class="text-center">{{ $grooming->jumlah_hewan }}</td>
            <td class="text-center">{{ $grooming->riwayat_kejang }}</td>
            <td>{{ $grooming->layanan_grooming }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($grooming->tanggal_booking)->format('d/m/Y') }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($grooming->jam_booking)->format('H:i') }}</td>
            <td class="text-center">{{ $grooming->jenis_layanan }}</td>
            <td class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="{{ route('data-grooming.edit', $grooming->id) }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                  </li>
                  <li>
                    <form action="{{ route('data-grooming.destroy', $grooming->id) }}" method="POST" onsubmit="return confirm('Hapus data grooming ini?')">
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
            <td colspan="13" class="text-center">Tidak ada data booking grooming.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {{ $groomings->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
