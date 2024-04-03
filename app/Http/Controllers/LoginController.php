<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = Karyawan::where('username', $request->username)->first();
        if ($data && $request->password === $data->password) {
            $nama = $data->nama_karyawan;
            $id_karyawan = $data->id_karyawan;
            // Session(['nama', $nama]);
            Session::put('nama', $nama);
            Session::put('id_karyawan', $id_karyawan);
            return redirect()->route('produk');
        }
        return view('login')->with('error', 'Username atau password salah.');
    }
    public function logout(Request $request)
    {
        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        return view('login'); // Redirect to login page
    }
}
