<div>

{{-- ================= HERO ================= --}}
<section class="px-6 md:px-12 lg:px-20 py-20 bg-white text-center">
    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl 
                font-bold leading-tight tracking-tight text-gray-900">
            
            Bangun Karier Lewat 
            <span class="text-blue-700 inline-block">
                Program Magang
            </span>
            <br>
            yang Relevan dan Berdampak

        </h1>

        <p class="mt-6 text-gray-600 text-base sm:text-lg">
            Platform resmi program magang Rumah BUMN Yogyakarta.
            Kembangkan keterampilan dan pengalaman profesional Anda.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row 
                    justify-center items-center gap-4">

            <a href="/daftar"
               class="px-6 py-3 bg-yellow-400 rounded-md font-medium
                      hover:bg-yellow-500 transition duration-200">
                Daftar Sekarang
            </a>

            <a href="/informasi"
               class="px-6 py-3 border border-black rounded-md
                      hover:bg-black hover:text-white
                      transition duration-200">
                Pelajari Lebih Lanjut
            </a>

        </div>

    </div>
</section>

<section class="px-6 md:px-12 lg:px-20 py-8 bg-linear-to-b from-blue-600 via-blue-700 to-blue-800">
    <div class="max-w-7xl mx-auto">
        <div class="mb-10 text-center">
            <h2 class="mt-4 text-3xl md:text-4xl font-extrabold  text-yellow-400">Timeline Seleksi Magang</h2>
            <p class="mt-6 text-white max-w-2xl mx-auto">Lihat tahapan seleksi dan tanggal penting program magang secara ringkas agar Anda dapat mempersiapkan diri dengan baik.</p>
        </div>

        @if($batch)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($batch->timeline_steps as $step)
            <div class="rounded-3xl bg-white/10 p-6
                hover:bg-white/20 hover:-translate-y-1
                transition duration-300 text-center">
                
                <p class="text-xs uppercase tracking-[0.2em] text-yellow-400 font-semibold">
                    {{ $step['title'] }}
                </p>

                <p class="mt-4 text-lg font-semibold text-white">
                    {{ $step['date'] }}
                </p>

            </div>
        @endforeach
    </div>
@else
    <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm">
        <p class="text-slate-700 font-medium">
            Informasi batch belum tersedia. Silakan hubungi admin untuk detail periode seleksi.
        </p>
    </div>
@endif
    </div>
</section>


<section class="px-6 md:px-12 lg:px-20 py-16 bg-slate-50">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Mengapa Bergabung?</h2>
            <p class="mt-3 text-slate-600 text-lg max-w-2xl mx-auto">Program magang dirancang untuk menghadirkan pengalaman praktis dan dukungan profesional di lingkungan BUMN.</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 text-center">
            <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50 shadow-sm hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white mb-5">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 16h-1v-4h-1m1-4h.01"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Proses Transparan</h3>
                <p class="text-slate-600">Semua tahapan pendaftaran dan seleksi ditampilkan jelas, sehingga peserta dapat merencanakan setiap langkah dengan mudah.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50 shadow-sm hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white mb-5">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h11"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Dukungan Profesional</h3>
                <p class="text-slate-600">Dapatkan pengalaman langsung bekerja di lingkungan BUMN dengan bimbingan yang terstruktur.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50 shadow-sm hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white mb-5">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 17v.01M15 17v.01M7 21h10a2 2 0 002-2V7.5L14.5 2H7a2 2 0 00-2 2v15a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Peningkatan Portofolio</h3>
                <p class="text-slate-600">Bangun portofolio yang lebih kuat dengan pengalaman kerja nyata dan dokumentasi profesional.</p>
            </div>
        </div>
    </div>
</section>


