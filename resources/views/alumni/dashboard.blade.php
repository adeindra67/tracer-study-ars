<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracer Study Alumni - ARS University</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-ars-university.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .step-content { display: none; }
        .step-content.active { display: block; animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .badge-opsional { transition: all 0.3s; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <nav class="bg-ars-navy text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1 rounded h-8 w-8 sm:h-10 sm:w-10">
                        <img src="{{ asset('images/logo-ars-university.webp') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="font-bold tracking-widest uppercase text-ars-yellow text-sm sm:text-base">KUESIONER ALUMNI</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-300 hidden sm:block">NIM: {{ $alumni->nim }}</span>
                    <form method="POST" action="{{ route('alumni.logout') }}" id="logoutForm">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="text-sm font-medium text-red-300 hover:text-red-100 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
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

        <!-- MUNCULKAN PESAN ERROR DARI CONTROLLER DI SINI -->
        @if (session('error'))
            <div class="max-w-4xl mx-auto bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl flex items-start gap-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <h3 class="text-sm font-bold text-red-800">Penyimpanan Gagal</h3>
                    <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
                </div>
            </div>
        @endif

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

                <!-- ================== STEP 0: DATA DIRI & STATUS ================== -->
                <div class="step-content active" data-step="0" data-title="Verifikasi & Status">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-lg mb-8 text-base text-blue-800 leading-relaxed">
                        Pastikan kontak Anda aktif. Status pekerjaan Anda akan menentukan <strong>pertanyaan mana yang wajib dan opsional</strong> di tahap selanjutnya.
                    </div>
                    
                    <div class="space-y-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Email Aktif <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ $alumni->email ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy" required>
                            </div>
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" name="no_hp" value="{{ $alumni->no_hp ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">NIK (Sesuai KTP) <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" value="{{ $alumni->nik ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy" required>
                            </div>
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">NPWP (Opsional)</label>
                                <input type="text" name="npwp" value="{{ $alumni->npwp ?? '' }}" placeholder="Isi jika ada" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy">
                            </div>
                        </div>

                        <!-- Status Saat Ini -->
                        <div class="border-t border-gray-100 pt-6">
                            <label class="block text-lg font-bold text-ars-navy mb-4">Status Anda Saat Ini <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                    <input type="radio" name="pekerjaan" value="Bekerja (full time/ part time)" onchange="applyDynamicValidation()" class="w-5 h-5 text-ars-navy focus:ring-ars-navy" {{ ($alumni->pekerjaan ?? '') == 'Bekerja (full time/ part time)' ? 'checked' : '' }} required>
                                    <span class="font-medium text-gray-700">Bekerja (Full / Part time)</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                    <input type="radio" name="pekerjaan" value="Wiraswasta" onchange="applyDynamicValidation()" class="w-5 h-5 text-ars-navy focus:ring-ars-navy" {{ ($alumni->pekerjaan ?? '') == 'Wiraswasta' ? 'checked' : '' }} required>
                                    <span class="font-medium text-gray-700">Wiraswasta / Pemilik Usaha</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                    <input type="radio" name="pekerjaan" value="Melanjutkan pendidikan" onchange="applyDynamicValidation()" class="w-5 h-5 text-ars-navy focus:ring-ars-navy" {{ ($alumni->pekerjaan ?? '') == 'Melanjutkan pendidikan' ? 'checked' : '' }} required>
                                    <span class="font-medium text-gray-700">Melanjutkan Pendidikan (Studi Lanjut)</span>
                                </label>
                                <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                    <input type="radio" name="pekerjaan" value="Belum memungkinkan kerja" onchange="applyDynamicValidation()" class="w-5 h-5 text-ars-navy focus:ring-ars-navy" {{ ($alumni->pekerjaan ?? '') == 'Belum memungkinkan kerja' ? 'checked' : '' }} required>
                                    <span class="font-medium text-gray-700">Belum / Tidak Bekerja</span>
                                </label>
                            </div>
                        </div>

                        <!-- Form Informasi Pekerjaan -->
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mt-6 relative">
                            <h3 class="text-lg font-bold text-ars-navy mb-4">
                                Informasi Pekerjaan Saat Ini 
                                <span id="badge_info_pekerjaan" class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded ml-2 hidden">Opsional untuk Anda</span>
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <!-- name diubah ke 'jabatan' -->
                                    <label class="block text-base font-bold text-gray-700 mb-2">Status / Jabatan <span class="text-red-500 star-pekerjaan">*</span></label>
                                    <input type="text" name="jabatan" id="input_pekerjaan" value="{{ $alumni->jabatan ?? '' }}" placeholder="Contoh: Staff IT..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy dynamic-pekerjaan">
                                </div>
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-2">Nama Perusahaan / Usaha <span class="text-red-500 star-pekerjaan">*</span></label>
                                    <input type="text" name="perusahaan" id="input_perusahaan" value="{{ $alumni->perusahaan ?? '' }}" placeholder="Contoh: PT. Maju Jaya..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy dynamic-pekerjaan">
                                </div>
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-2">Bidang Pekerjaan <span class="text-red-500 star-pekerjaan">*</span></label>
                                    <select name="bidang_kerja" id="input_bidang" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy dynamic-pekerjaan">
                                        <option value="">-- Pilih Bidang --</option>
                                        <option value="Infokom" {{ ($alumni->bidang_kerja ?? '') == 'Infokom' ? 'selected' : '' }}>Infokom (IT/Teknologi)</option>
                                        <option value="Non-Infokom" {{ ($alumni->bidang_kerja ?? '') == 'Non-Infokom' ? 'selected' : '' }}>Non-Infokom</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-2">Tingkat Instansi <span class="text-red-500 star-pekerjaan">*</span></label>
                                    <select name="tingkat" id="input_tingkat" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy dynamic-pekerjaan">
                                        <option value="">-- Pilih Tingkat --</option>
                                        <option value="Lokal" {{ ($alumni->tingkat ?? '') == 'Lokal' ? 'selected' : '' }}>Lokal / Tidak Berbadan Hukum</option>
                                        <option value="Nasional" {{ ($alumni->tingkat ?? '') == 'Nasional' ? 'selected' : '' }}>Nasional / Berbadan Hukum</option>
                                        <option value="Multinasional" {{ ($alumni->tingkat ?? '') == 'Multinasional' ? 'selected' : '' }}>Multinasional / Internasional</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================== STEP 1 - END: KUESIONER UTAMA ================== -->
                @php $step_index = 1; @endphp
                @foreach ($kuesioner as $nama_grup => $daftar_indikator)
                    <div class="step-content" data-step="{{ $step_index }}" data-title="{{ $nama_grup }}">
                        <div class="space-y-8 sm:space-y-10">
                            @foreach ($daftar_indikator as $tanya)
                                
                                @php
                                    $kode = $tanya->kode_dikti;
                                    $kategori = 'umum'; // Default: Wajib untuk semua

                                    if (in_array($kode, ['f502b', 'f5c'])) {
                                        $kategori = 'wiraswasta_only';
                                    }
                                    elseif ($kode == 'f502') {
                                        $kategori = 'bekerja_only';
                                    }
                                    elseif (
                                        in_array($kode, ['f504', 'f505', 'f5a1', 'f5a2', 'f1101', 'f5b', 'f14', 'f15', 'f16']) || 
                                        in_array($kode, ['f1762', 'f1764', 'f1766', 'f1768', 'f1770', 'f1772', 'f1774'])
                                    ) {
                                        $kategori = 'bekerja';
                                    } 
                                    elseif (str_starts_with($kode, 'f18')) {
                                        $kategori = 'lanjut_studi';
                                    } 
                                    elseif (in_array($kode, ['f301', 'f302', 'f303', 'f4', 'f6', 'f7', 'f7a', 'f1001'])) {
                                        $kategori = 'mencari_kerja';
                                    }
                                @endphp

                                <div class="question-wrapper bg-gray-50/50 p-6 sm:p-8 rounded-2xl border border-gray-200 shadow-sm" data-kategori="{{ $kategori }}" data-kode="{{ $kode }}">
                                    <div class="mb-4">
                                        <label class="text-lg font-bold text-gray-900 leading-snug block">
                                            {{ $tanya->indikator }}
                                            <span class="text-red-500 required-star hidden">*</span>
                                            <span class="badge-opsional text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded ml-2 inline-block hidden">Opsional untuk Anda</span>
                                        </label>
                                    </div>

                                    <div class="mt-4 input-container">
                                        
                                        {{-- FITUR AUTO RUPIAH UNTUK GAJI (F505) --}}
                                        @if ($kode == 'f505')
                                            <div class="relative w-full sm:w-2/3">
                                                <span class="absolute left-4 top-3 text-gray-500 font-bold">Rp</span>
                                                <input type="text" 
                                                    class="dynamic-input w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy" 
                                                    placeholder="0" 
                                                    onkeyup="formatUang(this, '{{ $tanya->kuesioner_alumni_no }}')">
                                                
                                                <input type="hidden" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" id="real_uang_{{ $tanya->kuesioner_alumni_no }}">
                                            </div>

                                        {{-- FITUR BARU: AUTO MASKING TANGGAL UNTUK DATE (F18D) --}}
                                        @elseif ($tanya->tipe_jawaban == 'date')
                                            <input type="text" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" 
                                                placeholder="DD/MM/YYYY"
                                                oninput="formatTanggalKuesioner(this)"
                                                class="dynamic-input w-full sm:w-2/3 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy tracking-widest text-lg font-medium">

                                        {{-- INPUT NUMBER/TEXT BIASA --}}
                                        @elseif (in_array($tanya->tipe_jawaban, ['number', 'text']))
                                            <input type="{{ $tanya->tipe_jawaban }}" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" 
                                                class="dynamic-input w-full sm:w-2/3 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-ars-navy">
                                        
                                        {{-- JIKA RADIO BIASA --}}
                                        @elseif ($tanya->tipe_jawaban == 'radio')
                                            @php 
                                                $opsi = is_array($tanya->opsi_jawaban) ? $tanya->opsi_jawaban : (json_decode($tanya->opsi_jawaban, true) ?? []); 
                                                
                                                $isBoxStyle = false;
                                                if (isset($opsi[0])) {
                                                    $cek = strtolower(trim($opsi[0]));
                                                    if (str_contains($cek, 'besar') || str_contains($cek, 'erat') || str_contains($cek, 'sekali') || str_contains($cek, 'sangat')) {
                                                        $isBoxStyle = true;
                                                    }
                                                }
                                            @endphp

                                            @if ($isBoxStyle)
                                                @php if(isset($opsi[0]) && str_contains(strtolower($opsi[0]), 'sangat')) $opsi = array_reverse($opsi); @endphp
                                                <div class="w-full mt-4">
                                                    <div class="flex flex-col sm:flex-row sm:flex-1 sm:justify-between bg-transparent sm:bg-white sm:px-4 sm:py-3 rounded-xl sm:border sm:border-gray-200 sm:shadow-sm sm:overflow-x-auto gap-2 sm:gap-0">
                                                        @foreach ($opsi as $val)
                                                            <label class="flex flex-row sm:flex-col items-center sm:justify-start cursor-pointer group p-3 sm:p-2 flex-1 sm:min-w-[70px] bg-white sm:bg-transparent border border-gray-200 sm:border-none rounded-xl sm:rounded-none hover:bg-blue-50 transition-colors mb-1 sm:mb-0">
                                                                <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $val }}" class="dynamic-input w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy cancelable-radio shrink-0 mr-3 sm:mr-0">
                                                                <span class="text-base sm:text-[10px] sm:text-xs text-left sm:text-center text-gray-800 sm:text-gray-600 sm:mt-2 font-medium group-hover:text-ars-navy transition leading-snug w-full sm:w-auto">{{ $val }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <div class="space-y-1 mt-3">
                                                    @foreach ($opsi as $val)
                                                        <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                            <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $val }}" class="dynamic-input w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy cancelable-radio">
                                                            <span class="text-base text-gray-800">{{ $val }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endif

                                        @elseif ($tanya->tipe_jawaban == 'radio_lainnya')
                                            @php $opsi = is_array($tanya->opsi_jawaban) ? $tanya->opsi_jawaban : (json_decode($tanya->opsi_jawaban, true) ?? []); @endphp
                                            <div class="space-y-1 mt-3">
                                                @foreach ($opsi as $val)
                                                    <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                        <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $val }}" class="dynamic-input w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy cancelable-radio" onchange="toggleLainnya(this, {{ $tanya->kuesioner_alumni_no }})">
                                                        <span class="text-base text-gray-800">{{ $val }}</span>
                                                    </label>
                                                @endforeach
                                                <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                    <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="Lainnya" class="dynamic-input w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy cancelable-radio" onchange="toggleLainnya(this, {{ $tanya->kuesioner_alumni_no }})">
                                                    <span class="text-base text-gray-800">Lainnya:</span>
                                                </label>
                                                <input type="text" name="jawaban_lainnya[{{ $tanya->kuesioner_alumni_no }}]" id="lainnya_{{ $tanya->kuesioner_alumni_no }}" class="mt-1 w-full sm:w-2/3 px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-ars-navy outline-none rounded-xl text-base hidden shadow-sm" placeholder="Tuliskan spesifiknya di sini...">
                                            </div>

                                        @elseif ($tanya->tipe_jawaban == 'checkbox' || $tanya->tipe_jawaban == 'checkbox_lainnya')
                                            @php $opsi = is_array($tanya->opsi_jawaban) ? $tanya->opsi_jawaban : (json_decode($tanya->opsi_jawaban, true) ?? []); @endphp
                                            <div class="space-y-1 mt-3">
                                                @foreach ($opsi as $val)
                                                    <label class="flex items-start gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                        <input type="checkbox" name="jawaban[{{ $tanya->kuesioner_alumni_no }}][]" value="{{ $val }}" class="dynamic-input w-5 h-5 mt-0.5 text-ars-navy border-gray-300 rounded focus:ring-ars-navy">
                                                        <span class="text-base text-gray-800 leading-snug">{{ $val }}</span>
                                                    </label>
                                                @endforeach
                                                @if($tanya->tipe_jawaban == 'checkbox_lainnya')
                                                    <label class="flex items-center gap-3 cursor-pointer p-3 -ml-3 rounded-xl hover:bg-blue-50 transition">
                                                        <input type="checkbox" name="jawaban[{{ $tanya->kuesioner_alumni_no }}][]" value="Lainnya" class="dynamic-input w-5 h-5 text-ars-navy border-gray-300 rounded focus:ring-ars-navy" onchange="toggleLainnya(this, {{ $tanya->kuesioner_alumni_no }})">
                                                        <span class="text-base text-gray-800">Lainnya:</span>
                                                    </label>
                                                    <input type="text" name="jawaban_lainnya[{{ $tanya->kuesioner_alumni_no }}]" id="lainnya_{{ $tanya->kuesioner_alumni_no }}" class="mt-1 w-full sm:w-2/3 px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-ars-navy outline-none rounded-xl text-base hidden shadow-sm" placeholder="Tuliskan spesifiknya di sini...">
                                                @endif
                                            </div>

                                        @elseif ($tanya->tipe_jawaban == 'scale')
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 w-full mt-4">
                                                <span class="text-sm sm:text-[10px] sm:text-sm font-bold text-gray-500 text-left sm:text-right w-full sm:w-16 sm:w-24 leading-tight uppercase">Sangat Rendah <span class="sm:hidden ml-1">(1)</span></span>
                                                
                                                <div class="flex flex-col sm:flex-row flex-1 justify-between bg-transparent sm:bg-white sm:px-4 sm:py-3 rounded-xl sm:border sm:border-gray-200 sm:shadow-sm sm:overflow-x-auto gap-2 sm:gap-0">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <label class="flex flex-row sm:flex-col items-center justify-start cursor-pointer group p-3 sm:p-2 flex-1 sm:min-w-[30px] bg-white sm:bg-transparent border border-gray-200 sm:border-none rounded-xl sm:rounded-none hover:bg-blue-50 transition-colors">
                                                            <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $i }}" class="dynamic-input w-5 h-5 text-ars-navy border-gray-300 focus:ring-ars-navy cancelable-radio shrink-0 mr-3 sm:mr-0">
                                                            <span class="text-base sm:text-sm sm:text-base text-gray-800 sm:mt-2 font-medium group-hover:text-ars-navy transition">{{ $i }}</span>
                                                        </label>
                                                    @endfor
                                                </div>
                                                
                                                <span class="text-sm sm:text-[10px] sm:text-sm font-bold text-gray-500 text-left sm:text-left w-full sm:w-16 sm:w-24 leading-tight uppercase">Sangat Tinggi <span class="sm:hidden ml-1">(5)</span></span>
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
                            Kirim Kuesioner
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // ==========================================
        // FITUR AUTO FORMAT RUPIAH
        // ==========================================
        function formatUang(element, idSoal) {
            let value = element.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            element.value = rupiah;
            
            const hiddenInput = document.getElementById('real_uang_' + idSoal);
            if (hiddenInput) {
                hiddenInput.value = value;
            }
        }

        // ==========================================
        // FITUR AUTO FORMAT TANGGAL (DD/MM/YYYY)
        // ==========================================
        function formatTanggalKuesioner(element) {
            let v = element.value.replace(/\D/g, ''); 
            if (v.length > 8) v = v.slice(0, 8); 

            let finalValue = "";
            if (v.length > 0) {
                let day = v.slice(0, 2);
                if (parseInt(day) > 31) day = "31";
                finalValue = day;
                
                if (v.length > 2) {
                    let month = v.slice(2, 4);
                    if (parseInt(month) > 12) month = "12";
                    finalValue += "/" + month;
                    
                    if (v.length > 4) {
                        let year = v.slice(4, 8);
                        finalValue += "/" + year;
                    }
                }
            }
            element.value = finalValue;
        }

        // ==========================================
        // VALIDASI, RESET & LOGIKA
        // ==========================================
        let previousStatus = document.querySelector('input[name="pekerjaan"]:checked')?.value || '';

        function applyDynamicValidation() {
            const statusRadio = document.querySelector('input[name="pekerjaan"]:checked');
            const status = statusRadio ? statusRadio.value : '';

            if (previousStatus !== '' && previousStatus !== status) {
                resetNonRelevantFields(status);
            }
            previousStatus = status;

            const isKerja = status.includes('Bekerja') || status.includes('Wiraswasta');
            const inputsPekerjaan = ['input_pekerjaan', 'input_perusahaan', 'input_bidang', 'input_tingkat'];
            const starsPekerjaan = document.querySelectorAll('.star-pekerjaan');
            const badgePekerjaan = document.getElementById('badge_info_pekerjaan');

            inputsPekerjaan.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (isKerja) el.setAttribute('required', 'required');
                    else el.removeAttribute('required');
                }
            });

            if (isKerja) {
                starsPekerjaan.forEach(star => star.classList.remove('hidden'));
                if(badgePekerjaan) badgePekerjaan.classList.add('hidden');
            } else {
                starsPekerjaan.forEach(star => star.classList.add('hidden'));
                if(badgePekerjaan) badgePekerjaan.classList.remove('hidden');
            }

            document.querySelectorAll('.question-wrapper').forEach(wrapper => {
                const kategori = wrapper.getAttribute('data-kategori');
                let isRequired = false;

                if (kategori === 'umum') {
                    isRequired = true;
                } else if (status !== '') {
                    if (kategori === 'bekerja_only' && status === 'Bekerja (full time/ part time)') isRequired = true;
                    if (kategori === 'wiraswasta_only' && status === 'Wiraswasta') isRequired = true; 
                    if (kategori === 'bekerja' && isKerja) isRequired = true;
                    if (kategori === 'lanjut_studi' && status.includes('Melanjutkan')) isRequired = true;
                    if (kategori === 'mencari_kerja' && !status.includes('Melanjutkan')) isRequired = true;
                }

                const inputs = wrapper.querySelectorAll('.dynamic-input');
                const star = wrapper.querySelector('.required-star');
                const badge = wrapper.querySelector('.badge-opsional');

                if (isRequired) {
                    inputs.forEach(input => {
                        if (input.type !== 'checkbox') input.setAttribute('required', 'required');
                    });
                    wrapper.setAttribute('data-wajib', 'true'); 
                    if (star) star.classList.remove('hidden');
                    if (badge) badge.classList.add('hidden');
                } else {
                    inputs.forEach(input => input.removeAttribute('required'));
                    wrapper.setAttribute('data-wajib', 'false');
                    if (star) star.classList.add('hidden');
                    if (badge) badge.classList.remove('hidden');
                }
            });

            // Panggil logika dinamis untuk F301, F302, F303 setelah validasi umum berjalan
            applyDynamicMencariKerja();
        }

        function resetNonRelevantFields(newStatus) {
            const isKerja = newStatus.includes('Bekerja') || newStatus.includes('Wiraswasta');
            
            if (!isKerja) {
                document.querySelectorAll('.dynamic-pekerjaan').forEach(input => {
                    if (input.tagName === 'SELECT') input.selectedIndex = 0;
                    else input.value = '';
                });
            }

            document.querySelectorAll('.question-wrapper').forEach(wrapper => {
                const kategori = wrapper.getAttribute('data-kategori');
                let shouldReset = false;

                if (kategori === 'bekerja_only' && newStatus !== 'Bekerja (full time/ part time)') shouldReset = true;
                if (kategori === 'wiraswasta_only' && newStatus !== 'Wiraswasta') shouldReset = true;
                if (kategori === 'bekerja' && !isKerja) shouldReset = true;
                if (kategori === 'lanjut_studi' && !newStatus.includes('Melanjutkan')) shouldReset = true;
                if (kategori === 'mencari_kerja' && newStatus.includes('Melanjutkan')) shouldReset = true;

                if (shouldReset) {
                    wrapper.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => {
                        input.value = '';
                        if(input.hasAttribute('onkeyup')) {
                            const hiddenInput = wrapper.querySelector('input[type="hidden"]');
                            if(hiddenInput) hiddenInput.value = '';
                        }
                    });
                    wrapper.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => input.checked = false);
                    wrapper.querySelectorAll('input[id^="lainnya_"]').forEach(input => {
                        input.classList.add('hidden');
                        input.value = '';
                    });
                }
            });
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Keluar dari Kuesioner?',
                text: "Data yang belum disimpan akan hilang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('logoutForm').submit();
            })
        }

        document.addEventListener('DOMContentLoaded', function() {
            applyDynamicValidation();

            const steps = document.querySelectorAll('.step-content');
            if (steps.length === 0) return;

            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');
            const submitWrapper = document.getElementById('submitWrapper');
            const titleEl = document.getElementById('stepTitle');
            const counterEl = document.getElementById('stepCounter');
            const progressEl = document.getElementById('progressBar');
            const form = document.getElementById('kuesionerForm');
            
            let currentStep = 0;
            const totalSteps = steps.length;

            const radioButtons = document.querySelectorAll('.cancelable-radio');
            radioButtons.forEach(radio => {
                radio.addEventListener('mousedown', function() { this.dataset.wasChecked = this.checked; });
                radio.addEventListener('click', function(e) {
                    if (this.dataset.wasChecked === 'true') {
                        this.checked = false;
                        this.dataset.wasChecked = 'false';
                        if (this.value === 'Lainnya') {
                            const wrapper = this.closest('.question-wrapper');
                            if (wrapper) {
                                const idSoal = this.name.match(/\[(.*?)\]/)[1];
                                const inputEsai = document.getElementById('lainnya_' + idSoal);
                                if(inputEsai) {
                                    inputEsai.classList.add('hidden');
                                    inputEsai.removeAttribute('required');
                                    inputEsai.value = '';
                                }
                            }
                        }
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
                let isValid = true;
                const currentInputs = steps[currentStep].querySelectorAll('input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])');
                
                for (let input of currentInputs) {
                    if (input.offsetParent === null) continue;
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        return false; 
                    }
                }

                const wrappers = steps[currentStep].querySelectorAll('.question-wrapper[data-wajib="true"]');
                for (let wrapper of wrappers) {
                    if (wrapper.offsetParent === null) continue;

                    const checkboxes = wrapper.querySelectorAll('input[type="checkbox"].dynamic-input');
                    if (checkboxes.length > 0) {
                        const checkedCount = wrapper.querySelectorAll('input[type="checkbox"].dynamic-input:checked').length;
                        
                        if (checkedCount === 0) {
                            checkboxes[0].setCustomValidity('Silakan pilih setidaknya satu opsi.');
                            checkboxes[0].reportValidity();
                            
                            checkboxes.forEach(cb => {
                                cb.addEventListener('change', function clearErr() {
                                    checkboxes[0].setCustomValidity('');
                                    cb.removeEventListener('change', clearErr);
                                }, { once: true });
                            });
                            
                            return false; 
                        } else {
                            checkboxes[0].setCustomValidity('');
                        }
                    }
                }

                return isValid;
            }

            btnNext.addEventListener('click', () => { if (validateCurrentStep()) { currentStep++; updateUI(); } });
            btnPrev.addEventListener('click', () => { currentStep--; updateUI(); });
            
            document.getElementById('btnSubmitFake').addEventListener('click', function() {
                if (validateCurrentStep()) {
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: "Data kuesioner akan disimpan secara permanen.",
                        icon: 'question',
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
            const parentWrapper = element.closest('.question-wrapper');
            const isParentRequired = parentWrapper ? parentWrapper.dataset.wajib === 'true' : false;

            if (element.checked && element.value === 'Lainnya') {
                inputEsai.classList.remove('hidden'); 
                if(isParentRequired) inputEsai.setAttribute('required', 'required'); 
            } else if (element.type === 'radio' || (element.type === 'checkbox' && !element.checked)) {
                inputEsai.classList.add('hidden');
                inputEsai.removeAttribute('required');
                inputEsai.value = ''; 
            }
        }

        // ========================================================
        // FITUR BARU: LOGIKA DINAMIS MENCARI KERJA (F301, F302, F303)
        // ========================================================
        function applyDynamicMencariKerja() {
            const f301Wrapper = document.querySelector('.question-wrapper[data-kode="f301"]');
            const f302Wrapper = document.querySelector('.question-wrapper[data-kode="f302"]');
            const f303Wrapper = document.querySelector('.question-wrapper[data-kode="f303"]');

            if (f301Wrapper && f302Wrapper && f303Wrapper) {
                // Jika kategori mencari kerja sedang TIDAK wajib (misal karena status alumni lanjut studi), hentikan.
                if (f301Wrapper.getAttribute('data-wajib') === 'false') return;

                const f301Checked = f301Wrapper.querySelector('input[type="radio"]:checked');
                const val = f301Checked ? f301Checked.value : '';

                const setRequiredStatus = (wrapper, isRequired) => {
                    const star = wrapper.querySelector('.required-star');
                    const badge = wrapper.querySelector('.badge-opsional');
                    const inputs = wrapper.querySelectorAll('.dynamic-input');

                    if (isRequired) {
                        // Jadikan Wajib
                        wrapper.setAttribute('data-wajib', 'true');
                        if(star) star.classList.remove('hidden');
                        if(badge) badge.classList.add('hidden');
                        // Berikan visual warna biru tipis sebagai penanda
                        wrapper.classList.add('border-blue-300', 'bg-blue-50/50');
                        inputs.forEach(input => {
                            if (input.type !== 'checkbox') input.setAttribute('required', 'required');
                        });
                    } else {
                        // Jadikan Opsional
                        wrapper.setAttribute('data-wajib', 'false');
                        if(star) star.classList.add('hidden');
                        if(badge) badge.classList.remove('hidden');
                        wrapper.classList.remove('border-blue-300', 'bg-blue-50/50');
                        inputs.forEach(input => {
                            input.removeAttribute('required');
                            // Reset pilihan yang ada agar database bersih
                            if(input.type === 'radio' || input.type === 'checkbox') input.checked = false;
                        });
                    }
                };

                // Terapkan Logika Tampil/Opsional
                if (val === 'Sebelum lulus kuliah') {
                    setRequiredStatus(f302Wrapper, true);   // F302 Wajib
                    setRequiredStatus(f303Wrapper, false);  // F303 Opsional
                } else if (val === 'Sesudah lulus kuliah') {
                    setRequiredStatus(f302Wrapper, false);  // F302 Opsional
                    setRequiredStatus(f303Wrapper, true);   // F303 Wajib
                } else {
                    // Jika pilih "Tidak mencari kerja" atau belum mengisi
                    setRequiredStatus(f302Wrapper, false); 
                    setRequiredStatus(f303Wrapper, false); 
                }
            }
        }

        // Tambahkan event listener untuk F301 agar bereaksi langsung saat diklik
        document.addEventListener('change', function(e) {
            if (e.target.closest('.question-wrapper[data-kode="f301"]')) {
                applyDynamicMencariKerja();
            }
        });
    </script>
</body>
</html>