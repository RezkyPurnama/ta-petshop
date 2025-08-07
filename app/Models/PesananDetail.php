<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{

    protected $table = 'pesanans_details'; // <- Nama sesuai migration
    protected $fillable = [
        'pesanan_id',     // ✅ wajib ditambahkan!
        'produk_id',
        'jumlah',
        'harga_satuan',
        'total_harga',
    ];
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    // Relasi ke Produk (OrderItem belongs to Produk)
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }


}
