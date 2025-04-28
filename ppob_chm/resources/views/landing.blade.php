<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('logo_chm/logo_chm1.jpg') }}" alt="Koperasi CHM" width="40" height="40" class="me-2">
                PPOB Koperasi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-black" href="/login">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>    

    <header class="bg-success text-white text-center py-5">
        <div class="container">
            <h1>Selamat Datang di PPOB Koperasi Central Hutama Mandiri</h1>
            <p class="lead">Solusi Pembayaran Online Mudah dan Cepat untuk Anggota Koperasi</p>
            <a href="/register" class="btn btn-light">Ayo Beli Sekarang</a>
        </div>
    </header>

    {{-- <section id="features" class="py-5">
        <div class="container text-center">
            <h2>Fitur Utama</h2>
            <p class="lead">Kami menyediakan berbagai layanan pembayaran PPOB dengan sistem yang cepat dan aman.</p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <h4>Top-Up Pulsa & Data</h4>
                    <p>Isi ulang pulsa dan paket data dengan harga terbaik.</p>
                </div>
                <div class="col-md-4">
                    <h4>Pembayaran Tagihan</h4>
                    <p>Bayar listrik, air, dan berbagai tagihan lainnya dengan mudah.</p>
                </div>
                <div class="col-md-4">
                    <h4>Riwayat Transaksi</h4>
                    <p>Cek histori transaksi kapan saja secara real-time.</p>
                </div>
            </div>
        </div>
    </section> --}}

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

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 PPOB Koperasi Central Hutama Mandiri. All rights reserved.</p>
    </footer>
</body>
</html>