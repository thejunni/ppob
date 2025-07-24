@extends('layouts.app-user')

@section('title', 'Pembelian - Koperasi CHM')

@section('content')
<script>
    const saldoNasabah = {{ $saldo ?? 0 }};
</script>

<div class="bg-success text-white fw-bold px-4 py-2 rounded mb-3">
    Saldo Nasabah : Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
</div>

@if (session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('modalBerhasil'));
            modal.show();
        });
    </script>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card shadow-sm p-4">
    <h4 class="mb-4"><i data-feather="smartphone"></i> Beli Pulsa</h4>

    <form method="POST" action="{{ route('pembelian.pulsa.store') }}" id="formPembelian">
        @csrf
        <input type="hidden" id="providerHidden" name="provider">
        <input type="hidden" id="nominal" name="nominal">
        <input type="hidden" id="namaPaket" name="namaPaket">
        <input type="hidden" id="jenisLayanan" name="jenisLayanan" value="pulsa">

        <div class="input-group mb-3">
            <span class="input-group-text"><i data-feather="phone"></i></span>
            <input type="text" class="form-control" id="nomorTujuan" name="nomorTujuan" placeholder="Nomor Telepon" required>
        </div>

        <div class="mb-3">
            <span class="text-muted">Provider:</span>
            <strong id="providerOutput">-</strong>
        </div>

        <h5 class="mb-3">Nominal Pembelian</h5>
        <div class="row g-2" id="nominalContainer">
            <div class="col-12 text-muted text-center">Silakan masukkan nomor telepon terlebih dahulu.</div>
        </div>

        <div class="mt-4">
            <label for="jenisPembayaran" class="form-label">Jenis Pembayaran</label>
            <select class="form-select" id="jenisPembayaran" name="jenisPembayaran" required>
                <option value="">Pilih Jenis Pembayaran</option>
                <option value="saldo">Saldo</option>
                <option value="transfer">Transfer Bank</option>
                <option value="qris">QRIS</option>
            </select>
        </div>

        <div class="mt-4">
            <label for="harga" class="form-label">Harga</label>
            <div class="harga fw-bold text-danger" id="harga">Rp 0</div>
        </div>

        <div class="d-grid mt-4">
            <button type="button" class="btn btn-success" onclick="cekDanTampilkanModal()">Beli</button>
        </div>
    </form>
</div>

@include('partials.modal-checkout')
@include('partials.modal-berhasil')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    feather.replace();

    const prefixProvider = {
        "Telkomsel": ["0811", "0812", "0813", "0821", "0822", "0823", "0852", "0853", "0851"],
        "Indosat": ["0814", "0815", "0816", "0855", "0856", "0857", "0858"],
        "XL": ["0817", "0818", "0819", "0859", "0877", "0878"],
        "Tri": ["0895", "0896", "0897", "0898", "0899"],
        "Smartfren": ["0881", "0882", "0883", "0884", "0885", "0886", "0887", "0888", "0889"],
        "AXIS": ["0831", "0832", "0833", "0838"]
    };

    document.getElementById('nomorTujuan').addEventListener('input', function () {
        const nomor = this.value;
        let provider = '-';

        if (nomor.length >= 4) {
            const prefix = nomor.substring(0, 4);
            for (const [nama, daftarPrefix] of Object.entries(prefixProvider)) {
                if (daftarPrefix.includes(prefix)) {
                    provider = nama;
                    break;
                }
            }
        }

        document.getElementById('providerOutput').innerText = provider;
        document.getElementById('providerHidden').value = provider;

        if (provider !== '-') {
            tampilkanNominalDariDB(provider);
        } else {
            tampilkanPlaceholderNominal("Silakan masukkan nomor telepon terlebih dahulu.");
        }
    });

    function tampilkanPlaceholderNominal(text) {
        document.getElementById('nominalContainer').innerHTML =
            `<div class="col-12 text-muted text-center">${text}</div>`;
    }

    function tampilkanNominalDariDB(provider) {
        const container = document.getElementById('nominalContainer');
        container.innerHTML = '<div class="col-12 text-muted text-center">Memuat data...</div>';

        fetch(`/pulsa/by-provider/${provider}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) return tampilkanPlaceholderNominal("Belum ada produk untuk provider ini.");
                container.innerHTML = '';
                data.forEach(item => {
                    const nominal = item.harga_jual;
                    const div = document.createElement('div');
                    div.className = 'col-6 col-md-4';
                    div.innerHTML = `
                        <div class="nominal-button text-center py-2 border rounded small" style="cursor:pointer;" 
                             onclick="pilihNominal(${nominal}, '${item.nama}')" id="btn-${nominal}">
                            ${item.nama} (Rp ${nominal.toLocaleString('id-ID')})
                        </div>`;
                    container.appendChild(div);
                });
            })
            .catch(() => tampilkanPlaceholderNominal("Gagal memuat data."));
    }

    function pilihNominal(nominal, namaPaket) {
        document.getElementById('nominal').value = nominal;
        document.getElementById('namaPaket').value = namaPaket;
        document.getElementById('harga').innerText = 'Rp ' + nominal.toLocaleString('id-ID');

        document.querySelectorAll('.nominal-button').forEach(btn =>
            btn.classList.remove('bg-success', 'text-white')
        );
        document.getElementById('btn-' + nominal)?.classList.add('bg-success', 'text-white');
    }

    function cekDanTampilkanModal() {
        const nominal = parseInt(document.getElementById('nominal').value);
        const nomor = document.getElementById('nomorTujuan').value;
        const metode = document.getElementById('jenisPembayaran').value;

        if (!nominal || isNaN(nominal)) {
            return Swal.fire({ icon: 'warning', title: 'Pilih Nominal!', text: 'Silakan pilih nominal terlebih dahulu.' });
        }

        if (!nomor || nomor.length < 8) {
            return Swal.fire({ icon: 'warning', title: 'Nomor Tidak Valid!', text: 'Silakan masukkan nomor yang valid.' });
        }

        if (!metode) {
            return Swal.fire({ icon: 'warning', title: 'Pilih Pembayaran!', text: 'Silakan pilih jenis pembayaran.' });
        }

        if (metode === 'saldo' && saldoNasabah < nominal) {
            return Swal.fire({ icon: 'error', title: 'Saldo Tidak Cukup!', text: 'Saldo Anda tidak mencukupi.' });
        }

        document.getElementById('modalJenis').innerText = document.getElementById('providerHidden').value + ' - ' + document.getElementById('namaPaket').value;
        document.getElementById('modalNomor').innerText = nomor;
        document.getElementById('modalHarga').innerText = 'Rp ' + nominal.toLocaleString('id-ID');
        document.getElementById('modalSubtotal').innerText = 'Rp ' + nominal.toLocaleString('id-ID');
        document.getElementById('modalTotal').innerText = 'Rp ' + nominal.toLocaleString('id-ID');
        document.getElementById('modalPembayaran').innerText = metode.toUpperCase();

        const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        modal.show();
    }

    document.getElementById('btnBayarModal')?.addEventListener('click', function () {
        document.getElementById('formPembelian').submit();
    });
</script>
@endpush
