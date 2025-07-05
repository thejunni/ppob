<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $produkList = [
            [
                'kode' => 'TS10',
                'provider' => 'Telkomsel',
                'nama' => 'Pulsa Telkomsel 10.000',
                'harga_modal' => 9800,
                'harga_jual' => 10500,
                'status' => 'aktif',
            ],
            [
                'kode' => 'TS20',
                'provider' => 'Telkomsel',
                'nama' => 'Pulsa Telkomsel 20.000',
                'harga_modal' => 19500,
                'harga_jual' => 21000,
                'status' => 'aktif',
            ],
            [
                'kode' => 'IS25',
                'provider' => 'Indosat',
                'nama' => 'Pulsa Indosat 25.000',
                'harga_modal' => 24200,
                'harga_jual' => 26000,
                'status' => 'aktif',
            ],
            [
                'kode' => 'IS50',
                'provider' => 'Indosat',
                'nama' => 'Pulsa Indosat 50.000',
                'harga_modal' => 48000,
                'harga_jual' => 50000,
                'status' => 'nonaktif',
            ],
        ];

        foreach ($produkList as $data) {
            Produk::create($data);
        }
    }
}

