@extends('layouts.app')

@section('title', 'Pendaftaran Anggota UMUM')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-3">
                    @php
                        $backUrl = request('from') == 'page' ? route('jenis.keanggotaan') : url('/') . '#keanggotaan';
                    @endphp
                    <a href="{{ $backUrl }}" class="btn btn-outline-secondary rounded-pill btn-sm shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Form Pendaftaran Anggota UMUM</h2>
                            <p class="text-muted">Lengkapi data diri Anda untuk bergabung sebagai Anggota Umum Rumah BUMN Yogyakarta.</p>
                        </div>

                        <hr class="mb-4">

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pendaftaran.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="umkm_category" value="UMUM">

                            <div class="mb-4">
                                <h5 class="fw-bold mb-3 text-primary">DATA DIRI</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status Keanggotaan di Rumah BUMN Yogyakarta <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="membership_status" id="statusLama" value="Anggota Lama" {{ old('membership_status') == 'Anggota Lama' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="statusLama">Anggota Lama</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="membership_status" id="statusBaru" value="Anggota Baru" {{ old('membership_status') == 'Anggota Baru' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="statusBaru">Anggota Baru</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nik" class="form-label fw-semibold">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" 
                                        maxlength="16" minlength="16" pattern="\d{16}" inputmode="numeric" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                        placeholder="Masukkan 16 digit NIK" required>
                                </div>

                                <div class="mb-3">
                                    <label for="place_date_birth" class="form-label fw-semibold">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="place_date_birth" name="place_date_birth" value="{{ old('place_date_birth') }}" placeholder="Contoh: Yogyakarta, 06 Juni 2024" required>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label fw-semibold">Alamat Tinggal <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Contoh: Jl. Sagan No.123, Kec. Gondokusuman, Kota Yogyakarta, DIY" required>{{ old('address') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="whatsapp_number" class="form-label fw-semibold">Nomor WhatsApp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}" 
                                        placeholder="Contoh: 085161609877" maxlength="15" minlength="10" pattern="\d+" inputmode="numeric" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">Nomor Telepon Aktif <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" 
                                        placeholder="Contoh: 085161609877" maxlength="15" minlength="10" pattern="\d+" inputmode="numeric" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">E-mail Aktif <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="rumahbumnyk1@gmail.com" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Apakah sudah memiliki usaha <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="has_business" id="businessSudah" value="Sudah" {{ old('has_business') == 'Sudah' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="businessSudah">Sudah</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="has_business" id="businessBelum" value="Belum" {{ old('has_business') == 'Belum' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="businessBelum">Belum</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold">Kirim Pendaftaran</button>
                                <a href="{{ route('home') }}" class="btn btn-link text-muted">Kembali ke Beranda</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
