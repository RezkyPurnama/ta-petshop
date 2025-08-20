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
          <input type="text" class="form-control @error('kode_produk') is-invalid @enderror"
                 id="kode_produk" name="kode_produk"
                 value="{{ old('kode_produk', $produk->kode_produk) }}" required>
          @error('kode_produk')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="nama_produk" class="form-label">Nama Produk</label>
          <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                 id="nama_produk" name="nama_produk"
                 value="{{ old('nama_produk', $produk->nama_produk) }}" required>
          @error('nama_produk')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="kategori_id" class="form-label">Kategori</label>
          <select name="kategori_id" id="kategori_id"
                  class="form-select @error('kategori_id') is-invalid @enderror">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
              <option value="{{ $kategori->id }}"
                {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
              </option>
            @endforeach
          </select>
          @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" class="form-control @error('harga') is-invalid @enderror"
                 id="harga" name="harga" step="0.01"
                 value="{{ old('harga', $produk->harga) }}" required>
          @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                    id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
          @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="gambar_produk" class="form-label">Gambar Produk</label><br>
          @if($produk->gambar_produk)
            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" width="100" class="mb-2">
          @endif
          <input type="file" class="form-control @error('gambar_produk') is-invalid @enderror"
                 id="gambar_produk" name="gambar_produk" accept="image/*">
          @error('gambar_produk')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
