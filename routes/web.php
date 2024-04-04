<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [KeranjangController::class, 'index']);

Route::get('produk', [ProdukController::class, 'index'])->name('produk');
Route::post('simpanproduk', [ProdukController::class, 'create']);
Route::delete('hapusproduk', [ProdukController::class, 'delete']);
// Route::put('editproduk/{$id}', [ProdukController::class, 'update'])->name('editproduk');
Route::put('editproduk/{id}', [ProdukController::class, 'update'])->name('editproduk');

Route::get('login', function () {
    if (session()->has('nama')) {
        return redirect()->route('index');
    }
    return view('login');
});
Route::post('login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('index', [KeranjangController::class, 'index'])->name('index');
Route::post('addkeranjang', [KeranjangController::class, 'create'])->name('addkeranjang');
Route::delete('hapuskeranjang', [KeranjangController::class, 'delete'])->name('hapuskeranjang');
Route::put('editqty/{id}', [KeranjangController::class, 'editqty'])->name('editqty');
Route::post('bayarkeranjang', [KeranjangController::class, 'bayarkeranjang'])->name('bayarkeranjang');

Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
Route::post('tambahpelanggan', [PelangganController::class, 'tambahpelanggan']);

Route::get('meja', [MejaController::class, 'index'])->name('meja');
Route::post('tambahmeja', [MejaController::class, 'tambahmeja']);
Route::put('status/{id}', [MejaController::class, 'status']);

Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('detail/{id}', [PesananController::class, 'detail']);

Route::get('barangdibeli', [ChartController::class, 'dibeli']);
Route::get('barangbelumdibeli', [ChartController::class, 'belumdibeli']);
