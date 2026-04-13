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
        Schema::create('kuesioner_alumni', function (Blueprint $table) {
            $table->id('kuesioner_alumni_no');
            $table->string('kode_dikti')->unique(); // Contoh: 'f8', 'f502', 'f1761'
            $table->text('pertanyaan');
            $table->string('tipe_jawaban'); // Contoh: 'radio', 'checkbox', 'essay'
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuesioner_alumnis');
    }
};
