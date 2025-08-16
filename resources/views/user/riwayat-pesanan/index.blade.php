@extends('user.layouts.main')

@section('content')

    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header py-5 mb-3">
    </div>
<div class="container py-5">
    <h3 class="mb-4">Riwayat Pesanan</h3>

    <!-- Filter Section -->
    <div class="d-flex flex-wrap mb-4 gap-2">
        <input type="text" class="form-control w-auto" placeholder="Cari pesanan...">
        <input type="date" class="form-control w-auto">
        <select class="form-select w-auto">
            <option>Semua Status</option>
            <option>Selesai</option>
            <option>Dikirim</option>
            <option>Diproses</option>
            <option>Menunggu Pembayaran</option>
            <option>Dibatalkan</option>
        </select>
        <select class="form-select w-auto">
            <option>Harga Tertinggi</option>
            <option>Harga Terendah</option>
            <option>Tanggal Terbaru</option>
            <option>Tanggal Terlama</option>
        </select>
        <button class="btn btn-warning px-4">Filter</button>
    </div>

    <!-- Table Section -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="fw-bold">No. Pesanan</th>
                        <th class="fw-bold">Tanggal</th>
                        <th class="fw-bold">Produk</th>
                        <th class="fw-bold">Jumlah</th>
                        <th class="fw-bold">Total Harga</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#ORD-2023-8721</td>
                        <td>20 Jun 2023</td>
                        <td>
                            <span class="me-2">
                                <i class="bi bi-bag-fill text-secondary"></i>
                            </span>
                            Royal Canin Maxi Adult
                            <span class="badge bg-light text-dark">+2</span>
                        </td>
                        <td>3</td>
                        <td><strong>Rp 850.000</strong></td>
                        <td><span class="badge rounded-pill bg-success">✔ Selesai</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Detail</button>
                            <button class="btn btn-sm btn-outline-warning">⭐ Ulasan</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-2023-8654</td>
                        <td>15 Jun 2023</td>
                        <td>
                            <i class="bi bi-bag-fill text-secondary me-2"></i>
                            Cat Grooming Package
                        </td>
                        <td>1</td>
                        <td><strong>Rp 250.000</strong></td>
                        <td><span class="badge rounded-pill bg-primary">🚚 Dikirim</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Detail</button>
                            <button class="btn btn-sm btn-outline-info">🔎 Lacak</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-2023-8532</td>
                        <td>10 Jun 2023</td>
                        <td>
                            <i class="bi bi-bag-fill text-secondary me-2"></i>
                            Dog Toys Bundle
                            <span class="badge bg-light text-dark">+4</span>
                        </td>
                        <td>5</td>
                        <td><strong>Rp 420.000</strong></td>
                        <td><span class="badge rounded-pill bg-info text-dark">⏳ Diproses</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-2023-8490</td>
                        <td>5 Jun 2023</td>
                        <td>
                            <i class="bi bi-bag-fill text-secondary me-2"></i>
                            Pet Carrier Medium Size
                        </td>
                        <td>1</td>
                        <td><strong>Rp 375.000</strong></td>
                        <td><span class="badge rounded-pill bg-warning text-dark">💳 Menunggu Pembayaran</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-2023-8321</td>
                        <td>28 Mei 2023</td>
                        <td>
                            <i class="bi bi-bag-fill text-secondary me-2"></i>
                            Vet Consultation
                        </td>
                        <td>1</td>
                        <td><strong>Rp 200.000</strong></td>
                        <td><span class="badge rounded-pill bg-danger">❌ Dibatalkan</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambahkan Bootstrap Icons -->
@endsection
