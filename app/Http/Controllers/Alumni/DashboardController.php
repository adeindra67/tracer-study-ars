<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $alumni = Auth::guard('alumni')->user();
        
        // Ambil semua pertanyaan yang aktif
        $kuesioner = DB::table('kuesioner_alumni')->where('aktif', true)->get();

        return view('alumni.dashboard', compact('alumni', 'kuesioner'));
    }

    public function store(Request $request)
    {
        $alumni = Auth::guard('alumni')->user();
        
        // Ambil semua data jawaban dari form
        $jawabans = $request->input('jawaban');

        // Looping untuk menyimpan setiap jawaban
        if ($jawabans) {
            foreach ($jawabans as $kuesioner_id => $jawaban_teks) {
                // Menggunakan updateOrInsert agar jika alumni mensubmit ulang, 
                // datanya akan di-update, bukan menjadi ganda (double data)
                DB::table('jawaban_kuesioner')->updateOrInsert(
                    [
                        'nim' => $alumni->nim, 
                        'kuesioner_id' => $kuesioner_id
                    ],
                    [
                        'jawaban' => $jawaban_teks, 
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }
        }

        // Kembalikan ke halaman dashboard dengan pesan sukses
        return redirect()->route('alumni.dashboard')->with('success', 'Terima kasih! Jawaban kuesioner Anda berhasil disimpan.');
    }
}