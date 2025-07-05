@extends('layouts.app')

@section('title', 'Edit Harga Produk')

@section('content')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: 'Pilih status',
                allowClear: true
            });
        });
    </script>
@endpush

<div class="container">
    <h4>Edit Produk</h4>
    <form method="POST" action="{{ route('admin.harga.update', $produk->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ $produk->kode }}" disabled>
        </div>
        <div class="mb-3">
            <label>Provider</label>
            <input type="text" name="provider" class="form-control" value="{{ $produk->provider }}" disabled>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}">
        </div>
        <div class="mb-3">
            <label>Harga Modal</label>
            <input type="number" name="harga_modal" class="form-control" value="{{ $produk->harga_modal }}" disabled>
        </div>
        <div class="mb-3">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" value="{{ $produk->harga_jual }}">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="kategori" class="form-control select2">
                <option value="PULSA" {{ $produk->kategori == 'PULSA' ? 'selected' : '' }}>Pulsa</option>
                <option value="DATA" {{ $produk->kategori == 'DATA' ? 'selected' : '' }}>Paket Data</option>
            </select>
        </div> 
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control select2">
                <option value="aktif" {{ $produk->status == 'aktif' ? 'selected' : '' }}>AKTIF</option>
                <option value="nonaktif" {{ $produk->status == 'nonaktif' ? 'selected' : '' }}>NON AKTIF</option>
            </select>
        </div>        

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.harga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
