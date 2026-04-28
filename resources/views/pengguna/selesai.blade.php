<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian Selesai | Tracer Study ARS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { 'ars-navy': '#0f172a', 'ars-yellow': '#facc15' } } }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-ars-navy text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex items-center h-16 gap-3">
                <div class="bg-white p-1 rounded flex items-center justify-center h-8 w-8 overflow-hidden">
                    <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="w-full h-full object-contain">
                </div>
                <span class="font-bold tracking-widest uppercase text-ars-yellow text-sm">Kuesioner Pengguna (Mitra)</span>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden text-center p-8 sm:p-12 relative">
            
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-green-50 rounded-full mix-blend-multiply opacity-60 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-blue-50 rounded-full mix-blend-multiply opacity-60 blur-2xl"></div>

            <div class="relative z-10">
                <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border-4 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">Penilaian Berhasil Dikirim!</h1>
                <p class="text-gray-500 mb-6 leading-relaxed">
                    Terima kasih atas partisipasi Bapak/Ibu dalam memberikan penilaian kinerja untuk lulusan kami.
                </p>

                <div class="bg-blue-50 border border-blue-100 p-5 rounded-2xl mb-8 text-left">
                    <p class="text-sm text-blue-800 leading-relaxed font-medium text-center">
                        Masukan objektif dari perusahaan Anda merupakan fondasi penting bagi kami untuk terus menyempurnakan kurikulum dan kualitas lulusan Fakultas Teknologi Informasi ARS University.
                    </p>
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('pengguna.index') }}" class="w-full bg-ars-navy text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Nilai Alumni Lainnya
                    </a>
                    <a href="{{ url('/') }}" class="w-full bg-white border-2 border-gray-200 text-gray-600 font-bold py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center">
        <p class="text-xs text-gray-400 font-bold tracking-widest uppercase">&copy; {{ date('Y') }} Tracer Study ARS University.</p>
    </footer>
</body>
</html>