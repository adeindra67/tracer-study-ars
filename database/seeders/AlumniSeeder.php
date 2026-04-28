<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // Data Testing 1 (Lulus 2026 - Simulasi Akses Terkunci)
        Alumni::create([
            'nim' => '17221034',
            'nama' => 'Indra Dwi Septianto',
            'tanggal_lahir' => '2003-09-07', 
            'prodi' => 'Teknik Informatika',
            'lulus_tahun' => 2026,
            'no_hp' => '081234567890',
            'email' => 'indra@example.com',
        ]);

        // Data Testing 2 (Lulus 2025 - Simulasi Akses Normal)
        Alumni::create([
            'nim' => '17221035',
            'nama' => 'Siti Nurhaliza',
            'tanggal_lahir' => '2003-09-08', 
            'prodi' => 'Sistem Informasi',
            'lulus_tahun' => 2025,
            'no_hp' => '081298765432',
            'email' => 'siti.nurhaliza@example.com',
        ]);

        // Data Testing 3 (Lulus 2024 - Simulasi Akses Normal)
        Alumni::create([
            'nim' => '17221036',
            'nama' => 'Budi Santoso',
            'tanggal_lahir' => '2003-09-09', 
            'prodi' => 'Teknik Informatika',
            'lulus_tahun' => 2024,
            'no_hp' => '085612345678',
            'email' => 'budi.santoso@example.com',
        ]);

        // Data Testing 4 (Lulus 2025 - Simulasi Akses Normal)
        Alumni::create([
            'nim' => '17221037',
            'nama' => 'Rina Melati',
            'tanggal_lahir' => '2003-01-10', 
            'prodi' => 'Sistem Informasi',
            'lulus_tahun' => 2025,
            'no_hp' => '081345678901',
            'email' => 'rina.melati@example.com',
        ]);

        // Data Testing 5 (Lulus 2026 - Simulasi Akses Terkunci)
        Alumni::create([
            'nim' => '17221038',
            'nama' => 'Ahmad Fauzi',
            'tanggal_lahir' => '2002-08-25', 
            'prodi' => 'Teknik Informatika',
            'lulus_tahun' => 2026,
            'no_hp' => '085798761234',
            'email' => 'ahmad.fauzi@example.com',
        ]);
    }
}