@extends('user.template1')

@section('body')
    <div class="d-flex justify-content-center fs-5">
        <div class="table-reponsive pt-3">
            <table class="table">
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item->no_pesanan }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total_harga }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection