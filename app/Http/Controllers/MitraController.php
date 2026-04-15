<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MitraController extends Controller
{
    // 1. Tampilkan halaman pencarian awal
    public function index()
    {
        return view('mitra.index');
    }

    // 2. Proses pencarian & verifikasi alumni
    public function search(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        // Cari alumni berdasarkan kemiripan nama (LIKE) dan kecocokan persis tanggal lahir
        $alumni = DB::table('alumni')
            ->where('nama', 'LIKE', '%' . $request->nama . '%')
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$alumni) {
            return back()->with('error', 'Maaf, data Alumni tidak ditemukan. Pastikan ejaan nama dan tanggal lahir sesuai.')->withInput();
        }

        // Simpan NIM ke session agar aman saat pindah halaman
        session(['mitra_alumni_nim' => $alumni->nim]);

        return redirect()->route('mitra.dashboard');
    }

    // 3. Tampilkan halaman kuesioner (Wizard)
    public function dashboard()
    {
        $nim = session('mitra_alumni_nim');

        if (!$nim) {
            return redirect()->route('mitra.index')->with('error', 'Sesi Anda telah berakhir. Silakan ulangi pencarian.');
        }

        $alumni = DB::table('alumni')->where('nim', $nim)->first();

        if (!$alumni) {
            return redirect()->route('mitra.index')->with('error', 'Data alumni tidak valid.');
        }

        // Ambil pertanyaan dan kelompokkan berdasarkan kategori
        $kuesioner = DB::table('kuesioner_mitra')->get()->groupBy('kategori');

        return view('mitra.dashboard', compact('alumni', 'kuesioner'));
    }

    // ==========================================
    // BAGIAN BARU: LOGIKA SIMPAN KE DATABASE
    // ==========================================
    
    // 4. Proses tangkap form dan simpan data
    public function store(Request $request)
    {
        // 1. Validasi Keamanan Data
        $request->validate([
            'nim' => 'required|exists:alumni,nim',
            'nama_perusahaan' => 'required|string|max:255',
            'sektor_perusahaan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string',
            'nama_penilai' => 'required|string|max:255',
            'jabatan_penilai' => 'required|string|max:255',
            'kontak_penilai' => 'nullable|string|max:255',
            'jawaban' => 'required|array', // Harus berbentuk array untuk kuesioner
        ]);

        // Mulai Transaksi Database (Mencegah data setengah tersimpan)
        DB::beginTransaction();

        try {
            // 2. Simpan Data Identitas Penilai & Perusahaan ke tabel 'penilaian_mitra'
            $penilaianId = DB::table('penilaian_mitra')->insertGetId([
                'nim' => $request->nim,
                'nama_penilai' => $request->nama_penilai,
                'jabatan_penilai' => $request->jabatan_penilai,
                'kontak_penilai' => $request->kontak_penilai,
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'sektor_perusahaan' => $request->sektor_perusahaan,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // 3. Rakit data jawaban HRD untuk dimasukkan ke tabel 'jawaban_mitra'
            $insertDataJawaban = [];
            foreach ($request->jawaban as $kuesioner_id => $isi_jawaban) {
                $insertDataJawaban[] = [
                    'penilaian_id' => $penilaianId,
                    'kuesioner_mitra_id' => $kuesioner_id,
                    'jawaban' => $isi_jawaban,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            // Simpan secara massal (Bulk Insert) agar lebih cepat
            DB::table('jawaban_mitra')->insert($insertDataJawaban);

            // 4. Konfirmasi penyimpanan sukses
            DB::commit();

            // Bersihkan memori sesi agar data tidak nyangkut jika HRD lain memakai komputer yang sama
            session()->forget('mitra_alumni_nim');

            // Lempar ke halaman Selesai
            return redirect()->route('mitra.selesai');

        } catch (\Exception $e) {
            // Batalkan semua penyimpanan jika terjadi error (Rollback)
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem saat menyimpan. Silakan coba lagi.');
        }
    }

    // 5. Tampilkan halaman Selesai / Terima Kasih
    public function selesai()
    {
        return view('mitra.selesai');
    }
}