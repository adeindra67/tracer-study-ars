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
            ['kode_dikti' => 'f8', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => true, 'pertanyaan' => 'Jelaskan Status anda saat ini?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Bekerja (full time/ part time)', 'Belum memungkinkan kerja', 'Wiraswasta', 'Melanjutkan pendidikan', 'Tidak kerja tetapi sedang mencari kerja'])],
            ['kode_dikti' => 'f504', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => true, 'pertanyaan' => 'Apakah anda telah mendapatkan pekerjaan <= 6 bulan/ termasuk bekerja sebelum lulus?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Ya', 'Tidak'])],
            ['kode_dikti' => 'f502', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => true, 'pertanyaan' => 'Dalam berapa bulan anda mendapatkan pekerjaan?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f505', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => false, 'pertanyaan' => 'Berapa rata-rata pendapatan anda perbulan? (take home pay)', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f5a1', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => true, 'pertanyaan' => 'Dimana lokasi tempat anda bekerja? Isikan nama provinsi lokasi anda bekerja.', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Banten', 'Bali', 'Sumatera Utara', 'Sulawesi Selatan', 'Kalimantan Timur', 'Luar Negeri'])],
            ['kode_dikti' => 'f5a2', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => true, 'pertanyaan' => 'Dimana lokasi tempat anda bekerja? isikan nama kota/kabupaten lokasi anda bekerja.', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Jakarta Pusat', 'Jakarta Selatan', 'Kota Bandung','Kabupaten Bandung', 'Surabaya', 'Semarang', 'Medan', 'Makassar', 'Denpasar'])],
            ['kode_dikti' => 'f1101', 'kategori' => 'Masa Tunggu Lulusan', 'is_wajib' => true, 'pertanyaan' => 'Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang?', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Instansi pemerintah', 'BUMN/BUMD', 'Institusi/Organisasi Multilateral', 'Organisasi non-profit/Lembaga Swadaya Masyarakat', 'Perusahaan swasta', 'Wiraswasta/perusahaan asing'])],

            // ================= SECTION 2: NAMA PERUSAHAAN / WIRAUSAHA =================
            ['kode_dikti' => 'f5b', 'kategori' => 'Nama Perusahaan / Wirausaha', 'is_wajib' => true, 'pertanyaan' => 'Apa nama perusahaan/kantor tempat anda bekerja?', 'tipe_jawaban' => 'text', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f5c', 'kategori' => 'Nama Perusahaan / Wirausaha', 'is_wajib' => false, 'pertanyaan' => 'Bila berwiraswasta, apa profesi/jabatan anda saat ini?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Founder', 'Co-founder', 'Staff', 'Freelance/kerja lepas'])],
            ['kode_dikti' => 'f5d', 'kategori' => 'Nama Perusahaan / Wirausaha', 'is_wajib' => true, 'pertanyaan' => 'Apa tingkat tempat kerja anda?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Lokal/wilayah/wiraswasta/tidak berbadan hukum', 'Nasional/wiraswasta berbadan hukum', 'Multinasional/internasional'])],

            // ================= SECTION 3: PERTANYAAN STUDI LANJUT =================
            ['kode_dikti' => 'f18a', 'kategori' => 'Pertanyaan Studi Lanjut', 'is_wajib' => true, 'pertanyaan' => 'Sumber biaya', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Biaya sendiri', 'Beasiswa', 'Tidak lanjut S2'])],
            ['kode_dikti' => 'f18b', 'kategori' => 'Pertanyaan Studi Lanjut', 'is_wajib' => true, 'pertanyaan' => 'Nama perguruan tinggi (jika tidak lanjut kuliah S2 gunakan tanda (-))', 'tipe_jawaban' => 'text', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f18c', 'kategori' => 'Pertanyaan Studi Lanjut', 'is_wajib' => true, 'pertanyaan' => 'Program Studi (jika tidak lanjut kuliah S2 gunakan tanda (-))', 'tipe_jawaban' => 'text', 'opsi_jawaban' => null],
            
            // REVISI: f18d sekarang menggunakan tipe 'date' dan is_wajib false
            ['kode_dikti' => 'f18d', 'kategori' => 'Pertanyaan Studi Lanjut', 'is_wajib' => false, 'pertanyaan' => 'Tanggal masuk (S2)', 'tipe_jawaban' => 'date', 'opsi_jawaban' => null],
            
            ['kode_dikti' => 'f1201', 'kategori' => 'Pertanyaan Studi Lanjut', 'is_wajib' => true, 'pertanyaan' => 'Sebutkan sumberdana dalam pembiayaan kuliah diploma/sarjana? (bukan ketika studi lanjut)', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Biaya sendiri/keluarga', 'Beasiswa ADIK', 'Beasiswa bidikmisi/KIP', 'Beasiswa PPA', 'Beasiswa afirmasi', 'Beasiswa perusahaan/swasta'])],

            // ================= SECTION 4: HUBUNGAN BIDANG STUDI =================
            ['kode_dikti' => 'f14', 'kategori' => 'Hubungan Bidang Studi dengan Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Seberapa erat hubungan bidang studi dengan pekerjaan anda?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat erat', 'Erat', 'Cukup Erat', 'Kurang Erat', 'Tidak sama sekali'])],
            ['kode_dikti' => 'f15', 'kategori' => 'Hubungan Bidang Studi dengan Pekerjaan', 'is_wajib' => false, 'pertanyaan' => 'Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan saat ini?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Setingkat Lebih tinggi', 'Tingkat yang sama', 'Setingkat lebih rendah', 'Tidak perlu pendidikan tinggi'])],

            // ================= SECTION 5: KOMPETENSI SAAT KULIAH =================
            ['kode_dikti' => 'f1761', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian Etika Anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1763', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian Keahlian berdasarkan bidang ilmu anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1765', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian Bahasa Inggris Anda saat Kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1767', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian penggunaan teknologi informasi anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1769', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian Komunikasi Anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1771', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian Kerja sama Tim Anda saat Kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1773', 'kategori' => 'Kompetensi Saat Kuliah', 'is_wajib' => false, 'pertanyaan' => 'Penilaian pengembangan anda saat kuliah?', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],

            // ================= SECTION 6: KOMPETENSI DI PEKERJAAN =================
            ['kode_dikti' => 'f1762', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Etika', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1764', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Keahlian berdasarkan bidang ilmu', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1766', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Bahasa inggris', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1768', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Penggunaan teknologi informasi', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1770', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Komunikasi', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1772', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Kerja sama tim', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1774', 'kategori' => 'Kompetensi di Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Pengembangan diri', 'tipe_jawaban' => 'scale', 'opsi_jawaban' => null],

            // ================= SECTION 7: METODE PEMBELAJARAN =================
            ['kode_dikti' => 'f21', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Perkuliahan', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f22', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Demonstrasi', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f23', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Partisipasi dalam proyek riset', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f24', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Magang', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f25', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Pratikum', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f26', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Kerja Lapangan', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],
            ['kode_dikti' => 'f27', 'kategori' => 'Metode Pembelajaran', 'is_wajib' => true, 'pertanyaan' => 'Diskusi', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak sama Sekali'])],

            // ================= SECTION 8: MENCARI PEKERJAAN =================
            ['kode_dikti' => 'f301', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Kapan anda mulai mencari pekerjaan? Mohon pekerjaan sembilan tidak dimasukkan', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['Sebelum lulus kuliah', 'Sesudah lulus kuliah', 'Saya tidak mencari kerja'])],
            ['kode_dikti' => 'f302', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => false, 'pertanyaan' => 'Kapan anda mulai mencari pekerjaan? Bila jawaban sebelum lulus, kira-kira berapa bulan sebelum lulus?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['1 bulan', '2 bulan', '3 bulan', '4 bulan', '5 bulan', '6 bulan', '> 6 bulan'])],
            ['kode_dikti' => 'f303', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => false, 'pertanyaan' => 'Kapan anda mulai mencari pekerjaan? Bila jawaban sesudah lulus, kira-kira berapa bulan sesudah lulus?', 'tipe_jawaban' => 'radio', 'opsi_jawaban' => json_encode(['1 bulan', '2 bulan', '3 bulan', '4 bulan', '5 bulan', '6 bulan', '> 6 bulan'])],
            ['kode_dikti' => 'f4', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Bagaimana anda mencari pekerjaan tersebut? jawaban bisa lebih dari satu.', 'tipe_jawaban' => 'checkbox', 'opsi_jawaban' => json_encode([
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
            ['kode_dikti' => 'f6', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Berapa perusahaan/instansi/institusi yang sudah anda lamar (lewat surat atau e-mail) sebelum anda memeroleh pekerjaan pertama?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f7', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Berapa banyak perusahaan/instansi/institusi yang merespons lamaran anda?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f7a', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Berapa banyak perusahaan/instansi/institusi yang mengundang anda untuk wawancara?', 'tipe_jawaban' => 'number', 'opsi_jawaban' => null],
            ['kode_dikti' => 'f1001', 'kategori' => 'Mencari Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Apakah anda aktif mencari pekerjaan dalam 4 Minggu terakhir?', 'tipe_jawaban' => 'radio_lainnya', 'opsi_jawaban' => json_encode(['Tidak', 'Tidak, tapi saya sedang menunggu hasil lamaran kerja', 'Ya, saya akan mulai bekerja dalam 2 minggu ke depan', 'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan'])],

            // ================= SECTION 9: KETIDAKSESUAIAN PEKERJAAN =================
            ['kode_dikti' => 'f16', 'kategori' => 'Ketidaksesuaian Pekerjaan', 'is_wajib' => true, 'pertanyaan' => 'Jika menurut anda pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa mengambilnya? (Jawaban bisa lebih dari satu)', 'tipe_jawaban' => 'checkbox_lainnya', 'opsi_jawaban' => json_encode([
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

        foreach ($kuesioner as $data) {
            DB::table('kuesioner_alumni')->insert(array_merge($data, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}