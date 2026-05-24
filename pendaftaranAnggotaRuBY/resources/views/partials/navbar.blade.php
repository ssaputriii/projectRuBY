<header class="site-header">
    <div class="container nav-wrapper">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('assets/images/logo-ruby.png') }}" alt="Rumah BUMN Yogyakarta" class="brand-logo">
        </a>

        <nav class="nav-menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('jenis.keanggotaan') }}" class="{{ request()->routeIs('jenis.keanggotaan') ? 'active' : '' }}">Jenis Keanggotaan</a>
            <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
            <!-- <a href="{{ route('home') }}#daftar">Pendaftaran</a> -->
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
        </nav>

        <button class="hamburger-menu" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>

        <div class="mobile-menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('jenis.keanggotaan') }}" class="{{ request()->routeIs('jenis.keanggotaan') ? 'active' : '' }}">Jenis Keanggotaan</a>
            <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
        </div>
    </div>
</header>
