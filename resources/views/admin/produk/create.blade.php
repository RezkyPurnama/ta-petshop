@extends('admin.layouts.main')
@section('content')
<div class="container">
  <div class="card mt-4">
    <h4 class="card-header">Tambah Produk</h4>
    <div class="card-body">
      <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="kode_produk" class="form-label">Kode Produk</label>
          <input type="text" class="form-control" id="kode_produk" name="kode_produk" required>
        </div>

        <div class="mb-3">
          <label for="nama_produk" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>

        <div class="mb-3">
          <label for="kategori_id" class="form-label">Kategori</label>
          <select name="kategori_id" id="kategori_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
              <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga" step="0.01" required>
        </div>

        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label for="gambar_produk" class="form-label">Gambar Produk</label>
          <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
