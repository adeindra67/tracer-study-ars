<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;

class AlumniAuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.alumni-login');
    }

    // Memproses data login (NIM & Tanggal Lahir)
    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        // Cek ke database apakah ada alumni dengan NIM & Tanggal Lahir tersebut
        $alumni = Alumni::where('nim', $request->nim)
                        ->where('tanggal_lahir', $request->tanggal_lahir)
                        ->first();

        if ($alumni) {
            // Jika ada, loginkan menggunakan guard 'alumni'
            Auth::guard('alumni')->login($alumni);
            $request->session()->regenerate();

            return redirect()->intended('/alumni/dashboard');
        }

        // Jika salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'nim' => 'Kombinasi NIM dan Tanggal Lahir tidak ditemukan.',
        ]);
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::guard('alumni')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}