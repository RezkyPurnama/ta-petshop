<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans'; //
    protected $fillable = [
        'user_id',
        'produk_id',
        'tgl_pesanan',
        'nama_penerima',
        'alamat',
        'telepon',
        'jumlah',
        'totalharga',
        'status',
        'trx_id',
        'tgl_pesanan'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pesanandetail()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
