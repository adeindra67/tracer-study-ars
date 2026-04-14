<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id('alumni_no');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir'); 
            $table->string('prodi')->nullable();
            $table->year('lulus_tahun')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nik')->nullable(); 
            $table->string('npwp')->nullable();
            $table->string('email')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
