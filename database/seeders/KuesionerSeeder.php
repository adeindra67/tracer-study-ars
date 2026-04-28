<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KuesionerSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('kuesioner_alumni')->truncate();
        Schema::enableForeignKeyConstraints();

        $kuesioner = [
            // ================= SECTION 1: MASA TUNGGU LULUSAN =================            
            ['kode_dikti' => 'f504', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Apakah anda telah mendapatkan pekerjaan <= 6 bulan / termasuk bekerja sebelum lulus?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Ya', 'Tidak'])],
            
            // Dipecah menjadi dua pertanyaan spesifik (Nanti disembunyikan/dimunculkan di Blade menggunakan if-else)
            ['kode_dikti' => 'f502', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Dalam berapa bulan Anda mendapatkan pekerjaan pertama?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f502b', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Dalam berapa bulan setelah lulus Anda memulai wiraswasta?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            
            ['kode_dikti' => 'f505', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Berapa rata-rata pendapatan anda perbulan? (take home pay)', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f5a1', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Dimana lokasi tempat anda bekerja? Isikan nama provinsi lokasi anda bekerja.', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Banten', 'Bali', 'Sumatera Utara', 'Sulawesi Selatan', 'Kalimantan Timur', 'Luar Negeri'])],
            ['kode_dikti' => 'f5a2', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Dimana lokasi tempat anda bekerja? isikan nama kota/kabupaten lokasi anda bekerja.', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Jakarta Pusat', 'Jakarta Selatan', 'Kota Bandung', 'Kabupaten Bandung', 'Surabaya', 'Semarang', 'Medan', 'Makassar', 'Denpasar'])],
            ['kode_dikti' => 'f1101', 'grup' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'indikator' => 'Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang?', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Instansi pemerintah', 'BUMN/BUMD', 'Institusi/Organisasi Multilateral', 'Organisasi non-profit/Lembaga Swadaya Masyarakat', 'Perusahaan swasta', 'Wiraswasta/perusahaan asing'])],

            // ================= SECTION 2: NAMA PERUSAHAAN / WIRAUSAHA =================
            ['kode_dikti' => 'f5c', 'grup' => 'Nama Perusahaan / Wirausaha', 'is_wajib' => false, 'indikator' => 'Bila berwiraswasta, apa profesi/jabatan anda saat ini?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Founder', 'Co-founder', 'Staff', 'Freelance/kerja lepas'])],

