@extends('admin.layouts.main')
@section('content')
<div class="container">
<div class="card mt-4">
  <h3 class="card-header d-flex justify-content-between align-items-center">
    <span>Kategori</span>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3"
   style="font-size: 1 rem; padding: 4px 8px;">+ Tambah Kategori</a>
  </h3>

  <div class="card-body">
    <table class="table table-bordered">
      <thead class="text-center">
        <tr>
          <th>Nama Kategori</th>
          <th width="10%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($kategori as $datakategoris)
        <tr>
          <td>{{ $datakategoris->nama_kategori }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('kategori.edit', $datakategoris->id) }}">
                  <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
                <form action="{{ route('kategori.destroy', $datakategoris->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="dropdown-item" onclick="return confirm('Hapus kategori ini?')">
                    <i class="bx bx-trash me-1"></i> Hapus
                  </button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="2" class="text-center">Tidak ada data kategori.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
</div>

@endsection
