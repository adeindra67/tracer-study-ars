<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $alumni = Auth::guard('alumni')->user();
        
        // Cek apakah sudah mengisi di tabel alumni_tracer
        $sudah_mengisi = DB::table('alumni_tracer')->where('alumni_no', $alumni->alumni_no)->exists();
        
        if ($sudah_mengisi) {
            return view('alumni.selesai', compact('alumni'));
        }

        // Ambil data kuesioner dan kelompokkan berdasarkan 'grup' (sesuai dokumen dosen)
        $kuesioner = DB::table('kuesioner_alumni')->where('aktif', true)->get()->groupBy('grup');

        return view('alumni.dashboard', compact('alumni', 'kuesioner'));
    }

    public function store(Request $request)
    {
        $alumni = Auth::guard('alumni')->user();
        
        DB::beginTransaction();
        try {
            // 1. Simpan Update Data Diri di tabel alumni
            DB::table('alumni')->where('alumni_no', $alumni->alumni_no)->update([
                'no_hp' => $request->input('no_hp'),
                'email' => $request->input('email'),
                'nik' => $request->input('nik'),  
                'npwp'=> $request->input('npwp'),
                'pekerjaan' => $request->input('pekerjaan'),
                'bidang_kerja' => $request->input('bidang_kerja'),
                'perusahaan' => $request->input('perusahaan'),
                'tingkat' => $request->input('tingkat'),
                'jabatan' => $request->input('jabatan'),
            ]);

            // 2. Dapatkan atau Buat Periode Tracer Studi Tahun Ini
            $tahunSekarang = Carbon::now()->year;
            $tracerStudi = DB::table('tracer_studi')->where('tahun', $tahunSekarang)->first();
            
            if (!$tracerStudi) {
                $tracerStudiNo = DB::table('tracer_studi')->insertGetId([
                    'tahun' => $tahunSekarang,
                    'tgl_mulai' => Carbon::now()->format('Y-01-01'),
                    'tgl_selesai' => Carbon::now()->format('Y-12-31'),
                    'lulus_tahun' => $tahunSekarang,
                    'created_at' => Carbon::now()
                ]);
            } else {
                $tracerStudiNo = $tracerStudi->tracer_studi_no;
            }

            // 3. Masukkan ke tabel transaksi AlumniTracer
            $alumniTracerNo = DB::table('alumni_tracer')->insertGetId([
                'tracer_studi_no' => $tracerStudiNo,
                'alumni_no' => $alumni->alumni_no,
                'created_at' => Carbon::now()
            ]);

            // 4. Simpan Jawaban Kuesioner ke tabel AlumniTracerKuesioner
            $jawabans = $request->input('jawaban');
            $jawaban_lainnya = $request->input('jawaban_lainnya');

            if ($jawabans) {
                $insertDataJawaban = [];
                foreach ($jawabans as $kuesioner_id => $jawaban_val) {
                    
                    // Logika pergantian "Lainnya" karya Anda (Tetap Dipertahankan)
                    if ($jawaban_val == 'Lainnya' && isset($jawaban_lainnya[$kuesioner_id])) {
                        $jawaban_val = $jawaban_lainnya[$kuesioner_id];
                    }

                    if (is_array($jawaban_val)) {
                        if (in_array('Lainnya', $jawaban_val) && isset($jawaban_lainnya[$kuesioner_id])) {
                            $key_lain = array_search('Lainnya', $jawaban_val);
                            $jawaban_val[$key_lain] = $jawaban_lainnya[$kuesioner_id];
                        }
                        $final_jawaban = implode(' | ', $jawaban_val);
                    } else {
                        $final_jawaban = $jawaban_val;
                    }

                    $insertDataJawaban[] = [
                        'alumni_tracer_no' => $alumniTracerNo,
                        'kuesioner_alumni_no' => $kuesioner_id,
                        'skor' => $final_jawaban, // Di dosen kolomnya bernama 'skor'
                        'created_at' => Carbon::now()
                    ];
                }
                
                // Bulk Insert
                DB::table('alumni_tracer_kuesioner')->insert($insertDataJawaban);
            }

            DB::commit();
            return redirect()->route('alumni.dashboard')->with('success', 'Data berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}