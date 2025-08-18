<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Booking Grooming</title>
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
        .progres { background-color: #ffc107; color: #000; }
        .selesai { background-color: #198754; }
        .cancel  { background-color: #dc3545; }

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

<h2>Laporan Booking Grooming</h2>
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
            <th>Umur</th>
            <th>Berat</th>
            <th>Riwayat Sakit</th>
            <th>Layanan Grooming</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($groomings as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">{{ $item->user->name ?? '-' }}</td>
            <td>{{ $item->nomor_telepon ?? '-' }}</td>
            <td class="text-start">{{ $item->nama_hewan }}</td>
            <td>{{ $item->jenis_hewan }}</td>
            <td>{{ $item->umur_hewan }} th</td>
            <td>{{ $item->berat_hewan }} kg</td>
            <td>{{ $item->riwayat_sakit ?? '-' }}</td>
            <td>{{ $item->layanan_grooming }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d/m/Y') }}</td>
            <td>{{ $item->jam_booking }}</td>
            <td>
                @php
                    $statusClass = [
                        'booking' => 'badge booking',
                        'progres' => 'badge progres',
                        'selesai' => 'badge selesai',
                        'cancel'  => 'badge cancel'
                    ];
                @endphp
                <span class="{{ $statusClass[$item->status] ?? 'badge bg-secondary' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="12">Tidak ada data booking grooming.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Dicetak pada: {{ now()->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }} | Laporan Booking Grooming
</div>

</body>
</html>
