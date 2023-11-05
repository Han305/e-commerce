<!DOCTYPE html>
<html>
<head>
    <title>Sidebar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* CSS untuk sidebar */
        .sidebar {
            height: 100%;
            width: 250px; /* Lebar sidebar */
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333; /* Warna latar belakang sidebar */
            padding-top: 20px;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 20px;
            color: #fff; /* Warna teks pada sidebar */
            display: block;
        }

        .sidebar a:hover {
            background-color: #555; /* Warna latar belakang saat hover */
        }

        /* CSS untuk konten halaman utama */
        .content {
            margin-left: 260px; /* Lebar sidebar + margin untuk konten */
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('index') }}">Dashboard</a>
        <a href="{{ route('produk') }}">Data Produk</a>
        <a href="{{ route('pesanan') }}">Pesanan</a>
        <a href="{{ route('riwayat') }}">Riwayat Pesanan</a>        
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <!-- Konten Halaman Utama -->
    <div class="content">
        @yield('body')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('script')
</html>