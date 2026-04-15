<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selesai - Kuesioner Mitra ARS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased flex items-center justify-center min-h-screen relative overflow-hidden">
    
    <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob" style="animation-delay: 4s;"></div>

    <div class="relative bg-white p-10 rounded-3xl shadow-xl max-w-lg w-full text-center z-10 border border-gray-100 mx-4">
        
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-black text-ars-navy mb-4">Terima Kasih!</h1>
        <p class="text-gray-600 mb-8 leading-relaxed">
            Data penilaian Anda telah berhasil kami simpan. Partisipasi objektif Anda sangat berharga bagi peningkatan mutu kurikulum dan layanan ARS University.
        </p>
        
        <a href="/" class="inline-block w-full bg-ars-navy hover:bg-blue-900 text-white font-bold py-4 px-8 rounded-xl shadow-lg transition-transform transform hover:-translate-y-0.5">
            Kembali ke Beranda Utama
        </a>
    </div>

</body>
</html>