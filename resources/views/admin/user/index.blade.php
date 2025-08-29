@extends('admin.layouts.main')
@section('content')

<div class="container">
<div class="card mt-4">
  <h5 class="card-header">Daftar Pengguna</h5>
  <div class="card-body">
    <table class="table table-bordered">
      <thead class="text-center">
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>No. Telepon</th>

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
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                {{-- Tombol Edit --}}
                <a class="dropdown-item" href="{{ route('setting-user.edit', $dataUser->id) }}">
                  <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
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
