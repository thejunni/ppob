@extends('layouts.app')

@section('title', 'Tambah Produk')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Produk Baru</h4>

    <form method="POST" action="{{ route('admin.harga.store') }}">
        @csrf

        <div class="mb-3">
            <label for="kode">Pilih Produk (Nama Produk)</label>
            <select name="kode" id="kode" class="form-control select2" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($produkList as $produk)
                    <option 
                        value="{{ $produk['buyer_sku_code'] }}"
                        data-brand="{{ $produk['brand'] }}"
                        data-name="{{ $produk['product_name'] }}"
                        data-price="{{ $produk['price'] }}"
                    >
                        {{ $produk['product_name'] }} ({{ $produk['brand'] }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Provider</label>
            <input type="text" name="provider" id="provider" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga Modal</label>
            <input type="number" name="harga_modal" id="harga_modal" class="form-control" required disabled>
        </div>

        <div class="mb-3">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <option value="PULSA">Pulsa</option>
                <option value="DATA">PAKET DATA</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
      

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.harga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Pilih Produk",
            allowClear: true,
            width: '100%'
        });

        $('#kode').on('change', function () {
            const selected = $(this).find(':selected');
            $('#provider').val(selected.data('brand') || '');
            $('#nama').val(selected.data('name') || '');
            $('#harga_modal').val(selected.data('price') || '');
        });
    });
</script>
@endpush
