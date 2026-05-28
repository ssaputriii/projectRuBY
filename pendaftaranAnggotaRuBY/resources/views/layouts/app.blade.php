<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah BUMN Yogyakarta')</title>
    <meta name="description" content="Platform pendaftaran anggota UMKM Rumah BUMN Yogyakarta. Daftar sekarang dan kembangkan usaha Anda bersama komunitas wirausaha terbaik di Yogyakarta.">

    {{-- Preload LCP image hanya di halaman utama --}}
    @if(Request::is('/'))
    <link rel="preload" as="image" href="{{ asset('assets/images/ruby1.webp') }}" type="image/webp" fetchpriority="high">
    @endif

    {{-- Preconnect untuk font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- CSS Kritis (local) — load normal, tidak di-defer --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    {{-- Bootstrap CSS — load normal (tidak defer) untuk layout utama --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    {{-- Bootstrap Icons — defer --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
          media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </noscript>

    {{-- Font Awesome — defer --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </noscript>

    {{-- Google Fonts — defer --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </noscript>
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const cards = document.querySelectorAll(".select-membership");

        cards.forEach(card => {
            card.addEventListener("click", function () {
                cards.forEach(c => c.classList.remove("active"));
                this.classList.add("active");
                document.getElementById("form-section").classList.remove("d-none");
                document.querySelectorAll(".membership-form").forEach(form => {
                    form.classList.add("d-none");
                });
                const target = this.getAttribute("data-target");
                document.getElementById(target).classList.remove("d-none");
            });
        });

        const hamburger = document.querySelector(".hamburger-menu");
        const mobileMenu = document.querySelector(".mobile-menu");
        const hamburgerIcon = hamburger.querySelector("i");

        hamburger.addEventListener("click", function () {
            mobileMenu.classList.toggle("active");
            if (mobileMenu.classList.contains("active")) {
                hamburgerIcon.classList.remove("bi-list");
                hamburgerIcon.classList.add("bi-x");
            } else {
                hamburgerIcon.classList.remove("bi-x");
                hamburgerIcon.classList.add("bi-list");
            }
        });

    });
    </script>
    @stack('scripts')
</body>
</html>