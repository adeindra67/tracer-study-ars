<!DOCTYPE html>
<!-- Menyimpan pilihan bahasa di LocalStorage agar tidak hilang saat di-refresh -->
<html lang="id" class="scroll-smooth" x-data="{ lang: localStorage.getItem('appLang') || 'id' }" x-init="$watch('lang', val => localStorage.setItem('appLang', val))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Judul dinamis -->
    <title x-text="lang === 'id' ? 'Tracer Study | FTI - ARS University' : 'Tracer Study | IT Faculty - ARS University'">Tracer Study | FTI - ARS University</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Mencegah teks bertumpuk sebelum Alpine selesai dimuat */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-figtree antialiased text-gray-800 bg-gray-50 selection:bg-ars-yellow selection:text-ars-navy relative">

    <!-- ================= NAVBAR ================= -->
     <nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="{ 'bg-ars-navy shadow-lg py-3': scrolled, 'bg-transparent py-5': !scrolled }"
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                
                <!-- Logo -->
                <a href="#">
                    <div class="flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="h-8 w-8 object-contain" onerror="this.outerHTML='<div class=\'h-8 w-8 bg-gray-200 rounded font-bold text-xs flex items-center justify-center text-gray-500\'>ARS</div>'">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black tracking-widest uppercase text-white text-lg sm:text-xl leading-none">
                                TRACER<span class="text-ars-yellow">STUDY</span>
                            </span>
                            <span x-show="lang === 'id'" class="text-ars-yellow text-[10px] sm:text-xs font-bold tracking-widest uppercase mt-0.5">
                                Fakultas Teknologi Informasi
                            </span>
                            <span x-cloak x-show="lang === 'en'" class="text-ars-yellow text-[10px] sm:text-xs font-bold tracking-widest uppercase mt-0.5">
                                Faculty of Info. Technology
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    
                    <a href="https://fti.ars.ac.id/" target="_blank" class="text-white hover:text-ars-yellow font-semibold transition-colors">FTI</a>
                    
                    <a href="{{ route('alumni.login') }}" class="text-white hover:text-ars-yellow font-semibold transition-colors">
                        <span x-show="lang === 'id'">Isi Survei Alumni</span>
                        <span x-cloak x-show="lang === 'en'">Alumni Survey</span>
                    </a>
                    
                    <a href="{{ route('pengguna.index') }}" class="text-white hover:text-ars-yellow font-semibold transition-colors">
                        <span x-show="lang === 'id'">Isi Survei Pengguna</span>
                        <span x-cloak x-show="lang === 'en'">Employer Survey</span>
                    </a>
                    
                    <!-- Login Button -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 bg-ars-yellow text-ars-navy px-6 py-2.5 rounded-full font-black tracking-wide hover:bg-yellow-400 transition-transform transform hover:-translate-y-0.5 shadow-lg shadow-ars-yellow/20">
                            <span x-show="lang === 'id'">Masuk</span>
                            <span x-cloak x-show="lang === 'en'">Login</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 border border-gray-100 overflow-hidden">
                            <div class="p-2">
                                <a href="" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-ars-navy rounded-xl transition-colors font-bold group/item">
                                    <div class="bg-blue-100 p-2 rounded-lg group-hover/item:bg-ars-navy group-hover/item:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </div>
                                    Portal Admin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-4">
                    <!-- Tombol Bahasa Mobile (Tetap Dipertahankan) -->
                    <div class="flex items-center bg-white/10 p-1 rounded-lg backdrop-blur-sm border border-white/10">
                        <button @click="lang = lang === 'id' ? 'en' : 'id'" class="flex items-center gap-2 px-2 py-1 text-xs font-bold text-white rounded transition-all duration-300">
                            <span x-text="lang === 'id' ? '🇬🇧 EN' : '🇮🇩 ID'"></span>
                        </button>
                    </div>

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
                <a href="https://fti.ars.ac.id/" target="_blank" class="block px-3 py-3 text-white font-semibold hover:bg-blue-900 rounded-lg">Beranda FTI</a>
                <a href="{{ route('alumni.login') }}" class="block px-3 py-3 text-white font-semibold hover:bg-blue-900 rounded-lg">
                    <span x-show="lang === 'id'">Isi Survei Alumni</span>
                    <span x-cloak x-show="lang === 'en'">Alumni Survey</span>
                </a>
                <a href="{{ route('pengguna.index') }}" class="block px-3 py-3 text-white font-semibold hover:bg-blue-900 rounded-lg">
                    <span x-show="lang === 'id'">Isi Survei Pengguna</span>
                    <span x-cloak x-show="lang === 'en'">Employer Survey</span>
                </a>
                <div class="h-px bg-blue-800 my-2"></div>
                <a href="" class="flex items-center gap-3 px-3 py-3 text-ars-yellow font-bold hover:bg-blue-900 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Login Admin
                </a>
            </div>
        </div>
    </nav>

    <!-- ================= HERO SECTION ================= -->
    <section id="beranda" class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/banner-kampus.webp') }}" alt="Banner FTI ARS" class="w-full h-full object-cover object-center" onerror="this.src='https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=2070'">
        </div>
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-ars-navy bg-opacity-80 z-10"></div>

        <!-- Hero Content -->
        <div class="relative z-20 text-center px-4 sm:px-6 max-w-5xl mx-auto mt-16">
            <span class="inline-block py-1 px-3 rounded-full bg-ars-yellow/20 text-ars-yellow border border-ars-yellow/30 text-sm font-bold tracking-widest uppercase mb-6 backdrop-blur-sm animate-fade-in-up">
                <span x-show="lang === 'id'">Sistem Informasi Terpadu</span>
                <span x-cloak x-show="lang === 'en'">Integrated Information System</span>
            </span>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-white tracking-tight leading-tight mb-6">
                <span x-show="lang === 'id'">Selamat Datang Lulusan</span>
                <span x-cloak x-show="lang === 'en'">Welcome IT Graduates</span>
                <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-ars-yellow to-yellow-200">
                    <span x-show="lang === 'id'">Fakultas Teknologi Informasi</span>
                    <span x-cloak x-show="lang === 'en'">Faculty of Information Tech.</span>
                </span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed">
                <span x-show="lang === 'id'">Platform Tracer Study FTI ARS University hadir untuk melacak jejak karier alumni, mengevaluasi mutu kurikulum, dan mempererat sinergi antara prodi dengan kebutuhan industri digital.</span>
                <span x-cloak x-show="lang === 'en'">The FTI ARS University Tracer Study platform is here to track alumni career paths, evaluate curriculum quality, and strengthen synergy with the digital industry.</span>
            </p>
            
            <div class="flex sm:hidden flex-col justify-center items-center gap-4">
                <a href="#akses" class="w-full sm:w-auto bg-ars-yellow text-ars-navy px-8 py-4 rounded-xl font-black text-lg hover:bg-white transition-colors duration-300 shadow-xl shadow-ars-yellow/20 flex items-center justify-center gap-2">
                    <span x-show="lang === 'id'">Mulai Mengisi Kuesioner</span>
                    <span x-cloak x-show="lang === 'en'">Start Questionnaire</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
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

    <!-- ================= ALUR PENGISIAN KUESIONER ================= -->
    <section id="alur-pengisian" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-ars-navy mb-4">
                    <span x-show="lang === 'id'">Bagaimana Cara Mengisinya?</span>
                    <span x-cloak x-show="lang === 'en'">How to Participate?</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    <span x-show="lang === 'id'">Panduan langkah demi langkah untuk menyelesaikan evaluasi tracer study.</span>
                    <span x-cloak x-show="lang === 'en'">Step-by-step guide to complete the tracer study evaluation.</span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <!-- Alur Alumni FTI -->
                <div class="bg-gray-50 rounded-[2rem] p-8 sm:p-10 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-14 h-14 bg-ars-navy text-ars-yellow rounded-2xl flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                        </div>
                        <h3 class="text-2xl font-black text-ars-navy">
                            <span x-show="lang === 'id'">Alur Alumni FTI</span>
                            <span x-cloak x-show="lang === 'en'">IT Alumni Flow</span>
                        </h3>
                    </div>

                    <div class="relative border-l-2 border-ars-navy/10 ml-6 space-y-10 pb-4">
                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-white text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50 group-hover:bg-ars-navy group-hover:text-ars-yellow transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Login Portal' : 'Portal Login'"></h4>
                            <p class="text-gray-600 leading-relaxed" x-text="lang === 'id' ? 'Masuk dengan menggunakan NIM dan Tanggal lahir Anda.' : 'Log in using your Student ID (NIM) and Date of Birth.'"></p>
                        </div>
                        
                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-white text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50 group-hover:bg-ars-navy group-hover:text-ars-yellow transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Pembaruan Profil' : 'Update Profile'"></h4>
                            <p class="text-gray-600 leading-relaxed" x-text="lang === 'id' ? 'Perbarui data diri serta status pekerjaan atau studi Anda saat ini.' : 'Update your personal data and current employment/study status.'"></p>
                        </div>

                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-white text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50 group-hover:bg-ars-navy group-hover:text-ars-yellow transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Isi Kuesioner' : 'Fill Questionnaire'"></h4>
                            <p class="text-gray-600 leading-relaxed" x-text="lang === 'id' ? 'Berikan informasi terkait perjalanan karier atau studi lanjut Anda setelah lulus.' : 'Provide information regarding your career journey or further studies.'"></p>
                        </div>

                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-ars-yellow text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Selesai' : 'Finish'"></h4>
                        </div>
                    </div>
                </div>

                <!-- Alur Pengguna (HRD) -->
                <div class="bg-gray-50 rounded-[2rem] p-8 sm:p-10 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-14 h-14 bg-ars-navy text-ars-yellow rounded-2xl flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-2xl font-black text-ars-navy">
                            <span x-show="lang === 'id'">Alur Pengguna (HRD)</span>
                            <span x-cloak x-show="lang === 'en'">Employer/HRD Flow</span>
                        </h3>
                    </div>

                    <div class="relative border-l-2 border-ars-navy/10 ml-6 space-y-10 pb-4">
                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-white text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50 group-hover:bg-ars-navy group-hover:text-ars-yellow transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Akses Portal' : 'Access Portal'"></h4>
                            <p class="text-gray-600 leading-relaxed" x-text="lang === 'id' ? 'Cari data lulusan yang bekerja di tempat Anda dengan mengetikkan nama Mereka.' : 'Search for alumni working in your company by typing their name.'"></p>
                        </div>
                        
                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-white text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50 group-hover:bg-ars-navy group-hover:text-ars-yellow transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Verifikasi Alumni' : 'Verify Alumni'"></h4>
                            <p class="text-gray-600 leading-relaxed" x-text="lang === 'id' ? 'Verifikasi data lulusan dengan menggunakan tanggal lahir Mereka.' : 'Verify the alumni data by providing their date of birth.'"></p>
                        </div>

                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-white text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50 group-hover:bg-ars-navy group-hover:text-ars-yellow transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Evaluasi Kinerja' : 'Performance Eval.'"></h4>
                            <p class="text-gray-600 leading-relaxed" x-text="lang === 'id' ? 'Beri penilaian objektif terkait soft skill dan hard skill.' : 'Provide objective assessment regarding their soft and hard skills.'"></p>
                        </div>

                        <div class="relative pl-10 group">
                            <div class="absolute -left-[21px] bg-ars-yellow text-ars-navy w-10 h-10 rounded-full flex items-center justify-center shadow-md border-4 border-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <h4 class="text-xl font-bold text-ars-navy mb-1" x-text="lang === 'id' ? 'Selesai' : 'Finish'"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= AKSES PORTAL SECTION ================= -->
    <section id="akses" class="py-24 bg-gray-50 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h3 class="text-3xl md:text-4xl font-black text-ars-navy mb-4">
                    <span x-show="lang === 'id'">Pilih Portal Evaluasi</span>
                    <span x-cloak x-show="lang === 'en'">Choose Evaluation Portal</span>
                </h3>
                <p class="text-gray-600 text-lg">
                    <span x-show="lang === 'id'">Silakan pilih jalur masuk yang sesuai dengan peran Anda saat ini.</span>
                    <span x-cloak x-show="lang === 'en'">Please select the portal that matches your current role.</span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Portal Alumni -->
                <div class="bg-white rounded-[2rem] p-10 shadow-xl border border-gray-100 flex flex-col h-full transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-50 to-blue-100 text-ars-navy rounded-full flex items-center justify-center mb-8 border border-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                    </div>
                    <h4 class="text-3xl font-black text-gray-900 mb-4" x-text="lang === 'id' ? 'Portal Alumni' : 'Alumni Portal'"></h4>
                    <p class="text-gray-600 mb-8 flex-grow text-lg leading-relaxed">
                        <span x-show="lang === 'id'">Khusus bagi Anda lulusan Fakultas Teknologi Informasi ARS University. Bagikan pengalaman transisi karier Anda, pembaruan data diri, serta evaluasi pelayanan kampus.</span>
                        <span x-cloak x-show="lang === 'en'">Specifically for graduates of the IT Faculty. Share your career transition experience, update personal data, and evaluate campus services.</span>
                    </p>
                    <a href="{{ route('alumni.login') }}" class="w-full text-center bg-white border-2 border-ars-navy text-ars-navy hover:bg-ars-navy hover:text-white font-bold py-4 rounded-xl transition-colors duration-300">
                        <span x-show="lang === 'id'">Masuk Sebagai Alumni FTI</span>
                        <span x-cloak x-show="lang === 'en'">Login as IT Alumni</span>
                    </a>
                </div>

                <!-- Portal Pengguna / HRD -->
                <div class="bg-ars-navy rounded-[2rem] p-10 shadow-2xl shadow-ars-navy/30 flex flex-col h-full transform hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full"></div>
                    
                    <div class="relative z-10 w-20 h-20 bg-white/10 text-ars-yellow rounded-full flex items-center justify-center mb-8 border border-white/20 backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h4 class="relative z-10 text-3xl font-black text-white mb-4" x-text="lang === 'id' ? 'Portal Pengguna' : 'Employer Portal'"></h4>
                    <p class="relative z-10 text-blue-100 mb-8 flex-grow text-lg leading-relaxed">
                        <span x-show="lang === 'id'">Khusus bagi Bapak/Ibu Pimpinan, HRD, atau Atasan Langsung dari alumni kami. Berikan penilaian objektif terkait kinerja lulusan FTI ARS di perusahaan Anda.</span>
                        <span x-cloak x-show="lang === 'en'">Specifically for Managers, HRD, or direct supervisors of our alumni. Provide objective assessment regarding the performance of our graduates in your company.</span>
                    </p>
                    <a href="{{ route('pengguna.index') }}" class="relative z-10 w-full text-center bg-ars-yellow text-ars-navy hover:bg-white font-black py-4 rounded-xl transition-colors duration-300 shadow-lg">
                        <span x-show="lang === 'id'">Mulai Penilaian (Perusahaan)</span>
                        <span x-cloak x-show="lang === 'en'">Start Evaluation (Employer)</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= DIREKTORI WEB FTI  ================= -->
    <section class="py-16 bg-ars-navy relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                <polygon fill="#facc15" points="0,100 100,0 100,100"/>
            </svg>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                <span x-show="lang === 'id'">Ingin Mengetahui Lebih Jauh Tentang Kami?</span>
                <span x-cloak x-show="lang === 'en'">Want to Know More About Us?</span>
            </h2>
            <p class="text-blue-200 mb-8 max-w-2xl mx-auto">
                <span x-show="lang === 'id'">Kunjungi website resmi Fakultas Teknologi Informasi ARS University untuk melihat pembaruan berita akademik, profil program studi, dan informasi pendaftaran.</span>
                <span x-cloak x-show="lang === 'en'">Visit the official website of the IT Faculty to see academic news updates, study program profiles, and enrollment information.</span>
            </p>
            <a href="https://fti.ars.ac.id/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-ars-navy font-black hover:text-white bg-ars-yellow hover:bg-transparent border-2 border-ars-yellow px-8 py-3 rounded-full transition-all duration-300">
                <span x-show="lang === 'id'">Kunjungi Website FTI</span>
                <span x-cloak x-show="lang === 'en'">Visit IT Website</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            </a>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-ars-navy text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-b border-gray-800 pb-12">
                
                <!-- Brand -->
                <div>
                    <a href="https://ars.ac.id" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 mb-6">
                        <div class="bg-white p-1 rounded">
                            <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="h-8 w-8 object-contain">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black tracking-widest uppercase text-xl leading-none">
                                ARS<span class="text-ars-yellow">UNIVERSITY</span>
                            </span>
                        </div>
                    </a>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        <span x-show="lang === 'id'">Sistem Informasi Tracer Study terintegrasi untuk mendata jejak karier dan mengevaluasi kinerja lulusan demi pengembangan Fakultas Teknologi Informasi yang lebih baik.</span>
                        <span x-cloak x-show="lang === 'en'">Integrated Tracer Study Information System to record career paths and evaluate graduate performance for the development of a better IT Faculty.</span>
                    </p>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white uppercase tracking-wider" x-text="lang === 'id' ? 'Hubungi Kami' : 'Contact Us'"></h4>
                    <ul class="space-y-4 text-gray-400">
                        <li>
                            <a href="https://maps.google.com/?q=Jl.+Sekolah+Internasional+No.1-2,+Antapani,+Kota+Bandung,+Jawa+Barat+40282" target="_blank" rel="noopener noreferrer" class="flex items-start gap-3 group hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-ars-yellow group-hover:scale-110 transition-transform duration-300"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>Jl. Sekolah Internasional No.1-2, Antapani, Kota Bandung, Jawa Barat 40282</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:fti@ars.ac.id" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 group hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-ars-yellow group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                <span>fti@ars.ac.id</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tautan Bantuan -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white uppercase tracking-wider" x-text="lang === 'id' ? 'Pusat Bantuan' : 'Help Center'"></h4>
                    <p class="text-gray-400 mb-6">
                        <span x-show="lang === 'id'">Mengalami kendala saat login atau mengisi kuesioner? Hubungi layanan dukungan kami.</span>
                        <span x-cloak x-show="lang === 'en'">Experiencing issues logging in or filling out the questionnaire? Contact our support service.</span>
                    </p>
                    <a href="https://api.whatsapp.com/send/?phone=6281222300425" target="_blank" class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.891 11.893-11.891 3.181 0 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.481 8.403 0 6.556-5.332 11.891-11.893 11.891-2.01 0-3.98-.511-5.725-1.481l-6.268 1.702zm5.086-5.146l.303.182c1.508.897 3.248 1.371 5.035 1.371 5.462 0 9.907-4.448 9.907-9.907 0-2.64-1.03-5.123-2.9-6.99s-4.352-2.9-6.993-2.9c-5.462 0-9.91 4.448-9.91 9.907 0 2.126.559 4.196 1.617 5.974l.197.333-1.06 3.873 3.967-1.077z"/></svg>
                        WhatsApp Admin
                    </a>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row justify-center items-center gap-4 text-gray-500 text-sm font-medium">
                <p>&copy; {{ date('Y') }} 
                    <span x-show="lang === 'id'">Fakultas Teknologi Informasi - ARS University. Hak Cipta Dilindungi.</span>
                    <span x-cloak x-show="lang === 'en'">Faculty of Information Technology - ARS University. All Rights Reserved.</span>
                </p>
            </div>
        </div>
    </footer>

    <!-- ================= FITUR GANTI BAHASA PREMIUM (MENGAPUNG DI DESKTOP) ================= -->
<div class="hidden md:flex fixed bottom-8 right-8 z-[99] items-center bg-white/90 backdrop-blur-md p-1.5 rounded-2xl shadow-2xl border border-gray-200 transition-all duration-300 hover:shadow-ars-navy/20 hover:-translate-y-1">

    <!-- Indonesia -->
    <button @click="lang = 'id'" 
        :class="lang === 'id' ? 'bg-ars-navy text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900'" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-bold rounded-xl transition-all duration-300">
        
        <img src="https://flagcdn.com/w40/id.png" alt="Indonesia" class="h-5 w-5 rounded-sm object-cover">
        ID
    </button>

    <!-- English -->
    <button @click="lang = 'en'" 
        :class="lang === 'en' ? 'bg-ars-navy text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900'" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-bold rounded-xl transition-all duration-300">
        
        <img src="https://flagcdn.com/w40/gb.png" alt="English" class="h-5 w-5 rounded-sm object-cover">
        EN
    </button>

</div>

</body>
</html>