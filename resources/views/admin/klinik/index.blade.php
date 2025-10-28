@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Daftar Kunjungan Pet Klinik</h4>
      <a href="{{ route('data-klinik.laporan.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-primary">
        <i class="bx bx-printer"></i> Cetak Laporan PDF
      </a>
    </div>

    <div class="card-body">

      {{-- Filter Bulan & Tahun --}}
      <form action="{{ route('data-klinik.index') }}" method="GET" class="row g-2 mb-3" id="filterForm">
        <div class="col-auto">
          <select name="bulan" class="form-select" required onchange="document.getElementById('filterForm').submit()">
            <option value="">-- Pilih Bulan --</option>
            @for ($m = 1; $m <= 12; $m++)
              <option value="{{ $m }}" {{ ($bulan ?? date('m')) == $m ? 'selected' : '' }}>
                {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
              </option>
            @endfor
          </select>
        </div>
        <div class="col-auto">
          <select name="tahun" class="form-select" required onchange="document.getElementById('filterForm').submit()">
            <option value="">-- Pilih Tahun --</option>
            @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
              <option value="{{ $y }}" {{ ($tahun ?? date('Y')) == $y ? 'selected' : '' }}>
                {{ $y }}
              </option>
            @endfor
          </select>
        </div>
      </form>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="text-center align-middle">
            <tr>
              <th>No</th>
              <th>Nama Pemilik</th>
              <th>Telepon</th>
              <th>Nama Hewan</th>
              <th>Jenis Hewan</th>
              <th>Vaksinasi</th>
              <th>Umur Hewan</th>
              <th>Berat (kg)</th>
              <th>Tanggal Kunjungan</th>
              <th>Waktu Kunjungan</th>
              <th>Keluhan</th>
              <th width="10%">Status</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($petkliniks as $klinik)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $klinik->user->name }}</td>
              <td>{{ $klinik->user->no_telepon }}</td>
              <td>{{ $klinik->nama_hewan }}</td>
              <td>{{ $klinik->jenis_hewan }}</td>
              <td>{{ $klinik->vaksinasi }}</td>
              <td>{{ $klinik->umur_hewan ?? '-' }}</td>
              <td>{{ $klinik->berat ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($klinik->tanggal_kunjungan)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $klinik->waktu_kunjungan)->format('H.i') }}</td>
              <td>{{ Str::limit($klinik->keluhan, 20, '...') }}</td>
              <td>
                @php
                    $statusClass = [
                        'booking' => 'badge bg-primary',
                        'progres' => 'badge bg-warning text-dark',
                        'selesai' => 'badge bg-success',
                        'cancel'  => 'badge bg-danger',
                    ];
                @endphp

                @if (in_array($klinik->status, ['selesai', 'cancel']))
                  <span class="{{ $statusClass[$klinik->status] ?? 'badge bg-secondary' }}">
                      {{ ucfirst($klinik->status) }}
                  </span>
                @else
                  <form action="{{ route('data-klinik.update', $klinik->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                      @if ($klinik->status == 'booking')
                        <option value="booking" selected>Booking</option>
                        <option value="progres">Progres</option>
                        <option value="cancel">Cancel</option>
                      @elseif($klinik->status == 'progres')
                        <option value="progres" selected>Progres</option>
                        <option value="selesai">Selesai</option>
                      @endif
                    </select>
                  </form>
                @endif
              </td>
              <td class="text-center">
                <div class="dropdown position-static">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('data-klinik.show', $klinik->id) }}"><i class="bx bx-show-alt me-1"></i> Detail</a></li>
                    <li><a class="dropdown-item" href="{{ route('data-klinik.edit', $klinik->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a></li>
                    <li>
                      <form action="{{ route('data-klinik.destroy', $klinik->id) }}" method="POST" onsubmit="return confirm('Hapus data kunjungan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger"><i class="bx bx-trash me-1"></i> Hapus</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="12" class="text-center">Tidak ada data kunjungan klinik.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {{ $petkliniks->onEachSide(1)->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>
</div>
<script>
    document.querySelectorAll('select[name="bulan"], select[name="tahun"]').forEach(el => {
        el.addEventListener('change', function() {
            let bulan = document.querySelector('select[name="bulan"]').value;
            let tahun = document.querySelector('select[name="tahun"]').value;

            fetch(`{{ route('data-klinik.index') }}?bulan=${bulan}&tahun=${tahun}`)
                .then(response => response.text())
                .then(html => {
                    // Update div tabel saja
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    document.querySelector('.table-responsive').innerHTML =
                        doc.querySelector('.table-responsive').innerHTML;
                });
        });
    });
</script>

@endsection
