@extends('user.template')

@section('body')
<div class="py-3">
@if(session('notification'))
    <div class="alert alert-success">
        {{ session('notification') }}
    </div>
@endif
</div>
<div class="text-center pb-4">

    <h4>Produk</h4>
</div>
    <div class="row">
        @forelse ($posts as $post)
            <div class="col-4">
                <div class="card overflow-hidden mb-4">
                    <img src="{{ asset($post->image) }}" alt="Post Image">
                    <a href="{{ route('page', ['post' => $post->id]) }}" class="text-decoration-none text-dark">
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
@endsection
