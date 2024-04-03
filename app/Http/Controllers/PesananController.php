<?php

namespace App\Http\Controllers;

use App\Models\ItemPesanan;
use App\Models\Meja;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        if (!session()->has('nama')) {
            return view('login');
        }
        $data = Pesanan::select('pesanans.id_pesanan', 'pelanggans.nama', 'mejas.nomor_meja', 'karyawans.nama_karyawan', 'pesanans.tanggal_pesanan', 'pesanans.total_harga')
            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'pesanans.id_pelanggan')
            ->join('karyawans', 'karyawans.id_karyawan', '=', 'pesanans.id_karyawan')
            ->join('mejas', 'mejas.id_meja', '=', 'pesanans.id_meja')
            ->get();
        $pelanggan = Pelanggan::all();
        $meja = Meja::all();
        return view('pesanan', compact('data', 'pelanggan', 'meja'));
    }

    public function detail($id)
    {
        if (!session()->has('nama')) {
            return view('login');
        }
        $data = ItemPesanan::select('produks.nama_produk', 'item_pesanans.jumlah', 'item_pesanans.subtotal')
            ->join('produks', 'produks.id_produk', '=', 'item_pesanans.id_produk')
            ->where('item_pesanans.id_pesanan', $id)
            ->get();
        // $data = ItemPesanan::where('id_pesanan', $id);
        return view('detail', compact('data'));
    }
}
