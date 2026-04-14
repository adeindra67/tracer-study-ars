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
    Schema::create('jawaban_kuesioner', function (Blueprint $table) {
        $table->id();
        $table->string('nim'); // Untuk tahu siapa yang menjawab
        $table->unsignedBigInteger('kuesioner_id'); // ID dari pertanyaan
        $table->text('jawaban')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuesioners');
    }
};
