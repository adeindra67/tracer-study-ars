<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard alumni (Kuesioner Wizard).
     */
    public function index()
    {
        $alumni = Auth::guard('alumni')->user();
        
        // Pengecekan: Apakah alumni sudah pernah mengisi kuesioner?
        // Jika NIM sudah ada di tabel jawaban_kuesioner, langsung arahkan ke halaman Selesai.
        $sudah_mengisi = DB::table('jawaban_kuesioner')->where('nim', $alumni->nim)->exists();
        
        if ($sudah_mengisi) {
            return view('alumni.selesai', compact('alumni'));
        }

        // Ambil data kuesioner dan kelompokkan berdasarkan kolom 'kategori' 
        // agar bisa di-render per section (step-by-step) di View.
        $kuesioner = DB::table('kuesioner_alumni')->get()->groupBy('kategori');

        return view('alumni.dashboard', compact('alumni', 'kuesioner'));
    }

    /**
     * Menyimpan data update profil dan jawaban kuesioner ke database.
     */
    public function store(Request $request)
    {
        $alumni = Auth::guard('alumni')->user();
        
        // 1. Simpan Update Data Diri (Step 1 pada Wizard)
        // Memperbarui data kontak dan pekerjaan di tabel alumni
        DB::table('alumni')->where('nim', $alumni->nim)->update([
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'nik' => $request->input('nik'),  // Tambahkan ini
            'npwp'=> $request->input('npwp'),
            'pekerjaan' => $request->input('pekerjaan'),
            'perusahaan' => $request->input('perusahaan'),
            'jabatan' => $request->input('jabatan'),
        ]);

        // 2. Simpan Jawaban Kuesioner (Step 2 dan seterusnya)
        $jawabans = $request->input('jawaban');
        $jawaban_lainnya = $request->input('jawaban_lainnya');

        if ($jawabans) {
            foreach ($jawabans as $kuesioner_id => $jawaban_val) {
                
                // Cek jika jawaban (tipe radio) adalah "Lainnya", maka ganti nilainya dengan inputan teks esai
                if ($jawaban_val == 'Lainnya' && isset($jawaban_lainnya[$kuesioner_id])) {
                    $jawaban_val = $jawaban_lainnya[$kuesioner_id];
                }

                // Cek jika jawaban adalah array (berasal dari input tipe Checkbox)
                if (is_array($jawaban_val)) {
                    // Jika di dalam array checkbox terdapat opsi "Lainnya"
                    if (in_array('Lainnya', $jawaban_val) && isset($jawaban_lainnya[$kuesioner_id])) {
                        // Cari index array yang berisi teks 'Lainnya'
                        $key_lain = array_search('Lainnya', $jawaban_val);
                        // Ganti tulisan 'Lainnya' di array tersebut dengan teks isian aslinya
                        $jawaban_val[$key_lain] = $jawaban_lainnya[$kuesioner_id];
                    }
                    // Gabungkan array menjadi satu string panjang, dipisahkan dengan tanda " | "
                    $final_jawaban = implode(' | ', $jawaban_val);
                } else {
                    $final_jawaban = $jawaban_val;
                }

                // Simpan atau update ke tabel jawaban_kuesioner
                DB::table('jawaban_kuesioner')->updateOrInsert(
                    [
                        'nim' => $alumni->nim, 
                        'kuesioner_id' => $kuesioner_id
                    ],
                    [
                        'jawaban' => $final_jawaban, 
                        'updated_at' => now(), 
                        'created_at' => now()
                    ]
                );
            }
        }

        // Setelah semua tersimpan, kembalikan ke dashboard. 
        // Karena ada pengecekan di index(), user akan otomatis dilempar ke halaman alumni.selesai
        return redirect()->route('alumni.dashboard')->with('success', 'Data diri dan Kuesioner berhasil disimpan!');
    }
}