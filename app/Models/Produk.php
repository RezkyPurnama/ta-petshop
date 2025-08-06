<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = [];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }

    public function stockproduk()
    {
        return $this->hasOne(StockProduk::class, 'produk_id');
    }
}
