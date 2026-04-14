<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Tracer Study - ARS University</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-ars-navy text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-white text-ars-navy font-bold p-1.5 rounded flex items-center justify-center h-8 w-8">
                        ARS
                    </div>
                    <span class="font-bold tracking-widest uppercase text-ars-yellow">Tracer Study</span>
                </div>
                
                <form method="POST" action="{{ route('alumni.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-blue-200 hover:text-white transition-colors flex items-center gap-2">
                        <span>Keluar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-ars-yellow opacity-10 rounded-bl-full"></div>
            <h1 class="text-3xl font-extrabold text-ars-navy mb-2">Halo, {{ $alumni->nama }}!</h1>
            <p class="text-ars-gray text-sm md:text-base">
                NIM: <span class="font-bold">{{ $alumni->nim }}</span> | Program Studi: {{ $alumni->prodi }} (Lulusan {{ $alumni->lulus_tahun }})
            </p>
            <p class="mt-4 text-gray-600 leading-relaxed">
                Terima kasih telah berpartisipasi dalam Tracer Study ARS University. Mohon isi kuesioner di bawah ini dengan data yang sebenar-benarnya untuk membantu peningkatan kualitas kampus kita.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border-t-4 border-ars-navy p-8 sm:p-10">
            <h2 class="text-xl font-bold text-ars-navy mb-6 border-b pb-4">Formulir Kuesioner Wajib</h2>

            @if (session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
        <p class="text-sm text-green-700 font-bold">{{ session('success') }}</p>
    </div>
@endif

<form action="{{ route('alumni.dashboard.store') }}" method="POST" class="space-y-8">                
    @csrf
                
                @foreach ($kuesioner as $index => $tanya)
                    <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100 transition duration-300 hover:shadow-md hover:border-ars-navy/20 group">
                        <div class="flex gap-3 mb-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-ars-navy text-ars-yellow font-bold flex items-center justify-center rounded-full text-sm">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <label class="text-base font-bold text-gray-900 leading-snug block">
                                    {{ $tanya->pertanyaan }}
                                </label>
                                <span class="text-xs text-gray-400 font-mono mt-1 block">Kode: {{ $tanya->kode_dikti }}</span>
                            </div>
                        </div>

                        <div class="ml-11">
                            @if ($tanya->tipe_jawaban == 'radio')
                                @php
                                    // Mengubah JSON dari database menjadi Array PHP
                                    $opsi = json_decode($tanya->opsi_jawaban, true);
                                @endphp
                                
                                <div class="space-y-3">
                                    @foreach ($opsi as $kunci => $nilai)
                                        <label class="flex items-start gap-3 cursor-pointer group/item">
                                            <div class="flex items-center h-5">
                                                <input type="radio" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" value="{{ $kunci }}" required
                                                    class="w-4 h-4 text-ars-navy border-gray-300 focus:ring-ars-navy">
                                            </div>
                                            <span class="text-sm text-gray-700 group-hover/item:text-ars-navy transition-colors">{{ $nilai }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            @elseif ($tanya->tipe_jawaban == 'number')
                                <input type="number" name="jawaban[{{ $tanya->kuesioner_alumni_no }}]" required
                                    class="w-full sm:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ars-navy focus:border-ars-navy outline-none transition-all"
                                    placeholder="Ketik angka di sini...">
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-ars-navy hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 flex items-center gap-2">
                        Simpan & Kirim Jawaban
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-center text-sm text-gray-400 mt-8 mb-4">
            &copy; {{ date('Y') }} ARS University. All rights reserved.
        </p>
    </main>

</body>
</html>