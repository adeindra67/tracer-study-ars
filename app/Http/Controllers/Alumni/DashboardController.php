<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\KuesionerAlumni;
use App\Models\TracerStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\Alumni $alumni */
        $alumni = Auth::guard('alumni')->user();
        $tahunSekarang = Carbon::now()->year;

        // =======================================================
        // 1. BLOKIR AKSES UNTUK LULUSAN TAHUN BERJALAN
        // =======================================================
        if ($alumni->lulus_tahun && $alumni->lulus_tahun >= $tahunSekarang) {
            return view('alumni.lock', compact('alumni', 'tahunSekarang'));
        }

        // =======================================================
        // 2. BLOKIR AKSES JIKA SUDAH PERNAH MENGISI TAHUN INI
        // =======================================================
        $tracerStudi = TracerStudi::where('tahun', $tahunSekarang)->first();
        if ($tracerStudi) {
            $sudahMengisi = DB::table('alumni_tracer')
                ->where('alumni_no', $alumni->alumni_no)
                ->where('tracer_studi_no', $tracerStudi->tracer_studi_no)
                ->exists();

            if ($sudahMengisi) {
                // Lempar ke halaman selesai dengan membawa pesan/sesi khusus
                return redirect()->route('alumni.selesai')->with('sudah_mengisi', true);
            }
        }

        // AMBIL SEMUA PERTANYAAN JIKA BELUM MENGISI
        $kuesioner = KuesionerAlumni::where('aktif', true)
            ->orderBy('grup_urut')
            ->orderBy('indikator_urut')
            ->get()
            ->groupBy('grup');

        return view('alumni.dashboard', compact('alumni', 'kuesioner'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\Alumni $alumni */
        $alumni = Auth::guard('alumni')->user();

        // Validasi Profil & Status
        $request->validate([
            'email' => 'required|email',
            'no_hp' => 'required',
            'pekerjaan' => 'required', 
        ]);

        DB::beginTransaction();
        try {
            $isBekerja = in_array($request->pekerjaan, ['Bekerja (full time/ part time)', 'Wiraswasta']);

            // Update Data Diri
            $alumni->update([
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'nik' => $request->nik,
                'npwp' => $request->npwp,
                'pekerjaan' => $request->pekerjaan, 
                'jabatan' => $isBekerja ? $request->jabatan : null, 
                'perusahaan' => $isBekerja ? $request->perusahaan : null,
                'bidang_kerja' => $isBekerja ? $request->bidang_kerja : null,
                'tingkat' => $isBekerja ? $request->tingkat : null,
            ]);

            // Ambil/Buat Master Tracer Studi
            $tracerStudi = TracerStudi::firstOrCreate(
                ['tahun' => Carbon::now()->year],
                ['tgl_mulai' => Carbon::now()->format('Y-01-01'), 'tgl_selesai' => Carbon::now()->format('Y-12-31')]
            );

            // Insert ke alumni_tracer (Menandakan alumni ini SUDAH mengisi)
            $alumniTracerId = DB::table('alumni_tracer')->insertGetId([
                'tracer_studi_no' => $tracerStudi->tracer_studi_no,
                'alumni_no' => $alumni->alumni_no,
                'created_at' => Carbon::now()
            ]);

            // Insert Jawaban Kuesioner
            if ($request->has('jawaban')) {
                $insertDataJawaban = [];
                foreach ($request->jawaban as $kuesioner_id => $isi_jawaban) {
                    if (empty($isi_jawaban)) continue;

                    if (is_array($isi_jawaban)) {
                        if (isset($request->jawaban_lainnya[$kuesioner_id]) && $request->jawaban_lainnya[$kuesioner_id] != '') {
                            $isi_jawaban[] = $request->jawaban_lainnya[$kuesioner_id];
                            $isi_jawaban = array_diff($isi_jawaban, ['Lainnya']);
                        }
                        $isi_jawaban = implode(', ', $isi_jawaban);
                    } 
                    elseif ($isi_jawaban === 'Lainnya' && isset($request->jawaban_lainnya[$kuesioner_id])) {
                        $isi_jawaban = $request->jawaban_lainnya[$kuesioner_id];
                    }

                    $insertDataJawaban[] = [
                        'alumni_tracer_no' => $alumniTracerId,
                        'kuesioner_alumni_no' => $kuesioner_id,
                        'skor' => $isi_jawaban,
                        'created_at' => Carbon::now()
                    ];
                }
                
                if (count($insertDataJawaban) > 0) {
                    DB::table('alumni_tracer_kuesioner')->insert($insertDataJawaban);
                }
            }

            DB::commit();
            return redirect()->route('alumni.selesai')->with('is_bekerja', $isBekerja);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data. Pesan error: ' . $e->getMessage());
        }
    }

    public function selesai()
    {
        /** @var \App\Models\Alumni $alumni */
        $alumni = Auth::guard('alumni')->user();
        
        return view('alumni.selesai', compact('alumni'));
    }
}