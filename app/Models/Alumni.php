<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Alumni extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alumni';
    protected $primaryKey = 'alumni_no'; 
    protected $fillable = [
        'nim', 'nama', 'tanggal_lahir', 'prodi', 'lulus_tahun', 
        'email', 'no_hp', 'nik', 'npwp', 
        'pekerjaan', 'jabatan', 'bidang_kerja', 'perusahaan', 'tingkat'
    ];

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'alumni_no', 'alumni_no');
    }

    public function tracer()
    {
        return $this->hasMany(AlumniTracer::class, 'alumni_no', 'alumni_no');
    }
}