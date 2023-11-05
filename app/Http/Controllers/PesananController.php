<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function pesanan() {
        $posts = Pesanan::all();
        return view('admin.pesanan', [
            'posts' => $posts
        ]);
    }
    

    public function konfirmasiPesanan($id) {        
        $pesanan = Pesanan::find($id);
        
        $riwayat = new Riwayat();
        $riwayat->no_pesanan = $pesanan->no_pesanan;
        $riwayat->name = $pesanan->name;
        $riwayat->total_harga = $pesanan->total_harga;
        $riwayat->nama_produk = $pesanan->nama_produk;
        $riwayat->status = "Sudah Dikonfirmasi";
        $riwayat->user_id = Auth::user()->id;
        $riwayat->save();
    
        $pesanan->delete();        
        
        return redirect(route('riwayat'))->with('message', 'Pesanan telah dikonfirmasi.');
    }


    
    public function riwayat() {
        $posts = Riwayat::all();
        return view('admin.riwayat', [
            'posts' => $posts
        ]);        
    }

    public function destroy(Riwayat $post)
    {        
        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();            

            return redirect(route('riwayat'))->with([
                'message' => 'Riwayat dihapus'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi kesalahan'
            ]);
        }
    }
}