<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\KategoriController;


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
