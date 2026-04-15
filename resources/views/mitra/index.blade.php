<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Kuesioner Mitra - Tracer Study ARS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar Atas -->
    <nav class="bg-ars-navy text-white shadow-lg relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 overflow-hidden">
                        <!-- Pastikan gambar logo tersedia di folder public/images -->
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="w-full h-full object-contain">
                    </div>
                    <span class="font-bold tracking-widest uppercase text-ars-yellow text-sm sm:text-base">Kuesioner Mitra</span>
                </div>
                <div>
                    <a href="/" class="text-sm font-medium text-gray-300 hover:text-white transition-colors flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="hidden sm:inline">Beranda Utama</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Welcome Section (Hero) -->
    <div class="bg-ars-navy text-white py-16 px-4 relative overflow-hidden">
        <!-- Dekorasi Background -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-800 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black mb-4">Selamat Datang, <span class="text-ars-yellow">Mitra Perusahaan.</span></h1>
            <p class="text-base sm:text-lg text-gray-300 leading-relaxed max-w-2xl mx-auto">
                Kami sangat menghargai waktu Anda. Kuesioner ini ditujukan untuk mengukur kinerja lulusan kami di tempat Anda bekerja guna mengevaluasi dan meningkatkan kualitas layanan pendidikan ARS University.
            </p>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow flex flex-col items-center justify-start -mt-8 px-4 sm:px-6 pb-16 relative z-20">
        
        <div class="max-w-xl w-full">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10">
                
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Verifikasi Data Alumni</h2>
                    <p class="text-sm text-gray-500 mt-2">Silakan cari alumni yang akan Anda nilai. Semua data yang Anda masukkan bersifat rahasia.</p>
                </div>

                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-xl flex items-start gap-3 animate-shake">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm text-red-700 font-medium leading-relaxed">{{ session('error') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('mitra.search') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Input Nama Alumni -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Alumni <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Ketik nama lengkap atau panggilan..." class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy focus:border-transparent outline-none transition-all text-gray-800" required>
                        </div>
                    </div>

                    <!-- Input Tanggal Lahir (Menggunakan Script Masking) -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir Alumni <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            
                            <!-- Input yang dilihat pengguna (format DD/MM/YYYY) -->
                            <input type="text" id="tanggal_lahir_mask" placeholder="DD / MM / YYYY" class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy focus:border-transparent outline-none transition-all text-gray-800" required>
                            
                            <!-- Input hidden yang dikirim ke server (format YYYY-MM-DD) -->
                            <input type="hidden" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        </div>
                        <p class="text-xs text-gray-500 mt-2 ml-1 flex items-start gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            Digunakan sebagai verifikasi keamanan untuk memastikan Anda menilai orang yang tepat.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full bg-ars-navy hover:bg-blue-900 text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-blue-900/20 transition-all flex justify-center items-center gap-2 transform hover:-translate-y-0.5">
                            Cari & Verifikasi
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
            
            <!-- Steps Info Bawah -->
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center px-4">
                <div>
                    <div class="mx-auto w-10 h-10 bg-white text-ars-navy font-bold rounded-full flex items-center justify-center shadow-sm mb-3">1</div>
                    <h4 class="text-sm font-bold text-gray-700">Verifikasi</h4>
                </div>
                <div>
                    <div class="mx-auto w-10 h-10 bg-gray-200 text-gray-400 font-bold rounded-full flex items-center justify-center shadow-sm mb-3">2</div>
                    <h4 class="text-sm font-bold text-gray-400">Identitas Diri</h4>
                </div>
                <div>
                    <div class="mx-auto w-10 h-10 bg-gray-200 text-gray-400 font-bold rounded-full flex items-center justify-center shadow-sm mb-3">3</div>
                    <h4 class="text-sm font-bold text-gray-400">Isi Penilaian</h4>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center mt-auto">
        <p class="text-xs text-gray-400 font-bold tracking-widest uppercase">&copy; {{ date('Y') }} Tracer Study ARS University.</p>
    </footer>

    <!-- Script Tanggal Lahir (Sama persis dengan halaman Login Alumni) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputDisplay = document.getElementById('tanggal_lahir_mask');
            const inputHidden = document.getElementById('tanggal_lahir');

            // Jika ada old('tanggal_lahir') karena error validasi, format ulang ke DD/MM/YYYY
            if(inputHidden.value) {
                const parts = inputHidden.value.split('-');
                if(parts.length === 3) {
                    inputDisplay.value = parts[2] + " / " + parts[1] + " / " + parts[0];
                }
            }

            inputDisplay.addEventListener('input', function(e) {
                let v = e.target.value.replace(/\D/g, ''); 
                if (v.length > 8) v = v.slice(0, 8); 

                let finalValue = "";
                if (v.length > 0) {
                    let day = v.slice(0, 2);
                    if (parseInt(day) > 31) day = "31";
                    finalValue = day;
                    
                    if (v.length > 2) {
                        let month = v.slice(2, 4);
                        if (parseInt(month) > 12) month = "12";
                        finalValue += " / " + month;
                        
                        if (v.length > 4) {
                            let year = v.slice(4, 8);
                            finalValue += " / " + year;
                        }
                    }
                }
                
                e.target.value = finalValue;

                if (v.length === 8) {
                    const y = v.slice(4, 8);
                    const m = v.slice(2, 4);
                    const d = v.slice(0, 2);
                    inputHidden.value = `${y}-${m}-${d}`;
                } else {
                    inputHidden.value = "";
                }
            });

            inputDisplay.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && (this.value.endsWith(' / '))) {
                    this.value = this.value.slice(0, -3);
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>