<!DOCTYPE html>
<html lang="en">

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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
                <form class="d-flex me-auto w-50" role="search" action="{{ route('utama') }}">
                    @csrf
                    <input class="form-control me-2" type="text" placeholder="Search" name="search"
                        value="{{ request('search') }}" />
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('register') }}" class="btn me-2 btn-outline-primary">Sign Up</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
            </div>
        </div>
    </nav>
    <img src="{{ asset('img/banner.png') }}" class="img-fluid" alt="">

    <div class="container pt-5">
        <div class="text-center pb-4">
            <h4>Produk</h4>
        </div>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-4">
                    <div class="card overflow-hidden mb-4">
                        <img src="{{ asset($post->image) }}" alt="Post Image">
                        <a href="{{ route('halaman', ['post' => $post->id]) }}" class="text-decoration-none text-dark">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->nama }}</h5>
                                <div class="pt-3">
                                    <p>Rp. {{ $post->harga }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="alert alert-dark text-center">
                    No post found
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
