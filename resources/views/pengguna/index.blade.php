<x-guest-layout>
    <div class="flex flex-col md:flex-row shadow-2xl overflow-hidden rounded-2xl mx-auto max-w-6xl border border-gray-100">
        
        <!-- Left Side (Branding Premium) -->
        <div class="w-full md:w-1/2 bg-ars-navy p-10 md:p-16 flex flex-col justify-center text-white relative">
            <div class="relative z-10">
                <div class="mb-8 flex items-center gap-4">
                    <div class="bg-white p-3 rounded-xl shadow-lg transform transition hover:rotate-6">
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <h1 class="text-2xl font-black tracking-tighter text-ars-yellow">ARS UNIVERSITY</h1>
                        <p class="text-xs uppercase tracking-widest opacity-80">Tracer Study Pengguna</p>
                    </div>
                </div>

                <h2 class="text-4xl font-extrabold mb-6 leading-tight">
                    Portal Evaluasi <br> 
                    <span class="text-ars-yellow text-5xl">Kinerja Lulusan</span>
                </h2>
                
                <p class="text-blue-100 text-lg mb-8 leading-relaxed">
                    Kami mengundang Bapak/Ibu pimpinan perusahaan untuk memberikan penilaian kinerja terhadap alumni kami yang bekerja di instansi Anda. Evaluasi Anda sangat berarti untuk pengembangan kurikulum kami.
                </p>
            </div>
        </div>

        <!-- Right Side (Form Pencarian) -->
        <div class="w-full md:w-1/2 bg-white p-10 md:p-20 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                
                <div class="mb-10 text-center md:text-left">
                    <h3 class="text-3xl font-black text-ars-navy mb-2">Cari Alumni</h3>
                    <p class="text-ars-gray font-medium">Silakan ketik nama karyawan (alumni) yang akan Anda nilai.</p>
                </div>

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md animate-shake">
                        <p class="text-sm text-red-700 font-bold">Terjadi Kesalahan!</p>
                        <p class="text-xs text-red-600 mt-1">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Perhatikan methodnya GET dan route-nya pengguna.hasil -->
                <form method="GET" action="{{ route('pengguna.hasil') }}" class="space-y-6">
                    
                    <div class="mb-6">
                        <label for="nama" class="block text-xs font-black text-ars-navy uppercase tracking-widest mb-2 ml-1">
                            Nama Lengkap / Nama Depan
                        </label>
                        <div class="relative group">
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   required 
                                   class="w-full px-5 py-4 border border-gray-200 rounded-xl focus:ring-4 focus:ring-ars-navy/5 focus:border-ars-navy outline-none transition-all duration-300 placeholder-gray-300 shadow-sm"
                                   placeholder="Contoh: Indra Dwi..."
                                   aria-label="Masukkan Nama Alumni">
                            
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-ars-navy transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-ars-navy text-white py-4 rounded-xl font-black tracking-widest hover:bg-blue-900 transform transition hover:-translate-y-1 shadow-xl hover:shadow-ars-navy/20 flex items-center justify-center gap-3 group">
                        CARI DATA ALUMNI
                    </button>
                </form>

                <div class="flex justify-center mt-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-bold text-ars-gray hover:text-ars-navy transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
                    <p class="mt-10 text-center text-xs text-ars-gray font-bold opacity-30 uppercase tracking-[0.2em]">
                       FTI ARS University  &copy; {{ date('Y') }}
                    </p>
            </div>
        </div>
    </div>
</x-guest-layout>