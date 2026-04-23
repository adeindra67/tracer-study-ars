<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaTracerKuesioner extends Model
{
    use HasFactory;

    protected $table = 'pengguna_tracer_kuesioner';

    // Tambahkan 'pengguna_no' jika Anda menyimpannya juga di controller
    protected $fillable = ['pengguna_no', 'pengguna_tracer_no', 'kuesioner_pengguna_no', 'skor'];

    public function penggunaTracer()
    {
        return $this->belongsTo(PenggunaTracer::class, 'pengguna_tracer_no', 'pengguna_tracer_no');
    }

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerPengguna::class, 'kuesioner_pengguna_no', 'kuesioner_pengguna_no');
    }
}