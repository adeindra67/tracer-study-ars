<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerPengguna extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_pengguna';
    protected $primaryKey = 'kuesioner_pengguna_no';
    public $timestamps = false;

    protected $fillable = ['pertanyaan', 'grup', 'is_wajib', 'tipe_jawaban', 'opsi_jawaban', 'aktif'];

    protected $casts = [
        'opsi_jawaban' => 'array',
        'is_wajib' => 'boolean',
        'aktif' => 'boolean',
    ];

    public function jawaban()
    {
        return $this->hasMany(PenggunaTracerKuesioner::class, 'kuesioner_pengguna_no', 'kuesioner_pengguna_no');
    }
}