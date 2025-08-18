<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    protected $table = 'petklinik';

    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'nama_hewan',
        'jenis_hewan',
        'umur_hewan',
        'berat',
        'tanggal_kunjungan',
        'keluhan',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
