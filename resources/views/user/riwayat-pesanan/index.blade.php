@extends('user.layouts.main')

@section('content')

    <style>
        .card-custom {
            background-color: #fff9f0 !important;
        }

        .card-custom .card-header {
            background-color: #fff9f0 !important;
        }

        .card-custom .table thead {
            background-color: #fff9f0 !important;
        }
    </style>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header py-5 mb-3"></div>
    <div class="container py-5">
        <h3 class="mb-4 fw-bold">📑 Riwayat Pesanan</h3>

        <!-- Filter Section -->
        <form method="GET" action="{{ route('riwayat.index') }}" class="d-flex flex-wrap mb-4 gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control w-auto"
                placeholder="🔍 Cari pesanan...">

            <select name="kategori" class="form-select w-auto">
                <option value="pesanan" {{ request('kategori') == 'pesanan' ? 'selected' : '' }}>🛒 Pesanan Produk</option>
                <option value="petklinik" {{ request('kategori') == 'petklinik' ? 'selected' : '' }}>🏥 Pet Klinik</option>
                <option value="pethotel" {{ request('kategori') == 'pethotel' ? 'selected' : '' }}>🏨 Pet Hotel</option>
                <option value="grooming" {{ request('kategori') == 'grooming' ? 'selected' : '' }}>✂ Grooming</option>
            </select>

            <button class="btn btn-warning px-4 fw-semibold">Filter</button>
        </form>

        <!-- Content Section -->
        <div class="row gy-4">

            {{-- ================= PESANAN PRODUK ================= --}}
            @if (!request('kategori') || request('kategori') == 'pesanan')
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 card-custom">
                        <div class="card-header bg-light fw-bold">🛒 Pesanan Produk</div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No. Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pesanans as $pesanan)
                                            <tr>
                                                <td>#{{ $pesanan->trx_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pesanan->tgl_pesanan)->format('d M Y') }}</td>
                                                <td>{{ $pesanan->nama_penerima }}</td>
                                                <td>{{ $pesanan->jumlah }}</td>
                                                <td><strong>Rp
                                                        {{ number_format($pesanan->totalharga, 0, ',', '.') }}</strong>
                                                </td>
                                                <td>
                                                    @if ($pesanan->status == 'tunggu_pembayaran')
                                                        <span class="badge bg-warning text-dark">💳 Menunggu
                                                            Pembayaran</span>
                                                    @elseif($pesanan->status == 'sedang_diproses')
                                                        <span class="badge bg-info text-dark">⏳ Diproses</span>
                                                    @elseif($pesanan->status == 'dalam_perjalanan')
                                                        <span class="badge bg-primary">🚚 Dikirim</span>
                                                    @elseif($pesanan->status == 'selesai')
                                                        <span class="badge bg-success">✔ Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger">❌ Dibatalkan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('riwayat.detail', $pesanan->id) }}"
                                                        class="btn btn-sm btn-outline-secondary">Detail</a>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-3">Belum ada pesanan
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ================= GROOMING ================= --}}
            @if (request('kategori') == 'grooming' || request('kategori') == 'grooming')
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 card-custom">
                        <div class="card-header bg-light fw-bold">✂ Grooming</div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <th>Hewan</th>
                                            <th>Layanan</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($groomings as $grooming)
                                            <tr>
                                                <td>{{ $grooming->nama_pemilik }}</td>
                                                <td>{{ $grooming->nama_hewan }} ({{ $grooming->jenis_hewan }})</td>
                                                <td>{{ $grooming->layanan_grooming }}</td>
                                                <td>{{ \Carbon\Carbon::parse($grooming->tanggal_booking)->format('d M Y') }}
                                                </td>
                                                <td>{{ $grooming->jam_booking }}</td>
                                                <td>
                                                    @if ($grooming->status == 'booking')
                                                        <span class="badge bg-warning text-dark">📅 Booking</span>
                                                    @elseif($grooming->status == 'progres')
                                                        <span class="badge bg-info text-dark">✂ Proses</span>
                                                    @elseif($grooming->status == 'selesai')
                                                        <span class="badge bg-success">✔ Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger">❌ Cancel</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-3">Belum ada booking
                                                    grooming</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ================= PET HOTEL ================= --}}
            @if (request('kategori') == 'pethotel' || request('kategori') == 'pethotel')
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 card-custom">
                        <div class="card-header bg-light fw-bold">🏨 Pet Hotel</div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <th>Hewan</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pethotels as $hotel)
                                            <tr>
                                                <td>{{ $hotel->nama_pemilik }}</td>
                                                <td>{{ $hotel->nama_hewan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($hotel->check_in)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($hotel->check_out)->format('d M Y') }}</td>
                                                <td>
                                                    @if ($hotel->status == 'booking')
                                                        <span class="badge bg-warning text-dark">📅 Booking</span>
                                                    @elseif($hotel->status == 'checkin')
                                                        <span class="badge bg-info text-dark">🏨 Check In</span>
                                                    @elseif($hotel->status == 'checkout')
                                                        <span class="badge bg-success">✔ Check Out</span>
                                                    @else
                                                        <span class="badge bg-danger">❌ Cancel</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-3">Belum ada booking pet
                                                    hotel</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ================= PET KLINIK ================= --}}
            @if (request('kategori') == 'petklinik' || request('kategori') == 'petklinik')
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 card-custom">
                        <div class="card-header bg-light fw-bold">🏥 Pet Klinik</div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <th>Hewan</th>
                                            <th>Keluhan</th>
                                            <th>Tanggal Kunjungan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($petkliniks as $klinik)
                                            <tr>
                                                <td>{{ $klinik->nama_pemilik }}</td>
                                                <td>{{ $klinik->nama_hewan }}</td>
                                                <td>{{ $klinik->keluhan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($klinik->tanggal_kunjungan)->format('d M Y') }}
                                                </td>
                                                <td>
                                                    @if ($klinik->status == 'booking')
                                                        <span class="badge bg-warning text-dark">📅 Booking</span>
                                                    @elseif($klinik->status == 'proses')
                                                        <span class="badge bg-info text-dark">🏥 Proses</span>
                                                    @elseif($klinik->status == 'selesai')
                                                        <span class="badge bg-success">✔ Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger">❌ Cancel</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-3">Belum ada kunjungan
                                                    klinik</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
