<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grooming extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'nomor_telepon',
        'nama_hewan',
        'jenis_hewan',
        'umur_hewan',
        'berat_hewan',
        'riwayat_sakit',
        'layanan_grooming',
        'tanggal_booking',
        'jam_booking',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
