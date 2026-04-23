<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniTracer extends Model
{
    use HasFactory;

    protected $table = 'alumni_tracer';
    protected $primaryKey = 'alumni_tracer_no';

    protected $fillable = ['tracer_studi_no', 'alumni_no'];

    // Relasi ke Master Periode
    public function tracerStudi()
    {
        return $this->belongsTo(TracerStudi::class, 'tracer_studi_no', 'tracer_studi_no');
    }

    // Relasi ke Siapa alumninya
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_no', 'alumni_no');
    }

    // Relasi ke Detail Jawaban-jawabannya
    public function detailJawaban()
    {
        return $this->hasMany(AlumniTracerKuesioner::class, 'alumni_tracer_no', 'alumni_tracer_no');
    }
}