<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $table = 'kategori'; // Ganti dengan nama tabel yang sesuai

    protected $fillable = ['nama_kategori'];
}
