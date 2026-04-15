<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel 1: Menyimpan Identitas HRD/Perusahaan dan ke Alumni mana penilaian ini ditujukan
        Schema::create('penilaian_mitra', function (Blueprint $table) {
            $table->id();
            $table->string('nim'); // Relasi ke alumni yang dinilai
            $table->string('nama_penilai');
            $table->string('jabatan_penilai');
            $table->string('kontak_penilai')->nullable(); // Email atau No HP
            $table->string('nama_perusahaan');
            $table->text('alamat_perusahaan')->nullable();
            $table->string('sektor_perusahaan')->nullable();
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('alumni')->onDelete('cascade');
        });

        // Tabel 2: Menyimpan Daftar Pertanyaan Master (Sesuai PDF)
        Schema::create('kuesioner_mitra', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->text('pertanyaan');
            $table->string('tipe_jawaban'); // 'scale4' atau 'text'
            $table->timestamps();
        });

        // Tabel 3: Menyimpan Jawaban Detail dari HRD (1 sampai 4, dan Saran)
        Schema::create('jawaban_mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id')->constrained('penilaian_mitra')->onDelete('cascade');
            $table->foreignId('kuesioner_mitra_id')->constrained('kuesioner_mitra')->onDelete('cascade');
            $table->text('jawaban')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_mitra');
        Schema::dropIfExists('kuesioner_mitra');
        Schema::dropIfExists('penilaian_mitra');
    }
};