<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Terkunci | Tracer Study ARS</title>
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
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-red-50 rounded-full mix-blend-multiply opacity-50 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-blue-50 rounded-full mix-blend-multiply opacity-50 blur-2xl"></div>

        <div class="relative z-10">
            <div class="w-24 h-24 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border-4 border-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">Akses Belum Tersedia</h1>
            <p class="text-gray-500 mb-6 leading-relaxed">
                Halo <strong class="text-ars-navy">{{ $alumni->nama }}</strong>, sistem mendeteksi bahwa Anda adalah lulusan tahun <strong class="text-red-500">{{ $alumni->lulus_tahun }}</strong>.
            </p>

            <div class="bg-blue-50 border border-blue-100 p-5 rounded-2xl mb-8">
                <p class="text-sm text-blue-800 leading-relaxed font-medium">
                    Sesuai dengan pedoman Tracer Study, kuesioner evaluasi lulusan hanya dapat diisi oleh alumni yang telah lulus <strong>minimal 1 tahun</strong> dari tahun pelaksanaan survei (Tahun ini: {{ $tahunSekarang }}).
                </p>
                <p class="text-xs text-blue-600 mt-2">
                    Silakan kembali berpartisipasi pada periode Tracer Study tahun depan. Terima kasih!
                </p>
            </div>

            <form method="POST" action="{{ route('alumni.logout') }}">
                @csrf
                <button type="submit" class="w-full bg-ars-navy text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" /></svg>
                    Kembali & Logout
                </button>
            </form>
        </div>
    </div>

</body>
</html>