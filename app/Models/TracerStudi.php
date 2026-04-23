<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudi extends Model
{
    use HasFactory;

    protected $table = 'tracer_studi';
    protected $primaryKey = 'tracer_studi_no';
    public $timestamps = false; // Tabel ini tidak punya created_at & updated_at

    protected $fillable = ['tahun', 'tgl_mulai', 'tgl_selesai'];

    // Relasi: Data tracer alumni yang masuk di tahun ini
    public function alumniTracer()
    {
        return $this->hasMany(AlumniTracer::class, 'tracer_studi_no', 'tracer_studi_no');
    }

    // Relasi: Data tracer pengguna/mitra yang masuk di tahun ini
    public function penggunaTracer()
    {
        return $this->hasMany(PenggunaTracer::class, 'tracer_studi_no', 'tracer_studi_no');
    }
}