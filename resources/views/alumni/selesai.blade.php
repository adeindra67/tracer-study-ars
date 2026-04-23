<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracer Study Alumni Selesai</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-ars-navy text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 overflow-hidden">
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="w-full h-full object-contain">
                    </div>
                    <span class="font-bold tracking-widest uppercase text-ars-yellow">KUESIONER ALUMNI</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative">
        <div class="absolute top-20 left-20 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-20 right-20 w-64 h-64 bg-yellow-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

        <div class="max-w-xl w-full bg-white rounded-3xl shadow-2xl p-10 text-center relative z-10 border-t-8 border-ars-navy">
            
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-50 mb-6">
                <svg class="h-14 w-14 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h2 class="text-3xl font-extrabold text-ars-navy mb-4">Terima Kasih, {{ $alumni->nama }}!</h2>
            
        <div class="bg-blue-50 text-blue-800 p-4 rounded-xl mb-6 border border-blue-100">
                <p class="text-sm md:text-base leading-relaxed">
                    Anda telah menyelesaikan pengisian kuesioner Tracer Study ARS University. Data Anda telah terekam dengan aman di dalam sistem kami.
                </p>
            </div>

            <div class="bg-[#FFF8E1] border-l-4 border-ars-yellow p-5 rounded-r-xl mb-8 text-left shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 mt-0.5 bg-ars-yellow/20 p-2 rounded-lg">
                        <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-amber-800 uppercase tracking-wider mb-1">Satu Langkah Lagi (Opsional)</h3>
                        <p class="text-sm text-amber-800 leading-relaxed">
                            Bagi Anda yang sudah bekerja, mohon kesediaannya untuk mengingatkan <strong>Atasan/HRD</strong> di tempat Anda bekerja agar turut mengisi <span class="font-bold underline decoration-ars-yellow decoration-2">Kuesioner Pengguna Lulusan</span> melalui portal utama Tracer Study ARS University.
                        </p>
                    </div>
                </div>
            </div>

            <p class="text-gray-500 text-sm mb-10">
                Kontribusi Anda sangat berharga untuk mengevaluasi kurikulum dan meningkatkan kualitas lulusan kampus kita di masa depan. Sukses selalu untuk karir Anda!
            </p>

            <form method="POST" action="{{ route('alumni.logout') }}">
                @csrf
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 border border-transparent text-sm font-bold rounded-xl text-white bg-ars-navy hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ars-navy transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ars-yellow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    KELUAR DARI SISTEM
                </button>
            </form>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center">
        <p class="text-xs text-gray-400 font-bold tracking-widest uppercase">
            &copy; {{ date('Y') }} ARS University. All Rights Reserved.
        </p>
    </footer>

</body>
</html>