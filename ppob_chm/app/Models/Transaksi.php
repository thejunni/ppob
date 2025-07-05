<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';

    protected $fillable = [
        'nomor_tujuan',
        'provider',
        'produk',
        'nominal',
        'harga_jual',
        'harga_modal',
        'profit',
        'status',
        'metode_pembayaran'
    ];

    // Contoh relasi jika nanti dibutuhkan
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}
