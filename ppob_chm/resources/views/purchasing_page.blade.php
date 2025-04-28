<!-- resources/views/pembelian.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian - Koperasi CHM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo_chm/logo_chm1.jpg') }}">
    <style>
        body, html {
            height: 100%;
        }
        .saldo {
            background-color: #27AE60;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .sidebar {
            width: 250px;
            transition: all 0.3s;
            background-color: #23753e;
            color: #ffffff;
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
    <div class="d-flex">
        <div id="sidebar" class="sidebar d-flex flex-column">
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
                    {{-- <span>Username: {{ Auth::user()->name }}</span> --}}
                    <span>Juni</span>
                </div>
            </nav>

            <div class="content">
                <div class="saldo mt-3">
                    <h5>Saldo Nasabah: Rp. 100.000,00</h5>
                </div>

                <div class="card shadow-sm p-4 mt-4">
                    <h4 class="mb-4"><i data-feather="smartphone"></i> Beli Pulsa</h4>

                    <form method="POST" action="{#}">
                    {{-- <form method="POST" action="{{ route('pembelian.proses') }}"> --}}
                        @csrf
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i data-feather="phone"></i></span>
                            <input type="text" class="form-control" id="nomorTujuan" name="nomorTujuan" placeholder="Nomor Telepon" required>
                        </div>

                        <h5 class="mb-3">Nominal Pembelian</h5>
                        <div class="row g-2">
                            @foreach ([5000, 10000, 15000, 20000, 25000, 30000, 35000, 40000, 50000, 55000, 60000, 70000, 75000, 100000, 135000, 1000000] as $nominal)
                                <div class="col-6 col-md-3">
                                    <div class="nominal-button text-center" onclick="pilihNominal({{ $nominal }})" id="btn-{{ $nominal }}">
                                        {{ number_format($nominal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="harga" id="harga">Rp. 0</div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">
                                Beli
                            </button>
                        </div>

                        <input type="hidden" id="nominal" name="nominal">
                    </form>
                </div>
            </div>

            <footer class="mt-auto">
                <p>&copy; 2025 PPOB Koperasi Central Hutama Mandiri. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();

        function pilihNominal(nominal) {
            document.getElementById('nominal').value = nominal;
            document.getElementById('harga').innerText = 'Rp. ' + (nominal + 700).toLocaleString('id-ID');

            document.querySelectorAll('.nominal-button').forEach(btn => {
                btn.classList.remove('active');
            });
            document.getElementById('btn-' + nominal).classList.add('active');
        }

        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
</body>
</html>
