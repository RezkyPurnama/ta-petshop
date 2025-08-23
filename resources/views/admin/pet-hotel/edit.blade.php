@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <h3 class="card-header">Edit Data Pet Hotel</h3>
            <div class="card-body">
                <form action="{{ route('data-pethotel.update', $pethotel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Nama Hewan --}}
                    <div class="mb-3">
                        <label for="nama_hewan" class="form-label">Nama Hewan</label>
                        <input type="text" name="nama_hewan" id="nama_hewan"
                            class="form-control @error('nama_hewan') is-invalid @enderror"
                            value="{{ old('nama_hewan', $pethotel->nama_hewan) }}" required>
                        @error('nama_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
                        <select name="jenis_hewan" id="jenis_hewan"
                            class="form-select @error('jenis_hewan') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Hewan --</option>
                            <option value="Kucing"
                                {{ old('jenis_hewan', $pethotel->jenis_hewan) == 'Kucing' ? 'selected' : '' }}>Kucing
                            </option>
                            <option value="Anjing"
                                {{ old('jenis_hewan', $pethotel->jenis_hewan) == 'Anjing' ? 'selected' : '' }}>Anjing
                            </option>
                        </select>
                        @error('jenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Umur Hewan --}}
                    <div class="mb-3">
                        <label for="umur_hewan" class="form-label">Umur Hewan</label>
                        <input type="text" name="umur_hewan" id="umur_hewan"
                            class="form-control @error('umur_hewan') is-invalid @enderror"
                            value="{{ old('umur_hewan', $pethotel->umur_hewan) }}">
                        @error('umur_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Berat Hewan --}}
                    <div class="mb-3">
                        <label for="berat_hewan" class="form-label">Berat Hewan (kg)</label>
                        <input type="text" name="berat_hewan" id="berat_hewan"
                            class="form-control @error('berat_hewan') is-invalid @enderror"
                            value="{{ old('berat_hewan', $pethotel->berat_hewan) }}">
                        @error('berat_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="tipe_room" class="form-label">Tipe Ruangan</label>
                        <select name="tipe_room" id="tipe_room"
                            class="form-select @error('tipe_room') is-invalid @enderror" required>
                            <option value="">-- Pilih Tipe Ruangan --</option>
                            <option value="Standard"
                                {{ old('tipe_room', $pethotel->tipe_room) == 'Standard' ? 'selected' : '' }}>Standard
                            </option>
                            <option value="Gabung"
                                {{ old('tipe_room', $pethotel->tipe_room) == 'Gabung' ? 'selected' : '' }}>Gabung
                            </option>
                            <option value="VIP"
                                {{ old('tipe_room', $pethotel->tipe_room) == 'VIP' ? 'selected' : '' }}>VIP</option>
                        </select>
                        @error('tipe_room')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Check In --}}
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check-In</label>
                        <input type="date" name="check_in" id="check_in"
                            class="form-control @error('check_in') is-invalid @enderror"
                            value="{{ old('check_in', $pethotel->check_in) }}" required>
                        @error('check_in')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Check Out --}}
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check-Out</label>
                        <input type="date" name="check_out" id="check_out"
                            class="form-control @error('check_out') is-invalid @enderror"
                            value="{{ old('check_out', $pethotel->check_out) }}" required>
                        @error('check_out')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Riwayat Sakit --}}
                    <div class="mb-3">
                        <label for="riwayat_sakit" class="form-label">Riwayat Sakit</label>
                        <textarea name="riwayat_sakit" id="riwayat_sakit" class="form-control @error('riwayat_sakit') is-invalid @enderror"
                            rows="3">{{ old('riwayat_sakit', $pethotel->riwayat_sakit) }}</textarea>
                        @error('riwayat_sakit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                            rows="3">{{ old('keterangan', $pethotel->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <a href="{{ route('data-pethotel.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection
