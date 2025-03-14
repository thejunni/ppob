<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - Koperasi CHM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            display: flex;
            width: 900px;
            height: 500px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .welcome {
            flex: 1;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .welcome h1 {
            font-size: 24px;
            color: #4CAF50;
            font-weight: bold;
        }
        .welcome img {
            width: 180px;
            margin-top: 20px;
        }
        .login {
            flex: 1;
            background: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login h2 {
            font-size: 20px;
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }
        label {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }
        .login button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }
        .login button:hover {
            background: #45a049;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 14px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h1>Selamat Datang</h1>
            <img src="{{ asset('logo_chm/logo_chm1.jpg') }}" alt="Koperasi CHM">
        </div>
        <div class="login">
            <h2>Masuk Akun</h2>
            <p class="text-muted">Agar dapat akses lebih banyak fitur</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                <div class="text-end mt-2">
                    <a href="#" class="text-decoration-none text-primary">Lupa Kata Sandi?</a>
                </div>
                <button type="submit">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>