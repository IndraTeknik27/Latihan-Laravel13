<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="auth-page">

    <div class="register-card glass-card fade-in">
        <div class="row g-0">
            <!-- Brand Panel -->
            <div class="col-lg-5 brand-panel">
                <div class="brand-content">
                    <div class="brand-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h1 class="brand-title">Bergabung Bersama Kami!</h1>
                    <p class="brand-subtitle">
                        Buat akun baru Anda dan mulai kelola sistem manajemen divisi perusahaan dengan mudah
                        dan terstruktur.
                    </p>
                </div>
            </div>

            <!-- Form Panel -->
            <div class="col-lg-7 form-panel">
                <h2 class="welcome-text">Buat Akun Baru</h2>
                <p class="welcome-sub">Lengkapi formulir di bawah untuk memulai</p>

                @if ($errors->any())
                    <div class="alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                                @if (!$loop->last)
                                    <br>
                                @endif
                            @endforeach
                        </span>
                    </div>
                @endif

                <form action="{{ route('prosess.register') }}" method="POST">
                    @csrf

                    <div class="input-group-modern">
                        <label for="name" class="form-label-modern">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" name="name" id="name" class="form-control-modern"
                                placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="field-error">
                                    <i class="bi bi-info-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group-modern">
                        <label for="email" class="form-label-modern">Email Address</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email" id="email" class="form-control-modern"
                                placeholder="nama@email.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="field-error">
                                    <i class="bi bi-info-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group-modern">
                        <label for="password" class="form-label-modern">Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="password" class="form-control-modern"
                                placeholder="Minimal 3 karakter" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                            @error('password')
                                <div class="field-error">
                                    <i class="bi bi-info-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <label class="terms-check">
                        <input type="checkbox" name="terms" required>
                        <span>Saya menyetujui <a href="#">Syarat & Ketentuan</a> yang berlaku</span>
                    </label>

                    <button type="submit" class="btn-register">
                        <i class="bi bi-person-plus"></i>
                        Daftar Sekarang
                    </button>
                </form>

                <div class="login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
