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
        Schema::create('alumni_tracer', function (Blueprint $table) {
            $table->id('alumni_tracer_no');
            $table->foreignId('tracer_studi_no')->constrained('tracer_studi', 'tracer_studi_no')->cascadeOnDelete();
            $table->foreignId('alumni_no')->constrained('alumni', 'alumni_no')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_tracers');
    }
};
