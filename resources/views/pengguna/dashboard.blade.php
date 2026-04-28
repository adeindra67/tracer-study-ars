<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penilaian Lulusan - Tracer Study ARS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- FITUR BARU: Library Telepon Internasional (CSS) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    
    <style>
        .step-content { display: none; }
        .step-content.active { display: block; animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Penyesuaian agar dropdown bendera negara rapi dengan Tailwind */
        .iti { width: 100%; display: block; }
        .iti__flag { background-image: url("https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/img/flags.png"); }
        @media (min-resolution: 2x) {
            .iti__flag { background-image: url("https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/img/flags@2x.png"); }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar Atas -->
    <nav class="bg-ars-navy text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 overflow-hidden">
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="w-full h-full object-contain">
                    </div>
                    <span class="font-bold tracking-widest uppercase text-ars-yellow text-sm sm:text-base">Kuesioner Pengguna (Mitra)</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-300 hidden sm:block">Menilai: {{ $alumni->nama }}</span>
                    <a href="{{ route('pengguna.index') }}" onclick="confirmCancel(event, this.href)" class="text-sm font-bold text-red-400 hover:text-red-200 transition-colors flex items-center gap-1 bg-red-900/30 px-3 py-1.5 rounded-lg">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-4xl mx-auto py-8 px-4 sm:px-6 w-full">
        
        <!-- Header Info Alumni -->
        <div class="bg-gradient-to-r from-blue-50 to-white border border-blue-100 rounded-2xl p-6 text-center mb-8 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-100 rounded-full mix-blend-multiply opacity-50 transform translate-x-10 -translate-y-10"></div>
            <p class="text-xs sm:text-sm text-blue-600 font-bold uppercase tracking-wider mb-2 relative z-10">Lembar Penilaian Kinerja Lulusan:</p>
            <h1 class="text-2xl sm:text-3xl font-black text-ars-navy relative z-10">{{ $alumni->nama }}</h1>
            <div class="flex items-center justify-center gap-2 mt-2 text-sm text-gray-600 relative z-10">
                <span class="font-semibold">NIM: {{ $alumni->nim }}</span>
                <span>•</span>
                <span>Lulusan {{ $alumni->lulus_tahun }}</span>
                <span>•</span>
                <span class="font-medium">{{ $alumni->prodi }}</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            @php 
                $total_steps = count($kuesioner) + 1; // +1 untuk step identitas
            @endphp

            <!-- Progress Bar Garis -->
            <div class="bg-gray-100 h-2.5 w-full">
                <div id="progressBar" class="bg-ars-yellow h-2.5 transition-all duration-500 w-0"></div>
            </div>

            <!-- Judul Step Aktif -->
            <div class="px-6 pt-8 pb-4 text-center border-b border-gray-50">
                <h2 id="stepTitle" class="text-xl sm:text-2xl font-black text-ars-navy tracking-wide">Identitas Penilai</h2>
                <p id="stepCounter" class="text-sm text-gray-500 font-medium mt-1">Bagian 1 dari {{ $total_steps }}</p>
            </div>

            <!-- Form Utama -->
            <form action="{{ route('pengguna.store') }}" method="POST" id="kuesionerForm" class="px-6 sm:px-10 pb-10 pt-6">
                @csrf
                <input type="hidden" name="nim" value="{{ $alumni->nim }}">

                <!-- ================== STEP 0: IDENTITAS PENILAI ================== -->
                <div class="step-content active" data-step="0" data-title="Identitas Perusahaan & Penilai">
                    <div class="bg-yellow-50 border-l-4 border-ars-yellow p-4 rounded-lg mb-8 text-sm text-yellow-800 leading-relaxed shadow-sm">
                        Data identitas maupun hasil kuesioner Anda bersifat <strong>rahasia</strong>. Mohon diisi dengan baik dan jujur untuk perbaikan layanan universitas kami.
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">
                        
                        <!-- IDENTITAS PERUSAHAAN (SESUAI DOKUMEN) -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">1. Nama Perusahaan / Instansi <span class="text-red-500">*</span></label>
                            <input type="text" name="perusahaan" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">2. Alamat Perusahaan <span class="text-red-500">*</span></label>
                            <textarea name="alamat_perusahaan" rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">3. Sektor Perusahaan / Instansi <span class="text-red-500">*</span></label>
                            <input type="text" name="sektor_perusahaan" placeholder="Contoh: Perbankan, IT, Pendidikan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat Perusahaan <span class="text-red-500">*</span></label>
                            <select name="tingkat" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="Lokal">Lokal / Tidak Berbadan Hukum</option>
                                <option value="Nasional">Nasional / Berbadan Hukum</option>
                                <option value="Multinasional">Multinasional / Internasional</option>
                            </select>
                        </div>
                        
                        <!-- DATA DIRI PENILAI -->
                        <div class="sm:col-span-2 border-t border-gray-100 pt-6 mt-2 relative">
                            <h3 class="inline-block bg-white pr-4 text-lg font-black text-ars-navy relative -top-3">Data Diri Penilai (Atasan / HRD)</h3>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Anda <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan Saat Ini <span class="text-red-500">*</span></label>
                            <input type="text" name="jabatan" placeholder="Contoh: HR Manager, SPV, Direktur..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                        </div>

                        <!-- PEMISAHAN EMAIL & NO HP DENGAN BENDERA NEGARA -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="email@perusahaan.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                            <div class="relative w-full">
                                <!-- Input Visual untuk User (Diformat Oleh Plugin) -->
                                <input type="tel" id="display_phone" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" required>
                                
                                <!-- Input Hidden untuk dikirim ke Database (Tanpa Spasi, ada Kode Negara) -->
                                <input type="hidden" name="no_hp" id="real_phone">
                            </div>
                            <span class="text-xs text-gray-400 mt-1 block">Pilih bendera. Format akan menyesuaikan secara otomatis.</span>
                        </div>
                    </div>
                </div>

                <!-- ================== STEP 1 - N: KUESIONER HRD ================== -->
                @php $step_index = 1; @endphp
                @foreach ($kuesioner as $nama_grup => $daftar_indikator)
                    <div class="step-content hidden" data-step="{{ $step_index }}" data-title="{{ preg_replace('/^[A-Z]\.\s*/', '', $nama_grup) }}">
                        
                        <!-- Box Panduan Skala -->
                        @if ($nama_grup != 'H. Saran & Kritik')
                            <div class="mb-8 flex justify-center">
                                <div class="inline-flex bg-white border border-gray-200 rounded-full p-1.5 shadow-sm text-xs sm:text-sm font-medium text-gray-600">
                                    <span class="px-3 py-1 rounded-full text-red-600">1: Kurang</span>
                                    <span class="px-3 py-1 rounded-full text-orange-500">2: Cukup</span>
                                    <span class="px-3 py-1 rounded-full text-blue-500">3: Baik</span>
                                    <span class="px-3 py-1 rounded-full text-green-600">4: Sangat Baik</span>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-6">
                            @foreach ($daftar_indikator as $tanya)
                                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all hover:border-blue-100">
                                    <div class="mb-5">
                                        <label class="text-base font-bold text-gray-800 leading-relaxed block">
                                            {{ $tanya->indikator }} <span class="text-red-500">*</span>
                                        </label>
                                    </div>

                                    <div>
                                        @if ($tanya->tipe_jawaban == 'scale4')
                                            <div class="grid grid-cols-4 gap-2 sm:gap-4 max-w-lg">
                                                @for ($i = 1; $i <= 4; $i++)
                                                    <label class="radio-label cursor-pointer text-center relative group">
                                                        <input type="radio" name="jawaban[{{ $tanya->kuesioner_pengguna_no }}]" value="{{ $i }}" class="absolute opacity-0 w-0 h-0" required>
                                                        <div class="border-2 border-gray-200 rounded-xl py-3 px-1 transition-all duration-200 bg-gray-50 text-gray-600 group-hover:border-ars-navy group-hover:text-ars-navy flex flex-col items-center justify-center gap-1">
                                                            <span class="text-lg font-black">{{ $i }}</span>
                                                            <span class="text-[10px] uppercase font-bold tracking-wider opacity-70 block hidden sm:block">
                                                                @if($i==1) Kurang @elseif($i==2) Cukup @elseif($i==3) Baik @else S.Baik @endif
                                                            </span>
                                                        </div>
                                                    </label>
                                                @endfor
                                            </div>

                                        @elseif ($tanya->tipe_jawaban == 'textarea')
                                            <textarea name="jawaban[{{ $tanya->kuesioner_pengguna_no }}]" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-ars-navy outline-none transition-all" placeholder="Tuliskan saran konstruktif Anda di sini..." required></textarea>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php $step_index++; @endphp
                @endforeach

                <!-- ================== NAVIGASI TOMBOL ================== -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex justify-between items-center">
                    <button type="button" id="btnPrev" class="hidden px-5 sm:px-6 py-3 bg-white border-2 border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-colors flex items-center gap-2 text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </button>
                    
                    <button type="button" id="btnNext" class="px-6 sm:px-8 py-3 bg-ars-navy text-white font-bold rounded-xl shadow-lg hover:bg-blue-900 transition-all transform hover:-translate-y-0.5 ml-auto flex items-center gap-2 text-sm sm:text-base">
                        Lanjut
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                    
                    <div id="submitWrapper" class="hidden ml-auto">
                        <button type="button" id="btnSubmitFake" class="px-6 sm:px-8 py-3 bg-green-500 text-white font-bold rounded-xl shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5 flex items-center gap-2 text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            Kirim Penilaian
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Steps Info Bawah -->
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center px-4">
            <div>
                <div class="mx-auto w-10 h-10 bg-green-500 text-white font-bold rounded-full flex items-center justify-center shadow-sm mb-3">✓</div>
                <h4 class="text-sm font-bold text-green-600">Verifikasi</h4>
            </div>
            <div>
                <div id="macro2Icon" class="mx-auto w-10 h-10 bg-white text-ars-navy font-bold rounded-full flex items-center justify-center shadow-sm mb-3 ring-4 ring-blue-100 transition-all">2</div>
                <h4 id="macro2Text" class="text-sm font-bold text-gray-700 transition-all">Identitas Diri</h4>
            </div>
            <div>
                <div id="macro3Icon" class="mx-auto w-10 h-10 bg-gray-200 text-gray-400 font-bold rounded-full flex items-center justify-center shadow-sm mb-3 transition-all">3</div>
                <h4 id="macro3Text" class="text-sm font-bold text-gray-400 transition-all">Isi Penilaian</h4>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center mt-auto">
        <p class="text-xs text-gray-400 font-bold tracking-widest uppercase">&copy; {{ date('Y') }} Tracer Study ARS University.</p>
    </footer>

    <!-- FITUR BARU: Library Telepon Internasional (JS) -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    
    <script>
        // ========================================================
        // KONFIRMASI BATAL MENGGUNAKAN SWEETALERT
        // ========================================================
        function confirmCancel(event, url) {
            event.preventDefault();
            Swal.fire({
                title: 'Batalkan Penilaian?',
                text: "Semua data yang sudah Anda isi di form ini akan hilang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Kembali'
            }).then((result) => { if (result.isConfirmed) window.location.href = url; });
        }

        document.addEventListener('DOMContentLoaded', function() {
            
            // ========================================================
            // INSISIALISASI INPUT TELEPON INTERNASIONAL
            // ========================================================
            const phoneInputField = document.querySelector("#display_phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "id", // Default Indonesia
                preferredCountries: ["id", "my", "sg", "us", "au"], // Negara yang muncul paling atas
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js", 
            });

            // Fungsi untuk update input hidden
            function updateRealPhoneValue() {
                const fullNumber = phoneInput.getNumber(); // Hasil bersih: +6283812345678 
                document.getElementById('real_phone').value = fullNumber;
            }

            // AUTO-FORMAT TAMPILAN SPASI DAN STRIP KHUSUS INDONESIA
            phoneInputField.addEventListener('input', function(e) {
                const countryData = phoneInput.getSelectedCountryData();
                
                // Hanya jalankan format kustom ini jika negaranya Indonesia
                if (countryData.iso2 === 'id') {
                    let val = this.value.replace(/[^\d+]/g, ''); // Bersihkan dari karakter aneh

                    // Otomatis ubah 0 di awal menjadi +62
                    if (val.startsWith('0')) {
                        val = '+62' + val.substring(1);
                        phoneInput.setNumber(val); // Sinkronisasikan ke plugin
                    }

                    // Format pola: +62 8xxx - xxxx - xxxx
                    if (val.startsWith('+62')) {
                        let numbers = val.substring(3);
                        let formatted = '+62';
                        
                        if (numbers.length > 0) {
                            formatted += ' ' + numbers.substring(0, 4);
                            if (numbers.length > 4) formatted += ' - ' + numbers.substring(4, 8);
                            if (numbers.length > 8) formatted += ' - ' + numbers.substring(8, 14); // Max 14 digit
                        }
                        this.value = formatted;
                    }
                }
                
                updateRealPhoneValue();
            });

            // MENCEGAH TOMBOL BACKSPACE NYANGKUT DI SPASI/STRIP (UX Improvement)
            phoneInputField.addEventListener('keydown', function(e) {
                const countryData = phoneInput.getSelectedCountryData();
                if (countryData.iso2 === 'id' && e.key === 'Backspace') {
                    if (this.value.endsWith(' - ')) {
                        this.value = this.value.slice(0, -3);
                        e.preventDefault();
                    } else if (this.value.endsWith(' ')) {
                        this.value = this.value.slice(0, -1);
                        e.preventDefault();
                    }
                }
            });

            // Reset input saat ganti bendera negara
            phoneInputField.addEventListener('countrychange', function() {
                this.value = ''; 
                updateRealPhoneValue();
            });

            // ========================================================
            // LOGIKA NAVIGASI STANDAR (TETAP SAMA)
            // ========================================================
            const steps = document.querySelectorAll('.step-content');
            const totalSteps = steps.length;
            const progressEl = document.getElementById('progressBar');
            
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');
            const submitWrapper = document.getElementById('submitWrapper');
            const titleEl = document.getElementById('stepTitle');
            const counterEl = document.getElementById('stepCounter');
            const form = document.getElementById('kuesionerForm');
            const btnSubmitFake = document.getElementById('btnSubmitFake');
            
            const macro2Icon = document.getElementById('macro2Icon');
            const macro2Text = document.getElementById('macro2Text');
            const macro3Icon = document.getElementById('macro3Icon');
            const macro3Text = document.getElementById('macro3Text');
            
            let currentStep = 0;

            function updateUI() {
                steps.forEach((step, index) => {
                    step.classList.remove('active');
                    if (index === currentStep) step.classList.add('active');
                });
                
                titleEl.innerText = steps[currentStep].getAttribute('data-title');
                counterEl.innerText = `Bagian ${currentStep + 1} dari ${totalSteps}`;
                progressEl.style.width = ((currentStep + 1) / totalSteps * 100) + '%';
                
                if (currentStep === 0) {
                    macro2Icon.className = "mx-auto w-10 h-10 bg-white text-ars-navy font-bold rounded-full flex items-center justify-center shadow-sm mb-3 ring-4 ring-blue-100 transition-all";
                    macro2Icon.innerHTML = "2";
                    macro2Text.className = "text-sm font-bold text-gray-700 transition-all";

                    macro3Icon.className = "mx-auto w-10 h-10 bg-gray-200 text-gray-400 font-bold rounded-full flex items-center justify-center shadow-sm mb-3 transition-all";
                    macro3Text.className = "text-sm font-bold text-gray-400 transition-all";
                } else {
                    macro2Icon.className = "mx-auto w-10 h-10 bg-green-500 text-white font-bold rounded-full flex items-center justify-center shadow-sm mb-3 transition-all";
                    macro2Icon.innerHTML = "✓";
                    macro2Text.className = "text-sm font-bold text-green-600 transition-all";

                    macro3Icon.className = "mx-auto w-10 h-10 bg-white text-ars-navy font-bold rounded-full flex items-center justify-center shadow-sm mb-3 ring-4 ring-blue-100 transition-all";
                    macro3Text.className = "text-sm font-bold text-gray-700 transition-all";
                }
                
                currentStep === 0 ? btnPrev.classList.add('hidden') : btnPrev.classList.remove('hidden');
                if (currentStep === totalSteps - 1) {
                    btnNext.classList.add('hidden');
                    submitWrapper.classList.remove('hidden');
                } else {
                    btnNext.classList.remove('hidden');
                    submitWrapper.classList.add('hidden');
                }
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            function validateCurrentStep() {
                const currentInputs = steps[currentStep].querySelectorAll('input[required]:not([type="hidden"]), select[required], textarea[required]');
                
                // Tambahan: Pastikan nomor telepon diisi valid sesuai negara
                if(currentStep === 0) {
                    if(!phoneInput.isValidNumber() && phoneInputField.value.trim() !== '') {
                        phoneInputField.setCustomValidity("Nomor telepon tidak valid untuk negara tersebut.");
                        phoneInputField.reportValidity();
                        return false;
                    } else {
                        phoneInputField.setCustomValidity(""); // Clear error
                        updateRealPhoneValue(); // Pastikan variabel aman
                    }
                }

                for (let input of currentInputs) {
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        return false;
                    }
                }
                return true;
            }

            btnNext.addEventListener('click', () => { if (validateCurrentStep()) { currentStep++; updateUI(); } });
            btnPrev.addEventListener('click', () => { currentStep--; updateUI(); });
            
            btnSubmitFake.addEventListener('click', function() {
                if (validateCurrentStep()) {
                    Swal.fire({
                        title: 'Selesai & Kirim?',
                        text: "Pastikan semua penilaian sudah sesuai. Data tidak dapat diubah setelah dikirim.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1e3a8a', 
                        cancelButtonColor: '#9ca3af', 
                        confirmButtonText: 'Ya, Kirim Penilaian',
                        cancelButtonText: 'Periksa Kembali'
                    }).then((result) => { if (result.isConfirmed) form.submit(); })
                }
            });
            
            updateUI(); 
        });
    </script>
    
</body>
</html>