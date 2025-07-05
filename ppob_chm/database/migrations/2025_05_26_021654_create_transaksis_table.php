<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tujuan');
            $table->string('provider');
            $table->string('produk');
            $table->integer('nominal');
            $table->integer('harga_jual');
            $table->integer('harga_modal');
            $table->integer('profit');
            $table->enum('status', ['sukses', 'gagal', 'pending'])->default('pending');
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

