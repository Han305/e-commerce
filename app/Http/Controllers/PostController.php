<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;

class PostController extends Controller
{
    const PATH = 'upload';

    public function index() {
        return view('admin.dashboard');
    }

    public function produk() {
        $posts = Produk::all();
        return view('admin.produk', [
            'posts' => $posts
        ]);
    }        

    public function create() {
        return view('admin.create');
    }
    
    public function store(Request $request) {
        $validated = (object) $request->validate([
            'nama' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',            
            'harga' => 'required|max:200',
            'deskripsi' => 'required|max:3000',
        ]);

        $imageFilename = time() . '_' . Carbon::now()->format('Ymd') . '.' . $request->image->getClientOriginalExtension();
        $image = self::PATH . '/' . $imageFilename;

        try {
            DB::beginTransaction();
            $post = new Produk();
            $post->nama = $validated->nama;
            $post->image = $image;                        
            $post->harga = $validated->harga;            
            $post->deskripsi = $validated->deskripsi;            
            $post->save();
            DB::commit();

            $request->image->move(public_path(self::PATH), $imageFilename);

            return redirect(route('produk'))->with([
                'message' => 'Produk ditambahkan'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi kesalahan'
            ])->withInput();
        }
    }  

    public function edit(Produk $post)
    {
        $posts = auth()->user()->posts;
        $user = auth()->user();        
        return view('admin.edit', compact('post'), [  
            'posts' => $posts,          
            'user' => $user
        ]);
    }

    public function update(Produk $post, Request $request)
    {
        $validated = (object) $request->validate([
            'nama' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',            
            'harga' => 'required|max:200',
            'deskripsi' => 'required|max:3000',
        ]);

        $oldImage = null;
        $imageFilename = null;
        $image = null;

        if ($request->image) {
            $oldImage = $post->image;
            $imageFilename = time() . '_' . Carbon::now()->format('Ymd') . '.' . $request->image->getClientOriginalExtension();
            $image = self::PATH . '/' . $imageFilename;
        }

        try {
            DB::beginTransaction();
            $post->nama = $validated->nama;
            if ($request->image) {
                $post->image = $image;
            }
            $post->harga = $validated->harga;
            $post->deskripsi = $validated->deskripsi;            
            $post->update();
            DB::commit();

            if ($request->image) {
                $request->image->move(public_path(self::PATH), $imageFilename);
                unlink(public_path($oldImage));
            }

            return redirect(route('produk'))->with([
                'message' => 'Produk diupdate!'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ])->withInput();
        }
    }

    public function destroy(Produk $post)
    {
        $imagePath = public_path($post->image);
        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();
            unlink($imagePath);

            return redirect(route('produk'))->with([
                'message' => 'Produk dihapus'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi kesalahan'
            ]);
        }
    }
        
}