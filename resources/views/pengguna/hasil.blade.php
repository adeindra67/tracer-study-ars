<x-guest-layout>
    <main class="flex-grow max-w-5xl mx-auto py-8 px-4 sm:px-6 w-full relative z-20">
        
        <div class="bg-white rounded-3xl shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden">
            
            <!-- Header Section with Gradient -->
            <div class="px-6 sm:px-10 py-10 bg-gradient-to-r from-ars-navy to-blue-900 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-bold tracking-widest uppercase mb-3 text-blue-100 backdrop-blur-sm">
                        Tahap 1
                    </span>
                    <h2 class="text-3xl font-black tracking-wide text-ars-yellow">Hasil Pencarian</h2>
                    <p class="text-sm text-blue-100 mt-2">
                        Menampilkan <strong class="text-white bg-white/20 px-2 py-0.5 rounded">{{ $alumni_list->count() }}</strong> alumni yang cocok dengan nama: <strong class="text-white">"{{ $nama }}"</strong>
                    </p>
                </div>
                
                <a href="{{ route('pengguna.index') }}" class="relative z-10 shrink-0 inline-flex items-center gap-2 text-sm font-bold bg-white/10 hover:bg-white hover:text-ars-navy text-white px-5 py-2.5 rounded-xl transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Cari Nama Lain
                </a>
            </div>

            <!-- Pesan Error (Muncul jika ada yang iseng ngetik URL langsung) -->
            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 mb-0 rounded-r-xl flex items-start gap-3 animate-shake">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-sm text-red-700 font-medium leading-relaxed">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Content Section -->
            <div class="p-6 sm:p-10 bg-gray-50/50 min-h-[300px]">
                @if($alumni_list->isEmpty())
                    <!-- Empty State Modern -->
                    <div class="text-center py-16 px-4">
                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-800">Alumni Tidak Ditemukan</h3>
                        <p class="text-gray-500 mt-2 max-w-md mx-auto">Kami tidak dapat menemukan alumni dengan nama tersebut. Pastikan ejaan nama sudah benar atau coba gunakan kata kunci yang lebih pendek.</p>
                        <a href="{{ route('pengguna.index') }}" class="mt-8 inline-flex bg-ars-navy text-white font-bold py-3 px-8 rounded-xl hover:bg-blue-900 transition-transform transform hover:-translate-y-1 shadow-lg shadow-blue-900/20">
                            Coba Pencarian Ulang
                        </a>
                    </div>
                @else
                    <!-- List Data -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        @foreach($alumni_list as $data)
                            <div class="group bg-white border border-gray-200 rounded-2xl p-6 hover:border-ars-navy/30 hover:shadow-xl hover:shadow-ars-navy/5 transition-all duration-300 transform {{ $data->is_locked ? 'opacity-70' : 'hover:-translate-y-1' }} flex flex-col justify-between h-full">
                                
                                <div class="flex items-start gap-4 mb-6">
                                    <div class="h-14 w-14 {{ $data->is_locked ? 'bg-gray-100 text-gray-400' : 'bg-gradient-to-br from-blue-100 to-blue-50 text-ars-navy border border-blue-100/50 group-hover:scale-110' }} rounded-2xl flex items-center justify-center font-black text-2xl flex-shrink-0 shadow-sm transition-transform duration-300">
                                        {{ strtoupper(substr($data->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 leading-tight {{ $data->is_locked ? '' : 'group-hover:text-ars-navy' }} transition-colors">{{ $data->nama }}</h3>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                                Lulusan {{ $data->lulus_tahun ?? '-' }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                                                {{ $data->prodi ?? 'ARS University' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-50 mt-auto">
                                    <!-- LOGIKA TAMPILAN LOCK (HANYA UNTUK FRESH GRADUATE) -->
                                    @if($data->is_locked)
                                        <div class="w-full bg-gray-50 border-2 border-gray-100 text-gray-400 px-6 py-3 rounded-xl font-bold flex items-center justify-center gap-2 cursor-not-allowed text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                            Lulusan Baru (Belum Bisa Dievaluasi)
                                        </div>
                                    @else
                                        <a href="{{ route('pengguna.verifikasi', $data->alumni_no) }}" class="w-full bg-white border-2 border-gray-100 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-ars-navy hover:text-white hover:border-ars-navy transition-colors duration-300 flex items-center justify-center gap-2 group/btn">
                                            Pilih & Mulai Penilaian 
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover/btn:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-guest-layout>