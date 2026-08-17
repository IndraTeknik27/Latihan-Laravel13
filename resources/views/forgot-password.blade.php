<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="auth-page">

    <div class="forgot-card glass-card fade-in">
        <div class="row g-0">
            <!-- Brand Panel -->
            <div class="col-lg-5 brand-panel">
                <div class="brand-content">
                    <div class="brand-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h1 class="brand-title">Lupa Password?</h1>
                    <p class="brand-subtitle">
                        Jangan khawatir, kami akan bantu Anda mendapatkan kembali akses ke akun Anda dalam
                        beberapa langkah mudah.
                    </p>
                </div>
            </div>

            <!-- Form Panel -->
            <div class="col-lg-7 form-panel">
                <h2 class="welcome-text">Reset Password</h2>
                <p class="welcome-sub">Masukkan email Anda dan kami akan mengirim link untuk reset password</p>

                @if ($errors->any())
                    <div class="alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('prosess.forgot.password') }}" method="POST">
                    @csrf

                    <div class="input-group-modern">
                        <label for="email" class="form-label-modern">Email Address</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email" id="email" class="form-control-modern"
                                placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="bi bi-send"></i>
                        Kirim Link Reset
                    </button>
                </form>

                <div class="login-link">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali ke
                    <a href="{{ route('login') }}">Halaman Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
