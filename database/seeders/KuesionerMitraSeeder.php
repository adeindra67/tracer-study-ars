<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KuesionerMitraSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('kuesioner_mitra')->truncate();
        Schema::enableForeignKeyConstraints();

        $kuesioner = [
            // A. ETIKA
            ['kategori' => 'A. Etika', 'pertanyaan' => 'Ketaatan terhadap peraturan', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'A. Etika', 'pertanyaan' => 'Sikap sopan santun baik terhadap atasan maupun sesama rekan kerja', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'A. Etika', 'pertanyaan' => 'Tata cara dalam memberikan saran dan kritik kepada atasan maupun rekan kerja', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'A. Etika', 'pertanyaan' => 'Tidak melemparkan tanggung-jawab kepada orang lain ketika melakukan kesalahan', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'A. Etika', 'pertanyaan' => 'Tidak menyalahgunakan wewenang (misalnya melaporkan penggunaan biaya operasional dll sesuai apa adanya)', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'A. Etika', 'pertanyaan' => 'Tidak melakukan hal-hal yang tidak ada kaitannya dengan tugas kerja selama berada di tempat kerja', 'tipe_jawaban' => 'scale4'],

            // B. KEAHLIAN
            ['kategori' => 'B. Keahlian Pada Bidang Ilmu', 'pertanyaan' => 'Ketepatan waktu dalam menyelesaikan tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'B. Keahlian Pada Bidang Ilmu', 'pertanyaan' => 'Ketepatan hasil dalam menyelesaikan tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'B. Keahlian Pada Bidang Ilmu', 'pertanyaan' => 'Tanggung jawab terhadap penyelesaian tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'B. Keahlian Pada Bidang Ilmu', 'pertanyaan' => 'Tanggung jawab di tempat tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'B. Keahlian Pada Bidang Ilmu', 'pertanyaan' => 'Penguasaan terhadap bidang tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'B. Keahlian Pada Bidang Ilmu', 'pertanyaan' => 'Pengetahuan terhadap bidang tugas bagian atau orang lain', 'tipe_jawaban' => 'scale4'],

            // C. BAHASA ASING
            ['kategori' => 'C. Kemampuan Berbahasa Asing', 'pertanyaan' => 'Kemampuan Alumni berbahasa Inggris secara lisan dan tulisan', 'tipe_jawaban' => 'scale4'],

            // D. TEKNOLOGI INFORMASI
            ['kategori' => 'D. Penggunaan Teknologi Informasi', 'pertanyaan' => 'Kemampuan Alumni menggunakan peralatan modern', 'tipe_jawaban' => 'scale4'],

            // E. KOMUNIKASI
            ['kategori' => 'E. Kemampuan Berkomunikasi', 'pertanyaan' => 'Kemampuan berkomunikasi, seperti mengemukakan pendapat', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'E. Kemampuan Berkomunikasi', 'pertanyaan' => 'Penguasaan terhadap pengambilan keputusan pada saat situasi yang mendesak', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'E. Kemampuan Berkomunikasi', 'pertanyaan' => 'Ketegasan tindakan', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'E. Kemampuan Berkomunikasi', 'pertanyaan' => 'Kemampuan menentukan prioritas', 'tipe_jawaban' => 'scale4'],

            // F. KERJASAMA TIM
            ['kategori' => 'F. Kerjasama Tim', 'pertanyaan' => 'Kemampuan kerjasama dalam tim', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'F. Kerjasama Tim', 'pertanyaan' => 'Penerimaan terhadap keputusan yang telah ditetapkan perusahaan', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'F. Kerjasama Tim', 'pertanyaan' => 'Pengutamaan terhadap kepentingan umum yang bertujuan untuk mencapai target perusahaan', 'tipe_jawaban' => 'scale4'],

            // G. PENGEMBANGAN DIRI
            ['kategori' => 'G. Pengembangan Diri', 'pertanyaan' => 'Kecakapan kerja Alumni dalam melaksanakan tugas atau perintah atasan', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'G. Pengembangan Diri', 'pertanyaan' => 'Keterampilan Alumni dalam menyelesaikan tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'G. Pengembangan Diri', 'pertanyaan' => 'Kesungguhan Alumni dalam melaksanakan tugas', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'G. Pengembangan Diri', 'pertanyaan' => 'Kesegaran dan kesehatan Alumni (tingkat kehadiran)', 'tipe_jawaban' => 'scale4'],
            ['kategori' => 'G. Pengembangan Diri', 'pertanyaan' => 'Inisiatif atau kreativitas untuk melakukan hal-hal baru', 'tipe_jawaban' => 'scale4'],

            // SARAN & KRITIK
            ['kategori' => 'H. Saran & Kritik', 'pertanyaan' => 'Berikan saran dan kritik Anda untuk pengembangan lulusan kami ke depannya:', 'tipe_jawaban' => 'textarea'],
        ];

        foreach ($kuesioner as $data) {
            DB::table('kuesioner_mitra')->insert(array_merge($data, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}