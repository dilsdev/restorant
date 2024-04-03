<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request){
        if (!$request->session()->has('nama')) {
            return view('login');
        }
        $data = Produk::paginate(5);
        return view('produk', compact('data'));
    }

    public function create(Request $request){
        $data = Produk::create($request->all());
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('foto/', $filename);
            $data->gambar = $filename;
            $data->save();
        }
        return redirect()->route('produk')->with('success', 'data berhasil di tambahkan');
    }

    public function update(Request $request, $id){
        $data  = Produk::findOrFail($id);
        $data->update($request->all());
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('foto/', $filename);
            $data->gambar = $filename;
            $data->save();
        }
        return redirect()->route('produk')->with('success', 'data berhasil di tambahkan');
    }

    public function delete(Request $request){
        $data = Produk::find($request->id);
        $data->delete();
        return redirect()->route('produk')->with('hapus', 'Data berhasil di hapus');
    }
}