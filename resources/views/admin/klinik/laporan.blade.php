<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kunjungan Pet Klinik</title>
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
        .cancel { background-color: #dc3545; }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #555;
        }

        @media print {
            body {
                background-color: #fff;
            }
            button {
                display: none;
            }
        }

        .btn-print {
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Laporan Kunjungan Pet Klinik</h2>
    <p class="print-date">
    Tanggal Cetak: {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d/m/Y') }}
</p>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>Nama Hewan</th>
                <th>Jenis Hewan</th>
                <th>Umur Hewan</th>
                <th>Berat (kg)</th>
                <th>Tanggal Kunjungan</th>
                <th>Waktu Kunjungan</th>
                <th>Keluhan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($petkliniks as $klinik)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-start">{{ $klinik->user->name }}</td>
                <td class="text-start">{{ $klinik->nama_hewan }}</td>
                <td>{{ $klinik->jenis_hewan }}</td>
                <td>{{ $klinik->umur_hewan ?? '-' }}</td>
                <td>{{ $klinik->berat }}</td>
                <td>{{ \Carbon\Carbon::parse($klinik->tanggal_kunjungan)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $klinik->waktu_kunjungan)->format('H.i') }}</td>
                <td class="text-start">{{ Str::limit($klinik->keluhan, 50, '...') }}</td>
                <td>
                    @php
                        $statusClass = [
                            'booking' => 'badge booking',
                            'progres' => 'badge progres',
                            'selesai' => 'badge selesai',
                            'cancel'  => 'badge cancel'
                        ];
                    @endphp
                    <span class="{{ $statusClass[$klinik->status] ?? 'badge bg-secondary' }}">
                        {{ ucfirst($klinik->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9">Tidak ada data kunjungan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

 <div class="footer">
    Dicetak pada: {{ now()->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }} | Laporan Kunjungan Pet Klinik
</div>

</body>
</html>
