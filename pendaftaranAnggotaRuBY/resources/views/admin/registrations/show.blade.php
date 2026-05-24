@extends('admin.layouts.app')

@section('title', 'Detail Pendaftaran - ' . $registration->name)

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}" class="text-decoration-none">Pendaftaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
        <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
            {{ $registration->name }}
            @php
                $badgeClass = [
                    'UMUM' => 'text-bg-success',
                    'UTAMA' => 'text-bg-primary',
                    'PRIORITAS' => 'text-bg-warning',
                ][$registration->umkm_category] ?? 'text-bg-secondary';
            @endphp
            <span class="badge {{ $badgeClass }} fs-6 fw-medium px-3 rounded-pill">{{ $registration->umkm_category }}</span>
        </h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm px-3 rounded-3">
            <i class="bi bi-pencil-square"></i>
            <span>Edit Data</span>
        </a>
        <a href="javascript:void(0)" onclick="confirmExport('{{ route('admin.registrations.pdf', $registration) }}')" class="btn btn-danger d-flex align-items-center gap-2 shadow-sm px-3 rounded-3">
            <i class="bi bi-file-earmark-pdf"></i>
            <span>Cetak PDF</span>
        </a>
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-light border shadow-sm px-3 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
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

<div class="row g-4">
    <div class="col-lg-8">
        <!-- DATA DIRI -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h6 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle"></i> DATA DIRI
                </h6>
            </div>
            <div class="card-body pt-0">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Status Keanggotaan</label>
                        <div class="fw-bold text-dark">{{ $registration->membership_status ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Nomor Induk Kependudukan (NIK)</label>
                        <div class="fw-bold text-dark d-flex align-items-center gap-2">
                            <span id="masked-nik">{{ $registration->masked_nik }}</span>
                            <span id="full-nik" class="d-none">{{ $registration->safe_nik }}</span>
                            <button class="btn btn-sm btn-link p-0 text-decoration-none" onclick="toggleField('nik')" title="Tampilkan/Sembunyikan NIK">
                                <i class="bi bi-eye" id="nik-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Tempat, Tanggal Lahir</label>
                        <div class="text-dark">{{ $registration->place_date_birth ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">E-mail Aktif</label>
                        <div class="text-dark">
                            <a href="mailto:{{ $registration->email }}" class="text-decoration-none d-flex align-items-center gap-1">
                                <i class="bi bi-envelope small"></i> {{ $registration->email }}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Nomor WhatsApp</label>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-dark fw-medium">{{ $registration->whatsapp_number ?? '-' }}</span>
                            @php
                                $waPhone = $registration->whatsapp_number ?: $registration->phone;
                                $waPhone = preg_replace('/\D+/', '', $waPhone ?? '');
                                if (str_starts_with($waPhone, '0')) { $waPhone = '62'.substr($waPhone, 1); }
                                $waUrl = $waPhone ? 'https://wa.me/'.$waPhone : null;
                            @endphp
                            @if($waUrl)
                                <a target="_blank" href="{{ $waUrl }}" class="btn btn-sm btn-success rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;" title="Hubungi via WhatsApp">
                                    <i class="bi bi-whatsapp" style="font-size: 0.75rem;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Nomor Telepon Aktif</label>
                        <div class="text-dark">{{ $registration->phone ?? '-' }}</div>
                    </div>
                    <div class="col-md-12">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Alamat Lengkap</label>
                        <div class="text-dark p-3 bg-light rounded-3 border-start border-primary border-4">{{ $registration->address ?? '-' }}</div>
                    </div>
                    @if($registration->umkm_category === 'UMUM')
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Sudah Memiliki Usaha?</label>
                        <div>
                            <span class="badge {{ $registration->has_business ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} px-3">
                                {{ $registration->has_business ? 'Sudah' : 'Belum' }}
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($registration->umkm_category !== 'UMUM')
        <!-- DATA USAHA -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h6 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-briefcase"></i> DATA USAHA
                </h6>
            </div>
            <div class="card-body pt-0">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-semibold mb-2 d-block">Logo Usaha</label>
                        @if($registration->business_logo)
                            <div class="position-relative group border rounded-4 overflow-hidden shadow-sm" style="width: 160px; height: 160px;">
                                <img src="{{ Storage::url($registration->business_logo) }}" alt="Logo" class="w-100 h-100 object-fit-contain p-2 bg-white">
                                <a href="{{ Storage::url($registration->business_logo) }}" target="_blank" class="position-absolute inset-0 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center opacity-0 group-hover:opacity-100 transition-all text-white text-decoration-none">
                                    <i class="bi bi-zoom-in fs-4"></i>
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center border border-dashed rounded-4 bg-light text-muted" style="width: 160px; height: 160px;">
                                <div class="text-center">
                                    <i class="bi bi-image fs-1 d-block mb-1 opacity-25"></i>
                                    <span class="small">Tanpa Logo</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="text-muted small text-uppercase fw-semibold mb-1">Nama Usaha</label>
                                <div class="fw-bold fs-5 text-dark">{{ $registration->business_name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-semibold mb-1">Legalitas</label>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($registration->legalities)
                                        @foreach($registration->legalities as $l)
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2">{{ $l }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-semibold mb-1">Nomor NPWP</label>
                                <div class="text-dark fw-medium d-flex align-items-center gap-2">
                                    <span id="masked-npwp">{{ $registration->masked_npwp }}</span>
                                    @if($registration->safe_npwp && $registration->safe_npwp !== '-')
                                        <span id="full-npwp" class="d-none">{{ $registration->safe_npwp }}</span>
                                        <button class="btn btn-sm btn-link p-0 text-decoration-none" onclick="toggleField('npwp')" title="Tampilkan/Sembunyikan NPWP">
                                            <i class="bi bi-eye" id="npwp-icon"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-semibold mb-1">Jenis Usaha</label>
                                <div class="text-dark">{{ $registration->business_type ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-semibold mb-1">Tahun Mulai</label>
                                <div class="text-dark">{{ $registration->business_start_year ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Deskripsi Usaha</label>
                        <div class="p-3 bg-light rounded-3 text-dark small" style="white-space: pre-line;">{{ $registration->business_description ?? '-' }}</div>
                    </div>

                    <div class="col-12">
                        <div class="p-3 border rounded-4 bg-light bg-opacity-50">
                            <h6 class="small fw-bold text-uppercase mb-3 text-muted border-bottom pb-2">Alamat Usaha</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="text-muted x-small text-uppercase mb-0">Jalan</label>
                                    <div class="small text-dark">{{ $registration->business_address_street ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted x-small text-uppercase mb-0">Kecamatan</label>
                                    <div class="small text-dark">{{ $registration->business_address_district ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted x-small text-uppercase mb-0">Kabupaten/Kota</label>
                                    <div class="small text-dark">{{ $registration->business_address_city ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted x-small text-uppercase mb-0">Provinsi</label>
                                    <div class="small text-dark">{{ $registration->business_address_province ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="text-muted small text-uppercase fw-semibold mb-2">Daftar Produk</label>
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-hover align-middle mb-0 small">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3" style="width: 250px;">Nama Produk</th>
                                        <th>Deskripsi Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($registration->product_names)
                                        @foreach($registration->product_names as $index => $name)
                                        <tr>
                                            <td class="ps-3 fw-bold text-dark">{{ $name }}</td>
                                            <td class="text-muted">{{ $registration->product_descriptions[$index] ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="2" class="text-center py-4 text-muted italic">Tidak ada data produk</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Jumlah Karyawan</label>
                        <div class="text-dark fw-bold">{{ $registration->employee_count ?? '0' }} Orang</div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Omset Per Bulan</label>
                        <div class="text-dark fw-bold text-primary">{{ $registration->monthly_turnover ?? '-' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Website</label>
                        <div class="text-dark">
                            @if($registration->website)
                                <a href="{{ $registration->website }}" target="_blank" class="text-decoration-none text-truncate d-block">
                                    <i class="bi bi-globe me-1"></i> {{ str_replace(['http://', 'https://'], '', $registration->website) }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-2">Media Sosial</label>
                        <div class="d-flex flex-wrap gap-2">
                            @if($registration->social_media)
                                @foreach($registration->social_media as $sm)
                                    <span class="badge bg-white text-dark border shadow-xs py-2 px-3 fw-medium">
                                        <i class="bi bi-instagram me-1 text-danger"></i> {{ $sm }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-2">Marketplace</label>
                        <div class="d-flex flex-wrap gap-2">
                            @if($registration->marketplaces)
                                @foreach($registration->marketplaces as $m)
                                    <span class="badge bg-white text-dark border shadow-xs py-2 px-3 fw-medium">
                                        <i class="bi bi-shop me-1 text-primary"></i> {{ $m }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="text-muted small text-uppercase fw-semibold mb-1">Event yang pernah diikuti</label>
                        <div class="text-dark small border p-3 rounded-3 bg-light bg-opacity-25">{{ $registration->events_followed ?: 'Belum pernah mengikuti event' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DOKUMEN & FOTO -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h6 class="mb-0 fw-bold text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-text"></i> DOKUMEN & FOTO
                </h6>
            </div>
            <div class="card-body pt-0">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-3 d-block">Bukti Legalitas Usaha</label>
                        @if($registration->legality_proofs)
                            <div class="d-grid gap-2">
                                @foreach($registration->legality_proofs as $proof)
                                    <a href="{{ Storage::url($proof) }}" target="_blank" class="btn btn-light border text-start d-flex align-items-center justify-content-between p-3 rounded-3 hover-shadow transition-all">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-file-earmark-pdf text-danger fs-5"></i>
                                            <span class="small fw-medium">Dokumen {{ $loop->iteration }}</span>
                                        </div>
                                        <i class="bi bi-download text-muted"></i>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 border border-dashed rounded-4 bg-light text-center text-muted">
                                <i class="bi bi-folder-x fs-2 d-block mb-1 opacity-25"></i>
                                <span class="small">Tidak ada file legalitas</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold mb-3 d-block">Foto Produk</label>
                        @if($registration->product_photos)
                            <div class="row g-2">
                                @foreach($registration->product_photos as $photo)
                                    <div class="col-4">
                                        <div class="position-relative group border rounded-3 overflow-hidden shadow-xs ratio ratio-1x1">
                                            <img src="{{ Storage::url($photo) }}" alt="Produk" class="w-100 h-100 object-fit-cover">
                                            <a href="{{ Storage::url($photo) }}" target="_blank" class="position-absolute inset-0 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center opacity-0 group-hover:opacity-100 transition-all text-white">
                                                <i class="bi bi-zoom-in"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 border border-dashed rounded-4 bg-light text-center text-muted">
                                <i class="bi bi-images fs-2 d-block mb-1 opacity-25"></i>
                                <span class="small">Tidak ada foto produk</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="sticky-top" style="top: 24px; z-index: 100;">
            <!-- DATA EKSPOR & REKENING (Compact) -->
            @if($registration->umkm_category !== 'UMUM')
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary small text-uppercase mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-globe"></i> Data Ekspor
                        </h6>
                        <div class="p-3 rounded-3 bg-primary-subtle bg-opacity-50">
                            <div class="text-muted x-small text-uppercase mb-1">Status Ekspor</div>
                            <div class="fw-bold text-primary d-flex align-items-center gap-2">
                                {{ $registration->has_exported ? 'Pernah Ekspor' : 'Belum Pernah' }}
                                <i class="bi bi-{{ $registration->has_exported ? 'check-circle-fill' : 'x-circle' }}"></i>
                            </div>
                            @if($registration->has_exported)
                                <div class="mt-2 pt-2 border-top border-primary-subtle">
                                    <div class="text-muted x-small text-uppercase mb-1">Negara Tujuan</div>
                                    <div class="small fw-medium">{{ $registration->export_destination ?? '-' }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h6 class="fw-bold text-primary small text-uppercase mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-bank"></i> Data Perbankan
                        </h6>
                        <div class="p-3 rounded-3 bg-info-subtle bg-opacity-50">
                            <div class="mb-3">
                                <div class="text-muted x-small text-uppercase mb-1">Nasabah BRI</div>
                                <div class="fw-bold text-info-emphasis">{{ $registration->bri_customer_status ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted x-small text-uppercase mb-1">Rekening BRI</div>
                                <div class="small fw-medium">{{ $registration->has_bri_cik_ditiro_account ? 'Punya' : 'Tidak Punya' }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted x-small text-uppercase mb-1">Nomor Rekening</div>
                                <div class="fw-bold font-monospace d-flex align-items-center gap-2">
                                    <span id="masked-acc">{{ $registration->masked_account_number }}</span>
                                    @if($registration->safe_account_number && $registration->safe_account_number !== '0')
                                        <span id="full-acc" class="d-none">{{ $registration->safe_account_number }}</span>
                                        <button class="btn btn-sm btn-link p-0 text-decoration-none" onclick="toggleField('acc')" title="Tampilkan/Sembunyikan Rekening">
                                            <i class="bi bi-eye text-primary" id="acc-icon"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="text-muted x-small text-uppercase mb-1">Layanan QRIS BRI</div>
                                <div class="small fw-medium">{{ $registration->has_qris_bri_cik_ditiro ? 'Aktif' : 'Tidak Aktif' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- ACTIONS -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="mb-0 fw-bold text-dark">KELOLA DATA</h6>
                </div>
                <div class="card-body pt-0">
                    <div class="alert bg-light border-0 small text-muted mb-4">
                        <i class="bi bi-info-circle me-1"></i>
                        Pendaftaran ini masuk pada <strong>{{ $registration->created_at?->format('d M Y, H:i') }}</strong>.
                    </div>
                    
                    <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-trash"></i> Hapus Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    .shadow-xs { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .group-hover\:opacity-100:hover { opacity: 1 !important; }
    .transition-all { transition: all 0.3s ease; }
    .hover-shadow:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.08); transform: translateY(-2px); }
    .border-dashed { border-style: dashed !important; }
</style>

<script>
    function toggleField(fieldId) {
        const masked = document.getElementById('masked-' + fieldId);
        const full = document.getElementById('full-' + fieldId);
        const icon = document.getElementById(fieldId + '-icon');
        
        if (full.classList.contains('d-none')) {
            full.classList.remove('d-none');
            masked.classList.add('d-none');
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            full.classList.add('d-none');
            masked.classList.remove('d-none');
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endsection
