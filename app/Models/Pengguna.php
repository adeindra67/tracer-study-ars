<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_no';

    protected $fillable = [
        'alumni_no', 'nama', 'no_hp', 'email', 'perusahaan', 'tingkat', 'jabatan'
    ];

    // Relasi: HRD ini menilai Alumni siapa?
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_no', 'alumni_no');
    }

    // Relasi: HRD ini mengisi Tracer Studi apa saja?
    public function tracer()
    {
        return $this->hasMany(PenggunaTracer::class, 'pengguna_no', 'pengguna_no');
    }
}