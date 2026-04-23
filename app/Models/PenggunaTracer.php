<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaTracer extends Model
{
    use HasFactory;

    protected $table = 'pengguna_tracer';
    protected $primaryKey = 'pengguna_tracer_no';

    protected $fillable = ['tracer_studi_no', 'pengguna_no'];

    public function tracerStudi()
    {
        return $this->belongsTo(TracerStudi::class, 'tracer_studi_no', 'tracer_studi_no');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_no', 'pengguna_no');
    }

    public function detailJawaban()
    {
        return $this->hasMany(PenggunaTracerKuesioner::class, 'pengguna_tracer_no', 'pengguna_tracer_no');
    }
}