<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;

class StockProduk extends Model
{
    protected $fillable = ['produk_id', 'stock'];
    protected $table = 'stock_produk';

    /**
     * Relasi ke model Produk.
     * Setiap entri stok produk terkait dengan satu produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
