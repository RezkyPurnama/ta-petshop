@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Daftar Pesanan</h4>
            <a href="{{ route('data-pesanan.laporan.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-primary">
                <i class="bx bx-printer"></i> Cetak Laporan PDF
            </a>
        </div>

        <div class="card-body">
            {{-- Filter Bulan & Tahun --}}
            <form action="{{ route('data-pesanan.index') }}" method="GET" class="row g-2 mb-3" id="filterForm">
                <div class="col-auto">
                    <select name="bulan" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ request('bulan', date('m')) == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select name="tahun" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
            </form>

            @if (session('success'))
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
                            <th>Nama Pemesan</th>
                            <th>Telepon</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesanan</th>
                            <th>Status Pesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesanans as $pesanan)
                        <tr class="text-center">
                            <td>{{ $loop->iteration + ($pesanans->currentPage() - 1) * $pesanans->perPage() }}</td>
                            <td>{{ $pesanan->user->name }}</td>
                            <td>{{ $pesanan->telepon ?? '-' }}</td>
                            <td>{{ $pesanan->nama_penerima }}</td>
                            <td>{{ Str::limit($pesanan->alamat, 25, '...') }}</td>
                            <td>Rp {{ number_format($pesanan->totalharga, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'tunggu_pembayaran' => 'badge bg-warning text-dark',
                                        'sedang_diproses' => 'badge bg-info text-dark',
                                        'dalam_perjalanan' => 'badge bg-primary',
                                        'selesai' => 'badge bg-success',
                                        'cancel' => 'badge bg-danger',
                                    ];
                                @endphp
                                @if (in_array($pesanan->status, ['selesai', 'cancel']))
                                    <span class="{{ $statusClass[$pesanan->status] ?? 'badge bg-secondary' }}">
                                        {{ ucfirst($pesanan->status) }}
                                    </span>
                                @else
                                    <form action="{{ route('data-pesanan.update', $pesanan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            @if ($pesanan->status == 'tunggu_pembayaran')
                                                <option value="tunggu_pembayaran" selected>Menunggu Pembayaran</option>
                                                <option value="sedang_diproses">Sedang Diproses</option>
                                                <option value="cancel">Cancel</option>
                                            @elseif ($pesanan->status == 'sedang_diproses')
                                                <option value="sedang_diproses" selected>Sedang Diproses</option>
                                                <option value="dalam_perjalanan">Dalam Perjalanan</option>
                                            @elseif ($pesanan->status == 'dalam_perjalanan')
                                                <option value="dalam_perjalanan" selected>Dalam Perjalanan</option>
                                                <option value="selesai">Selesai</option>
                                            @endif
                                        </select>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <span class="badge
                                    @if($pesanan->status_pembayaran == 'unpaid') bg-warning text-dark
                                    @elseif($pesanan->status_pembayaran == 'paid') bg-success
                                    @else bg-danger @endif">
                                    {{ ucfirst($pesanan->status_pembayaran) }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn p-0 dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('data-pesanan.show', $pesanan->id) }}">
                                            <i class="bx bx-show-alt me-1"></i> Detail
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('data-pesanan.edit', $pesanan->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a></li>
                                        <li>
                                            <form action="{{ route('data-pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bx bx-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end">
                {{ $pesanans->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
