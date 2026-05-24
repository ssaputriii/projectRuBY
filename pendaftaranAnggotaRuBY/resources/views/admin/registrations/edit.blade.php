@extends('admin.layouts.app')

@section('title', 'Edit Anggota - ' . $registration->name)

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}" class="text-decoration-none">Pendaftaran</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.registrations.show', $registration) }}" class="text-decoration-none">Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <h4 class="mb-0 fw-bold">Edit Data: {{ $registration->name }}</h4>
    </div>
    <div>
        <a href="{{ route('admin.registrations.show', $registration) }}" class="btn btn-light border shadow-sm px-3 rounded-3">
            <i class="bi bi-x-circle me-1"></i> Batal
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <h6 class="mb-0 fw-bold">Berhasil!</h6>
        </div>
        @php
            $message = session('success');
            $parts = explode(' Perubahan: ', $message);
        @endphp
        <p class="mb-0 small ps-4">
            {{ $parts[0] }}
            @if(count($parts) > 1)
                <br>
                <span class="text-dark fw-bold mt-1 d-inline-block">Bagian yang diubah:</span> {{ $parts[1] }}
            @endif
        </p>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <h6 class="mb-0 fw-bold">Terjadi Kesalahan!</h6>
        </div>
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.registrations.update', $registration) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan semua perubahan data ini?')">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- DATA DIRI -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle"></i> DATA DIRI
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Keanggotaan</label>
                            <select name="membership_status" class="form-select" required>
                                <option value="Anggota Baru" {{ $registration->membership_status == 'Anggota Baru' ? 'selected' : '' }}>Anggota Baru</option>
                                <option value="Anggota Lama" {{ $registration->membership_status == 'Anggota Lama' ? 'selected' : '' }}>Anggota Lama</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $registration->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK (16 Digit)</label>
                            <div class="input-group shadow-sm">
                                <input type="password" name="nik" id="nik" class="form-control" value="{{ old('nik', $registration->safe_nik) }}" maxlength="16" minlength="16" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="toggleInputVisibility('nik')">
                                    <i class="bi bi-eye" id="nik-icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat, Tanggal Lahir</label>
                            <input type="text" name="place_date_birth" class="form-control" value="{{ old('place_date_birth', $registration->place_date_birth) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $registration->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor WhatsApp</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $registration->whatsapp_number) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $registration->phone) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" rows="3" required>{{ old('address', $registration->address) }}</textarea>
                        </div>
                        @if($registration->umkm_category === 'UMUM')
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sudah Memiliki Usaha?</label>
                            <select name="has_business" class="form-select" required>
                                <option value="1" {{ $registration->has_business ? 'selected' : '' }}>Sudah</option>
                                <option value="0" {{ !$registration->has_business ? 'selected' : '' }}>Belum</option>
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($registration->umkm_category !== 'UMUM')
            <!-- DATA USAHA -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-briefcase"></i> DATA USAHA
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Nama Usaha</label>
                            <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $registration->business_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Usaha</label>
                            <input type="text" name="business_type" class="form-control" value="{{ old('business_type', $registration->business_type) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tahun Mulai</label>
                            <input type="number" name="business_start_year" class="form-control" value="{{ old('business_start_year', $registration->business_start_year) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor NPWP</label>
                            <div class="input-group shadow-sm">
                                <input type="password" name="npwp_number" id="npwp_number" class="form-control" value="{{ old('npwp_number', $registration->safe_npwp) }}" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="toggleInputVisibility('npwp_number')">
                                    <i class="bi bi-eye" id="npwp_number-icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Rantai Usaha</label>
                            <input type="text" name="business_chain" class="form-control" value="{{ old('business_chain', $registration->business_chain) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Legalitas (Pisahkan dengan koma jika banyak)</label>
                            @php
                                $legalitiesStr = is_array($registration->legalities) ? implode(', ', $registration->legalities) : $registration->legalities;
                            @endphp
                            <input type="text" id="legalities_input" class="form-control" value="{{ old('legalities_str', $legalitiesStr) }}" placeholder="NIB, Halal, PIRT, dll">
                            <div id="legalities_container">
                                @if(is_array($registration->legalities))
                                    @foreach($registration->legalities as $l)
                                        <input type="hidden" name="legalities[]" value="{{ $l }}">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi Usaha</label>
                            <textarea name="business_description" class="form-control" rows="3" required>{{ old('business_description', $registration->business_description) }}</textarea>
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="fw-bold text-muted small text-uppercase">Alamat Usaha</h6>
                            <hr class="mt-1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jalan</label>
                            <input type="text" name="business_address_street" class="form-control" value="{{ old('business_address_street', $registration->business_address_street) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kecamatan</label>
                            <input type="text" name="business_address_district" class="form-control" value="{{ old('business_address_district', $registration->business_address_district) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kota/Kabupaten</label>
                            <input type="text" name="business_address_city" class="form-control" value="{{ old('business_address_city', $registration->business_address_city) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Provinsi</label>
                            <input type="text" name="business_address_province" class="form-control" value="{{ old('business_address_province', $registration->business_address_province) }}" required>
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="fw-bold text-muted small text-uppercase">Data Produk</h6>
                            <hr class="mt-1">
                        </div>
                        <div id="product-edit-container">
                            @if($registration->product_names)
                                @foreach($registration->product_names as $index => $pname)
                                <div class="product-item border rounded p-3 mb-3 position-relative">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-product"></button>
                                    <div class="mb-2">
                                        <label class="small fw-bold">Nama Produk</label>
                                        <input type="text" name="product_names[]" class="form-control form-control-sm" value="{{ $pname }}" required>
                                    </div>
                                    <div>
                                        <label class="small fw-bold">Deskripsi Produk</label>
                                        <textarea name="product_descriptions[]" class="form-control form-control-sm" rows="2" required>{{ $registration->product_descriptions[$index] ?? '' }}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="add-product-btn">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                        </button>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jumlah Karyawan</label>
                            <input type="number" name="employee_count" class="form-control" value="{{ old('employee_count', $registration->employee_count) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Omset Per Bulan</label>
                            <select name="monthly_turnover" class="form-select" required>
                                @foreach(['< 300 JT', '300 JT - 1 M', '> 1 M'] as $turnover)
                                    <option value="{{ $turnover }}" {{ $registration->monthly_turnover == $turnover ? 'selected' : '' }}>{{ $turnover }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Website</label>
                            <input type="text" name="website" class="form-control" value="{{ old('website', $registration->website) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sosial Media</label>
                            <div id="sm-edit-container">
                                @if($registration->social_media)
                                    @foreach($registration->social_media as $sm)
                                    <div class="input-group mb-2">
                                        <input type="text" name="social_media[]" class="form-control" value="{{ $sm }}" required>
                                        <button class="btn btn-outline-danger remove-sm" type="button"><i class="bi bi-trash"></i></button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-sm-btn">+ Tambah</button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Marketplace</label>
                            <div id="mp-edit-container">
                                @if($registration->marketplaces)
                                    @foreach($registration->marketplaces as $mp)
                                    <div class="input-group mb-2">
                                        <input type="text" name="marketplaces[]" class="form-control" value="{{ $mp }}" required>
                                        <button class="btn btn-outline-danger remove-mp" type="button"><i class="bi bi-trash"></i></button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-mp-btn">+ Tambah</button>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Event yang diikuti</label>
                            <textarea name="events_followed" class="form-control" rows="2">{{ old('events_followed', $registration->events_followed) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 24px;">
                @if($registration->umkm_category !== 'UMUM')
                <!-- DATA EKSPOR & BANK -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary small text-uppercase mb-3">Data Ekspor</h6>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Pernah Ekspor?</label>
                                <select name="has_exported" class="form-select form-select-sm" required>
                                    <option value="1" {{ $registration->has_exported ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ !$registration->has_exported ? 'selected' : '' }}>Belum</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label small fw-bold">Negara Tujuan</label>
                                <input type="text" name="export_destination" class="form-control form-control-sm" value="{{ old('export_destination', $registration->export_destination) }}">
                            </div>
                        </div>

                        <div>
                            <h6 class="fw-bold text-primary small text-uppercase mb-3">Data Perbankan</h6>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Status Nasabah BRI</label>
                                <select name="bri_customer_status" class="form-select form-select-sm" required>
                                    @foreach(['Simpanan', 'Pinjaman', 'Tidak'] as $status)
                                        <option value="{{ $status }}" {{ $registration->bri_customer_status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Punya Rekening BRI?</label>
                                <select name="has_bri_cik_ditiro_account" class="form-select form-select-sm" required>
                                    <option value="1" {{ $registration->has_bri_cik_ditiro_account ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ !$registration->has_bri_cik_ditiro_account ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Nomor Rekening</label>
                                <div class="input-group shadow-sm">
                                    <input type="password" name="bri_cik_ditiro_account_number" id="acc_number" class="form-control form-control-sm" value="{{ old('bri_cik_ditiro_account_number', $registration->safe_account_number) }}" required>
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="toggleInputVisibility('acc_number')">
                                        <i class="bi bi-eye" id="acc_number-icon"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="form-label small fw-bold">QRIS BRI?</label>
                                <select name="has_qris_bri_cik_ditiro" class="form-select form-select-sm" required>
                                    <option value="1" {{ $registration->has_qris_bri_cik_ditiro ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$registration->has_qris_bri_cik_ditiro ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LOGO EDIT -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary small text-uppercase mb-3">Logo Usaha</h6>
                        @if($registration->business_logo)
                            <div class="mb-3 text-center">
                                <img src="{{ Storage::url($registration->business_logo) }}" class="img-thumbnail" style="max-height: 120px;">
                            </div>
                        @endif
                        <input type="file" name="business_logo" class="form-control form-control-sm" accept="image/*">
                        <div class="form-text x-small text-muted">Biarkan kosong jika tidak ingin mengubah logo.</div>
                    </div>
                </div>
                @endif

                <!-- SAVE BUTTON -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .x-small { font-size: 0.75rem; }
    .remove-product { background-color: #fff; border: 1px solid #dee2e6; padding: 0.25rem; }
</style>

@endsection

@push('scripts')
<script>
    function toggleInputVisibility(id) {
        const input = document.getElementById(id);
        const icon = document.getElementById(id + '-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Legalities handler
        const legalitiesInput = document.getElementById('legalities_input');
        const legalitiesContainer = document.getElementById('legalities_container');

        if (legalitiesInput) {
            legalitiesInput.addEventListener('change', function() {
                const values = this.value.split(',').map(s => s.trim()).filter(s => s !== '');
                legalitiesContainer.innerHTML = '';
                values.forEach(val => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'legalities[]';
                    input.value = val;
                    legalitiesContainer.appendChild(input);
                });
            });
        }

        // Add Product handler
        const addProductBtn = document.getElementById('add-product-btn');
        const productContainer = document.getElementById('product-edit-container');

        if (addProductBtn) {
            addProductBtn.addEventListener('click', function() {
                const div = document.createElement('div');
                div.className = 'product-item border rounded p-3 mb-3 position-relative';
                div.innerHTML = `
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-product"></button>
                    <div class="mb-2">
                        <label class="small fw-bold">Nama Produk</label>
                        <input type="text" name="product_names[]" class="form-control form-control-sm" required>
                    </div>
                    <div>
                        <label class="small fw-bold">Deskripsi Produk</label>
                        <textarea name="product_descriptions[]" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>
                `;
                productContainer.appendChild(div);
                attachRemoveEvent(div.querySelector('.remove-product'));
            });
        }

        function attachRemoveEvent(btn) {
            btn.addEventListener('click', function() {
                this.parentElement.remove();
            });
        }

        document.querySelectorAll('.remove-product').forEach(btn => attachRemoveEvent(btn));

        // Social Media & Marketplace handlers
        const addSmBtn = document.getElementById('add-sm-btn');
        const smContainer = document.getElementById('sm-edit-container');
        if (addSmBtn) {
            addSmBtn.addEventListener('click', function() {
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" name="social_media[]" class="form-control" required>
                    <button class="btn btn-outline-danger remove-sm" type="button"><i class="bi bi-trash"></i></button>
                `;
                smContainer.appendChild(div);
                div.querySelector('.remove-sm').addEventListener('click', () => div.remove());
            });
        }
        document.querySelectorAll('.remove-sm').forEach(btn => {
            btn.addEventListener('click', () => btn.parentElement.remove());
        });

        const addMpBtn = document.getElementById('add-mp-btn');
        const mpContainer = document.getElementById('mp-edit-container');
        if (addMpBtn) {
            addMpBtn.addEventListener('click', function() {
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" name="marketplaces[]" class="form-control" required>
                    <button class="btn btn-outline-danger remove-mp" type="button"><i class="bi bi-trash"></i></button>
                `;
                mpContainer.appendChild(div);
                div.querySelector('.remove-mp').addEventListener('click', () => div.remove());
            });
        }
        document.querySelectorAll('.remove-mp').forEach(btn => {
            btn.addEventListener('click', () => btn.parentElement.remove());
        });
    });
</script>
@endpush
