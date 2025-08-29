@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <div class="card mt-4">
            <h3 class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Produk</span>
                <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3"
                    style="font-size: 1rem; padding: 4px 8px;">+ Tambah Produk</a>
            </h3>

            <div class="card-body">

                {{-- Form Pencarian --}}
                <form action="{{ route('produk.index') }}" method="GET" id="formSearch" class="d-flex mb-3">
                    <input type="text" name="search" id="searchInput" value="{{ $search }}"
                        class="form-control me-2" placeholder="Cari nama produk...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>

                <script>
                    document.getElementById('searchInput').addEventListener('input', function() {
                        if (this.value === '') {
                            document.getElementById('formSearch').submit();
                        }
                    });
                </script>


                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notifikasi Error --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks as $produk)
                            <tr>
                                <td>{{ $loop->iteration + $produks->firstItem() - 1 }}</td>
                                <td>{{ $produk->kode_produk }}</td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td>{{ $produk->kategori?->nama_kategori ?? '-' }}</td>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if ($produk->gambar_produk)
                                        <img src="{{ asset('storage/' . $produk->gambar_produk) }}" width="60"
                                            alt="Gambar Produk">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('produk.edit', $produk->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('Hapus produk ini?')">
                                                    <i class="bx bx-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $produks->links() }}
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            this.form.submit(); // otomatis submit tiap ketik / hapus
        });
    </script>
@endsection
