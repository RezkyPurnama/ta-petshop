@extends('admin.layouts.main')
@section('content')
<div class="container">
  <div class="card mt-4">
    <h4 class="card-header">Edit Produk</h4>
    <div class="card-body">
      <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="kode_produk" class="form-label">Kode Produk</label>
          <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="{{ $produk->kode_produk }}" required>
        </div>

        <div class="mb-3">
          <label for="nama_produk" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}" required>
        </div>

        <div class="mb-3">
          <label for="kategori_id" class="form-label">Kategori</label>
          <select name="kategori_id" id="kategori_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
              <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga" step="0.01" value="{{ $produk->harga }}" required>
        </div>

        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
          <label for="gambar_produk" class="form-label">Gambar Produk</label><br>
          @if($produk->gambar_produk)
            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" width="100" class="mb-2">
          @endif
          <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
