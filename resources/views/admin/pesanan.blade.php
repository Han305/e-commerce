@extends('admin.template')

@section('body')
    <h4>Pesanan</h4>
    @error('message')
        <div class="alert alert-danger small py-3 mb-2">
            {{ $message }}
        </div>
    @enderror
    @if (session('message'))
        <div class="alert alert-success small py-3 mb-2">
            {{ session('message') }}
        </div>
    @endif
    <div class="table-reponsive pt-3">
        <table class="table table-striped border">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No</th>
                    <th scope="col">Nomor Pesanan</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->no_pesanan }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total_harga }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <form action="{{ route('pesanan.konfirmasi', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function deleteConfirm() {
            let approve = confirm('Apakah anda yakin ingin menghapus data?');
            return approve;
        }
    </script>
@endsection
