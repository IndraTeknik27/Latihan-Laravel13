<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Divisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="p-3 p-md-4">

    <div class="container fade-in" style="max-width: 640px;">

        <!-- Header -->
        <div class="mb-4">
            <a href="{{ route('divisi.index') }}"
                class="btn btn-glass px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2 mb-3"
                style="background: rgba(255,255,255,0.12); color: white; border: 1px solid rgba(255,255,255,0.3);">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
            <h1 class="page-title">
                <span class="page-title-icon">
                    <i class="bi bi-plus-circle"></i>
                </span>
                Tambah Divisi
            </h1>
            <p class="text-white-50 mt-2 mb-0">Lengkapi formulir di bawah untuk menambahkan divisi baru</p>
        </div>

        <!-- Form Card -->
        <div class="glass-card p-4 p-md-5">

            @if ($errors->any())
                <div class="alert-error mb-4">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                            @if (!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('divisi.store') }}" method="POST">
                @csrf

                <div class="input-group-modern">
                    <label for="kode" class="form-label-modern">Kode Divisi</label>
                    <div class="input-wrapper">
                        <i class="bi bi-hash input-icon"></i>
                        <input type="text" name="kode" id="kode" class="form-control-modern"
                            placeholder="Contoh: IT, HR, FIN" value="{{ old('kode') }}" required autofocus
                            maxlength="10" style="text-transform: uppercase;">
                    </div>
                    <small class="text-white-50 mt-1 d-block">
                        <i class="bi bi-info-circle me-1"></i>
                        Kode unik untuk identifikasi divisi (max 10 karakter)
                    </small>
                </div>

                <div class="input-group-modern">
                    <label for="nama" class="form-label-modern">Nama Divisi</label>
                    <div class="input-wrapper">
                        <i class="bi bi-building input-icon"></i>
                        <input type="text" name="nama" id="nama" class="form-control-modern"
                            placeholder="Contoh: Information Technology" value="{{ old('nama') }}" required>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-gradient px-4 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-save"></i>
                        Simpan Divisi
                    </button>
                    <a href="{{ route('divisi.index') }}"
                        class="btn btn-secondary px-4 py-2 rounded-3 d-inline-flex align-items-center gap-2"
                        style="background: #6b7280; color: white; border: none;">
                        <i class="bi bi-x-lg"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