// ================= SECTION 3: PERTANYAAN STUDI LANJUT =================
            ['kode_dikti' => 'f18a', 'grup' => 'Pertanyaan Studi Lanjut', 'is_wajib' => false, 'indikator' => 'Sumber biaya Studi Lanjut Anda', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Biaya sendiri', 'Beasiswa', 'Lainnya'])],
            ['kode_dikti' => 'f18b', 'grup' => 'Pertanyaan Studi Lanjut', 'is_wajib' => false, 'indikator' => 'Nama perguruan tinggi tempat Studi Lanjut', 'tipe_jawaban' => 'text', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f18c', 'grup' => 'Pertanyaan Studi Lanjut', 'is_wajib' => false, 'indikator' => 'Nama Program Studi Lanjut', 'tipe_jawaban' => 'text', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f18d', 'grup' => 'Pertanyaan Studi Lanjut', 'is_wajib' => false, 'indikator' => 'Tanggal masuk Studi Lanjut', 'tipe_jawaban' => 'date', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1201', 'grup' => 'Pertanyaan Studi Lanjut', 'is_wajib' => true, 'indikator' => 'Sebutkan sumberdana dalam pembiayaan kuliah ketika berkuliah di ARS (Dahulu)?', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Biaya sendiri/keluarga', 'Beasiswa ADIK', 'Beasiswa bidikmisi/KIP', 'Beasiswa PPA', 'Beasiswa afirmasi', 'Beasiswa perusahaan/swasta'])],

            // ================= SECTION 4: HUBUNGAN BIDANG STUDI =================
            ['kode_dikti' => 'f14', 'grup' => 'Hubungan Bidang Studi dengan Pekerjaan', 'is_wajib' => false, 'indikator' => 'Seberapa erat hubungan bidang studi dengan pekerjaan anda?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat erat', 'Erat', 'Cukup Erat', 'Kurang Erat', 'Tidak sama sekali'])],
            ['kode_dikti' => 'f15', 'grup' => 'Hubungan Bidang Studi dengan Pekerjaan', 'is_wajib' => false, 'indikator' => 'Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan saat ini?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Setingkat Lebih tinggi', 'Tingkat yang sama', 'Setingkat lebih rendah', 'Tidak perlu pendidikan tinggi'])],
            
            // ================= SECTION 5: KOMPTENSI DI KULIAH? =================
            ['kode_dikti' => 'f1761', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian Etika Anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1763', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian Keahlian berdasarkan bidang ilmu anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1765', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian Bahasa Inggris Anda saat Kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1767', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian penggunaan teknologi informasi anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1769', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian Komunikasi Anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1771', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian Kerja sama Tim Anda saat Kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1773', 'grup' => 'Kompetensi Anda di Kuliah', 'is_wajib' => true, 'indikator' => 'Penilaian pengembangan anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],

            // ================= SECTION 6:KOMPETENSI DI PEKERJAAN? =================
            ['kode_dikti' => 'f1762', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Etika', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1764', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Keahlian berdasarkan bidang ilmu', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1766', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Bahasa inggris', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1768', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Penggunaan teknologi informasi', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1770', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Komunikasi', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1772', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Kerja sama tim', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1774', 'grup' => 'Kompetensi Anda di pekerjaan', 'is_wajib' => true, 'indikator' => 'Pengembangan diri', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],

            // ================= SECTION 7: METODE PEMBELAJARAN =================
            ['kode_dikti' => 'f21', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Perkuliahan', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f22', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Demonstrasi', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f23', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Partisipasi dalam proyek riset', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f24', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Magang', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f25', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Pratikum', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f26', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Kerja Lapangan', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f27', 'grup' => 'Seberapa besar penekanan metode pembelajaran berikut di program studi Anda?', 'is_wajib' => true, 'indikator' => 'Diskusi', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],

            // ================= SECTION 8: MENCARI PEKERJAAN =================
            ['kode_dikti' => 'f301', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => false, 'indikator' => 'Kapan anda mulai mencari pekerjaan? Mohon pekerjaan sembilan tidak dimasukkan', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sebelum lulus kuliah', 'Sesudah lulus kuliah', 'Saya tidak mencari kerja'])],
            ['kode_dikti' => 'f302', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => false, 'indikator' => 'Kapan anda mulai mencari pekerjaan? Bila jawaban sebelum lulus, kira-kira berapa bulan sebelum lulus?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['1 bulan', '2 bulan', '3 bulan', '4 bulan', '5 bulan', '6 bulan', '> 6 bulan'])],
            ['kode_dikti' => 'f303', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => false, 'indikator' => 'Kapan anda mulai mencari pekerjaan? Bila jawaban sesudah lulus, kira-kira berapa bulan sesudah lulus?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['1 bulan', '2 bulan', '3 bulan', '4 bulan', '5 bulan', '6 bulan', '> 6 bulan'])],
            ['kode_dikti' => 'f4', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => false, 'indikator' => 'Bagaimana anda mencari pekerjaan tersebut? jawaban bisa lebih dari satu.', 'tipe_jawaban' => 'checkbox', 'opsi_jawaban' => json_encode([
                'Melalui iklan di koran/majalah, brosur.',
                'Melamar ke perusahaan tanpa mengetahui lowongan yang ada.',
                'Pergi ke bursa/pameran kerja.',
                'Mencari lewat internet/iklan online/milis.',
                'Dihubungi oleh perusahaan.',
                'Menghubungi Kemenakertrans.',
                'Menghubungi agen tenaga kerja komersial/swasta.',
                'Memeroleh informasi dari pusat/kantor pengembangan karir fakultas/universitas (f408).',
                'Menghubungi kantor kemahasiswaan/hubungan alumni.',
                'Membangun jejaring (network) sejak masih kuliah.',
                'Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll).',
                'Membangun bisnis sendiri.',
                'Melalui penempatan kerja atau magang.',
                'Bekerja di tempat yang sama dengan tempat kerja semasa kuliah.'
            ])],
            ['kode_dikti' => 'f6', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => true, 'indikator' => 'Berapa perusahaan/instansi/institusi yang sudah anda lamar (lewat surat atau e-mail) sebelum anda memeroleh pekerjaan pertama?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f7', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => true, 'indikator' => 'Berapa banyak perusahaan/instansi/institusi yang merespons lamaran anda?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f7a', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => true, 'indikator' => 'Berapa banyak perusahaan/instansi/institusi yang mengundang anda untuk wawancara?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1001', 'grup' => 'Mencari Pekerjaan', 'is_wajib' => true, 'indikator' => 'Apakah anda aktif mencari pekerjaan dalam 4 Minggu terakhir?', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Tidak', 'Tidak, tapi saya sedang menunggu hasil lamaran kerja', 'Ya, saya akan mulai bekerja dalam 2 minggu ke depan', 'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan'])],

            // ================= SECTION 9: KETIDAKSESUAIAN PEKERJAAN =================
            ['kode_dikti' => 'f16', 'grup' => 'Ketidaksesuaian Pekerjaan', 'is_wajib' => false, 'indikator' => 'Jika menurut anda pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa mengambilnya? (Jawaban bisa lebih dari satu)', 'tipe_jawaban' => 'checkbox_lainnya', 'opsi_jawaban' => json_encode([
                'Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah sesuai dengan pendidikan saya.',
                'Saya belum mendapatkan pekerjaan yang lebih sesuai.',
                'Di pekerjaan ini saya memeroleh prospek karir yang baik.',
                'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya.',
                'Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya.',
                'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini.',
                'Pekerjaan saya saat ini lebih aman/terjamin/secure',
                'Pekerjaan saya saat ini lebih menarik',
                'Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll.',
                'Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya.',
                'Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya.',
                'Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya'
            ])],
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

            DB::table('kuesioner_alumni')->insert(array_merge($data, [
                'grup_urut' => $grupUrut,
                'indikator_urut' => $indikatorUrut,
                'created_at' => now(),
                'updated_at' => now()
            ]));

            // Naikkan nomor urut indikator untuk pertanyaan berikutnya
            $indikatorUrut++;
        }
    }
}