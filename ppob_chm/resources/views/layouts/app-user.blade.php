<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Koperasi CHM')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo_chm/logo_chm1.jpg') }}">
    @stack('styles')
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background-color: #099c13;
            color: #fff;
        }
        .sidebar a {
            color: #000000;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #025f0d;
            color: #fff;
        }
        .sidebar .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
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
            .container {
            padding: 2rem;
        }
        html, body {
            height: 100%;
            margin: 0;
        }

        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .btn-layanan {
            background-color: #5ddb92 !important; 
            color: white !important;
            border: none;
        }

        .btn-layanan:hover {
            background-color: #219150 !important; 
        }

        .btn-layanan i {
            color: white !important;
        }
        .custom-active {
            background-color: #ffcc00 !important;  /* warna kuning misalnya */
            color: #000 !important;                /* teks hitam */
            border: 1px solid #cc9900 !important;  /* border kuning gelap */
        }
        .custom-active:hover {
            background-color: #e6b800 !important;  /* warna saat hover */
        }
    </style>
</head>
<body>
    @include('partials.sidebar-user')

    <main class="content">
        @yield('content')
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
    @stack('scripts')
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 PPOB Koperasi Central Hutama Mandiri. All rights reserved.</p>
    </footer>
</body>
</html>