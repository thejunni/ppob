<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPulsa extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pulsa'; 
    protected $fillable = [
        'user_id',
        'produk_id',
        'nomor',
        'harga',
        'ref_id',
        'status',
        'metode',
        'layanan',
        'harga_modal',
        'profit'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
