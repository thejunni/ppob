@extends('layouts.app-user')

@section('title', 'Dashboard - Koperasi CHM')

@section('content')

<div class="saldo mt-3">
    Saldo Anda: Rp {{ number_format($user->balance->balance ?? 0, 2, ',', '.') }}
</div>

<div class="service-grid">
    {{-- Layanan aktif --}}
    <a href="/pembelian-pulsa" class="btn btn-layanan d-flex flex-column align-items-center justify-content-center p-3 position-relative">
        <i data-feather="smartphone"></i>
        <br>Pulsa
    </a>
    <a href="/pembelian-data" class="btn btn-layanan d-flex flex-column align-items-center justify-content-center p-3 position-relative">
        <i data-feather="globe"></i>
        <br>Paket Data
    </a>

    {{-- Segera Hadir --}}
    @php
        $layananSegeraHadir = [
            ['icon' => 'zap', 'label' => 'Token Listrik'],
            ['icon' => 'credit-card', 'label' => 'Tagihan Listrik'],
            ['icon' => 'phone', 'label' => 'Telkom'],
            ['icon' => 'file-text', 'label' => 'Pascabayar'],
            ['icon' => 'home', 'label' => 'PDAM'],
            ['icon' => 'heart', 'label' => 'BPJS'],
            ['icon' => 'dollar-sign', 'label' => 'Angsuran'],
            ['icon' => 'shield', 'label' => 'Asuransi'],
            ['icon' => 'credit-card', 'label' => 'Kartu Kredit'],
            ['icon' => 'gift', 'label' => 'Zakat'],
            ['icon' => 'shopping-bag', 'label' => 'Voucher Digital'],
            ['icon' => 'tv', 'label' => 'Internet dan TV Kabel'],
            ['icon' => 'play-circle', 'label' => 'Streaming'],
        ];
    @endphp

    @foreach($layananSegeraHadir as $layanan)
        <a class="btn btn-layanan d-flex flex-column align-items-center justify-content-center p-3 position-relative">
            <i data-feather="{{ $layanan['icon'] }}"></i>
            <br>{{ $layanan['label'] }}
            <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                Segera Hadir
                <span class="visually-hidden">unavailable</span>
            </span>
        </a>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
    feather.replace();
</script>
@endpush
