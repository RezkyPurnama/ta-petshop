<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #0d6efd;
        }
        .print-date {
            text-align: center;
            font-size: 11px;
            color: #555;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #e9ecef;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 500;
            color: #fff;
        }
        .tunggu { background-color: #ffc107; color: #000; }
        .diproses { background-color: #0d6efd; }
        .perjalanan { background-color: #0dcaf0; color: #000; }
        .selesai { background-color: #198754; }
        .cancel { background-color: #dc3545; }
        .unpaid { background-color: #ffc107; color: #000; }
        .paid { background-color: #198754; }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #555;
        }
        @media print {
            body { background-color: #fff; }
            button { display: none; }
        }
    </style>
</head>
<body>

<h2>Laporan Pesanan Bulan {{ $bulanNama }} {{ $tahun }}</h2>
<p class="print-date">
    Tanggal Cetak: {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d/m/Y') }}
</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Telepon</th>
            <th>Nama Penerima</th>
            <th>Alamat</th>
            <th>Total Harga</th>
            <th>Ongkir</th> <!-- Kolom Ongkir -->
            <th>Tanggal Pesanan</th>
            <th>Status Pesanan</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pesanans as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">{{ $item->user->name ?? '-' }}</td>
            <td>{{ $item->telepon ?? '-' }}</td>
            <td>{{ $item->nama_penerima }}</td>
            <td class="text-start">{{ $item->alamat }}</td>
            <td>Rp {{ number_format($item->totalharga, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->ongkir, 0, ',', '.') }}</td> <!-- Tampilkan Ongkir -->
            <td>{{ \Carbon\Carbon::parse($item->tgl_pesanan)->format('d/m/Y') }}</td>
            <td>
                @php
                    $statusClass = [
                        'tunggu_pembayaran' => 'badge tunggu',
                        'sedang_diproses'   => 'badge diproses',
                        'dalam_perjalanan'  => 'badge perjalanan',
                        'selesai'           => 'badge selesai',
                        'cancel'            => 'badge cancel'
                    ];
                @endphp
                <span class="{{ $statusClass[$item->status] ?? 'badge bg-secondary' }}">
                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                </span>
            </td>
            <td>
                <span class="badge {{ $item->status_pembayaran }}">
                    {{ ucfirst($item->status_pembayaran) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10">Tidak ada data pesanan.</td> <!-- colspan disesuaikan -->
        </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Dicetak pada: {{ now()->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }} | Laporan Pesanan
</div>

</body>
</html>
