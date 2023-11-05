@extends('user.template1')

@section('body')
    <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width:35rem;">
            <div class="card-body">
                <h4 class="card-title text-center">Profil</h4>
                <form action="{{ route('profil.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama:</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="">
                        <label for="telp" class="form-label">Telphone:</label>
                        <input type="text" name="telp" class="form-control" id="telp" value="{{ old('telp', $user->telp) }}">
                    </div>
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-warning me-auto">Edit</button>
                        <a href="{{ route('logout') }}" class="btn btn-danger">logout</a>
                        <a href="{{ route('main') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection