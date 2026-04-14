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
    Schema::table('kuesioner_alumni', function (Blueprint $table) {
        $table->string('kategori')->nullable()->after('opsi_jawaban');
        $table->boolean('is_wajib')->default(true)->after('kategori');
    });
}

public function down(): void
{
    Schema::table('kuesioner_alumni', function (Blueprint $table) {
        $table->dropColumn(['kategori', 'is_wajib']);
    });
}
};
