<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\ProdukController;


Route::get('/', function () {
    return view('dashboard');
});

//Route::get('/', function () {
//    return redirect()->route('login');
//});
//Route::middleware(['auth', 'verified'])->group(function () {
//
//});
Route::controller(KategoriController::class)->group(function () {
    Route::get('kategori/data', 'data')->name('kategori.data');
});
Route::resource('/kategori', KategoriController::class);

Route::controller(ProdukController::class)->group(function () {
    Route::get('produk/data', 'data')->name('produk.data');
    Route::post('produk/hapus-terpilih', 'deleteSelected')->name('produk.deleteSelected');
    Route::post('produk/cetak-barcode', 'cetakBarcode')->name('produk.cetakBarcode');
});
Route::resource('/produk', ProdukController::class);


