<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('nama')) {
            return view('login');
        }
        if ($request->has('search')) {
            $data = Produk::where('nama_produk', 'LIKE', '%' . $request->search . '%')
                ->orWhere('harga', 'LIKE', '%' . $request->search . '%')
                ->orWhere('sisa', 'LIKE', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $request->search . '%')
                ->paginate(5);
        } else {
            $data = Produk::paginate(5);
        }
        return view('produk', compact('data'));
    }

    public function create(Request $request)
    {
        $data = Produk::create($request->all());
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('foto/', $filename);
            $data->gambar = $filename;
            $data->save();
        }
        // return redirect()->route('produk')->with('success', 'data berhasil di tambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data  = Produk::findOrFail($id);
        $data->update($request->all());


        if ($request->hasFile('gambar')) {
            $file_path = public_path('foto/' . $data->gambar);
            if (file_exists($file_path)) {
                File::delete($file_path);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('foto/', $filename);
            $data->gambar = $filename;
            $data->save();
        }
        // return redirect()->route('produk')->with('success', 'data berhasil di tambahkan');
        return redirect()->back();

    }

    public function delete(Request $request)
    {
        $data = Produk::find($request->id);

        if (!$data) {
            return redirect()->route('produk')->with('error', 'Data tidak ditemukan');
        }

        $file_path = public_path('foto/' . $data->gambar);
        if (file_exists($file_path)) {
            File::delete($file_path);
        }

        $data->delete();

        // return redirect()->route('produk')->with('hapus', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
