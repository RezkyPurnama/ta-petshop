@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="card mt-4">
    <h3 class="card-header">Edit Stok Produk</h3>
    <div class="card-body">
      <form action="{{ route('stock-produk.update', $stockProduk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="produk_id" class="form-label">Nama Produk</label>
          <select name="produk_id" id="produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
            <option value="">-- Pilih Produk --</option>
            @foreach ($produks as $produk)
              <option value="{{ $produk->id }}" {{ $stockProduk->produk_id == $produk->id ? 'selected' : '' }}>
                {{ $produk->nama_produk }}
              </option>
            @endforeach
          </select>
          @error('produk_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="stock" class="form-label">Jumlah Stok</label>
          <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ $stockProduk->stock }}" required>
          @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <a href="{{ route('stock-produk.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </form>
    </div>
  </div>
</div>
@endsection
