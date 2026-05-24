<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #2563eb;
            --admin-primary-soft: #eff6ff;
            --admin-bg: #f8fafc;
            --admin-sidebar-bg: #ffffff;
            --admin-text: #1e293b;
            --admin-text-muted: #64748b;
            --admin-border: #e2e8f0;
        }

        body { background: var(--admin-bg); color: var(--admin-text); overflow-x: hidden; font-family: 'Inter', sans-serif; }
        html { overflow-x: hidden; }
        
        .sidebar { 
            width: 260px; 
            min-height: 100vh; 
            background: var(--admin-sidebar-bg); 
            color: var(--admin-text-muted); 
            position: fixed; 
            inset: 0 auto 0 0; 
            padding: 16px; 
            border-right: 1px solid var(--admin-border);
            box-shadow: 4px 0 15px rgba(0,0,0,0.02);
        }

        .sidebar .brand { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 12px 10px; 
            margin-bottom: 24px; 
            border-bottom: 1px solid var(--admin-border);
        }

        .sidebar .menu { display: grid; gap: 8px; }
        
        .sidebar a { 
            color: var(--admin-text-muted); 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 12px 16px; 
            border-radius: 12px; 
            font-weight: 500; 
            transition: all 0.2s ease;
        }

        .sidebar a.active { 
            background: var(--admin-primary); 
            color: #ffffff; 
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .sidebar a:hover:not(.active) { 
            background: var(--admin-primary-soft); 
            color: var(--admin-primary); 
        }

        .content { flex: 1; min-width: 0; margin-left: 260px; }
        
        .topbar { 
            background: #ffffff; 
            border-bottom: 1px solid var(--admin-border); 
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .stat { 
            border: 1px solid var(--admin-border); 
            border-radius: 16px; 
            background: #fff; 
            padding: 20px;
            transition: transform 0.2s ease;
        }
        .stat:hover { transform: translateY(-3px); }

        .stat .icon { 
            width: 48px; 
            height: 48px; 
            display: grid; 
            place-items: center; 
            border-radius: 12px; 
        }

        .list-card { 
            background: #fff; 
            border: 1px solid var(--admin-border); 
            border-radius: 18px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .table thead th { 
            background: #f8fafc; 
            border-bottom: 1px solid var(--admin-border);
            color: var(--admin-text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.025em;
            padding: 16px;
        }

        .table tbody td { padding: 16px; border-bottom: 1px solid #f1f5f9; }

        .btn-primary {
            background: var(--admin-primary);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-primary:hover { background: #1d4ed8; }

        .badge-soft { padding: .4rem .75rem; border-radius: 8px; font-weight: 600; font-size: 0.8rem; }
        .badge-umum { background: #ecfdf5; color: #059669; }
        .badge-utama { background: #eff6ff; color: #2563eb; }
        .badge-prioritas { background: #fffbeb; color: #d97706; }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 1050;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1040;
                backdrop-filter: blur(4px);
            }
            .sidebar-overlay.active {
                display: block;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
    @stack('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="d-flex">
        <aside class="sidebar">
            <div class="brand">
                <img src="{{ asset('assets/images/logo-ruby.png') }}" alt="logo" height="36">
                
            </div>
            <nav class="menu">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>
                
                <div class="menu-label mt-3 mb-1 small text-uppercase fw-bold text-muted" style="padding: 0 16px; font-size: 0.7rem; letter-spacing: 0.05em;">Manajemen Anggota</div>
                <a href="{{ route('admin.registrations.index') }}" class="{{ request()->routeIs('admin.registrations.index') && !request('category') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i><span>Semua Anggota</span>
                </a>
                <a href="{{ route('admin.registrations.index', ['category' => 'UMUM']) }}" class="{{ request('category') == 'UMUM' ? 'active' : '' }}">
                    <i class="bi bi-person"></i><span>Anggota Umum</span>
                </a>
                <a href="{{ route('admin.registrations.index', ['category' => 'UTAMA']) }}" class="{{ request('category') == 'UTAMA' ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i><span>Anggota Utama</span>
                </a>
                <a href="{{ route('admin.registrations.index', ['category' => 'PRIORITAS']) }}" class="{{ request('category') == 'PRIORITAS' ? 'active' : '' }}">
                    <i class="bi bi-star"></i><span>Anggota Prioritas</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" class="pt-4" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari Admin Panel?')">
                    @csrf
                    <button class="btn btn-danger w-100 rounded-3"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                </form>
            </nav>
        </aside>
        <div class="content">
            <nav class="navbar navbar-expand topbar">
                <div class="container-fluid">
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-light d-lg-none" id="sidebar-toggler">
                            <i class="bi bi-list"></i>
                        </button>
                        <span class="fw-semibold">Admin Panel</span>
                        <span class="text-muted small">Dashboard</span>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('home') }}" class="btn btn-light border me-2">Ke Website</a>
                        <span class="text-muted small me-2">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width:32px;height:32px">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
                        </span>
                    </div>
                </div>
            </nav>
            <main class="container-fluid py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const sidebarToggler = document.getElementById('sidebar-toggler');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        }

        sidebarToggler.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        function confirmExport(url) {
            Swal.fire({
                title: 'Verifikasi Keamanan',
                text: 'Masukkan password admin Anda untuk mengunduh data lengkap.',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocorrect: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Verifikasi & Unduh',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch('{{ route("admin.verify-password") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ password: password })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(json => {
                                throw new Error(json.message || 'Password salah.');
                            });
                        }
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(error.message);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        // Toast Configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Show Success Message
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}'
            });
        @endif

        // Show Error Message
        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        @endif

        // Show Validation Errors
        @if($errors->any())
            Toast.fire({
                icon: 'error',
                title: 'Ada kesalahan pada data yang Anda masukkan'
            });
        @endif
    </script>
    @stack('scripts')
    </body>
</html>
