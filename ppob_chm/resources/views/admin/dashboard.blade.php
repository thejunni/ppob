@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Dashboard Admin PPOB</h4>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Transaksi Sukses</h6>
                    <h3>{{ $sukses }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Transaksi Gagal</h6>
                    <h3>{{ $gagal }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Transaksi Pending</h6>
                    <h3>{{ $pending }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Total Saldo Provider</h6>
                    <h4>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Ringkasan -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Total Biaya Transaksi</div>
                <div class="card-body">
                    <h5>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Total Profit</div>
                <div class="card-body">
                    <h5>Rp {{ number_format($totalProfit, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi Terbaru -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Transaksi Terbaru</span>
            <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nasabah</th>
                        <th>Provider</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Profit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksiTerbaru as $trx)
                    <tr>
                        <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $trx->user->name ?? '-' }}</td>
                        <td>{{ $trx->produk->provider ?? '-' }}</td>
                        <td>{{ $trx->produk->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($trx->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($trx->profit, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge 
                                @if($trx->status == 'sukses') bg-success 
                                @elseif($trx->status == 'pending') bg-warning 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($trx->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
