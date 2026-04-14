<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KuesionerSeeder extends Seeder
{
    public function run(): void
    {
        $kuesioner = [
            [
                'kode_dikti' => 'f8',
                'pertanyaan' => 'Jelaskan status Anda saat ini?',
                'tipe_jawaban' => 'radio', // Pilihan tunggal
                'opsi_jawaban' => json_encode([
                    '1' => 'Bekerja (full time / part time)',
                    '2' => 'Belum memungkinkan bekerja',
                    '3' => 'Wiraswasta',
                    '4' => 'Melanjutkan Pendidikan',
                    '5' => 'Tidak kerja tetapi sedang mencari kerja'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_dikti' => 'f505',
                'pertanyaan' => 'Berapa rata-rata pendapatan Anda per bulan? (take home pay)?',
                'tipe_jawaban' => 'number', // Isian angka
                'opsi_jawaban' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_dikti' => 'f1101',
                'pertanyaan' => 'Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang?',
                'tipe_jawaban' => 'radio',
                'opsi_jawaban' => json_encode([
                    '1' => 'Instansi pemerintah',
                    '6' => 'BUMN/BUMD',
                    '7' => 'Institusi/Organisasi Multilateral',
                    '2' => 'Organisasi non-profit/Lembaga Swadaya Masyarakat',
                    '3' => 'Perusahaan swasta',
                    '4' => 'Wiraswasta/perusahaan sendiri',
                    '5' => 'Lainnya'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_dikti' => 'f14',
                'pertanyaan' => 'Seberapa erat hubungan bidang studi dengan pekerjaan Anda?',
                'tipe_jawaban' => 'radio',
                'opsi_jawaban' => json_encode([
                    '1' => 'Sangat Erat',
                    '2' => 'Erat',
                    '3' => 'Cukup Erat',
                    '4' => 'Kurang Erat',
                    '5' => 'Tidak Sama Sekali'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('kuesioner_alumni')->insert($kuesioner);
    }
}