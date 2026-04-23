<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Alumni
        Schema::create('alumni', function (Blueprint $table) {
            $table->id('alumni_no');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir'); // Wajib untuk verifikasi
            $table->string('prodi')->nullable();
            $table->year('lulus_tahun')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nik')->nullable(); // Sesuai PDF
            $table->string('npwp')->nullable(); // Sesuai PDF
            $table->string('email')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('bidang_kerja')->nullable(); // Sesuai dokumen dosen
            $table->string('perusahaan')->nullable();
            $table->string('tingkat')->nullable(); // Sesuai dokumen dosen
            $table->string('jabatan')->nullable();
            $table->timestamps();
        });

        // 2. Tabel TracerStudi (Master Periode)
        Schema::create('tracer_studi', function (Blueprint $table) {
            $table->id('tracer_studi_no');
            $table->year('tahun');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->year('lulus_tahun')->nullable(); 
            $table->timestamps();
        });

        // 3. Tabel Pengguna (Perusahaan/Mitra)
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('pengguna_no');
            $table->foreignId('alumni_no')->constrained('alumni', 'alumni_no')->cascadeOnDelete();
            $table->string('nama'); // Nama HRD/Penilai
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('perusahaan');
            $table->string('tingkat')->nullable();
            $table->string('jabatan'); // Jabatan HRD/Penilai
            $table->timestamps();
        });

        // 4. Tabel AlumniTracer (Relasi Alumni mengikuti Tracer)
        Schema::create('alumni_tracer', function (Blueprint $table) {
            $table->id('alumni_tracer_no');
            $table->foreignId('tracer_studi_no')->constrained('tracer_studi', 'tracer_studi_no')->cascadeOnDelete();
            $table->foreignId('alumni_no')->constrained('alumni', 'alumni_no')->cascadeOnDelete();
            $table->timestamps();
        });

        // 5. Tabel PenggunaTracer (Relasi Pengguna mengikuti Tracer)
        Schema::create('pengguna_tracer', function (Blueprint $table) {
            $table->id('pengguna_tracer_no');
            $table->foreignId('tracer_studi_no')->constrained('tracer_studi', 'tracer_studi_no')->cascadeOnDelete();
            $table->foreignId('pengguna_no')->constrained('pengguna', 'pengguna_no')->cascadeOnDelete();
            $table->timestamps();
        });

        // 6. Tabel KuesionerAlumni (Master Pertanyaan Alumni)
        Schema::create('kuesioner_alumni', function (Blueprint $table) {
            $table->id('kuesioner_alumni_no');
            $table->string('kode_dikti')->unique()->nullable(); 
            $table->string('grup'); // Dokumen dosen
            $table->integer('grup_urut')->default(1); // Dokumen dosen
            $table->text('indikator'); // Dokumen dosen (Pertanyaannya)
            $table->integer('indikator_urut')->default(1); // Dokumen dosen
            $table->string('tipe_jawaban'); // Kebutuhan Web
            $table->json('opsi_jawaban')->nullable(); // Kebutuhan Web
            $table->boolean('is_wajib')->default(true); // Kebutuhan Web
            $table->boolean('aktif')->default(true); // Dokumen dosen
            $table->timestamps();
        });

        // 7. Tabel KuesionerPengguna (Master Pertanyaan Mitra)
        Schema::create('kuesioner_pengguna', function (Blueprint $table) {
            $table->id('kuesioner_pengguna_no');
            $table->string('grup'); 
            $table->integer('grup_urut')->default(1); 
            $table->text('indikator'); 
            $table->integer('indikator_urut')->default(1); 
            $table->string('tipe_jawaban'); 
            $table->json('opsi_jawaban')->nullable(); 
            $table->boolean('aktif')->default(true); 
            $table->timestamps();
        });

        // 8. Tabel AlumniTracerKuesioner (Jawaban Kuesioner Alumni)
        Schema::create('alumni_tracer_kuesioner', function (Blueprint $table) {
            $table->id('alumni_tracer_kuesioner_no');
            $table->foreignId('alumni_tracer_no')->constrained('alumni_tracer', 'alumni_tracer_no')->cascadeOnDelete();
            $table->foreignId('kuesioner_alumni_no')->constrained('kuesioner_alumni', 'kuesioner_alumni_no')->cascadeOnDelete();
            $table->text('skor')->nullable(); // Dokumen Dosen pakai kata 'skor', isinya bisa text jawaban
            $table->timestamps();
        });

        // 9. Tabel PenggunaTracerKuesioner (Jawaban Kuesioner Pengguna)
        Schema::create('pengguna_tracer_kuesioner', function (Blueprint $table) {
            $table->id('pengguna_tracer_kuesioner_no');
            $table->foreignId('pengguna_no')->constrained('pengguna', 'pengguna_no')->cascadeOnDelete();
            $table->foreignId('pengguna_tracer_no')->constrained('pengguna_tracer', 'pengguna_tracer_no')->cascadeOnDelete();
            $table->foreignId('kuesioner_pengguna_no')->constrained('kuesioner_pengguna', 'kuesioner_pengguna_no')->cascadeOnDelete();
            $table->text('skor')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna_tracer_kuesioner');
        Schema::dropIfExists('alumni_tracer_kuesioner');
        Schema::dropIfExists('kuesioner_pengguna');
        Schema::dropIfExists('kuesioner_alumni');
        Schema::dropIfExists('pengguna_tracer');
        Schema::dropIfExists('alumni_tracer');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('tracer_studi');
        Schema::dropIfExists('alumni');
    }
};