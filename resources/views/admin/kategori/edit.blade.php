@extends('admin.layouts.main')

@section('content')
<div class="card mt-4">
  <h5 class="card-header">Edit Kategori</h5>
  <div class="card-body">
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
               value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
