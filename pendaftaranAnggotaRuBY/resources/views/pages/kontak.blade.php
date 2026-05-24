@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<section class="contact-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Hubungi Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Ada pertanyaan atau butuh bantuan mengenai pendaftaran dan program Rumah BUMN Yogyakarta? Tim kami siap membantu Anda.
            </p>
        </div>

        <div class="row g-4">
            <!-- INFO KONTAK -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">

                    <!-- TELEPON -->
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex gap-3">
                            <div class="contact-icon-box bg-success-subtle text-success">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Telepon / WhatsApp</h5>
                                <p class="text-muted mb-2 small">085161609877</p>
                                <a href="https://wa.me/6285161609877" target="_blank" class="btn btn-success btn-sm rounded-pill px-3">
                                    <i class="bi bi-whatsapp me-1"></i> Chat Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex gap-3">
                            <div class="contact-icon-box bg-info-subtle text-info">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Email</h5>
                                <p class="text-muted mb-0 small">rumahbumnyogyakarta@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- SOSIAL MEDIA -->
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex gap-3">
                                <div class="contact-icon-box bg-danger-subtle text-danger">
                                    <i class="bi bi-instagram"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Instagram</h5>
                                    <p class="text-muted mb-0 small">@rumahbumn.yogyakarta</p>
                                    <a href="https://www.instagram.com/rumahbumn.yogyakarta" target="_blank" class="btn btn-link p-0 text-decoration-none small">Lihat Profil</a>
                                </div>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex gap-3">
                                <div class="contact-icon-box bg-dark-subtle text-dark">
                                    <i class="bi bi-tiktok"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">TikTok</h5>
                                    <p class="text-muted mb-0 small">@rumahbumn.jogja</p>
                                    <a href="https://www.tiktok.com/@rumahbumn.jogja" target="_blank" class="btn btn-link p-0 text-decoration-none small">Lihat Profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MAP -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-3"><i class="bi bi-map-fill me-2 text-primary"></i>Lokasi Kami</h5>
                        <p class="text-muted small mb-4">
                            Kunjungi kantor kami untuk konsultasi langsung mengenai pendaftaran dan program pemberdayaan UMKM.
                        </p>
                        <div class="rounded-4 overflow-hidden shadow-sm">
                            <iframe 
                                src="https://www.google.com/maps?q=Rumah+BUMN+Yogyakarta&output=embed"
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
