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
        Schema::create('alumni_tracer_kuesioner', function (Blueprint $table) {
            $table->id('alumni_tracer_kuesioner_no');
            $table->foreignId('alumni_tracer_no')->constrained('alumni_tracer', 'alumni_tracer_no')->cascadeOnDelete();
            $table->foreignId('kuesioner_alumni_no')->constrained('kuesioner_alumni', 'kuesioner_alumni_no')->cascadeOnDelete();
            $table->text('jawaban'); // Kita pakai text agar bisa menampung angka (1, 2) maupun esai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_tracer_kuesioners');
    }
};
