@extends('layouts.app')

@section('title', 'Sistem Pendaftaran Anggota Rumah BUMN Yogyakarta')

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div>
            <h1>Wujudkan Impian Wirausaha Anda Bersama Rumah BUMN Yogyakarta</h1>
            <p>
                Platform inkubasi bisnis yang didukung oleh BUMN untuk memberdayakan
                UMKM dan calon wirausahawan di Yogyakarta.
            </p>
            <div class="hero-actions">
                <a href="{{ route('jenis.keanggotaan') }}" class="btn btn-outline-light">Jenis Keanggotaan</a>
                <a href="#keanggotaan" class="btn btn-outline-light">Daftar Sekarang</a>
            </div>
        </div>
        <div class="hero-carousel-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner shadow-lg rounded-4 overflow-hidden">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/ruby1.png') }}" class="d-block w-100" alt="RuBy 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/ruby2.png') }}" class="d-block w-100" alt="RuBy 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/ruby3.png') }}" class="d-block w-100" alt="RuBy 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/ruby4.png') }}" class="d-block w-100" alt="RuBy 4">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="about section">
    <div class="container">
        <h2>Tentang Rumah BUMN Yogyakarta</h2>
        

        <div class="about-grid">
            <img src="{{ asset('assets/images/ruby3.png') }}" alt="Kegiatan Rumah BUMN" class="about-image mx-auto">
            <div class="text-center text-lg-start">
                <p>
            Rumah BUMN Yogyakarta adalah pusat pengembangan dan pemberdayaan UMKM
            yang berkomitmen untuk menciptakan ekosistem wirausaha yang berkelanjutan dan berdaya saing.
        </p>
                <p>
                    Menjadi pusat inkubasi dan pengembangan wirausaha lokal yang adaptif,
                    kolaboratif, dan berdampak bagi pertumbuhan ekonomi daerah.
                </p>
                <p>
                    Menyediakan pendampingan bisnis, akses jaringan, dan pelatihan terstruktur
                    untuk melahirkan UMKM naik kelas di Yogyakarta.
                </p>
            </div>
        </div>

        <div class="partner-logos">
            <img src="{{ asset('assets/images/logodanantara.png') }}" alt="BUMN Untuk Indonesia">
            <img src="{{ asset('assets/images/logobri.png') }}" alt="BRI">
            <img src="{{ asset('assets/images/logoruby.png') }}" alt="Rumah BUMN Yogyakarta">
        </div>
    </div>
</section>

<section class="benefits section" id="daftar">
    <div class="container">
        <h2>Mengapa Bergabung?</h2>
        <p class="section-intro">
            Rumah BUMN Yogyakarta adalah pusat pengembangan dan pemberdayaan UMKM yang berkomitmen
            untuk menciptakan ekosistem wirausaha yang berkelanjutan dan berdaya saing.
        </p>

        <div class="row g-3 g-md-4 justify-content-center">
            @foreach($benefits as $benefit)
                <div class="col-6 col-md-6 col-lg-3">
                    <article class="feature-card h-100">
                        <div class="feature-icon">⬢</div>
                        <h3>{{ $benefit['title'] }}</h3>
                        <p>{{ $benefit['description'] }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="registration-flow section bg-white">
    <div class="container text-center">
        <h2>Alur Pendaftaran</h2>
        <p class="section-intro">Ikuti 3 langkah mudah untuk bergabung menjadi anggota</p>
        
        <div class="row mt-5 justify-content-center flow-grid">
            <div class="col-md-4 mb-4">
                <div class="flow-item">
                    <div class="flow-number">1</div>
                    <div class="flow-icon-box">
                        <i class="bi bi-person-check fs-1"></i>
                    </div>
                    <h4>Pilih Jenis Keanggotaan</h4>
                    <p class="text-muted small">Pilih kategori keanggotaan yang sesuai dengan skala usaha Anda.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="flow-item">
                    <div class="flow-number">2</div>
                    <div class="flow-icon-box">
                        <i class="bi bi-file-earmark-text fs-1"></i>
                    </div>
                    <h4>Isi Formulir Lengkap</h4>
                    <p class="text-muted small">Lengkapi data diri dan data usaha Anda pada formulir online.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="flow-item">
                    <div class="flow-number">3</div>
                    <div class="flow-icon-box">
                        <i class="bi bi-whatsapp fs-1"></i>
                    </div>
                    <h4>Gabung Grup WhatsApp</h4>
                    <p class="text-muted small">Setelah mendaftar, Anda akan diarahkan untuk bergabung ke komunitas kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="membership section" id="keanggotaan">
    <div class="container">
        <h2>Pilih Jenis Keanggotaan Anda</h2>
        <p class="section-intro">Klik salah satu untuk langsung mendaftar</p>

        <div class="membership-grid">
            @foreach($membershipTypes as $type)
                <article class="membership-card">
                    <div class="member-icon-box bg-{{ $type['accent'] }}-soft text-{{ $type['accent'] }}">
                        <i class="bi {{ $type['icon'] }} fs-2"></i>
                    </div>
                    <h3 class="fw-bold">{{ $type['name'] }}</h3>
                    <p class="member-subtitle text-muted">{{ $type['subtitle'] }}</p>

                    <div class="text-start w-100 px-2">
                        <h5 class="fw-bold small mb-3">Yang diperlukan:</h5>
                        <ul class="list-unstyled">
                            @foreach($type['requirements'] as $requirement)
                                <li class="mb-2 d-flex align-items-start gap-2">
                                    <i class="bi bi-check-circle-fill text-{{ $type['accent'] }}"></i>
                                    <span>{{ $requirement }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @php
                        $route = '#';
                        if ($type['name'] === 'Anggota UMUM') {
                            $route = route('pendaftaran.umum', ['from' => 'home']);
                        } elseif ($type['name'] === 'Anggota UTAMA') {
                            $route = route('pendaftaran.utama', ['from' => 'home']);
                        } elseif ($type['name'] === 'Anggota PRIORITAS') {
                            $route = route('pendaftaran.prioritas', ['from' => 'home']);
                        }
                    @endphp
                    <a href="{{ $route }}" class="btn-membership btn-{{ $type['accent'] }}">
                        {{ $type['button_text'] }}
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="cta section">
    <div class="container">
        <div class="cta-box">
            <h2>Siap Bergabung dengan Rumah BUMN Yogyakarta?</h2>
            <p>Daftar sekarang dan mulai perjalanan wirausaha Anda bersama Kami!</p>
            <div class="cta-actions">
                <a href="{{ route('jenis.keanggotaan') }}" class="btn btn-light">Jenis Keanggotaan</a>
                <a href="#keanggotaan" class="btn btn-light">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection
