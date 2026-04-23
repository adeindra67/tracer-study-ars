<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracer Study - ARS University</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS untuk Mobile Menu (Bawaan Laravel) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-figtree antialiased text-gray-800 bg-gray-50 selection:bg-ars-yellow selection:text-ars-navy">

    <!-- ================= NAVBAR ================= -->
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="{ 'bg-ars-navy shadow-lg py-3': scrolled, 'bg-transparent py-5': !scrolled }"
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-lg flex items-center justify-center">
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="h-8 w-8 object-contain">
                    </div>
                    <span class="font-black tracking-widest uppercase text-white text-lg sm:text-xl">
                        TRACER<span class="text-ars-yellow">STUDY</span>
                    </span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-white hover:text-ars-yellow font-semibold transition-colors">Beranda</a>
                    <a href="#tentang" class="text-white hover:text-ars-yellow font-semibold transition-colors">Tentang</a>
                    <a href="#akses" class="text-white hover:text-ars-yellow font-semibold transition-colors">Akses Portal</a>
                    
                    <!-- Dropdown Masuk (Hover CSS) -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 bg-ars-yellow text-ars-navy px-6 py-2.5 rounded-full font-black tracking-wide hover:bg-yellow-400 transition-transform transform hover:-translate-y-0.5 shadow-lg shadow-ars-yellow/20">
                            Masuk
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 border border-gray-100 overflow-hidden">
                            <div class="p-2">
                                <a href="{{ route('alumni.login') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-ars-navy rounded-xl transition-colors font-bold group/item">
                                    <div class="bg-blue-100 p-2 rounded-lg group-hover/item:bg-ars-navy group-hover/item:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                                    </div>
                                    Portal Alumni
                                </a>
                                <a href="{{ route('pengguna.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-ars-navy rounded-xl transition-colors font-bold mt-1 group/item">
                                    <div class="bg-blue-100 p-2 rounded-lg group-hover/item:bg-ars-navy group-hover/item:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </div>
                                    Portal Pengguna/Mitra
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-ars-navy absolute w-full shadow-2xl border-t border-blue-800">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#beranda" class="block px-3 py-3 text-white font-semibold hover:bg-blue-900 rounded-lg">Beranda</a>
                <a href="#tentang" class="block px-3 py-3 text-white font-semibold hover:bg-blue-900 rounded-lg">Tentang</a>
                <div class="h-px bg-blue-800 my-2"></div>
                <p class="px-3 py-2 text-sm text-blue-300 font-bold uppercase tracking-widest">Masuk Sebagai:</p>
                <a href="{{ route('alumni.login') }}" class="flex items-center gap-3 px-3 py-3 text-ars-yellow font-bold hover:bg-blue-900 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /></svg>
                    Alumni ARS
                </a>
                <a href="{{ route('pengguna.index') }}" class="flex items-center gap-3 px-3 py-3 text-ars-yellow font-bold hover:bg-blue-900 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    Pengguna / Mitra (HRD)
                </a>
            </div>
        </div>
    </nav>

    <!-- ================= HERO SECTION ================= -->
    <!-- Ganti 'images/banner-kampus.jpg' dengan letak gambar banner Anda di folder public -->
    <section id="beranda" class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/banner-kampus.webp') }}" alt="" class="w-full h-full object-cover object-center" onerror="">
        </div>
        
        <!-- Dark Overlay (Opacity direndahkan agar tulisan terbaca) -->
        <div class="absolute inset-0 bg-ars-navy bg-opacity-70 z-10"></div>

        <!-- Hero Content -->
        <div class="relative z-20 text-center px-4 sm:px-6 max-w-5xl mx-auto mt-16">
            <span class="inline-block py-1 px-3 rounded-full bg-ars-yellow/20 text-ars-yellow border border-ars-yellow/30 text-sm font-bold tracking-widest uppercase mb-6 backdrop-blur-sm animate-fade-in-up">
                Sistem Informasi Terpadu
            </span>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-white tracking-tight leading-tight mb-6">
                Selamat Datang di <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-ars-yellow to-yellow-200">Tracer Study ARS University</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed">
                Tracer Study ARS University hadir untuk melacak jejak karier alumni, mengevaluasi kualitas pembelajaran, dan mempererat sinergi antara dunia pendidikan dengan dunia industri.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="#akses" class="w-full sm:w-auto bg-ars-yellow text-ars-navy px-8 py-4 rounded-xl font-black text-lg hover:bg-white transition-colors duration-300 shadow-xl shadow-ars-yellow/20 flex items-center justify-center gap-2">
                    Mulai Mengisi Kuesioner
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </a>
                <a href="#tentang" class="w-full sm:w-auto bg-white/10 text-white border border-white/30 px-8 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-ars-navy transition-all duration-300 backdrop-blur-sm flex items-center justify-center">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- ================= TENTANG SECTION ================= -->
    <section id="tentang" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h3 class="text-3xl md:text-4xl font-black text-gray-900 mb-6">Mengapa Ini Penting?</h3>
                <p class="text-gray-600 text-lg">Kontribusi Anda melalui pengisian kuesioner ini akan berdampak langsung pada 3 pilar pengembangan universitas kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Card 1 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-16 h-16 bg-blue-100 text-ars-navy rounded-2xl flex items-center justify-center mb-6 group-hover:bg-ars-navy group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Evaluasi Kurikulum</h4>
                    <p class="text-gray-600 leading-relaxed">Menyelaraskan materi yang diajarkan di kampus dengan kebutuhan nyata di dunia kerja dan industri saat ini.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-16 h-16 bg-blue-100 text-ars-navy rounded-2xl flex items-center justify-center mb-6 group-hover:bg-ars-navy group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Kemitraan Industri</h4>
                    <p class="text-gray-600 leading-relaxed">Membangun hubungan erat antara ARS University dengan perusahaan/instansi tempat alumni berkarier.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-16 h-16 bg-blue-100 text-ars-navy rounded-2xl flex items-center justify-center mb-6 group-hover:bg-ars-navy group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Jejaring Alumni</h4>
                    <p class="text-gray-600 leading-relaxed">Memetakan sebaran lulusan ARS University di seluruh Indonesia maupun mancanegara sebagai satu keluarga besar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= AKSES PORTAL SECTION ================= -->
    <section id="akses" class="py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h3 class="text-3xl md:text-4xl font-black text-ars-navy mb-4">Pilih Portal Evaluasi</h3>
                <p class="text-gray-600 text-lg">Silakan pilih jalur masuk yang sesuai dengan peran Anda saat ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Portal Alumni -->
                <div class="bg-white rounded-[2rem] p-10 shadow-xl border border-gray-100 flex flex-col h-full transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-50 to-blue-100 text-ars-navy rounded-full flex items-center justify-center mb-8 border border-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                    </div>
                    <h4 class="text-3xl font-black text-gray-900 mb-4">Portal Alumni</h4>
                    <p class="text-gray-600 mb-8 flex-grow text-lg leading-relaxed">
                        Khusus bagi Anda lulusan ARS University. Bagikan pengalaman transisi karier Anda, pembaruan data diri, serta evaluasi pelayanan kampus.
                    </p>
                    <a href="{{ route('alumni.login') }}" class="w-full text-center bg-white border-2 border-ars-navy text-ars-navy hover:bg-ars-navy hover:text-white font-bold py-4 rounded-xl transition-colors duration-300">
                        Masuk Sebagai Alumni
                    </a>
                </div>

                <!-- Portal Pengguna / HRD -->
                <div class="bg-ars-navy rounded-[2rem] p-10 shadow-2xl shadow-ars-navy/30 flex flex-col h-full transform hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
                    <!-- Dekorasi Lingkaran -->
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full"></div>
                    
                    <div class="relative z-10 w-20 h-20 bg-white/10 text-ars-yellow rounded-full flex items-center justify-center mb-8 border border-white/20 backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h4 class="relative z-10 text-3xl font-black text-white mb-4">Portal Pengguna</h4>
                    <p class="relative z-10 text-blue-100 mb-8 flex-grow text-lg leading-relaxed">
                        Khusus bagi Bapak/Ibu Pimpinan, HRD, atau Atasan Langsung dari alumni kami. Berikan penilaian objektif terkait kinerja lulusan ARS University di perusahaan Anda.
                    </p>
                    <a href="{{ route('pengguna.index') }}" class="relative z-10 w-full text-center bg-ars-yellow text-ars-navy hover:bg-white font-black py-4 rounded-xl transition-colors duration-300 shadow-lg">
                        Mulai Penilaian (Perusahaan)
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-b border-gray-800 pb-12">
                
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-white p-1 rounded">
                            <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="h-8 w-8 object-contain">
                        </div>
                        <span class="font-black tracking-widest uppercase text-xl">
                            ARS<span class="text-ars-yellow">UNIVERSITY</span>
                        </span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Sistem Informasi Tracer Study terintegrasi untuk mendata jejak karier dan mengevaluasi kinerja lulusan demi pengembangan kampus yang lebih baik.
                    </p>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white uppercase tracking-wider">Hubungi Kami</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-ars-yellow" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>Jl. Sekolah Internasional No.1-2, Antapani, Kota Bandung, Jawa Barat 40282</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-ars-yellow" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span>kampus@ars.ac.id</span>
                        </li>
                    </ul>
                </div>

                <!-- Tautan Bantuan -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white uppercase tracking-wider">Pusat Bantuan</h4>
                    <p class="text-gray-400 mb-6">Mengalami kendala saat login atau mengisi form? Hubungi layanan dukungan kami.</p>
                    <a href="https://api.whatsapp.com/send/?phone=6281222300425" target="_blank" class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.891 11.893-11.891 3.181 0 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.481 8.403 0 6.556-5.332 11.891-11.893 11.891-2.01 0-3.98-.511-5.725-1.481l-6.268 1.702zm5.086-5.146l.303.182c1.508.897 3.248 1.371 5.035 1.371 5.462 0 9.907-4.448 9.907-9.907 0-2.64-1.03-5.123-2.9-6.99s-4.352-2.9-6.993-2.9c-5.462 0-9.91 4.448-9.91 9.907 0 2.126.559 4.196 1.617 5.974l.197.333-1.06 3.873 3.967-1.077z"/></svg>
                        WhatsApp Admin
                    </a>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-500 text-sm font-medium">
                <p>&copy; {{ date('Y') }} ARS University. Hak Cipta Dilindungi.</p>
                <p>Dikembangkan untuk Tracer Study System</p>
            </div>
        </div>
    </footer>

</body>
</html>