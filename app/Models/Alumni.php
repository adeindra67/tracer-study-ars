<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Authenticatable
{
    use HasFactory;

    protected $table = 'alumni';
    protected $primaryKey = 'alumni_no';

    // Kolom apa saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nim', 'nama', 'tanggal_lahir', 'prodi', 'lulus_tahun', 
        'no_hp', 'email', 'pekerjaan', 'bidang_kerja', 
        'perusahaan', 'tingkat', 'jabatan'
    ];

    // Karena kita tidak pakai password, kita beri tahu Laravel
    public function getAuthPassword()
    {
        return null;
    }

    public function tracers()
    {
        return $this->hasMany(AlumniTracer::class, 'alumni_no', 'alumni_no');
    }
}