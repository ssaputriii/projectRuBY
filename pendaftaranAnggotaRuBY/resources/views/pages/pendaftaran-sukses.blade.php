@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Pendaftaran Berhasil!</h2>
                        <p class="text-muted mb-5">
                            Terima kasih telah mendaftar sebagai anggota Rumah BUMN Yogyakarta. Data Anda telah kami terima dan akan segera diproses oleh tim kami.
                        </p>
                        
                        <div class="d-grid gap-3">
                            @php
                                $category = session('registered_category', 'UMUM');
                                $waLinks = [
                                    'PRIORITAS' => 'https://chat.whatsapp.com/Lw87ioUGyDKE9P6r65bTxA?s=cl&p=a&mlu=4',
                                    'UTAMA' => 'https://chat.whatsapp.com/CLj5J9GuqYB4Id6qGyPBL3?s=cl&p=a&mlu=4',
                                    'UMUM' => 'https://chat.whatsapp.com/LcYlzqUpoSeAVlg5aDqoQ8?s=cl&p=a&mlu=4'
                                ];
                                $targetLink = $waLinks[$category] ?? $waLinks['UMUM'];
                            @endphp
                            <a href="{{ $targetLink }}" target="_blank" class="btn btn-success btn-lg rounded-3 fw-bold">
                                <i class="bi bi-whatsapp me-2"></i> Gabung WhatsApp Group ({{ ucfirst(strtolower($category)) }})
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg rounded-3 fw-bold">
                                Kembali ke Beranda
                            </a>
                        </div>

                        <div class="mt-4 pt-4 border-top">
                            <p class="small text-muted mb-0">
                                Butuh bantuan? <a href="{{ route('kontak') }}">Hubungi kami</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
