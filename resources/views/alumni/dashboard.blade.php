<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracer Study Alumni- ARS University</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <nav class="bg-ars-navy text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 overflow-hidden">
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo ARS" class="w-full h-full object-contain">
                    </div>
                    <span class="font-bold tracking-widest uppercase text-ars-yellow text-sm sm:text-base">KUESIONER ALUMNI</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-300 hidden sm:block">NIM: {{ $alumni->nim }}</span>
                    <form method="POST" action="{{ route('alumni.logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-300 hover:text-red-100 flex items-center gap-1">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
        
        <div class="text-center mb-10 pt-6">
            <h1 class="text-3xl sm:text-4xl font-black text-ars-navy">Halo, {{ $alumni->nama }}!</h1>
            <p class="text-gray-500 text-base mt-2">Lulusan {{ $alumni->lulus_tahun }} | {{ $alumni->prodi }}</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <div class="bg-gray-100 h-2.5 w-full">
                <div id="progressBar" class="bg-ars-yellow h-2.5 transition-all duration-500 w-0"></div>
            </div>
            
            <div class="p-6 sm:p-8 border-b bg-ars-navy/5 text-center">
                <h2 id="stepTitle" class="text-xl font-bold text-ars-navy uppercase tracking-wider">Tahap 1: Verifikasi Data Diri</h2>
                <p id="stepCounter" class="text-sm text-gray-500 font-bold mt-1">Bagian 1 dari {{ count($kuesioner) + 1 }}</p>
            </div>

            <form action="{{ route('alumni.dashboard.store') }}" method="POST" id="kuesionerForm" class="p-6 sm:p-10">
                @csrf

                <!-- ================== STEP 0: UPDATE DATA DIRI ================== -->
                <div class="step-content active" data-step="0" data-title="Verifikasi & Update Data Diri">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-lg mb-8 text-base text-blue-800 leading-relaxed">
                        Pastikan data kontak, NIK, dan pekerjaan terbaru Anda di bawah ini sudah benar.
                    </div>
                    
                    <div class="space-y-8">
                        <!-- Baris 1: Email & HP -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Email Aktif <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ $alumni->email ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none" required>
                            </div>
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" name="no_hp" value="{{ $alumni->no_hp ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none" required>
                            </div>
                        </div>

                        <!-- Baris 2: NIK & NPWP -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">NIK (Sesuai KTP) <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" value="{{ $alumni->nik ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none" required>
                            </div>
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">NPWP (Opsional)</label>
                                <input type="text" name="npwp" value="{{ $alumni->npwp ?? '' }}" placeholder="Isi jika ada" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none">
                            </div>
                        </div>

                        <!-- REVISI: Tambah input hidden untuk bidang_kerja dan tingkat (Sesuai Struktur Tabel) -->
                        <input type="hidden" name="bidang_kerja" value="{{ $alumni->bidang_kerja ?? '' }}">
                        <input type="hidden" name="tingkat" value="{{ $alumni->tingkat ?? '' }}">

                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="text-lg font-bold text-ars-navy mb-4">Informasi Pekerjaan Saat Ini</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-2">Status / Pekerjaan</label>
                                    <input type="text" name="pekerjaan" value="{{ $alumni->pekerjaan ?? '' }}" placeholder="Contoh: Staff IT..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none">
                                </div>
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-2">Nama Perusahaan / Instansi</label>
                                    <input type="text" name="perusahaan" value="{{ $alumni->perusahaan ?? '' }}" placeholder="Contoh: PT. Maju Jaya..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-base font-bold text-gray-700 mb-2">Jabatan / Posisi</label>
                                    <input type="text" name="jabatan" value="{{ $alumni->jabatan ?? '' }}" placeholder="Contoh: Senior Web Developer" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================== STEP 1 - 9: KUESIONER ================== -->
                @php $step_index = 1; @endphp
                {{-- REVISI: $nama_kategori diubah jadi $nama_grup, $daftar_pertanyaan jadi $daftar_indikator --}}
                @foreach ($kuesioner as $nama_grup => $daftar_indikator)
                    <div class="step-content hidden" data-step="{{ $step_index }}" data-title="{{ $nama_grup }}">
                        <div class="space-y-8 sm:space-y-10">
                            @foreach ($daftar_indikator as $tanya)
                                <div class="bg-gray-50/50 p-6 sm:p-8 rounded-2xl border border-gray-200 shadow-sm">
                                    <div class="mb-4">
                                        <label class="text-lg font-bold text-gray-900 leading-snug block">
                                            {{-- REVISI: $tanya->pertanyaan diubah jadi $tanya->indikator --}}
                                            {{ $tanya->indikator }}
                                            @if($tanya->is_wajib) <span class="text-red-500">*</span> @endif
                                        </label>
                                        @if(!$tanya->is_wajib) <span class="text-sm text-gray-400 block mt-1">(Boleh dikosongkan)</span> @endif
                                    </div>

                                    <div class="mt-4">
                                        
                                        {{-- 1. PENGGABUNGAN: DATE, NUMBER, TEXT BIASA --}}
                                        @if (in_array($tanya->tipe_jawaban, ['number', 'text', 'date']))
                                            <input type="{{ $tanya->tipe_jawaban }}" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" 
                                                class="w-full sm:w-2/3 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy outline-none text-base shadow-sm"
                                                {{ $tanya->is_wajib ? 'required' : '' }}>
                                        
                                        {{-- 2. RADIO BUTTON --}}
                                        @elseif ($tanya->tipe_jawaban == 'radio')
                                            @php $opsi = json_decode($tanya->opsi_jawaban, true); @endphp
                                            @if ($nama_grup == 'Metode Pembelajaran')
                                                @php
                                                    // Pastikan opsi diurutkan dari yang terkecil ke terbesar (kiri ke kanan)
                                                    if(isset($opsi[0]) && $opsi[0] == 'Sangat Besar') {
                                                        $opsi = array_reverse($opsi);
                                                    }
                                                @endphp
                                                <div class="flex items-center w-full mt-4">
                                                    <div class="flex flex-1 justify-between bg-white px-2 sm:px-4 py-3 rounded-xl border border-gray-200 shadow-sm overflow-x-auto">
                                                        @foreach ($opsi as $val)
                                                            <label class="flex flex-col items-center justify-start cursor-pointer group p-1 sm:p-2 flex-1 min-w-[70px]">
                                                                <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $val }}" class="w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy" {{ $tanya->is_wajib ? 'required' : '' }}>
                                                                <span class="text-[10px] sm:text-xs text-center text-gray-600 mt-2 font-medium group-hover:text-ars-navy transition leading-snug">{{ $val }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <div class="space-y-1 mt-3">
                                                    @foreach ($opsi as $val)
                                                        <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                            <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $val }}" class="w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy" {{ $tanya->is_wajib ? 'required' : '' }}>
                                                            <span class="text-base text-gray-800">{{ $val }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endif

                                        {{-- 3. RADIO BUTTON LAINNYA --}}
                                        @elseif ($tanya->tipe_jawaban == 'radio_lainnya')
                                            @php $opsi = json_decode($tanya->opsi_jawaban, true); @endphp
                                            <div class="space-y-1 mt-3">
                                                @foreach ($opsi as $val)
                                                    <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                        <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $val }}" class="w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy" onchange="toggleLainnya(this, {{ $tanya->kuesioner_alumni_no }})" {{ $tanya->is_wajib ? 'required' : '' }}>
                                                        <span class="text-base text-gray-800">{{ $val }}</span>
                                                    </label>
                                                @endforeach
                                                <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                    <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="Lainnya" class="w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy" onchange="toggleLainnya(this, {{ $tanya->kuesioner_alumni_no }})" {{ $tanya->is_wajib ? 'required' : '' }}>
                                                    <span class="text-base text-gray-800">Lainnya:</span>
                                                </label>
                                                <input type="text" name="jawaban_lainnya[{{ $tanya->kuesioner_alumni_no }}]" id="lainnya_{{ $tanya->kuesioner_alumni_no }}" class="mt-1 w-full sm:w-2/3 px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-ars-navy outline-none rounded-xl text-base hidden shadow-sm" placeholder="Tuliskan spesifiknya di sini...">
                                            </div>

                                        {{-- 4. CHECKBOX --}}
                                        @elseif ($tanya->tipe_jawaban == 'checkbox' || $tanya->tipe_jawaban == 'checkbox_lainnya')
                                            @php $opsi = json_decode($tanya->opsi_jawaban, true); @endphp
                                            <div class="space-y-1 mt-3">
                                                @foreach ($opsi as $val)
                                                    <label class="flex items-start gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                        <input type="checkbox" name="jawaban[{{ $tanya->kuesioner_alumni_no }}][]" value="{{ $val }}" class="w-5 h-5 mt-0.5 text-ars-navy border-gray-300 rounded focus:ring-ars-navy">
                                                        <span class="text-base text-gray-800 leading-snug">{{ $val }}</span>
                                                    </label>
                                                @endforeach
                                                @if($tanya->tipe_jawaban == 'checkbox_lainnya')
                                                    <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                        <input type="checkbox" name="jawaban[{{ $tanya->kuesioner_alumni_no }}][]" value="Lainnya" class="w-5 h-5 text-ars-navy border-gray-300 rounded focus:ring-ars-navy" onchange="toggleLainnya(this, {{ $tanya->kuesioner_alumni_no }})">
                                                        <span class="text-base text-gray-800">Lainnya:</span>
                                                    </label>
                                                    <input type="text" name="jawaban_lainnya[{{ $tanya->kuesioner_alumni_no }}]" id="lainnya_{{ $tanya->kuesioner_alumni_no }}" class="mt-1 w-full sm:w-2/3 px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-ars-navy outline-none rounded-xl text-base hidden shadow-sm" placeholder="Tuliskan spesifiknya di sini...">
                                                @endif
                                            </div>

                                        {{-- 5. SCALE --}}
                                        @elseif ($tanya->tipe_jawaban == 'scale')
                                            <div class="flex items-center gap-2 sm:gap-6 w-full mt-4">
                                                <span class="text-[10px] sm:text-sm font-bold text-gray-500 text-right w-16 sm:w-24 leading-tight uppercase">Sangat Rendah</span>
                                                <div class="flex flex-1 justify-between bg-white px-4 py-3 rounded-xl border border-gray-200 shadow-sm overflow-x-auto">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <label class="flex flex-col items-center justify-start cursor-pointer group p-1 sm:p-2 flex-1 min-w-[30px]">
                                                            <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $i }}" class="w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy" {{ $tanya->is_wajib ? 'required' : '' }}>
                                                            <span class="text-sm sm:text-base text-gray-800 mt-2 font-medium group-hover:text-ars-navy transition">{{ $i }}</span>
                                                        </label>
                                                    @endfor
                                                </div>
                                                <span class="text-[10px] sm:text-sm font-bold text-gray-500 text-left w-16 sm:w-24 leading-tight uppercase">Sangat Tinggi</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php $step_index++; @endphp
                @endforeach

                <div class="mt-12 pt-8 border-t border-gray-200 flex justify-between items-center">
                    <button type="button" id="btnPrev" class="hidden px-6 py-3.5 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition-colors">
                        &larr; Kembali
                    </button>
                    
                    <button type="button" id="btnNext" class="px-8 py-3.5 bg-ars-navy text-white font-bold rounded-xl shadow-md hover:bg-blue-900 transition-colors ml-auto text-lg">
                        Selanjutnya &rarr;
                    </button>
                    
                    <div id="submitWrapper" class="hidden ml-auto">
                        <button type="button" id="btnSubmitFake" class="flex px-8 py-3.5 bg-green-500 text-white font-bold rounded-xl shadow-md hover:bg-green-600 transition-colors items-center gap-2 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <p class="text-center text-sm text-gray-400 mt-10 mb-6">&copy; {{ date('Y') }} ARS University. All Rights Reserved.</p>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.step-content');
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');
            const submitWrapper = document.getElementById('submitWrapper');
            const titleEl = document.getElementById('stepTitle');
            const counterEl = document.getElementById('stepCounter');
            const progressEl = document.getElementById('progressBar');
            const form = document.getElementById('kuesionerForm');
            const btnSubmitFake = document.getElementById('btnSubmitFake');
            
            let currentStep = 0;
            const totalSteps = steps.length;

            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('mousedown', function() { this.dataset.wasChecked = this.checked; });
                radio.addEventListener('click', function() {
                    if (this.dataset.wasChecked === 'true') {
                        this.checked = false;
                        this.dataset.wasChecked = 'false';
                        this.dispatchEvent(new Event('change'));
                    }
                });
            });

            function updateUI() {
                steps.forEach((step, index) => {
                    step.classList.remove('active');
                    if (index === currentStep) step.classList.add('active');
                });
                titleEl.innerText = steps[currentStep].getAttribute('data-title');
                counterEl.innerText = `Bagian ${currentStep + 1} dari ${totalSteps}`;
                progressEl.style.width = ((currentStep + 1) / totalSteps * 100) + '%';
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
                const currentInputs = steps[currentStep].querySelectorAll('input[required], select[required]');
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
                        title: 'Apakah Anda Yakin?',
                        text: "Pastikan semua jawaban kuesioner sudah terisi dengan benar.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Kirim Kuesioner!',
                        cancelButtonText: 'Batal'
                    }).then((result) => { if (result.isConfirmed) form.submit(); })
                }
            });
            updateUI(); 
        });

        function toggleLainnya(element, id) {
            const inputEsai = document.getElementById('lainnya_' + id);
            if (element.checked && element.value === 'Lainnya') {
                inputEsai.classList.remove('hidden'); 
                inputEsai.setAttribute('required', 'required'); 
            } else if (element.type === 'radio' || (element.type === 'checkbox' && !element.checked)) {
                inputEsai.classList.add('hidden');
                inputEsai.removeAttribute('required');
                inputEsai.value = ''; 
            }
        }
    </script>
</body>
</html>