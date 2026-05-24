@extends('layouts.app')

@section('content')

<section class="section-sm pt-5">
    <div class="container text-center">
        <h1 class="page-title">
            Jenis Keanggotaan Rumah BUMN Yogyakarta
        </h1>

        <p class="section2-intro">
            Pilih jenis keanggotaan yang sesuai dengan tahapan perjalanan wirausaha Anda.
        </p>
    </div>
</section>
<section class="registration-flow section bg-white">
    <div class="container text-center">
        <h3>Alur Pendaftaran</h3>
        <p class="section-intro">3 langkah mudah untuk bergabung menjadi anggota</p>
        
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

<section class="membership2-section">
    <div class="membership2-wrapper">

        <!-- CARD 1 -->
        <div class="membership2-card green">
            <div class="card-header">
                <h3>Anggota Umum</h3>
                <a href="{{ route('pendaftaran.umum', ['from' => 'page']) }}" class="btn-card">Daftar Sekarang</a>
            </div>
            <div class="card-body">
                <p>Untuk mahasiswa dan individu yang ingin mulai berwirausaha.</p>
            </div>
            <div class="card-grid">
                <div>
                    <h4>Manfaat & Fasilitas</h4>
                    <ul>
                        <li>Mengikuti Program Inkubasi</li>
                        <li>Mendapatkan pelatihan offline maupun online (Go Modern, Go Digital, Go Online, Go Global) secara GRATIS</li>
                        <li>Memberikan akses pasar (Digital Apps & Marketplace)</li>
                        <li>Konsultasi bisnis untuk pengembangan ide</li>
                        <li>Akses ke ruang kerja bersama (co-working space)</li>
                        <li>Bagi Mahasiswa dapat magang konversi di Rumah BUMN Yogyakarta</li>
                    </ul>
                </div>

                <div>
                    <h4>Persyaratan Pendaftaran</h4>
                    <ul>
                        <li>Mengisi Form Pendaftaran dengan lengkap dan benar</li>
                        <li>Masuk WhatsApp Group untuk informasi lainnya</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- CARD 2 -->
        <div class="membership2-card blue">
            <div class="card-header">
                <h3>Anggota Utama</h3>
                <a href="{{ route('pendaftaran.utama', ['from' => 'page']) }}" class="btn-card">Daftar Sekarang</a>
            </div>
            <div class="card-body">
                <p>Untuk UMKM yang sedang berkembang dan butuh pendampingan.</p>
                
            </div>
            <div class="card-grid">
                <div>
                    <h4>Manfaat & Fasilitas</h4>
                    <ul>
                        <li>Mengikuti Program Inkubasi</li>
                        <li>Mendapatkan pelatihan offline maupun online (Go Modern, Go Digital, Go Online, Go Global) secara GRATIS</li>
                        <li>Memberikan akses pasar (Digital Apps & Marketplace)</li>
                        <li>Konsultasi bisnis untuk pengembangan ide</li>
                        <li>Akses ke ruang kerja bersama (co-working space)</li>
                        <li>Dibantu dalam Legalitas Usaha</li>
                        <li>Mendapat akses pemodalan usaha dari Bank BRI seperti KUR, Kupedes, dll</li>
                    </ul>
                </div>

                <div>
                    <h4>Persyaratan Pendaftaran</h4>
                    <ul>
                        <li>Mengisi Form Pendaftaran dengan lengkap dan benar</li>
                        <li>Masuk WhatsApp Group untuk informasi lainnya</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="membership2-card gold">
            <div class="card-header">
                <h3>Anggota Prioritas</h3>
                <a href="{{ route('pendaftaran.prioritas', ['from' => 'page']) }}" class="btn-card">Daftar Sekarang</a>
            </div>
            <div class="card-body">
                <p>Untuk UMKM yang siap naik level dan ekspansi pasar.</p>
                
            </div>
            <div class="card-grid">
                <div>
                    <h4>Manfaat & Fasilitas</h4>
                    <ul>
                        <li>Mengikuti Program Inkubasi</li>
                        <li>Mendapatkan pelatihan offline maupun online (Go Modern, Go Digital, Go Online, Go Global) secara GRATIS</li>
                        <li>Memberikan akses pasar (Digital Apps & Marketplace)</li>
                        <li>Konsultasi bisnis untuk pengembangan ide</li>
                        <li>Akses ke ruang kerja bersama (co-working space)</li>
                        <li>Dibantu dalam Legalitas Usaha</li>
                        <li>Mendapat akses pemodalan usaha dari Bank BRI seperti KUR, Kupedes, dll</li>
                        <li>Berkesempatan untuk mengikuti Bazar, Pameran, Expo, dan Event lokal, nasional, maupun internasional lainnya bersama Rumah BUMN Yogyakarta</li>
                        <li>Mendapat foto produk dan dimasukkan ke katalog Rumah BUMN Yogyakarta secara GRATIS</li>
                        <li>Mendapat review produk dan dibuatkan konten secara gratis</li>
                        <li>Berkesempatan untuk mendisplay produknya di RuBY Store</li>
                    </ul>
                </div>

                <div>
                    <h4>Persyaratan Pendaftaran</h4>
                    <ul>
                        <li>Mengisi Form Pendaftaran dengan lengkap dan benar</li>
                        <li>Masuk WhatsApp Group untuk informasi lainnya</li>
                        <li>Bersedia melakukan pembukaan Rekening di BRI Cik Ditiro (Apabila belum ada)</li>
                        <li>Bersedia melakukan pendaftaran QRIS (QR Code Indonesia Standard) di BRI Cik DItiro</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="cta section">
    <div class="container cta-box">
        <h2>Masih Bingung Memilih Jenis Keanggotaan?</h2>
        <p>Tim kami siap membantu Anda menemukan jenis keanggotaan yang paling sesuai dengan kebutuhan dan tujuan bisnis Anda</p>
        <div class="cta-actions">
            <a href="https://wa.me/6285161609877" target="_blank" class="btn btn-light">Hubungi Kami</a>
        </div>
    </div>
</section>

@endsection