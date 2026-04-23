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
            'tanggal_lahir' => '2003-09-07', 
            'prodi' => 'Teknik Informatika',
            'lulus_tahun' => 2026,
            'no_hp' => '081234567890',
            'email' => 'indra@example.com',
        ]);

        
    }
}