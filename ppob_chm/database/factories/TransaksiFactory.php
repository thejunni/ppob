<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition(): array
    {
        $nominal = $this->faker->randomElement([5000, 10000, 25000, 50000, 100000]);
        $harga_modal = $nominal - $this->faker->numberBetween(200, 1000);
        $harga_jual = $nominal + $this->faker->numberBetween(500, 1500);
        $profit = $harga_jual - $harga_modal;

        return [
            'nomor_tujuan' => $this->faker->numerify('08##########'),
            'provider' => $this->faker->randomElement(['Telkomsel', 'Indosat', 'XL', 'Tri', 'Smartfren', 'AXIS']),
            'produk' => $this->faker->randomElement(['Data 1GB', 'Data 2GB', 'Data 5GB']),
            'nominal' => $nominal,
            'harga_jual' => $harga_jual,
            'harga_modal' => $harga_modal,
            'profit' => $profit,
            'status' => $this->faker->randomElement(['sukses', 'gagal', 'pending']),
            'metode_pembayaran' => $this->faker->randomElement(['saldo', 'transfer', 'qris']),
        ];
    }
}

