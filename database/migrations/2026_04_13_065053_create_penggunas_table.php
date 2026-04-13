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
    Schema::create('pengguna', function (Blueprint $table) {
        $table->id('pengguna_no');
        $table->foreignId('alumni_no')->constrained('alumni', 'alumni_no')->cascadeOnDelete();
        $table->string('nama'); // Nama pengisi (atasan/mitra)
        $table->string('no_hp');
        $table->string('email');
        $table->string('perusahaan');
        $table->string('tingkat');
        $table->string('jabatan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
