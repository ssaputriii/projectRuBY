<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah BUMN Yogyakarta')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #f8f9fa;
            --accent-color: #ffc107;
            --text-dark: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: #fff;
        }

        .navbar {
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 40px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem 2rem;
            border-radius: 30px;
            font-weight: 600;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem 2rem;
            border-radius: 30px;
            font-weight: 600;
        }

        .section-padding {
            padding: 80px 0;
        }

        .footer {
            background-color: var(--primary-color);
            color: #fff;
            padding: 60px 0 20px;
        }

        .footer h2, .footer h4 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
        }

        .footer ul li i {
            color: #fff;
            margin-right: 15px;
            font-size: 1.2rem;
            margin-top: 3px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 50px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        /* About Visi Misi Styles */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            margin-top: 40px;
        }

        .about-image {
            width: 100%;
            max-width: 500px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        @media (max-width: 991px) {
            .about-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.40), rgba(0,0,0,0.40)), url('/assets/images/heroruby.png');
            background-size: cover;
            background-position: center;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .hero-section h1 {
            color: var(--white);
            line-height: 1.2;
        }
        

        /* Partner Logos */
        .partner-logos {
            padding: 60px 0;
            background: var(--white);
            border-bottom: 1px solid var(--bg-light);
        }

        .partner-logos img {
            height: 100px;
            width: auto;
            object-fit: contain;
        }

    
        @media (max-width: 768px) {
            .partner-logos img {
                height: 35px;
            }
        }

        /* Utilities */
        .text-primary { color: #fff; !important; }
        .bg-light { background-color: var(--bg-light) !important; }
        .bg-primary-light { background-color: var(--primary-light) !important; }
        .max-width-700 { max-width: 700px; }
    </style>
    @yield('styles')
</head>
<body>

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
