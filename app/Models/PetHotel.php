<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetHotel extends Model
{
    protected $table = 'pethotels';
    protected $fillable = [
        'nama_pemilik',
        'nomor_telepon',
        'nama_hewan',
        'jenis_hewan',
        'jumlah_hewan',
        'ras_hewan',
        'riwayat_sakit',
        'status_vaksin',
        'umur_hewan',
        'berat_hewan',
        'sertifikat_hewan',
        'check_in',
        'check_out',
        'keterangan',
    ];
}