{{-- ================= CTA + STAT ================= --}}
<section class="px-6 md:px-12 lg:px-20 py-20 
                bg-linear-to-b from-blue-600 via-blue-700 to-blue-800 
                text-white">

    <div class="max-w-6xl mx-auto">

        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl 
                           font-bold text-yellow-400">
                    Siap Memulai Perjalanan Magang Anda?
                </h2>
            </div>

            <div>
                <p class="text-gray-200 text-base md:text-lg">
                    Bergabunglah dan kembangkan potensi Anda
                    bersama lingkungan BUMN profesional.
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-4">

                    <a href="/daftar"
                       class="px-6 py-3 bg-yellow-400 text-black 
                              rounded-md font-medium
                              hover:bg-yellow-500
                              transition duration-200 text-center">
                        Daftar Sekarang
                    </a>

                    <a href="/kontak"
                       class="px-6 py-3 border border-white rounded-md
                              hover:bg-white hover:text-blue-700
                              transition duration-200 text-center">
                        Hubungi Kami
                    </a>

                </div>
            </div>

        </div>

        {{-- STATISTIK --}}
        <div class="mt-20 grid sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">

            <div class="bg-white/10 p-10 rounded-xl">
                <h3 class="text-4xl font-bold text-yellow-400">100+</h3>
                <p class="mt-2 text-sm uppercase tracking-wide">
                    Alumni Magang
                </p>
            </div>

            <div class="bg-white/10 p-10 rounded-xl">
                <h3 class="text-4xl font-bold text-yellow-400">3 – 6</h3>
                <p class="mt-2 text-sm uppercase tracking-wide">
                    Bulan Program
                </p>
            </div>

            <div class="bg-white/10 p-10 rounded-xl">
                <h3 class="text-4xl font-bold text-yellow-400">20+</h3>
                <p class="mt-2 text-sm uppercase tracking-wide">
                    BUMN Partner
                </p>
            </div>

        </div>

    </div>
</section>


<section class="bg-white py-12 border-t border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24">

            {{-- Danantara --}}
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/logo Danantra.png') }}"
                     alt="Danantara"
                     class="h-20 md:h-24 w-auto object-contain 
                            opacity-90 hover:opacity-100 
                            transition duration-300">
            </div>

            {{-- BRI --}}
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/Logo bri.png') }}"
                     alt="BRI"
                     class="h-20 md:h-28 w-auto object-contain 
                            opacity-90 hover:opacity-100 
                            transition duration-300">
            </div>

            {{-- Rumah BUMN --}}
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/Logo Rumah BUMN.png') }}"
                     alt="Rumah BUMN"
                     class="h-20 md:h-26 w-auto object-contain 
                            opacity-90 hover:opacity-100 
                            transition duration-300">
            </div>

        </div>

    </div>
</section>


{{-- ================= FAQ FULL ================= --}}
<section class="px-6 md:px-12 lg:px-20 py-16 
                bg-linear-to-b from-blue-800 via-blue-700 to-blue-500 
                text-white">

    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-4">
                FAQ
            </h2>
            <p class="text-base md:text-lg text-gray-200">
                Temukan jawaban atas pertanyaan umum seputar program magang 
                dan proses pendaftarannya.
            </p>
        </div>

        {{-- Grid FAQ --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">

            {{-- Item 1 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/work.svg') }}" 
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Siapa yang bisa mendaftar magang?
                </h4>

                <p class="text-sm text-gray-200">
                    Program terbuka bagi mahasiswa dan lulusan 
                    yang memenuhi persyaratan administrasi.
                </p>
            </div>

            {{-- Item 2 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/interests.svg') }}" 
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Bagaimana cara mendaftar?
                </h4>

                <p class="text-sm text-gray-200">
                    Pendaftaran dilakukan secara online 
                    melalui website resmi SIM Magang.
                </p>
            </div>

            {{-- Item 3 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/docs.svg') }}" 
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Dokumen apa saja yang diperlukan?
                </h4>

                <p class="text-sm text-gray-200">
                    CV, surat pengantar kampus, dan 
                    dokumen pendukung lainnya.
                </p>
            </div>

            {{-- Item 4 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/time.svg') }}" 
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Berapa lama durasi magang?
                </h4>

                <p class="text-sm text-gray-200">
                    Program berlangsung selama 3–6 bulan 
                    sesuai periode yang tersedia.
                </p>
            </div>

            {{-- Item 5 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/dashboard.svg') }}" 
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Apakah bisa memilih divisi?
                </h4>

                <p class="text-sm text-gray-200">
                    Ya, peserta dapat memilih divisi 
                    sesuai minat dan kebutuhan program.
                </p>
            </div>

            {{-- Item 6 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/call (2).svg') }}" 
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Siapa yang dapat dihubungi jika ada kendala?
                </h4>

                <p class="text-sm text-gray-200">
                    Silakan hubungi admin Rumah BUMN 
                    melalui halaman kontak resmi.
                </p>
            </div>

        </div>

        <div class="text-center mt-16">
            <p class="text-lg font-semibold mb-2">
                Masih memiliki pertanyaan?
            </p>
            <p class="text-gray-200 mb-6">
                Tim kami siap membantu Anda.
            </p>

            <a href="/kontak"
               class="inline-block px-8 py-3 bg-yellow-400 text-black 
                      rounded-md font-medium
                      hover:bg-yellow-500
                      transition duration-200">
                Kontak
            </a>
        </div>

    </div>
</section>

</div>