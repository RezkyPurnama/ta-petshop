<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans'; //
    protected $fillable = [
        'user_id',
        'trx_id',
        'nama_penerima',
        'alamat',
        'telepon',
        'jumlah',
        'totalharga',
        'ongkir',
        'status',
        'status_pembayaran',
        'tgl_pesanan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function pesanandetail()
    {
        return $this->hasMany(PesananDetail::class, 'pesanan_id');
    }
}
