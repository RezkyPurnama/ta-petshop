@extends('admin.layouts.main')
@section('content')

<div class="container">
<div class="card mt-4">
  <h5 class="card-header">Daftar Pengguna</h5>
  <div class="card-body">
    {{-- Hapus class "table-responsive text-nowrap" agar tidak ada scroll --}}
    <table class="table table-bordered">
      <thead class="text-center">
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>No. Telepon</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($users as $dataUser)
        <tr>
          <td>{{ $dataUser->name }}</td>
          <td>{{ $dataUser->email }}</td>
          <td>{{ $dataUser->alamat }}</td>
          <td>{{ $dataUser->no_telepon }}</td>
          <td>
            @if ($dataUser->is_active)
              <span class="badge bg-label-success">Aktif</span>
            @else
              <span class="badge bg-label-secondary">Nonaktif</span>
            @endif
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                {{--  Tombol Edit  --}}
                {{--  <a class="dropdown-item" href="{{ route('user.edit', $dataUser->id) }}">  --}}
                  <i class="bx bx-edit-alt me-1"></i> Edit
                </a>

                {{-- Tombol Hapus --}}
                {{--  <form action="{{ route('user.destroy', $dataUser->id) }}" method="POST">  --}}
                  @csrf
                  @method('DELETE')
                  <button class="dropdown-item" onclick="return confirm('Hapus user ini?')">
                    <i class="bx bx-trash me-1"></i> Hapus
                  </button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach

        @if($users->isEmpty())
        <tr>
          <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection
