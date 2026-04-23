<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Karena dipakai login
use Illuminate\Notifications\Notifiable;

class Alumni extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alumni';
    protected $primaryKey = 'alumni_no'; // Override Primary Key default Laravel

    protected $fillable = [
        'nim', 'nama', 'tanggal_lahir', 'prodi', 'lulus_tahun', 
        'email', 'no_hp', 'nik', 'pekerjaan_saat_ini'
    ];

    // Relasi: Satu Alumni bisa dinilai oleh banyak HRD (Pengguna)
    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'alumni_no', 'alumni_no');
    }

    // Relasi: Satu Alumni bisa punya banyak riwayat pengisian kuesioner
    public function tracer()
    {
        return $this->hasMany(AlumniTracer::class, 'alumni_no', 'alumni_no');
    }
}