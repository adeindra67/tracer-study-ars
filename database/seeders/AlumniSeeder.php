<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // Data Testing 1
        Alumni::create([
            'nim' => '17221034',
            'nama' => 'Indra Dwi Septianto',
            'tanggal_lahir' => '2003-09-07', // Format wajib YYYY-MM-DD
            'prodi' => 'Teknik Informatika',
            'lulus_tahun' => 2026,
            'no_hp' => '081234567890',
            'email' => 'indra@example.com',
        ]);

        // Data Testing 2
        Alumni::create([
            'nim' => '21000124',
            'nama' => 'Asep',
            'tanggal_lahir' => '2001-08-17',
            'prodi' => 'Sistem Informasi',
            'lulus_tahun' => 2025,
            'no_hp' => '081298765432',
            'email' => 'adhirajasa@example.com',
        ]);
    }
}