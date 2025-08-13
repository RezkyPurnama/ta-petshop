<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grooming extends Model
{
    protected $fillable = [
        'nama_pemilik',
        'nomor_telepon',
        'nama_hewan',
        'jenis_hewan',
        'umur_hewan',
        'berat_hewan',
        'jumlah_hewan',
        'riwayat_kejang',
        'layanan_grooming',
        'tanggal_booking',
        'jam_booking',
        'jenis_layanan',
    ];
}
