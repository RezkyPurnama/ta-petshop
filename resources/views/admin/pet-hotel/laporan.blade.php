<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kunjungan Pet Hotel</title>
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
        .booking { background-color: #0d6efd; }
        .checkin { background-color: #ffc107; color: #000; }
        .selesai { background-color: #198754; }
        .cancel { background-color: #dc3545; }

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

<h2>Laporan Kunjungan Pet Hotel</h2>
<p class="print-date">
    Tanggal Cetak: {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d/m/Y') }}
</p>


<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pemilik</th>
            <th>Nomor Telepon</th>
            <th>Nama Hewan</th>
            <th>Jenis Hewan</th>
            <th>Umur Hewan</th>
            <th>Berat (kg)</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pethotels as $hotel)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">{{ $hotel->user->name }}</td>
            <td>{{ $hotel->nomor_telepon ?? '-' }}</td>
            <td class="text-start">{{ $hotel->nama_hewan }}</td>
            <td>{{ $hotel->jenis_hewan }}</td>
            <td>{{ $hotel->umur_hewan ?? '-' }}</td>
            <td>{{ $hotel->berat_hewan ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($hotel->check_in)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($hotel->check_out)->format('d/m/Y') }}</td>
            <td class="text-start">{{ $hotel->riwayat_sakit ?? $hotel->keterangan }}</td>
            <td>
                @php
                    $statusClass = [
                        'booking' => 'badge booking',
                        'checkin' => 'badge checkin',
                        'selesai' => 'badge selesai',
                        'cancel'  => 'badge cancel'
                    ];
                @endphp
                <span class="{{ $statusClass[$hotel->status] ?? 'badge bg-secondary' }}">
                    {{ ucfirst($hotel->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11">Tidak ada data kunjungan.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Dicetak pada: {{ now()->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }} | Laporan Kunjungan Pet Hotel
</div>

</body>
</html>
