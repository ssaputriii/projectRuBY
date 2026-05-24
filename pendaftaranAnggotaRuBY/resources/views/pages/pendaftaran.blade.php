@extends('layouts.app')

@section('title', 'Pendaftaran Anggota Rumah BUMN')

@section('content')

{{-- INTRO --}}
<section class="section py-5 bg-light">
    <div class="container">
        <div class="text-center">
            <h2 class="fw-bold">Pendaftaran Anggota Rumah BUMN</h2>
            <p class="text-muted">Pilih kategori keanggotaan yang sesuai dengan status Anda saat ini.</p>
        </div>
    </div>
</section>

{{-- SECTION SYARAT --}}
<section class="section py-5">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Langkah Pendaftaran</h2>
            <p class="text-muted">
                Proses pendaftaran mudah dan cepat dengan mengikuti langkah-langkah berikut.
            </p>
        </div>

        <!-- CARDS SYARAT -->
        <div class="row justify-content-center g-4">

            <div class="col-lg-4 col-md-6">
                <div class="syarat-card text-center p-4 shadow-sm rounded-4 h-100 bg-white border">
                    <i class="bi bi-pencil-square fs-1 mb-3 text-primary"></i>
                    <h5 class="fw-bold">Pilih Kategori</h5>
                    <p class="text-muted">
                        Pilih kategori keanggotaan: UMUM, UTAMA, atau PRIORITAS.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="syarat-card text-center p-4 shadow-sm rounded-4 h-100 bg-white border">
                    <i class="bi bi-file-earmark-text fs-1 mb-3 text-primary"></i>
                    <h5 class="fw-bold">Isi Formulir</h5>
                    <p class="text-muted">
                        Lengkapi formulir pendaftaran dengan data yang benar dan sesuai.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="syarat-card text-center p-4 shadow-sm rounded-4 h-100 bg-white border">
                    <i class="bi bi-chat-dots fs-1 mb-3 text-primary"></i>
                    <h5 class="fw-bold">Gabung WhatsApp</h5>
                    <p class="text-muted">
                        Setelah terdaftar, bergabunglah ke grup WhatsApp resmi kami.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- SECTION PILIH KEANGGOTAAN --}}
<section class="py-5 bg-light">
    <div class="container">

        <!-- Judul Tengah -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pilih Jenis Keanggotaan</h2>
            <p class="text-muted">
                Klik pada salah satu kategori di bawah ini untuk menuju halaman formulir
            </p>
        </div>

        <!-- Card 3 Sejajar -->
        <div class="row g-4 justify-content-center">

            <!-- UMUM -->
            <div class="col-md-4">
                <a href="{{ route('pendaftaran.umum') }}" class="text-decoration-none">
                    <div class="membership-card text-center p-4 h-100 rounded-4 shadow-sm bg-white border-top border-5 border-success">
                        <i class="bi bi-mortarboard fs-1 mb-3 text-success"></i>
                        <h5 class="fw-bold text-dark">Anggota UMUM</h5>
                        <p class="text-muted small">
                            Untuk Mahasiswa atau yang belum memiliki usaha
                        </p>
                        <div class="btn btn-success btn-sm mt-3">Pilih Kategori</div>
                    </div>
                </a>
            </div>

            <!-- UTAMA -->
            <div class="col-md-4">
                <a href="{{ route('pendaftaran.utama') }}" class="text-decoration-none">
                    <div class="membership-card text-center p-4 h-100 rounded-4 shadow-sm bg-white border-top border-5 border-primary">
                        <i class="bi bi-shop fs-1 mb-3 text-primary"></i>
                        <h5 class="fw-bold text-dark">Anggota UTAMA</h5>
                        <p class="text-muted small">
                            Untuk Pemilik Usaha / UMKM
                        </p>
                        <div class="btn btn-primary btn-sm mt-3">Pilih Kategori</div>
                    </div>
                </a>
            </div>

            <!-- PRIORITAS -->
            <div class="col-md-4">
                <a href="{{ route('pendaftaran.prioritas') }}" class="text-decoration-none">
                    <div class="membership-card text-center p-4 h-100 rounded-4 shadow-sm bg-white border-top border-5 border-warning">
                        <i class="bi bi-star fs-1 mb-3 text-warning"></i>
                        <h5 class="fw-bold text-dark">Anggota PRIORITAS</h5>
                        <p class="text-muted small">
                            Untuk Pemilik Usaha skala UMKM berkembang
                        </p>
                        <div class="btn btn-warning btn-sm mt-3">Pilih Kategori</div>
                    </div>
                </a>
            </div>

        </div>

    </div>
</section>

@endsection
