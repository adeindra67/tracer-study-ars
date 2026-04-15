<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row shadow-2xl overflow-hidden rounded-2xl mx-auto max-w-6xl my-0 md:my-10 border border-gray-100">
        

        <div class="w-full md:w-1/2 bg-ars-navy p-10 md:p-16 flex flex-col justify-center text-white relative">

            <div class="relative z-10">
                <div class="mb-8 flex items-center gap-4">
                    <div class="bg-white p-3 rounded-xl shadow-lg transform transition hover:rotate-6">
                        <x-application-logo class="w-16 h-16" />
                    </div>
                    <div>
                        <h1 class="text-2xl font-black tracking-tighter text-ars-yellow">ARS UNIVERSITY</h1>
                        <p class="text-xs uppercase tracking-widest opacity-80">Tracer Study</p>
                    </div>
                </div>

                <h2 class="text-4xl font-extrabold mb-6 leading-tight">
                    Selamat Datang di <br> 
                    <span class="text-ars-yellow text-5xl">Portal Login Tracer Study Alumni</span>
                </h2>
                
                <p class="text-blue-100 text-lg mb-8 leading-relaxed">
                    Silahkan login dengan memasukkan <strong> NIM </strong> dan <strong> Tanggal Lahir </strong> Anda. Kontribusi Anda sangat berarti bagi pengembangan kurikulum dan peningkatan kualitas lulusan kami di masa depan.
                </p>

                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-xl mt-10 transition hover:bg-white/20">
                    <h4 class="text-ars-yellow font-bold mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Butuh Bantuan?
                    </h4>
                    <p class="text-sm text-blue-50 leading-relaxed">
                        Jika Anda lupa NIM atau mengalami kendala akses, silakan hubungi Admin Kampus melalui WhatsApp:
                    </p>
                    <a href="https://api.whatsapp.com/send/?phone=6281222300425&text=Hallo%20PMB%20Center...&type=phone_number&app_absent=0" target="_blank" class="mt-4 inline-flex items-center gap-2 bg-ars-yellow text-ars-navy px-4 py-2 rounded-lg font-bold text-sm hover:bg-white transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.891 11.893-11.891 3.181 0 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.481 8.403 0 6.556-5.332 11.891-11.893 11.891-2.01 0-3.98-.511-5.725-1.481l-6.268 1.702zm5.086-5.146l.303.182c1.508.897 3.248 1.371 5.035 1.371 5.462 0 9.907-4.448 9.907-9.907 0-2.64-1.03-5.123-2.9-6.99s-4.352-2.9-6.993-2.9c-5.462 0-9.91 4.448-9.91 9.907 0 2.126.559 4.196 1.617 5.974l.197.333-1.06 3.873 3.967-1.077z"/></svg>
                        Chat Admin Kampus
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white p-10 md:p-20 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                <div class="mb-10 text-center md:text-left">
                    <h3 class="text-3xl font-black text-ars-navy mb-2">Masuk Alumni</h3>
                    <p class="text-ars-gray font-medium">Lengkapi data verifikasi Anda di bawah ini.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md animate-shake">
                        <p class="text-sm text-red-700 font-bold">Verifikasi Gagal!</p>
                        <p class="text-xs text-red-600 mt-1">NIM atau Tanggal Lahir tidak sesuai dengan data kami.</p>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login-alumni') }}" class="space-y-6">
                    @csrf
                   <div class="mb-6">
    <label for="nim" class="block text-xs font-black text-ars-navy uppercase tracking-widest mb-2 ml-1">
        Nomor Induk Mahasiswa
    </label>
    <div class="relative group">
        <input type="text" 
               id="nim" 
               name="nim" 
               required 
               value="{{ old('nim') }}"
               inputmode="numeric" 
               pattern="[0-9]*"
               class="w-full px-5 py-4 border border-gray-200 rounded-xl focus:ring-4 focus:ring-ars-navy/5 focus:border-ars-navy outline-none transition-all duration-300 placeholder-gray-300 shadow-sm"
               placeholder="Contoh: 17221034"
               aria-label="Masukkan Nomor Induk Mahasiswa Anda">
        
        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-ars-navy transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
        </div>
    </div>
</div>

<div class="mb-6">
    <label for="tanggal_lahir_mask" class="block text-xs font-black text-ars-navy uppercase tracking-widest mb-2 ml-1">
        Tanggal Lahir
    </label>
    <div class="relative group">
        <input type="text" 
               id="tanggal_lahir_mask" 
               name="tanggal_lahir_display" 
               required 
               inputmode="numeric"
               class="w-full px-5 py-4 border border-gray-200 rounded-xl focus:ring-4 focus:ring-ars-navy/5 focus:border-ars-navy outline-none transition-all duration-300 text-ars-gray shadow-sm placeholder-gray-300"
               placeholder="Tgl / Bln / Thn (Contoh: 07/09/2003)"
               aria-label="Masukkan tanggal lahir format hari dua digit, bulan dua digit, tahun empat digit">
        
        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-ars-navy transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
    </div>
    
    <input type="hidden" id="tanggal_lahir" name="tanggal_lahir">
    
    <p class="mt-2 ml-1 text-[10px] text-gray-400 font-medium tracking-wide italic leading-relaxed">
        *Ketik langsung angka, format " / " akan muncul secara otomatis.
    </p>
</div>

                    <button type="submit"
                        class="w-full bg-ars-navy text-white py-4 rounded-xl font-black tracking-widest hover:bg-blue-900 transform transition hover:-translate-y-1 shadow-xl hover:shadow-ars-navy/20 flex items-center justify-center gap-3 group">
                        MASUK KE DASHBOARD
                    </button>
                </form>

                <div class="hidden md:flex justify-center mt-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-bold text-ars-gray hover:text-ars-navy transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
                
                <p class="mt-10 text-center text-xs text-ars-gray font-bold opacity-30 uppercase tracking-[0.2em]">
                    ARS University  &copy; {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>


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

