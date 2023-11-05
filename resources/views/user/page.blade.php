@extends('user.template1')

@section('body')
    @error('message')
        <div class="alert alert-danger small py-3">
            {{ $message }}
        </div>
    @enderror
    @if (session('message'))
        <div class="alert alert-success small py-3 my-3">
            {{ session('message') }}
        </div>
    @endif
    <div class="d-flex mx-5">
        <img src="{{ asset($post->image) }}" class="h-25" alt="">
        <div class="pt-5 ms-5">
            <h4>{{ $post->nama }}</h4>            
            <p>Rp. {{ $post->harga }}</p>
            <a href="{{ route('keranjang', ['post' => $post->id]) }}" class="text-decoration-none text-dark">
                <i class="bi bi-cart-fill fs-3"></i></a>
            <p class="pt-4">Deskripsi:</p>
            <p>{{ $post->deskripsi }}</p>
        </div>
    </div>
@endsection
