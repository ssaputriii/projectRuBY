@extends('layouts.app')

@section('title', 'Pendaftaran Anggota UTAMA')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
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
                            <h2 class="fw-bold">Form Pendaftaran Anggota UTAMA</h2>
                            <p class="text-muted">Lengkapi data diri dan data usaha Anda untuk bergabung sebagai Anggota Utama Rumah BUMN Yogyakarta.</p>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-5">
                            <div class="position-relative">
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar" role="progressbar" id="formProgressBar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="position-absolute top-50 start-0 translate-middle d-flex flex-column align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center step-indicator active" id="step1" style="width: 30px; height: 30px; font-size: 14px; border: 2px solid #fff; box-shadow: 0 0 0 1px #0d6efd;">1</div>
                                    <span class="small mt-1 fw-bold text-primary">Data Diri</span>
                                </div>
                                <div class="position-absolute top-50 start-33 translate-middle d-flex flex-column align-items-center" style="left: 33.33% !important;">
                                    <div class="rounded-circle bg-white text-muted d-flex align-items-center justify-content-center step-indicator" id="step2" style="width: 30px; height: 30px; font-size: 14px; border: 2px solid #dee2e6;">2</div>
                                    <span class="small mt-1 text-muted">Data Usaha</span>
                                </div>
                                <div class="position-absolute top-50 start-66 translate-middle d-flex flex-column align-items-center" style="left: 66.66% !important;">
                                    <div class="rounded-circle bg-white text-muted d-flex align-items-center justify-content-center step-indicator" id="step3" style="width: 30px; height: 30px; font-size: 14px; border: 2px solid #dee2e6;">3</div>
                                    <span class="small mt-1 text-muted">Data Tambahan</span>
                                </div>
                                <div class="position-absolute top-50 start-100 translate-middle d-flex flex-column align-items-center">
                                    <div class="rounded-circle bg-white text-muted d-flex align-items-center justify-content-center step-indicator" id="step4" style="width: 30px; height: 30px; font-size: 14px; border: 2px solid #dee2e6;">4</div>
                                    <span class="small mt-1 text-muted">Konfirmasi</span>
                                </div>
                            </div>
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

                        <form id="registrationForm" action="{{ route('pendaftaran.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="umkm_category" value="UTAMA">

                            <!-- STEP 1: DATA DIRI -->
                            <div class="form-step active" id="stepContainer1">
                                <div class="mb-5">
                                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">A. DATA DIRI</h5>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label fw-semibold">Status Keanggotaan Rumah BUMN Yogyakarta <span class="text-danger">*</span></label>
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

                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Ahmad Sulaiman" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="nik" class="form-label fw-semibold">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" 
                                                maxlength="16" minlength="16" pattern="\d{16}" inputmode="numeric" 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                                placeholder="Contoh: 3404XXXXXXXXXXXX" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="place_date_birth" class="form-label fw-semibold">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="place_date_birth" name="place_date_birth" value="{{ old('place_date_birth') }}" placeholder="Contoh: Yogyakarta, 06 Juni 2000" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label fw-semibold">E-mail Aktif <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: ahmad@gmail.com" required>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Contoh: Jl. Sagan No.123, Terban, Kec. Gondokusuman, Kota Yogyakarta, DIY 55223" required>{{ old('address') }}</textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="whatsapp_number" class="form-label fw-semibold">Nomor WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}" 
                                                placeholder="Contoh: 0851XXXXXXXX" maxlength="15" minlength="10" pattern="\d+" inputmode="numeric" 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label fw-semibold">Nomor Telepon Aktif <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" 
                                                placeholder="Contoh: 0812XXXXXXXX" maxlength="15" minlength="10" pattern="\d+" inputmode="numeric" 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary px-5 rounded-pill next-step">Lanjut <i class="bi bi-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- STEP 2: DATA USAHA -->
                            <div class="form-step d-none" id="stepContainer2">
                                <div class="mb-5">
                                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">B. DATA USAHA</h5>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="business_name" class="form-label fw-semibold">Nama Usaha <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{ old('business_name') }}" placeholder="Contoh: Bakpia Pathok 25" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_logo" class="form-label fw-semibold">Logo Usaha / Perusahaan</label>
                                            <input type="file" class="form-control" id="business_logo" name="business_logo" accept="image/*">
                                            <div class="form-text">PNG/JPG/JPEG Maksimum 10 MB</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Legalitas / Sertifikat Usaha <span class="text-danger">*</span></label>
                                            <div class="d-flex flex-wrap gap-3">
                                                @foreach(['NPWP', 'NIB', 'HALAL', 'IRT', 'Tidak Ada'] as $legality)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="legalities[]" value="{{ $legality }}" id="legality_{{ $loop->index }}" {{ is_array(old('legalities')) && in_array($legality, old('legalities')) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="legality_{{ $loop->index }}">{{ $legality }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="legality_proofs" class="form-label fw-semibold">Upload Bukti Legalitas Usaha (Opsional)</label>
                                            <input type="file" class="form-control" id="legality_proofs" name="legality_proofs[]" multiple accept="image/*">
                                            <div class="form-text">PNG/JPG/JPEG, Maksimum 10 file, maks 10 MB per file</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="npwp_number" class="form-label fw-semibold">Nomor NPWP <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="npwp_number" name="npwp_number" value="{{ old('npwp_number') }}" placeholder='Isi "-" apabila tidak ada' required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_type" class="form-label fw-semibold">Jenis Usaha <span class="text-danger">*</span></label>
                                            <select class="form-select" id="business_type" name="business_type" required onchange="toggleOtherBusinessType(this)">
                                                <option value="" disabled selected>Pilih Jenis Usaha</option>
                                                @foreach(['FnB (Makanan & Minuman)', 'Home Decor / Craft', 'Fashion', 'Jasa', 'Lainnya'] as $type)
                                                    <option value="{{ $type }}" {{ old('business_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            <div id="other_business_type_container" class="mt-2 {{ old('business_type') == 'Lainnya' ? '' : 'd-none' }}">
                                                <input type="text" class="form-control" id="other_business_type" name="other_business_type" value="{{ old('other_business_type') }}" placeholder="Sebutkan jenis usaha lainnya">
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="business_description" class="form-label fw-semibold">Deskripsi Usaha <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="business_description" name="business_description" rows="3" placeholder="Jelaskan secara singkat tentang produk atau jasa yang Anda tawarkan..." required>{{ old('business_description') }}</textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_start_year" class="form-label fw-semibold">Tahun Mulai Usaha <span class="text-danger">*</span></label>
                                            <select class="form-select" id="business_start_year" name="business_start_year" required>
                                                <option value="" disabled selected>Pilih Tahun</option>
                                                @php
                                                    $currentYear = date('Y');
                                                    $startYear = $currentYear - 50;
                                                @endphp
                                                @for ($year = $currentYear; $year >= $startYear; $year--)
                                                    <option value="{{ $year }}" {{ old('business_start_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_chain" class="form-label fw-semibold">Rantai Usaha <span class="text-danger">*</span></label>
                                            <select class="form-select" id="business_chain" name="business_chain" required onchange="toggleOtherBusinessChain(this)">
                                                <option value="" disabled selected>Pilih Rantai Usaha</option>
                                                @foreach(['Produksi', 'Reseller', 'Supplier', 'Lainnya'] as $chain)
                                                    <option value="{{ $chain }}" {{ old('business_chain') == $chain ? 'selected' : '' }}>{{ $chain }}</option>
                                                @endforeach
                                            </select>
                                            <div id="other_business_chain_container" class="mt-2 {{ old('business_chain') == 'Lainnya' ? '' : 'd-none' }}">
                                                <input type="text" class="form-control" id="other_business_chain" name="other_business_chain" value="{{ old('other_business_chain') }}" placeholder="Sebutkan rantai usaha lainnya">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <p class="fw-bold mb-2">ALAMAT USAHA</p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_address_street" class="form-label fw-semibold">Alamat Jalan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="business_address_street" name="business_address_street" value="{{ old('business_address_street') }}" placeholder="Contoh: Jl. Malioboro No. 1" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_address_district" class="form-label fw-semibold">Kecamatan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="business_address_district" name="business_address_district" value="{{ old('business_address_district') }}" placeholder="Contoh: Danurejan" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_address_city" class="form-label fw-semibold">Kabupaten / Kota <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="business_address_city" name="business_address_city" value="{{ old('business_address_city') }}" placeholder="Contoh: Kota Yogyakarta" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="business_address_province" class="form-label fw-semibold">Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="business_address_province" name="business_address_province" value="{{ old('business_address_province') }}" placeholder="Contoh: DI Yogyakarta" required>
                                        </div>

                                        <div class="col-md-12">
                                            <p class="fw-bold mb-2">DATA PRODUK</p>
                                        </div>

                                        <div id="product-container">
                                            <div class="product-item border rounded p-3 mb-3">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="product_names[]" placeholder="Contoh: Bakpia Keju Spesial" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Deskripsi Produk <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="product_descriptions[]" rows="2" placeholder="Contoh: Bakpia dengan isian keju melimpah dan tekstur lembut..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addProduct()">+ Tambah Produk</button>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="product_photos" class="form-label fw-semibold">Foto Produk <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="product_photos" name="product_photos[]" multiple accept=".png,.jpg,.jpeg" required>
                                            <div class="form-text">Hanya file PNG, JPG, atau JPEG. Maksimum 10 MB per file.</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="employee_count" class="form-label fw-semibold">Jumlah Karyawan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="employee_count" name="employee_count" value="{{ old('employee_count') }}" placeholder="Contoh: 5" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="monthly_turnover" class="form-label fw-semibold">Omset Per Bulan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="monthly_turnover" name="monthly_turnover" required>
                                                <option value="" disabled selected>Pilih Omset</option>
                                                @foreach(['< 300 JT', '300 JT - 1 M', '> 1 M'] as $turnover)
                                                    <option value="{{ $turnover }}" {{ old('monthly_turnover') == $turnover ? 'selected' : '' }}>{{ $turnover }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="website" class="form-label fw-semibold">Website (Opsional)</label>
                                            <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Akun Sosial Media Usaha <span class="text-danger">*</span></label>
                                            <div id="social-media-container">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="social_media[]" placeholder="Instagram - @tokoku" required>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addSocialMedia()">+ Tambah Sosial Media</button>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label fw-semibold">Marketplace yang digunakan <span class="text-danger">*</span></label>
                                            <div id="marketplace-container">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="marketplaces[]" placeholder="Shopee - Nama Toko" required>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addMarketplace()">+ Tambah Marketplace</button>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="events_followed" class="form-label fw-semibold">Event yang pernah diikuti (Pameran / Expo / Bazar)</label>
                                            <textarea class="form-control" id="events_followed" name="events_followed" rows="3" placeholder="Contoh: Pameran UMKM DIY 2023, Bazar Ramadhan 2024..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary px-5 rounded-pill prev-step"><i class="bi bi-arrow-left me-2"></i> Sebelumnya</button>
                                    <button type="button" class="btn btn-primary px-5 rounded-pill next-step">Lanjut <i class="bi bi-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- STEP 3: DATA TAMBAHAN -->
                            <div class="form-step d-none" id="stepContainer3">
                                <!-- SECTION C: DATA EKSPOR -->
                                <div class="mb-5">
                                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">C. DATA EKSPOR</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Sudah Pernah Ekspor <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="has_exported" id="exportSudah" value="Sudah" {{ old('has_exported') == 'Sudah' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="exportSudah">Sudah</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="has_exported" id="exportBelum" value="Belum" {{ old('has_exported') == 'Belum' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="exportBelum">Belum</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="export_destination" class="form-label fw-semibold">Negara Tujuan Ekspor (Opsional)</label>
                                            <input type="text" class="form-control" id="export_destination" name="export_destination" value="{{ old('export_destination') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- SECTION D: DATA REKENING -->
                                <div class="mb-5">
                                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">D. DATA REKENING</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Nasabah BRI <span class="text-danger">*</span></label>
                                            <select class="form-select" name="bri_customer_status" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="Simpanan" {{ old('bri_customer_status') == 'Simpanan' ? 'selected' : '' }}>Simpanan</option>
                                                <option value="Pinjaman" {{ old('bri_customer_status') == 'Pinjaman' ? 'selected' : '' }}>Pinjaman</option>
                                                <option value="Tidak" {{ old('bri_customer_status') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Memiliki Rekening BRI <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="has_bri_cik_ditiro_account" id="briAccSudah" value="Sudah" {{ old('has_bri_cik_ditiro_account') == 'Sudah' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="briAccSudah">Sudah</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="has_bri_cik_ditiro_account" id="briAccBelum" value="Belum" {{ old('has_bri_cik_ditiro_account') == 'Belum' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="briAccBelum">Belum</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="bri_cik_ditiro_account_number" class="form-label fw-semibold">Nomor Rekening BRI <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bri_cik_ditiro_account_number" name="bri_cik_ditiro_account_number" value="{{ old('bri_cik_ditiro_account_number') }}" 
                                                placeholder='isi "0" apabila belum ada' pattern="\d+" inputmode="numeric" 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Memiliki QRIS dari BRI <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="has_qris_bri_cik_ditiro" id="qrisSudah" value="Sudah" {{ old('has_qris_bri_cik_ditiro') == 'Sudah' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="qrisSudah">Sudah</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="has_qris_bri_cik_ditiro" id="qrisBelum" value="Belum" {{ old('has_qris_bri_cik_ditiro') == 'Belum' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="qrisBelum">Belum</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary px-5 rounded-pill prev-step"><i class="bi bi-arrow-left me-2"></i> Sebelumnya</button>
                                    <button type="button" class="btn btn-primary px-5 rounded-pill next-step">Lanjut <i class="bi bi-arrow-right ms-2"></i></button>
                                </div>
                            </div>

                            <!-- STEP 4: KONFIRMASI -->
                            <div class="form-step d-none" id="stepContainer4">
                                <div class="mb-5 border rounded p-4 bg-light">
                                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">E. PERNYATAAN</h5>
                                    <p class="text-muted mb-4">Silakan tinjau kembali data yang telah Anda masukkan. Jika sudah yakin, centang pernyataan di bawah ini dan klik "Kirim Pendaftaran".</p>
                                    <div class="form-check p-3 border rounded bg-white">
                                        <input class="form-check-input ms-0" type="checkbox" name="agreement" id="agreement" value="1" required style="margin-top: 0.3rem;">
                                        <label class="form-check-label ms-2" for="agreement">
                                            Dengan ini saya menyatakan bahwa data yang saya berikan benar dan dapat dipertanggungjawabkan, serta menyetujui untuk memenuhi persyaratan yang berlaku.
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-5">
                                    <button type="button" class="btn btn-outline-secondary px-5 rounded-pill prev-step"><i class="bi bi-arrow-left me-2"></i> Sebelumnya</button>
                                    <div class="d-grid gap-2 d-md-flex">
                                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold">Kirim Pendaftaran <i class="bi bi-send ms-2"></i></button>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('home') }}" class="btn btn-link text-muted">Batal & Kembali ke Beranda</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registrationForm');
        const steps = document.querySelectorAll('.form-step');
        const indicators = document.querySelectorAll('.step-indicator');
        const progressBar = id => document.getElementById('formProgressBar');
        let currentStep = 1;

        function updateStep(step) {
            // Hide all steps
            steps.forEach(s => s.classList.add('d-none'));
            steps.forEach(s => s.classList.remove('active'));
            
            // Show current step
            const currentStepContainer = document.getElementById(`stepContainer${step}`);
            currentStepContainer.classList.remove('d-none');
            currentStepContainer.classList.add('active');

            // Update indicators
            indicators.forEach((ind, index) => {
                const stepNum = index + 1;
                const span = ind.nextElementSibling;
                
                if (stepNum < step) {
                    ind.classList.remove('bg-white', 'text-muted');
                    ind.classList.add('bg-success', 'text-white');
                    ind.innerHTML = '<i class="bi bi-check-lg"></i>';
                    ind.style.borderColor = '#198754';
                    ind.style.boxShadow = 'none';
                    if (span) span.classList.add('text-success');
                } else if (stepNum === step) {
                    ind.classList.remove('bg-success', 'bg-white', 'text-muted');
                    ind.classList.add('bg-primary', 'text-white');
                    ind.innerHTML = stepNum;
                    ind.style.borderColor = '#fff';
                    ind.style.boxShadow = '0 0 0 1px #0d6efd';
                    if (span) {
                        span.classList.remove('text-muted', 'text-success');
                        span.classList.add('text-primary', 'fw-bold');
                    }
                } else {
                    ind.classList.remove('bg-primary', 'bg-success', 'text-white');
                    ind.classList.add('bg-white', 'text-muted');
                    ind.innerHTML = stepNum;
                    ind.style.borderColor = '#dee2e6';
                    ind.style.boxShadow = 'none';
                    if (span) {
                        span.classList.remove('text-primary', 'text-success', 'fw-bold');
                        span.classList.add('text-muted');
                    }
                }
            });

            // Update progress bar
            const progress = ((step - 1) / (steps.length - 1)) * 100;
            progressBar().style.width = `${progress === 0 ? 25 : progress}%`;
            
            // Scroll to top of card
            window.scrollTo({
                top: document.querySelector('.card').offsetTop - 20,
                behavior: 'smooth'
            });
        }

        // Next button click
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', () => {
                const currentContainer = document.getElementById(`stepContainer${currentStep}`);
                const inputs = currentContainer.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        isValid = false;
                        return;
                    }
                });

                if (isValid && currentStep < steps.length) {
                    currentStep++;
                    updateStep(currentStep);
                }
            });
        });

        // Previous button click
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateStep(currentStep);
                }
            });
        });
    });

    function toggleOtherBusinessType(select) {
        const container = document.getElementById('other_business_type_container');
        const input = document.getElementById('other_business_type');
        if (select.value === 'Lainnya') {
            container.classList.remove('d-none');
            input.setAttribute('required', 'required');
        } else {
            container.classList.add('d-none');
            input.removeAttribute('required');
            input.value = '';
        }
    }

    function toggleOtherBusinessChain(select) {
        const container = document.getElementById('other_business_chain_container');
        const input = document.getElementById('other_business_chain');
        if (select.value === 'Lainnya') {
            container.classList.remove('d-none');
            input.setAttribute('required', 'required');
        } else {
            container.classList.add('d-none');
            input.removeAttribute('required');
            input.value = '';
        }
    }

    // File validation
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const files = this.files;
            const maxSize = 10 * 1024 * 1024; // 10MB
            const allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            const allowedFileTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                // Check size
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: `File "${file.name}" melebihi batas maksimal 10MB.`,
                        confirmButtonText: 'Tutup',
                        confirmButtonColor: '#0d6efd'
                    });
                    this.value = '';
                    return;
                }

                // Check type based on input name
                if (this.name === 'business_logo' || this.name.startsWith('product_photos')) {
                    if (!allowedImageTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format File Tidak Sesuai',
                            text: `File "${file.name}" harus berupa gambar (JPG, JPEG, atau PNG).`,
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#0d6efd'
                        });
                        this.value = '';
                        return;
                    }
                } else if (this.name.startsWith('legality_proofs')) {
                    if (!allowedFileTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format File Tidak Sesuai',
                            text: `File "${file.name}" harus berupa gambar atau PDF.`,
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#0d6efd'
                        });
                        this.value = '';
                        return;
                    }
                }
            }
        });
    });

    function addProduct() {
        const container = document.getElementById('product-container');
        const div = document.createElement('div');
        div.className = 'product-item border rounded p-3 mb-3';
        div.innerHTML = `
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="product_names[]" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi Produk <span class="text-danger">*</span></label>
                <textarea class="form-control" name="product_descriptions[]" rows="2" required></textarea>
            </div>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.parentElement.remove()">Hapus Produk</button>
        `;
        container.appendChild(div);
    }

    function addSocialMedia() {
        const container = document.getElementById('social-media-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="social_media[]" placeholder="Instagram - @tokoku" required>
            <button class="btn btn-outline-danger" type="button" onclick="this.parentElement.remove()">Hapus</button>
        `;
        container.appendChild(div);
    }

    function addMarketplace() {
        const container = document.getElementById('marketplace-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="marketplaces[]" placeholder="Shopee - Nama Toko" required>
            <button class="btn btn-outline-danger" type="button" onclick="this.parentElement.remove()">Hapus</button>
        `;
        container.appendChild(div);
    }
</script>
@endsection
