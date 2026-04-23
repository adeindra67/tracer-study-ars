<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenggunaController extends Controller
{
    // =====================================
    // TAHAP 1 & 2: PENCARIAN (Metode GET)
    // =====================================
    public function index()
    {
        return view('pengguna.index');
    }

    public function hasil(Request $request)
    {
        $nama = $request->input('nama');
        
        if (!$nama) return redirect()->route('pengguna.index');

        $alumni_list = DB::table('alumni')->where('nama', 'LIKE', '%' . $nama . '%')->get();

        // CEK STATUS EVALUASI: Apakah alumni ini sudah dinilai tahun ini?
        $tahunSekarang = Carbon::now()->year;
        $tracerStudi = DB::table('tracer_studi')->where('tahun', $tahunSekarang)->first();

        foreach ($alumni_list as $alumni) {
            if ($tracerStudi) {
                $alumni->sudah_dinilai = DB::table('pengguna')
                    ->join('pengguna_tracer', 'pengguna.pengguna_no', '=', 'pengguna_tracer.pengguna_no')
                    ->where('pengguna.alumni_no', $alumni->alumni_no)
                    ->where('pengguna_tracer.tracer_studi_no', $tracerStudi->tracer_studi_no)
                    ->exists();
            } else {
                $alumni->sudah_dinilai = false;
            }
        }

        return view('pengguna.hasil', compact('alumni_list', 'nama'));
    }

    // =====================================
    // TAHAP 3: VERIFIKASI (Parameter URL)
    // =====================================
    public function verifikasi($alumni_no)
    {
        $alumni = DB::table('alumni')->where('alumni_no', $alumni_no)->first();
        if (!$alumni) return redirect()->route('pengguna.index');

        // KEAMANAN GANDA: Blokir akses URL langsung jika sudah dinilai
        $tahunSekarang = Carbon::now()->year;
        $tracerStudi = DB::table('tracer_studi')->where('tahun', $tahunSekarang)->first();
        
        if ($tracerStudi) {
            $sudahDinilai = DB::table('pengguna')
                ->join('pengguna_tracer', 'pengguna.pengguna_no', '=', 'pengguna_tracer.pengguna_no')
                ->where('pengguna.alumni_no', $alumni_no)
                ->where('pengguna_tracer.tracer_studi_no', $tracerStudi->tracer_studi_no)
                ->exists();

            if ($sudahDinilai) {
                return redirect()->route('pengguna.hasil', ['nama' => $alumni->nama])
                    ->with('error', 'Maaf, evaluasi untuk alumni ini sudah diisi sebelumnya.');
            }
        }

        return view('pengguna.verifikasi', compact('alumni'));
    }

    public function prosesVerifikasi(Request $request, $alumni_no)
    {
        $request->validate(['tanggal_lahir' => 'required|date']);

        $alumni = DB::table('alumni')
            ->where('alumni_no', $alumni_no)
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (!$alumni) {
            return back()->with('error', 'Tanggal Lahir tidak sesuai. Silakan coba lagi.')->withInput();
        }

        session(['pengguna_alumni_no' => $alumni->alumni_no]);
        
        return redirect()->route('pengguna.dashboard');
    }

    // =====================================
    // TAHAP 4: KUESIONER
    // =====================================
    public function dashboard()
    {
        $alumni_no = session('pengguna_alumni_no');
        if (!$alumni_no) return redirect()->route('pengguna.index')->with('error', 'Silakan cari dan verifikasi alumni terlebih dahulu.');

        $alumni = DB::table('alumni')->where('alumni_no', $alumni_no)->first();
        if (!$alumni) return redirect()->route('pengguna.index');

        $kuesioner = DB::table('kuesioner_pengguna')->where('aktif', true)->get()->groupBy('grup');

        return view('pengguna.dashboard', compact('alumni', 'kuesioner'));
    }

    public function store(Request $request)
    {
        $alumni_no = session('pengguna_alumni_no');
        
        $request->validate([
            'nama' => 'required|string|max:255', 
            'perusahaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jawaban' => 'required|array', 
        ]);

        DB::beginTransaction();
        try {
            $penggunaNo = DB::table('pengguna')->insertGetId([
                'alumni_no' => $alumni_no,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'perusahaan' => $request->perusahaan,
                'tingkat' => $request->tingkat,
                'jabatan' => $request->jabatan,
                'created_at' => Carbon::now()
            ]);

            $tahunSekarang = Carbon::now()->year;
            $tracerStudi = DB::table('tracer_studi')->where('tahun', $tahunSekarang)->first();
            $tracerStudiNo = $tracerStudi ? $tracerStudi->tracer_studi_no : DB::table('tracer_studi')->insertGetId([
                'tahun' => $tahunSekarang, 'tgl_mulai' => Carbon::now()->format('Y-01-01'), 'tgl_selesai' => Carbon::now()->format('Y-12-31')
            ]);

            $penggunaTracerNo = DB::table('pengguna_tracer')->insertGetId([
                'tracer_studi_no' => $tracerStudiNo,
                'pengguna_no' => $penggunaNo,
                'created_at' => Carbon::now()
            ]);

            $insertDataJawaban = [];
            foreach ($request->jawaban as $kuesioner_id => $isi_jawaban) {
                $insertDataJawaban[] = [
                    'pengguna_no' => $penggunaNo,
                    'pengguna_tracer_no' => $penggunaTracerNo,
                    'kuesioner_pengguna_no' => $kuesioner_id,
                    'skor' => $isi_jawaban,
                    'created_at' => Carbon::now()
                ];
            }
            DB::table('pengguna_tracer_kuesioner')->insert($insertDataJawaban);

            DB::commit();
            session()->forget('pengguna_alumni_no'); 
            return redirect()->route('pengguna.selesai');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Kesalahan: ' . $e->getMessage());
        }
    }

    public function selesai() { return view('pengguna.selesai'); }
}