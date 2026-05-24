<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah BUMN Yogyakarta')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll(".select-membership");

    cards.forEach(card => {
        card.addEventListener("click", function () {

            // Hapus active dari semua
            cards.forEach(c => c.classList.remove("active"));

            // Tambahkan active ke yang diklik
            this.classList.add("active");

            // Tampilkan form section
            document.getElementById("form-section").classList.remove("d-none");

            // Sembunyikan semua form
            document.querySelectorAll(".membership-form").forEach(form => {
                form.classList.add("d-none");
            });

            // Tampilkan form sesuai target
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
