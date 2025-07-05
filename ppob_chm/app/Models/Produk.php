<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $fillable = [
        'kode',
        'provider',
        'nama',
        'harga_modal',
        'harga_jual',
        'status',
        'kategori',
    ];
}

