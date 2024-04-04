<?php

namespace App\Http\Controllers;

use App\Models\ItemPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function dibeli()
{
    if (!session()->has('nama')) {
        return view('login');
    }

    $dibeli = ItemPesanan::select('item_pesanans.jumlah', 'produks.nama_produk')
        ->join('produks', 'produks.id_produk', '=', 'item_pesanans.id_produk')
        ->get();
    $beli = [];

    foreach ($dibeli as $item) {
        $namaProduk = $item->nama_produk;
        $jumlah = $item->jumlah;

        if (isset($beli[$namaProduk])) {
            $beli[$namaProduk]['jumlah'] += $jumlah;
        } else {
            $beli[$namaProduk] = [
                'jumlah' => $jumlah,
                'nama_produk' => $namaProduk,
            ];
        }
    }

    return view('dibeli', compact('beli'));
}
public function belumdibeli(){
    if (!session()->has('nama')) {
        return view('login');
    }
    $belumdibeli = Produk::all();
    return view('belumdibeli', compact('belumdibeli'));
}
}
