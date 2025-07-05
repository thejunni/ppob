<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Koperasi CHM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo_chm/logo_chm1.jpg') }}">

    <style>
        .saldo {
            background-color: #27AE60;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .service-item {
            text-align: center;
            padding: 15px;
            background-color: #ECF0F1;
            border-radius: 5px;
            position: relative;
        }
        .service-item .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: yellow;
            color: black;
            font-size: 12px;
            padding: 5px;
            border-radius: 5px;
        }
        .service-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 100px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 15px;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .service-button:hover {
            background: #e9ecef;
            transform: scale(1.05);
        }
        .badge-unavailable {
            background: yellow;
            color: black;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 12px;
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
            color: black;
        }
        .sidebar.collapsed a span {
            display: none;
        }
        .container {
            padding: 2rem;
        }
        footer {
            height: 50px;
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="d-flex vh-100">
        <div id="sidebar" class="sidebar">
            <div class="logo">
                <img src="{{ asset('logo_chm/logo_chm1.jpg') }}" alt="Koperasi CHM" width="40" height="40" class="me-2" id="toggleSidebar">
                <span class="logo-text">Koperasi CHM</span>
            </div>
            <a href="/dashboard" style="color: #ffffff;"><i data-feather="home"></i><span style="margin-left: 8px;">Dashboard</span></a>
            <a href="#" style="color: #ffffff;;"><i data-feather="tag"></i><span style="margin-left: 8px;">Promo</span></a>
            <a href="#" style="color: #ffffff;"><i data-feather="plus-circle"></i><span style="margin-left: 8px;">Top Up</span></a>
            <a href="#" style="color: #ffffff;"><i data-feather="clock"></i><span style="margin-left: 8px; ">History</span></a>
        </div>
        <div class="container flex-grow-1 ">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Dashboard</span>
                    {{-- <span>Username: {{ Auth::user()->name }}</span> --}}
                    <span>Juni</span>
                </div>
            </nav>
            <div class="saldo mt-3">
                <h5>Saldo Nasabah: Rp. 100.000,00</h5>
            </div>
            <div class="service-grid">
                <a href="/pembelian-pulsa" class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="smartphone"></i>
                    <br>Pulsa
                </a>
                <a href="/pembelian-data" class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="globe"></i>
                    <br>Paket Data
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="zap"></i>
                    <br>Token Listrik
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="credit-card"></i>
                    <br>Tagihan Listrik
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="phone"></i>
                    <br>Telkom
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="file-text"></i>
                    <br>Pascabayar
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="home"></i>
                    <br>PDAM
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="heart"></i>
                    <br>BPJS
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="dollar-sign"></i>
                    <br>Angsuran
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="shield"></i>
                    <br>Asuransi
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="credit-card"></i>
                    <br>Kartu Kredit
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="gift"></i>
                    <br>Zakat
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="gamepad"></i>
                    <br>Voucher Game
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="shopping-bag"></i>
                    <br>Voucher Digital
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="tv"></i>
                    <br>Internet dan TV Kabel
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>
                <a class="btn btn-light d-flex flex-column align-items-center justify-content-center p-3 position-relative">
                    <i data-feather="play-circle"></i>
                    <br>Streaming
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-warning">
                        Segera Hadir
                        <span class="visually-hidden">unavailable</span>
                      </span>
                </a>       
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 PPOB Koperasi Central Hutama Mandiri. All rights reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
</body>
</html>