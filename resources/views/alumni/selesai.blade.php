<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kuesioner Selesai | Tracer Study ARS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { 'ars-navy': '#0f172a', 'ars-yellow': '#facc15' } } }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800 flex items-center justify-center min-h-screen px-4">

    <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden text-center p-8 sm:p-12 relative">
        
        <!-- Dekorasi Background Latar Belakang -->
        <div class="absolute top-0 left-0 -mt-10 -ml-10 w-40 h-40 bg-green-50 rounded-full mix-blend-multiply opacity-50 blur-2xl"></div>
        <div class="absolute bottom-0 right-0 -mb-10 -mr-10 w-40 h-40 bg-blue-50 rounded-full mix-blend-multiply opacity-50 blur-2xl"></div>

        <div class="relative z-10">
            <!-- Ikon Centang Sukses -->
            <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border-4 border-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">Terima Kasih!</h1>
            
            <!-- Logika Perubahan Pesan Berdasarkan Sesi -->
            <p class="text-gray-500 mb-6 leading-relaxed">
                Halo <strong class="text-ars-navy">{{ Auth::guard('alumni')->user()->nama ?? 'Alumni' }}</strong>, 
                @if(session('sudah_mengisi'))
                    Anda <strong class="text-blue-600">sudah pernah berpartisipasi</strong> dan mengisi kuesioner Tracer Study pada tahun ini.
                @else
                    data kuesioner Anda <strong class="text-green-600">telah berhasil disimpan</strong> di dalam sistem kami.
                @endif
            </p>

            <div class="bg-blue-50 border border-blue-100 p-5 rounded-2xl mb-6 text-left">
                <p class="text-sm text-blue-800 leading-relaxed font-medium text-center">
                    Partisipasi Anda sangat berarti bagi pengembangan mutu akademik dan kurikulum di lingkungan Fakultas Teknologi Informasi, ARS University.
                </p>
            </div>

            <!-- Pesan Pengingat Khusus Untuk Alumni yang Bekerja -->
            @php
                $pekerjaanAlumni = Auth::guard('alumni')->user()->pekerjaan ?? '';
                $isBekerja = str_contains(strtolower($pekerjaanAlumni), 'bekerja');
            @endphp

            @if($isBekerja)
            <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-2xl mb-8 text-left relative overflow-hidden shadow-sm">
                <!-- Dekorasi Ikon Transparan -->
                <div class="absolute -right-4 -top-4 opacity-10 text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                
                <h3 class="text-sm font-black text-yellow-800 mb-2 flex items-center gap-2 relative z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Satu Langkah Lagi!
                </h3>
                <p class="text-xs text-yellow-700 leading-relaxed font-medium relative z-10">
                    Sistem mendeteksi Anda saat ini berstatus bekerja. Mohon kesediaannya untuk menyampaikan kepada <strong>Atasan atau HRD</strong> di tempat Anda bekerja agar turut mengisi <a href="{{ route('pengguna.index') }}" class="underline font-bold text-yellow-900 hover:text-ars-navy transition-colors">Survei Pengguna Lulusan</a>.
                </p>
            </div>
            @endif

            <!-- Tombol Keluar -->
            <form method="POST" action="{{ route('alumni.logout') }}">
                @csrf
                <button type="submit" class="w-full bg-ars-navy text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar dari Sistem
                </button>
            </form>
        </div>
    </div>

</body>
</html>