<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('nama')) {
            return view('login');
        }
        if ($request->has('search')) {
            $data = Pelanggan::where('nama', 'LIKE', '%' . $request->search . '%')
                ->orWhere('telepon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->paginate(5);
        } else {
            $data = Pelanggan::paginate(5);
        }
        return view('pelanggan', compact('data'));
    }

    public function tambahpelanggan(Request $request)
    {
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan');
    }
}
