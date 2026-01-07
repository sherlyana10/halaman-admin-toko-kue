<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\AuthController;
use  App\Http\Controllers\Admin\PelangganController;
use  App\Http\Controllers\Admin\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::resource('/admin/kategori', KategoriController::class);
     Route::resource('/admin/produk', ProdukController::class);
     Route::resource('/admin/pelanggan', PelangganController::class);
     Route::resource('/admin/transaksi', TransaksiController::class);
        
});
