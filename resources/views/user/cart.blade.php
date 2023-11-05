@extends('user.template1')

@section('body')
<div class="row" style="margin: 0 130px 0 130px;">
    @error('message')
        <div class="alert alert-danger small py-3 mt-3">
            {{ $message }}
        </div>
    @enderror
    @if (session('message'))
        <div class="alert alert-success small py-3 mt-3">
            {{ session('message') }}
        </div>
    @endif
        <div class="table-responsive">
            <table class="table">
                @php
                    $totalHarga = 0;
                @endphp
                @foreach ($posts as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="Image" style="width: 100px;">
                        </td>
                        <td>
                            <p>{{ $item->nama }}</p>
                        </td>
                        <td>
                            <p>{{ number_format($item->harga, 3, '.', '.') }}</p>
                            <!-- Menampilkan harga dengan tiga angka di belakang koma -->
                            @php
                                $totalHarga += intval($item->harga);
                            @endphp
                        </td>
                        <td>
                            <a href="{{ route('cart.destroy', ['post' => $item->id]) }}" onclick="return deleteConfirm()"
                                class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="border-top border-bottom" style="margin: 20px 0 0 0;">
            <div class="d-flex justify-content-between">
                <h4 class="pt-3">Total Harga: Rp. {{ number_format($totalHarga, 3, '.', '.') }}</h4>
                <div class="px-4">
                    <form action="{{ route('pesan.simpan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_harga" value="{{ $totalHarga }}">
                        <button type="submit" class="ch">Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteConfirm() {
            let approve = confirm('Apakah anda yakin ingin menghapus pesanan?');
            return approve;
        }
    </script>
@endsection
