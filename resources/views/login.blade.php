<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="auth-page">

    <div class="login-card glass-card fade-in">
        <div class="row g-0">
            <!-- Brand Panel -->
            <div class="col-lg-5 brand-panel">
                <div class="brand-content">
                    <div class="brand-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h1 class="brand-title">Selamat Datang Kembali!</h1>
                    <p class="brand-subtitle">
                        Masuk untuk mengakses sistem manajemen divisi dan kelola data perusahaan Anda dengan mudah.
                    </p>
                </div>
            </div>

            <!-- Form Panel -->
            <div class="col-lg-7 form-panel">
                <h2 class="welcome-text">Login Akun</h2>
                <p class="welcome-sub">Masukkan kredensial Anda untuk melanjutkan</p>

                @if (session('status'))
                    <div class="alert-success-modern">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('prosess.login') }}" method="POST">
                    @csrf

                    <div class="input-group-modern">
                        <label for="email" class="form-label-modern">Email Address</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email" id="email" class="form-control-modern"
                                placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="input-group-modern">
                        <label for="password" class="form-label-modern">Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-control-modern"
                                placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="form-check-modern">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ route('forgot.password') }}" class="forgot-link">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk Sekarang
                    </button>
                </form>

                <div class="register-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
