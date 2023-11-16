<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{

    public function main() {
        $posts = Produk::latest()->filter()->get();
        return view('user.main', [
            'posts' => $posts
        ]);
    }

    public function page (Produk $post)
    {
        $posts = Produk::all();       
        return view('user.page', compact('post'), [            
            'posts' => $posts
        ]);
    }

    public function profil() {
        $user = Auth::user();
        return view('user.profil', [
            'user' => $user
        ]);
    }

    public function profilUpdate(Request $request, $user) {
        $data = User::findOrFail($user);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->telp = $request->telp;
        $data->update();

        return redirect('/main');
    }
    
    public function store(Request $request, $id) {
        try {
            DB::beginTransaction();

            $produk = Produk::findOrFail($id);

            $transaksi = new Transaksi();
            $transaksi->nama = $produk->nama;
            $transaksi->image = $produk->image;            
            $transaksi->harga = $produk->harga;
            $transaksi->user_id = Auth::user()->id;
            
            $transaksi->save();            

            DB::commit();

            return redirect()->route('page', ['post' => $produk])->with([
            'message' => 'Tersimpan Di keranjang'
        ]);
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ]);
        }
    }   

    public function cart() {
        $transaksi = Transaksi::all();
        return view('user.cart', [
            'posts' => $transaksi
        ]);
    }

    public function destroy(Transaksi $post)
    {     
        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();            

            return redirect(route('cart'))->with([
                'message' => 'Pesanan dihapus'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ]);
        }
    }

    public function simpanPesanan(Request $request) {
    
    $totalHarga = Transaksi::where('user_id', auth()->user()->id)->sum('harga');
    
    $produkDipesan = Transaksi::where('user_id', auth()->user()->id)->pluck('nama')->toArray();
    
    $nomorPesanan = 'P' . Carbon::now()->format('YmdHis'); 
    
    $namaPengguna = auth()->user()->name;
    
    $pesanan = new Pesanan();
    $pesanan->no_pesanan = $nomorPesanan;
    $pesanan->name = $namaPengguna;
    $pesanan->nama_produk = implode(', ', $produkDipesan); 
    $pesanan->total_harga = $totalHarga;
    $pesanan->status = 'Menunggu Konfirmasi';
    $pesanan->user_id = auth()->user()->id;
    $pesanan->save();
    
    Transaksi::where('user_id', auth()->user()->id)->delete();
    
    return redirect((route('cart')))->with('message', 'Pesanan Anda dengan nomor pesanan ' . $nomorPesanan . ' telah disimpan! dan sedang menunggu konfirmasi');
}

    // public function notifikasi() {
        
    // }

}