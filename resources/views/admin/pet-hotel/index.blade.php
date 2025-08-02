@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header d-flex justify-content-between align-items-center">
      <span>Daftar Stok Produk</span>
      <a href="{{ route('stock-produk.create') }}" class="btn btn-primary mb-3">+ Tambah Stok</a>
    </h3>

    <div class="card-body">
      <table class="table table-bordered">
        <thead class="text-center">
          <tr>
            <th>Nama Produk</th>
            <th>Stok</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($stock_produk as $stock)
          <tr>
            <td>{{ $stock->produk->nama_produk ?? '-' }}</td>
            <td>{{ $stock->stock }}</td>
            <td class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('stock-produk.edit', $stock->id) }}">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                  </a>
                  <form action="{{ route('stock-produk.destroy', $stock->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item" onclick="return confirm('Hapus stok produk ini?')">
                      <i class="bx bx-trash me-1"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center">Tidak ada data stok produk.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {{ $stock_produk->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
