<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembelian - Koperasi CHM</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/png" href="{{ asset('logo_chm/logo_chm1.jpg') }}" />
  <style>
    html, body {
      height: 100%;
    }

    .sidebar {
      width: 250px;
      transition: all 0.3s;
      background-color: #23753e;
      color: #ffffff;
      height: 100vh; /* Tinggi sidebar sama dengan layar */
      position: sticky;
      top: 0;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .sidebar .logo {
      text-align: center;
      padding: 15px;
    }

    .sidebar.collapsed .logo-text {
      display: none;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 10px;
      text-decoration: none;
      color: #ffffff;
    }

    .sidebar.collapsed a span {
      display: none;
    }

    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .content {
      flex: 1;
      padding: 2rem;
    }

    footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 10px;
    }

    .saldo {
      background-color: #27AE60;
      color: white;
      padding: 10px;
      border-radius: 5px;
      text-align: center;
    }

    .nominal-button {
      width: 100%;
      padding: 15px;
      background-color: #ecf0f1;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
    }

    .nominal-button.active {
      border: 2px solid #28a745;
      background-color: #d4edda;
    }

    .harga {
      font-size: 24px;
      font-weight: bold;
      color: red;
    }
  </style>
</head>
<body>
<script>
  const saldoNasabah = {{ $saldo ?? 0 }};
</script>

<div class="d-flex">
  <div id="sidebar" class="sidebar">
    <div class="logo">
      <img src="{{ asset('logo_chm/logo_chm1.jpg') }}" alt="Koperasi CHM" width="40" height="40" class="me-2" id="toggleSidebar">
      <span class="logo-text">Koperasi CHM</span>
    </div>
    <a href="/dashboard"><i data-feather="home"></i><span style="margin-left: 8px;">Dashboard</span></a>
    <a href="#"><i data-feather="tag"></i><span style="margin-left: 8px;">Promo</span></a>
    <a href="#"><i data-feather="plus-circle"></i><span style="margin-left: 8px;">Top Up</span></a>
    <a href="#"><i data-feather="clock"></i><span style="margin-left: 8px;">History</span></a>
  </div>

  <div class="main-content">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Pembelian</span>
        <span>Juni</span>
      </div>
    </nav>

    <div class="content">
      <div class="saldo mt-3">
        <h5>Saldo Nasabah: Rp. {{ number_format($saldo ?? 100000, 0, ',', '.') }}</h5>
      </div>

      <div class="card shadow-sm p-4 mt-4">
        <h4 class="mb-4"><i data-feather="smartphone"></i> Beli Paket Data</h4>

        <form method="POST" action="#">
          @csrf
          <div class="input-group mb-2">
            <span class="input-group-text"><i data-feather="phone"></i></span>
            <input type="text" class="form-control" id="nomorTujuan" name="nomorTujuan" placeholder="Nomor Telepon" required>
          </div>

          <div class="mb-3">
            <span class="text-muted">Provider: </span>
            <strong id="providerOutput">-</strong>
          </div>

          <h5 class="mb-3">Nominal Pembelian</h5>
          <div class="row g-2">
            @foreach ([5000,10000,15000,20000,25000,30000,35000,40000,50000,60000,70000,100000] as $nominal)
              <div class="col-6 col-md-3">
                <div class="nominal-button text-center" onclick="pilihNominal({{ $nominal }})" id="btn-{{ $nominal }}">
                  {{ number_format($nominal, 0, ',', '.') }}
                </div>
              </div>
            @endforeach
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
            <div class="harga" id="harga">Rp. 0</div>
          </div>

          <div class="d-grid mt-4">
            <button type="button" class="btn btn-success" onclick="cekDanTampilkanModal()">Beli</button>
          </div>

          <input type="hidden" id="nominal" name="nominal">
          <input type="hidden" id="providerHidden" name="provider">
        </form>
      </div>
    </div>

    <footer class="mt-auto">
      <p>&copy; 2025 PPOB Koperasi Central Hutama Mandiri. All rights reserved.</p>
    </footer>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded shadow-sm">
      <div class="modal-body">
        <h5 class="mb-3"><i data-feather="smartphone" class="text-success me-2"></i><strong>Checkout</strong></h5>
        <div class="border-top pt-3 mb-3">
          <p class="mb-1">Jenis Layanan</p>
          <p><strong id="modalJenis">-</strong></p>
          <p class="mb-1">Nomor</p>
          <p><strong id="modalNomor">-</strong></p>
          <p class="mb-1">Harga</p>
          <p class="text-danger fw-bold" id="modalHarga">Rp 0</p>
          <p class="mb-1">Pembayaran</p>
          <p><strong id="modalPembayaran">-</strong></p>
        </div>

        <h6 class="border-top pt-3 mb-2">Ringkasan Pembayaran</h6>
        <div class="d-flex justify-content-between">
          <span>Subtotal Tagihan</span><span id="modalSubtotal">Rp 0</span>
        </div>
        <div class="d-flex justify-content-between">
          <span>Diskon</span><span>Rp 0</span>
        </div>
        <div class="d-flex justify-content-between fw-bold">
          <span>Total Tagihan</span><span id="modalTotal">Rp 0</span>
        </div>

        <div class="d-grid mt-4">
          <button type="button" class="btn btn-success" id="btnBayarModal">Bayar</button>
        </div>
      </div>
    </div>
  </div>
</div>

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
  });

  function pilihNominal(nominal) {
    document.getElementById('nominal').value = nominal;
    document.getElementById('harga').innerText = 'Rp. ' + (nominal + 700).toLocaleString('id-ID');
    document.querySelectorAll('.nominal-button').forEach(btn => btn.classList.remove('active'));
    document.getElementById('btn-' + nominal).classList.add('active');
  }

  function cekDanTampilkanModal() {
    const nominal = parseInt(document.getElementById('nominal').value);
    const total = nominal + 700;
    const nomor = document.getElementById('nomorTujuan').value;
    const metode = document.getElementById('jenisPembayaran').value;
    const provider = document.getElementById('providerHidden').value || '-';

    if (!nominal || isNaN(nominal)) {
      return Swal.fire({ icon: 'warning', title: 'Pilih Nominal!', text: 'Silakan pilih nominal pembelian terlebih dahulu.' });
    }

    if (!nomor || nomor.length < 8) {
      return Swal.fire({ icon: 'warning', title: 'Nomor Tidak Valid!', text: 'Silakan masukkan nomor tujuan yang valid.' });
    }

    if (!metode) {
      return Swal.fire({ icon: 'warning', title: 'Metode Pembayaran Kosong!', text: 'Pilih jenis pembayaran terlebih dahulu.' });
    }

    if (metode === 'saldo' && saldoNasabah < total) {
      return Swal.fire({ icon: 'error', title: 'Saldo Tidak Cukup!', text: 'Saldo Anda tidak mencukupi untuk transaksi ini.' });
    }

    document.getElementById('modalJenis').innerText = provider + ' ' + nominal.toLocaleString('id-ID');
    document.getElementById('modalNomor').innerText = nomor;
    document.getElementById('modalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('modalSubtotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('modalTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('modalPembayaran').innerText = metode.toUpperCase();

    const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
    modal.show();
  }

  document.getElementById('btnBayarModal').addEventListener('click', function () {
    document.querySelector('form').submit();
  });

  document.getElementById('toggleSidebar').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
  });
</script>
</body>
</html>
