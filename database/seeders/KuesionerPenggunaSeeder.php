<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KuesionerPenggunaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        // Ubah nama tabel tujuan menjadi kuesioner_pengguna sesuai database dosen
        DB::table('kuesioner_pengguna')->truncate();
        Schema::enableForeignKeyConstraints();

        // Kategori diubah jadi "grup", Pertanyaan diubah jadi "indikator"
        $kuesioner = [
            // A. ETIKA
            ['grup' => 'A. Etika', 'indikator' => 'Ketaatan terhadap peraturan', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'A. Etika', 'indikator' => 'Sikap sopan santun baik terhadap atasan maupun sesama rekan kerja', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'A. Etika', 'indikator' => 'Tata cara dalam memberikan saran dan kritik kepada atasan maupun rekan kerja', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'A. Etika', 'indikator' => 'Tidak melemparkan tanggung-jawab kepada orang lain ketika melakukan kesalahan', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'A. Etika', 'indikator' => 'Tidak menyalahgunakan wewenang (misalnya melaporkan penggunaan biaya operasional dll sesuai apa adanya)', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'A. Etika', 'indikator' => 'Tidak melakukan hal-hal yang tidak ada kaitannya dengan tugas kerja selama berada di tempat kerja', 'tipe_jawaban' => 'scale4'],

            // B. KEAHLIAN
            ['grup' => 'B. Keahlian Pada Bidang Ilmu', 'indikator' => 'Ketepatan waktu dalam menyelesaikan tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'B. Keahlian Pada Bidang Ilmu', 'indikator' => 'Ketepatan hasil dalam menyelesaikan tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'B. Keahlian Pada Bidang Ilmu', 'indikator' => 'Tanggung jawab terhadap penyelesaian tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'B. Keahlian Pada Bidang Ilmu', 'indikator' => 'Tanggung jawab di tempat tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'B. Keahlian Pada Bidang Ilmu', 'indikator' => 'Penguasaan terhadap bidang tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'B. Keahlian Pada Bidang Ilmu', 'indikator' => 'Pengetahuan terhadap bidang tugas bagian atau orang lain', 'tipe_jawaban' => 'scale4'],

            // C. BAHASA ASING
            ['grup' => 'C. Kemampuan Berbahasa Asing', 'indikator' => 'Kemampuan Alumni berbahasa Inggris secara lisan dan tulisan', 'tipe_jawaban' => 'scale4'],

            // D. TEKNOLOGI INFORMASI
            ['grup' => 'D. Penggunaan Teknologi Informasi', 'indikator' => 'Kemampuan Alumni menggunakan peralatan modern', 'tipe_jawaban' => 'scale4'],

            // E. KOMUNIKASI
            ['grup' => 'E. Kemampuan Berkomunikasi', 'indikator' => 'Kemampuan berkomunikasi, seperti mengemukakan pendapat', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'E. Kemampuan Berkomunikasi', 'indikator' => 'Penguasaan terhadap pengambilan keputusan pada saat situasi yang mendesak', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'E. Kemampuan Berkomunikasi', 'indikator' => 'Ketegasan tindakan', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'E. Kemampuan Berkomunikasi', 'indikator' => 'Kemampuan menentukan prioritas', 'tipe_jawaban' => 'scale4'],

            // F. KERJASAMA TIM
            ['grup' => 'F. Kerjasama Tim', 'indikator' => 'Kemampuan kerjasama dalam tim', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'F. Kerjasama Tim', 'indikator' => 'Penerimaan terhadap keputusan yang telah ditetapkan perusahaan', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'F. Kerjasama Tim', 'indikator' => 'Pengutamaan terhadap kepentingan umum yang bertujuan untuk mencapai target perusahaan', 'tipe_jawaban' => 'scale4'],

            // G. PENGEMBANGAN DIRI
            ['grup' => 'G. Pengembangan Diri', 'indikator' => 'Kecakapan kerja Alumni dalam melaksanakan tugas atau perintah atasan', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'G. Pengembangan Diri', 'indikator' => 'Keterampilan Alumni dalam menyelesaikan tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'G. Pengembangan Diri', 'indikator' => 'Kesungguhan Alumni dalam melaksanakan tugas', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'G. Pengembangan Diri', 'indikator' => 'Kesegaran dan kesehatan Alumni (tingkat kehadiran)', 'tipe_jawaban' => 'scale4'],
            ['grup' => 'G. Pengembangan Diri', 'indikator' => 'Inisiatif atau kreativitas untuk melakukan hal-hal baru', 'tipe_jawaban' => 'scale4'],

            // SARAN & KRITIK
            ['grup' => 'H. Saran & Kritik', 'indikator' => 'Berikan saran dan kritik Anda untuk pengembangan lulusan kami ke depannya:', 'tipe_jawaban' => 'textarea'],
        ];

        // Logika untuk memberikan nomor urut pada 'grup' dan 'indikator' secara otomatis
        $currentGrup = '';
        $grupUrut = 0;
        $indikatorUrut = 1;

        foreach ($kuesioner as $data) {
            // Jika nama grup berganti, nomor urut grup ditambah 1, dan nomor indikator di-reset jadi 1
            if ($currentGrup !== $data['grup']) {
                $currentGrup = $data['grup'];
                $grupUrut++;
                $indikatorUrut = 1;
            }

            DB::table('kuesioner_pengguna')->insert(array_merge($data, [
                'grup_urut' => $grupUrut,
                'indikator_urut' => $indikatorUrut,
                'created_at' => now(),
                'updated_at' => now()
            ]));

            $indikatorUrut++;
        }
    }
}