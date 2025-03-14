<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Koperasi CHM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo_chm/logo_chm1.jpg') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero {
            background: url('{{ asset('logo_chm/logo chm.jpg') }}') no-repeat center center/cover;
            height: 80vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(41, 170, 21, 0.5);
        }
        .hero .container {
            position: relative;
            z-index: 1;
        }
        .features {
            padding: 50px 0;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
        }
        .feature-box i {
            font-size: 40px;
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .footer {
            background: #222;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('logo_chm/logo_chm1.jpg') }}" alt="Koperasi CHM" width="40" height="40" class="me-2">
                PPOB Koperasi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-success text-white" href="/login">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-4">Solusi Pembayaran PPOB Terbaik</h1>
            <p class="lead">Layanan pembayaran online yang cepat, aman, dan terpercaya</p>
            <a href="/register" class="btn btn-light btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container text-center">
            <h2>Fitur Unggulan</h2>
            <div class="row mt-4">
                <div class="col-md-4 feature-box">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Top-Up Pulsa & Data</h4>
                    <p>Isi ulang pulsa dan paket data dengan harga terbaik.</p>
                </div>
                <div class="col-md-4 feature-box">
                    <i class="fas fa-file-invoice"></i>
                    <h4>Pembayaran Tagihan</h4>
                    <p>Bayar listrik, air, dan berbagai tagihan lainnya dengan mudah.</p>
                </div>
                <div class="col-md-4 feature-box">
                    <i class="fas fa-history"></i>
                    <h4>Riwayat Transaksi</h4>
                    <p>Cek histori transaksi kapan saja secara real-time.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2025 PPOB Koperasi Central Hutama Mandiri. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>