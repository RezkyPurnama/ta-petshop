@extends('admin.layouts.main')

@section('content')
<div class="card mt-4 col-md-6 mx-auto">
  <h5 class="card-header">Tambah Kategori</h5>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
