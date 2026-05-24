<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Pendaftaran - {{ $registration->name }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #103bcf; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #103bcf; font-size: 20px; }
        .section-title { background: #f1f5ff; padding: 5px 10px; font-weight: bold; color: #061b6b; margin-top: 20px; border-left: 4px solid #103bcf; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table td { padding: 5px 0; vertical-align: top; border-bottom: 1px solid #eee; }
        table td.label { width: 35%; color: #666; font-weight: bold; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>RUMAH BUMN YOGYAKARTA</h1>
        <p>Data Pendaftaran Anggota RuBY</p>
    </div>

    <div class="section-title">INFORMASI DASAR</div>
    <table>
        <tr><td class="label">ID Pendaftaran</td><td>#{{ $registration->id }}</td></tr>
        <tr><td class="label">Kategori UMKM</td><td>{{ $registration->umkm_category }}</td></tr>
        <tr><td class="label">Status Keanggotaan</td><td>{{ $registration->membership_status }}</td></tr>
        <tr><td class="label">Tanggal Daftar</td><td>{{ $registration->created_at->format('d M Y, H:i') }}</td></tr>
    </table>

    <div class="section-title">PROFIL PENDAFTAR</div>
    <table>
        <tr><td class="label">Nama Lengkap</td><td>{{ $registration->name }}</td></tr>
        <tr><td class="label">NIK</td><td>{{ ($isVerified ?? false) ? $registration->nik : $registration->masked_nik }}</td></tr>
        <tr><td class="label">Tempat, Tanggal Lahir</td><td>{{ $registration->place_date_birth }}</td></tr>
        <tr><td class="label">Email</td><td>{{ $registration->email }}</td></tr>
        <tr><td class="label">No. WhatsApp</td><td>{{ $registration->whatsapp_number }}</td></tr>
        <tr><td class="label">No. Telepon</td><td>{{ $registration->phone }}</td></tr>
        <tr><td class="label">Alamat Lengkap</td><td>{{ $registration->address }}</td></tr>
    </table>

    <div class="section-title">DATA USAHA</div>
    <table>
        <tr><td class="label">Sudah Punya Usaha?</td><td>{{ $registration->has_business ? 'Ya' : 'Belum' }}</td></tr>
        @if($registration->has_business || $registration->umkm_category !== 'UMUM')
            <tr><td class="label">Nama Usaha</td><td>{{ $registration->business_name }}</td></tr>
            <tr><td class="label">Jenis Usaha</td><td>{{ $registration->business_type }}</td></tr>
            <tr><td class="label">Legalitas</td><td>{{ is_array($registration->legalities) ? implode(', ', $registration->legalities) : $registration->legalities }}</td></tr>
            <tr><td class="label">NPWP</td><td>{{ ($isVerified ?? false) ? $registration->npwp_number : $registration->masked_npwp }}</td></tr>
            <tr><td class="label">Tahun Mulai</td><td>{{ $registration->business_start_year }}</td></tr>
            <tr><td class="label">Rantai Usaha</td><td>{{ $registration->business_chain }}</td></tr>
            <tr><td class="label">Alamat Usaha</td><td>{{ $registration->business_address_street }}, {{ $registration->business_address_district }}, {{ $registration->business_address_city }}, {{ $registration->business_address_province }}</td></tr>
        @endif
    </table>

    @if($registration->umkm_category !== 'UMUM')
    <div class="section-title">DATA REKENING</div>
    <table>
        <tr><td class="label">Status Nasabah BRI</td><td>{{ $registration->bri_customer_status }}</td></tr>
        <tr><td class="label">Memiliki Rekening BRI</td><td>{{ $registration->has_bri_cik_ditiro_account ? 'Ya' : 'Tidak' }}</td></tr>
        <tr><td class="label">No. Rekening BRI</td><td>{{ ($isVerified ?? false) ? $registration->bri_cik_ditiro_account_number : $registration->masked_account_number }}</td></tr>
        <tr><td class="label">Memiliki QRIS BRI</td><td>{{ $registration->has_qris_bri_cik_ditiro ? 'Ya' : 'Tidak' }}</td></tr>
    </table>
    @endif

    <div class="section-title">PRODUK & PEMASARAN</div>
    <table>
        <tr><td class="label">Daftar Produk</td><td>{{ is_array($registration->product_names) ? implode(', ', $registration->product_names) : $registration->product_names }}</td></tr>
        <tr><td class="label">Jumlah Karyawan</td><td>{{ $registration->employee_count }}</td></tr>
        <tr><td class="label">Omset per Bulan</td><td>{{ $registration->monthly_turnover }}</td></tr>
        <tr><td class="label">Website</td><td>{{ $registration->website }}</td></tr>
        <tr><td class="label">Media Sosial</td><td>{{ is_array($registration->social_media) ? implode(', ', $registration->social_media) : $registration->social_media }}</td></tr>
        <tr><td class="label">Marketplace</td><td>{{ is_array($registration->marketplaces) ? implode(', ', $registration->marketplaces) : $registration->marketplaces }}</td></tr>
    </table>

    <div class="section-title">DATA PERBANKAN (BRI)</div>
    <table>
        <tr><td class="label">Status Nasabah BRI</td><td>{{ $registration->bri_customer_status }}</td></tr>
        <tr><td class="label">Memiliki Rekening BRI</td><td>{{ $registration->has_bri_cik_ditiro_account ? 'Ya' : 'Tidak' }}</td></tr>
        <tr><td class="label">Nomor Rekening BRI</td><td>{{ $registration->masked_account_number }}</td></tr>
        <tr><td class="label">QRIS BRI</td><td>{{ $registration->has_qris_bri_cik_ditiro ? 'Ya' : 'Tidak' }}</td></tr>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d M Y, H:i:s') }} | Rumah BUMN Yogyakarta</p>
    </div>
</body>
</html>
