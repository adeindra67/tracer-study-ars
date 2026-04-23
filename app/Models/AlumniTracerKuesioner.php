<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniTracerKuesioner extends Model
{
    use HasFactory;

    protected $table = 'alumni_tracer_kuesioner';
    // Tabel ini menggunakan auto-increment 'id' sebagai primary key bawaan Laravel, jadi tidak perlu di-override.

    protected $fillable = ['alumni_tracer_no', 'kuesioner_alumni_no', 'skor'];

    // Relasi ke Transaksi Utamanya
    public function alumniTracer()
    {
        return $this->belongsTo(AlumniTracer::class, 'alumni_tracer_no', 'alumni_tracer_no');
    }

    // Relasi: Ini jawaban dari pertanyaan kuesioner yang mana?
    public function kuesioner()
    {
        return $this->belongsTo(KuesionerAlumni::class, 'kuesioner_alumni_no', 'kuesioner_alumni_no');
    }
}