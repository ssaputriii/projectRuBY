@extends('layouts.app')

@section('title', 'Beranda - Rumah BUMN Yogyakarta')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInUp">Selamat Datang di <br><span class="text-white">Rumah BUMN Yogyakarta</span></h1>
                <p class="lead mb-5 pe-lg-5 animate__animated animate__fadeInUp animate__delay-1s text-white-50">Pusat pemberdayaan UMKM dan pengembangan bakat muda di Yogyakarta. Kami hadir untuk membantu bisnis Anda tumbuh lebih besar dan lebih kuat melalui digitalisasi.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="#pendaftaran" class="btn btn-primary btn-lg px-5">Daftar Sekarang</a>
                    <a href="#about" class="btn btn-outline-light btn-lg px-5">Tentang Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partner Logos Section -->
<div class="partner-logos">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-4 gap-md-5">
        <img src="{{ asset('assets/images/logodanantara.png') }}" alt="BUMN Untuk Indonesia" width="170" height="100" decoding="async">
        <img src="{{ asset('assets/images/logobri.png') }}" alt="BRI" width="170" height="100" decoding="async">
        <img src="{{ asset('assets/images/logoruby.png') }}" alt="Rumah BUMN Yogyakarta" width="170" height="100" decoding="async">
    </div>
</div>

<!-- About Section -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="{{ asset('assets/images/ruby2-900.webp') }}" alt="Tentang Rumah BUMN" class="img-fluid rounded-4 shadow-lg" width="900" height="675" loading="lazy" decoding="async">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-4 rounded-4 m-3 d-none d-md-block shadow">
                        <h4 class="mb-0 fw-bold">100+</h4>
                        <p class="mb-0 small">UMKM Terbina</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Siapa Kami?</h6>
                <h2 class="display-5 mb-4">Mendorong UMKM Yogyakarta <span class="text-primary">Naik Kelas</span></h2>
                <p class="text-muted mb-4 fs-5">
                    Rumah BUMN Yogyakarta merupakan wadah kolaborasi bagi para pelaku UMKM untuk mendapatkan pendampingan, pelatihan, dan akses pasar yang lebih luas.
                </p>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-light p-2 rounded-circle me-3">
                                <i class="bi bi-check2 text-primary"></i>
                            </div>
                            <span class="fw-semibold">Inkubasi Bisnis</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-light p-2 rounded-circle me-3">
                                <i class="bi bi-check2 text-primary"></i>
                            </div>
                            <span class="fw-semibold">Digital Marketing</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-light p-2 rounded-circle me-3">
                                <i class="bi bi-check2 text-primary"></i>
                            </div>
                            <span class="fw-semibold">Akses Modal</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-light p-2 rounded-circle me-3">
                                <i class="bi bi-check2 text-primary"></i>
                            </div>
                            <span class="fw-semibold">Networking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi & Misi Section -->
        <div class="row align-items-center g-5 mt-5 pt-lg-5">
            <div class="col-lg-6 order-lg-2">
                <img src="{{ asset('assets/images/ruby1-900.webp') }}" alt="Visi Misi Rumah BUMN" class="img-fluid rounded-4 shadow-lg" width="900" height="675" loading="lazy" decoding="async">
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="mb-5">
                    <h3 class="fw-bold d-flex align-items-center mb-3">
                        <span class="bg-primary text-white p-2 rounded-3 me-3"><i class="bi bi-eye"></i></span>
                        VISI
                    </h3>
                    <p class="text-muted fs-5 ps-lg-5 border-start border-primary border-4 ms-3">
                        Menjadi pusat inkubasi dan pengembangan wirausaha lokal yang adaptif, kolaboratif, dan berdampak bagi pertumbuhan ekonomi daerah.
                    </p>
                </div>
                <div>
                    <h3 class="fw-bold d-flex align-items-center mb-3">
                        <span class="bg-primary text-white p-2 rounded-3 me-3"><i class="bi bi-bullseye"></i></span>
                        MISI
                    </h3>
                    <p class="text-muted fs-5 ps-lg-5 border-start border-primary border-4 ms-3">
                        Menyediakan pendampingan bisnis, akses jaringan, dan pelatihan terstruktur untuk melahirkan UMKM naik kelas di Yogyakarta.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pendaftaran Section -->
<section id="pendaftaran" class="section-padding bg-light">
    <div class="container">
        <div class="text-center max-width-700 mx-auto mb-5">
            <h6 class="text-primary fw-bold text-uppercase mb-3">Bergabunglah</h6>
            <h2 class="display-5 mb-3">Pilih Kategori Pendaftaran</h2>
            <p class="text-muted fs-5">Silakan pilih kategori yang paling sesuai dengan kebutuhan Anda saat ini.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Pendaftaran Magang -->
            <div class="col-lg-5">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="p-5 text-center">
                        <div class="bg-primary-light d-inline-block p-4 rounded-circle mb-4">
                            <i class="bi bi-mortarboard text-primary display-4"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Pendaftaran Magang</h3>
                        <p class="text-muted mb-4 px-lg-4">
                            Dapatkan pengalaman kerja nyata di ekosistem BUMN. Terbuka untuk mahasiswa aktif dan lulusan baru yang ingin berkembang.
                        </p>
                        <a href="{{ route('daftar.magang') }}" class="btn btn-outline-primary w-100 py-3">Daftar Sebagai Magang</a>
                    </div>
                </div>
            </div>
            
            <!-- Pendaftaran UMKM -->
            <div class="col-lg-5">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="p-5 text-center">
                        <div class="bg-primary-light d-inline-block p-4 rounded-circle mb-4">
                            <i class="bi bi-shop text-primary display-4"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Anggota UMKM</h3>
                        <p class="text-muted mb-4 px-lg-4">
                            Bergabunglah dengan komunitas UMKM kami. Dapatkan akses ke pelatihan eksklusif, pameran, dan networking.
                        </p>
                        <a href="{{ route('pendaftaranAnggotaRuBY') }}" target="_blank" class="btn btn-outline-primary w-100 py-3">Pendaftaran Anggota RuBY</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
