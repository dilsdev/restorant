<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('nama')) {
            return view('login');
        }
        if ($request->has('search')) {
            $data = Meja::where('nomor_meja', 'LIKE', '%' . $request->search . '%')
                ->orWhere('kapasitas', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->get();
        } else {
            $data = Meja::all();
        }
        return view('meja', compact('data'));
    }

    public function tambahmeja(Request $request)
    {
        Meja::create($request->all());
        return redirect()->route('meja');
    }

    public function status(Request $request, $id)
    {
        $data = Meja::find($id);
        $data->status = $request->status;
        $data->save();
        return redirect()->route('meja');
    }
}
