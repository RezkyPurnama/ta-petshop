<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetHotel extends Model
{
    protected $table = 'pethotels';
    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'nomor_telepon',
        'nama_hewan',
        'jenis_hewan',
        'riwayat_sakit',
        'umur_hewan',
        'berat_hewan',
        'tipe_room',
        'check_in',
        'check_out',
        'keterangan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
