<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="auth-page">

    <div class="reset-card glass-card fade-in">
        <div class="row g-0">
            <!-- Brand Panel -->
            <div class="col-lg-5 brand-panel">
                <div class="brand-content">
                    <div class="brand-icon">
                        <i class="bi bi-key"></i>
                    </div>
                    <h1 class="brand-title">Buat Password Baru</h1>
                    <p class="brand-subtitle">
                        Silakan masukkan password baru Anda. Pastikan password kuat dan mudah diingat untuk
                        menjaga keamanan akun Anda.
                    </p>
                </div>
            </div>

            <!-- Form Panel -->
            <div class="col-lg-7 form-panel">
                <h2 class="welcome-text">Reset Password</h2>
                <p class="welcome-sub">Untuk akun: <strong class="text-dark">{{ $email }}</strong></p>

                @if ($errors->any())
                    <div class="alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('prosess.reset.password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="input-group-modern">
                        <label for="password" class="form-label-modern">Password Baru</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-control-modern"
                                placeholder="Masukkan password baru" required autofocus>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group-modern">
                        <label for="password_confirmation" class="form-label-modern">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-shield-check input-icon"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control-modern" placeholder="Ulangi password baru" required>
                            <button type="button" class="password-toggle" onclick="toggleConfirmPassword()">
                                <i class="bi bi-eye" id="toggleConfirmIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="bi bi-check2-circle"></i>
                        Simpan Password Baru
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
    <script>
        function toggleConfirmPassword() {
            const input = document.getElementById('password_confirmation');
            const icon = document.getElementById('toggleConfirmIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>

</body>

</html>
