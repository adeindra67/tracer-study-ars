<x-guest-layout>
    <main class="flex-grow flex flex-col items-center justify-start -mt-8 px-4 sm:px-6 pb-16 relative z-20">
        
        <div class="max-w-xl w-full">
            <div class="bg-white rounded-3xl shadow-2xl shadow-ars-navy/5 border border-gray-100 overflow-hidden">
                
                <!-- Header Premium dengan Ikon Keamanan -->
                <div class="bg-gradient-to-b from-blue-50/60 to-white pt-10 pb-6 px-8 text-center border-b border-gray-50 relative overflow-hidden">
                    <!-- Ornamen Dekorasi -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-100 rounded-full mix-blend-multiply opacity-40 blur-xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-20 h-20 bg-ars-yellow rounded-full mix-blend-multiply opacity-20 blur-xl"></div>

                    <div class="relative z-10 w-16 h-16 bg-white border border-blue-100 shadow-sm rounded-2xl flex items-center justify-center mx-auto mb-5 text-ars-navy transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="relative z-10 text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Verifikasi Keamanan</h2>
                    <p class="relative z-10 text-sm text-gray-500 mt-3 leading-relaxed max-w-sm mx-auto">
                        Masukkan tanggal lahir untuk memverifikasi identitas alumni <br>
                        <strong class="text-ars-navy text-base mt-1 inline-block">{{ $alumni->nama }}</strong>
                    </p>
                </div>

                <div class="p-8 sm:p-10">
                    <!-- Pesan Error dari Session -->
                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-xl flex items-start gap-3 animate-shake">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-sm text-red-700 font-medium leading-relaxed">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pengguna.verifikasi.proses', $alumni->alumni_no) }}" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Tanggal Lahir Alumni <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 group-focus-within:text-ars-navy transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                
                                <!-- Input Display Premium -->
                                <input type="text" id="tanggal_lahir_mask" placeholder="DD / MM / YYYY" class="w-full pl-14 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-ars-navy/10 focus:border-ars-navy outline-none transition-all duration-300 text-gray-800 text-lg font-bold tracking-widest placeholder-gray-300 shadow-sm" required>
                                
                                <!-- Hidden input -->
                                <input type="hidden" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>

                            <!-- Pesan Error Validasi Bawaan Laravel -->
                            @error('tanggal_lahir')
                                <p class="text-xs text-red-500 font-bold mt-2 ml-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                    Mohon lengkapi format tanggal lahir dengan benar (8 digit).
                                </p>
                            @enderror
                        </div>

                        <div class="pt-8 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('pengguna.index') }}" class="order-2 sm:order-1 w-full sm:w-1/3 bg-white border-2 border-gray-200 text-gray-500 font-bold py-4 px-4 rounded-2xl text-center hover:bg-gray-50 hover:text-gray-800 hover:border-gray-300 transition-all flex items-center justify-center">
                                Batal
                            </a>
                            <button type="submit" class="order-1 sm:order-2 w-full sm:w-2/3 bg-ars-navy hover:bg-blue-900 text-white font-bold py-4 px-4 rounded-2xl shadow-xl shadow-ars-navy/20 transition-all duration-300 flex justify-center items-center gap-2 transform hover:-translate-y-1">
                                Verifikasi Sekarang
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Indikator Step -->
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center px-4 opacity-80">
                <div>
                    <div class="mx-auto w-10 h-10 bg-green-500 text-white font-bold rounded-full flex items-center justify-center shadow-sm mb-3">✓</div>
                    <h4 class="text-sm font-bold text-green-600">Pencarian</h4>
                </div>
                <div>
                    <div class="mx-auto w-10 h-10 bg-white text-ars-navy ring-4 ring-blue-100 font-bold rounded-full flex items-center justify-center shadow-sm mb-3">2</div>
                    <h4 class="text-sm font-bold text-gray-700">Verifikasi</h4>
                </div>
                <div>
                    <div class="mx-auto w-10 h-10 bg-gray-200 text-gray-400 font-bold rounded-full flex items-center justify-center shadow-sm mb-3 transition-all duration-300">3</div>
                    <h4 class="text-sm font-bold text-gray-400">Penilaian</h4>
                </div>
            </div>
        </div>
    </main>

    <!-- Memasukkan Script Masking Tanggal -->
    @push('scripts')
    <script>
        const inputDisplay = document.getElementById('tanggal_lahir_mask');
        const inputHidden = document.getElementById('tanggal_lahir');

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
    </script>
    @endpush
</x-guest-layout>