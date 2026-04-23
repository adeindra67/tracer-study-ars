<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerAlumni extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_alumni';
    protected $primaryKey = 'kuesioner_alumni_no';
    public $timestamps = false;

    protected $fillable = ['pertanyaan', 'grup', 'is_wajib', 'tipe_jawaban', 'opsi_jawaban', 'aktif'];

    // Casting agar JSON berubah otomatis menjadi Array di PHP
    protected $casts = [
        'opsi_jawaban' => 'array',
        'is_wajib' => 'boolean',
        'aktif' => 'boolean',
    ];

    public function jawaban()
    {
        return $this->hasMany(AlumniTracerKuesioner::class, 'kuesioner_alumni_no', 'kuesioner_alumni_no');
    }
}