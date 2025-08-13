@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header d-flex justify-content-between align-items-center">
      <span>Daftar Data Pet Hotel</span>
    </h3>

    <div class="card-body">
      <table class="table table-bordered align-middle">
        <thead class="text-center">
          <tr>
            <th>Nama Pemilik</th>
            <th>Nomor Telepon</th>
            <th>Nama Hewan</th>
            <th>Jenis Hewan</th>
            <th>Jumlah</th>
            <th>Ras</th>
            <th>Vaksin</th>
            <th>Sertifikat</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th width="20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pethotels as $item)
          <tr>
            <td>{{ $item->nama_pemilik }}</td>
            <td>{{ $item->nomor_telepon }}</td>
            <td>{{ $item->nama_hewan }}</td>
            <td>{{ $item->jenis_hewan }}</td>
            <td class="text-center">{{ $item->jumlah_hewan }}</td>
            <td>{{ $item->ras_hewan }}</td>
            <td>{{ $item->status_vaksin }}</td>
            <td class="text-center">
                @if($item->sertifikat_hewan === 'Ada')
                    <span class="badge bg-success">Ada</span>
                @elseif($item->sertifikat_hewan === 'Tidak')
                    <span class="badge bg-danger">Tidak</span>
                @else
                    <span class="badge bg-secondary">Belum Diisi</span>
                @endif
            </td>

            <td>{{ \Carbon\Carbon::parse($item->check_in)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->check_out)->format('d-m-Y') }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('data-pethotel.edit', $item->id) }}">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </a>
                  <form action="{{ route('data-pethotel.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item" onclick="return confirm('Hapus data ini?')">
                      <i class="bx bx-trash me-1"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="12" class="text-center">Tidak ada data Pet Hotel.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {{ $pethotels->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
