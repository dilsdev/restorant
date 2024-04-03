<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        if (!session()->has('nama')) {
            return view('login');
        }
        $data = Pelanggan::all();
        return view('pelanggan', compact('data'));
    }

    public function tambahpelanggan(Request $request){
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan');
    }
}
