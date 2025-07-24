@extends('layouts.app-user')

@section('title', 'Riwayat Pembelian')

@section('content')
<div class="container">
    <h4 class="mb-4">Riwayat Pembelian Pulsa</h4>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nomor Tujuan</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Harga Modal</th>
                        <th>Profit</th>
                        <th>Status</th>
                        <th>Metode</th>
                        <th>Layanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $trx)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $trx->nomor }}</td>
                        <td>{{ $trx->produk->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($trx->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($trx->harga_modal, 0, ',', '.') }}</td>
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
                        <td>{{ ucfirst($trx->metode) }}</td>
                        <td>{{ ucfirst($trx->layanan) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
