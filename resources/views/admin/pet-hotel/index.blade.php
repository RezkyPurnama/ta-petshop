@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header d-flex justify-content-between align-items-center">
      <span>Daftar Data Pet Hotel</span>
    </h3>

    <div class="card-body">
      <table class="table table-bordered table-striped">
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
            <th width="10%">Aksi</th>
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
            <td>{{ $item->sertifikat_hewan }}</td>
            <td>{{ $item->check_in }}</td>
            <td>{{ $item->check_out }}</td>
            <td class="text-center">
              <a href="{{ route('data-pethotel.edit', $item->id) }}" class="btn btn-sm btn-warning">
                <i class="bx bx-edit"></i> Edit
              </a>
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
