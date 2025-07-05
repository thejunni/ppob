<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin PPOB')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo_chm/logo_chm1.jpg') }}">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
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
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.sidebar')

    <main class="content">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
