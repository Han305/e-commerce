<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/20231002_084739_0000-removebg-preview.png') }}" alt="Logo" width="30"
                    height="30" class="d-inline-block align-text-top" />
                KATE.CO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('utama') }}">Home</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('register') }}" class="btn me-2 btn-outline-primary">Sign Up</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @error('message')
            <div class="alert alert-danger small py-3">
                {{ $message }}
            </div>
        @enderror
        @if (session('message'))
            <div class="alert alert-danger small py-3 my-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="d-flex mx-5">
            <img src="{{ asset($post->image) }}" class="h-25" alt="">
            <div class="pt-5 ms-5">
                <h4>{{ $post->nama }}</h4>
                <p>Rp. {{ $post->harga }}</p>
                <a href="{{ route('pag', ['post' => $post->id]) }}" class="text-decoration-none text-dark">
                    <i class="bi bi-cart-fill fs-3"></i></a>
                <p class="pt-4">Deskripsi:</p>
                <p>{{ $post->deskripsi }}</p>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('script')

</html>
