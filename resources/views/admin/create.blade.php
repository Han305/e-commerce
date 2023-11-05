@extends('admin.template')

@section('body')
    <h4>Tambah Produk</h4>
    @error('message')
        <div class="alert alert-danger small py-3 mb-4">
            {{ $message }}
        </div>
    @enderror
    @if (session('message'))
        <div class="alert alert-success small py-3  mb-4">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" />
            <small class="text-danger">{{ $errors->first('nama') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar</label>
            <input type="file" class="form-control" name="image" />
            <small class="text-danger">{{ $errors->first('gambar') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Harga</label>
            <input type="text" class="form-control" name="harga" value="{{ old('harga') }}" />
            <small class="text-danger">{{ $errors->first('harga') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" cols="30" rows="4">{{ old('deskripsi') }}</textarea>
            <small class="text-danger">{{ $errors->first('deskripsi') }}</small>
        </div>
        <div class="d-grid mt-3">
            <button class="btn btn-primary btn-md">
                Submit
            </button>
        </div>
    </form>
@endsection
