<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; }
        .card { border:0; border-radius:1rem; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height:100vh">
    <div class="container" style="max-width:420px">
        <div class="text-center mb-3">
            <img src="{{ asset('assets/images/logo-ruby.png') }}" alt="logo" height="48">
            <h4 class="mt-2">Admin Panel</h4>
            <p class="text-muted small">Masuk untuk mengelola pendaftaran</p>
        </div>
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
        <p class="text-center text-muted small mt-3">
            Bukan admin? <a href="{{ route('home') }}">Kembali ke beranda</a>
        </p>
    </div>
</body>
</html>
