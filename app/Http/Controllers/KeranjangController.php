<?php

namespace App\Http\Controllers;

use App\Models\ItemPesanan;
use App\Models\Keranjang;
use App\Models\Meja;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class KeranjangController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('nama')) {
            return view('login');
        }


        $data = Keranjang::select('keranjangs.id_keranjang', 'keranjangs.qty', 'pelanggans.nama', 'produks.nama_produk', 'produks.harga')
            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'keranjangs.id_pelanggan')
            ->join('produks', 'produks.id_produk', '=', 'keranjangs.id_produk')
            ->get();
        $data_terakhir = Keranjang::select('keranjangs.id_keranjang', 'keranjangs.qty', 'pelanggans.id_pelanggan', 'pelanggans.nama', 'produks.nama_produk', 'produks.harga')
            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'keranjangs.id_pelanggan')
            ->join('produks', 'produks.id_produk', '=', 'keranjangs.id_produk')
            ->latest('keranjangs.id_keranjang')
            ->first();
        $meja = Meja::all();
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        return view('index', compact('data', 'pelanggan', 'produk', 'data_terakhir', 'meja'));;
    }
    public function create(Request $request)
    {

        $cekbarang = Produk::find($request->id_produk);
        if ($request->quantity > $cekbarang->sisa) {
            return redirect()->back()->with(['error' => 'Jumlah yang diminta melebihi sisa produk yang tersedia'])->withInput();
        }
        $produk = Keranjang::where('id_produk', $request->id_produk)->first();
        $tambah = $request->quantity;
        if ($produk) {
            $qty1 = $produk->qty;
            $qty1 = $qty1 + $tambah;
            $produk->qty = $qty1;
            $produk->save();
        } else {
            Keranjang::create([
                "id_pelanggan" => $request->id_pelanggan,
                "id_produk" => $request->id_produk,
                "qty" => $request->quantity,
            ]);
        }
        return redirect()->route('index');
    }

    public function delete(Request $request)
    {
        $data = Keranjang::find($request->id);
        $data->delete();
        return redirect()->route('index');
    }

    public function editqty(Request $request, $id)
    {
        $data = Keranjang::find($id);
        $data->qty = $request->quantity;
        $data->save();
        return redirect()->route('index');
    }
    public function bayarkeranjang(Request $request)
    {
        $data = Keranjang::all();
        $totalharga = $request->total;
        $id_meja = $request->id_meja;
        $id_karyawan = $request->id_karyawan;
        $id_pelanggan = $request->id_pelanggan;
        $tanggal_pesanan = Carbon::now()->format('Y-m-d H:i:s');
        // dd($request);
        $keranjang = Pesanan::create([
            "id_pelanggan" => $id_pelanggan,
            "id_meja" => $id_meja,
            "id_karyawan" => $id_karyawan,
            "tanggal_pesanan" => $tanggal_pesanan,
            "total_harga" => $totalharga,
        ]);
        foreach ($data as $isi) {
            $produk = Produk::find($isi->id_produk);
            $subtotal = ($isi->qty * $produk->harga);
            $produk->sisa -= $isi->qty;
            $produk->save();
            ItemPesanan::create([
                "id_pesanan" => $keranjang->id_pesanan,
                "id_produk" => $isi->id_produk,
                "jumlah" => $isi->qty,
                "subtotal" => $subtotal
            ]);
            $isi->delete();
        }
        return redirect()->route('index');
    }
}
