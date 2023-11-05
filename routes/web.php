<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->middleware('guest')->group(function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'loginProcess'])->name('login.process');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
});

Route::middleware('auth')->group(function() {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/admin', [PostController::class, 'index'])->name('index');    
    Route::get('/produk', [PostController::class, 'produk'])->name('produk');    
    Route::get('/produk/create', [PostController::class, 'create'])->name('produk.create');    
    Route::post('/produk/create', [PostController::class, 'store'])->name('produk.store');    
    Route::get('/produk/edit/{post}', [PostController::class, 'edit'])->name('produk.edit');    
    Route::put('/produk/edit/{post}', [PostController::class, 'update'])->name('produk.update');    
    Route::get('/produk/delete/{post}', [PostController::class, 'destroy'])->name('produk.destroy');    
    Route::get('/riwayat/delete/{post}', [PesananController::class, 'destroy'])->name('riwayat.destroy');    
    Route::get('/pesanan', [PesananController::class, 'pesanan'])->name('pesanan');    
    Route::get('/riwayat', [PesananController::class, 'riwayat'])->name('riwayat');   
    Route::post('/pesanan/konfirmasi/{id}', [PesananController::class, 'konfirmasiPesanan'])->name('pesanan.konfirmasi'); 
    
    Route::get('/main', [TransaksiController::class, 'main'])->name('main');
    Route::get('/profil', [TransaksiController::class, 'profil'])->name('profil');
    Route::get('/page/{post}', [TransaksiController::class, 'page'])->name('page');
    Route::get('/keranjang/{post}', [TransaksiController::class, 'store'])->name('keranjang');
    Route::get('/cart', [TransaksiController::class, 'cart'])->name('cart');
    Route::get('/cart/{post}', [TransaksiController::class, 'destroy'])->name('cart.destroy');
    Route::post('/pesan', [TransaksiController::class, 'simpanPesanan'])->name('pesan.simpan');
});