<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Divisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="p-3 p-md-4">

    <div class="container-fluid max-w-7xl fade-in" style="max-width: 1280px;">

        @if (session('success'))
            <div class="alert-success-modern mb-4">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error mb-4">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Top Bar -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
            <div>
                <p class="text-white-50 mb-2 small">
                    <i class="bi bi-hand-thumbs-up-fill me-1"></i>
                    Login berhasil, selamat datang
                    <span class="fw-semibold text-white">{{ Auth::user()->name }}</span>!
                </p>
                <h1 class="page-title">
                    <span class="page-title-icon">
                        <i class="bi bi-building"></i>
                    </span>
                    Data Divisi
                </h1>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-glass px-4 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small fw-medium mb-1">Total Divisi</p>
                            <p class="display-6 fw-bold mb-0">{{ $divisi->count() }}</p>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-diagram-3 fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small fw-medium mb-1">Total Pegawai</p>
                            <p class="display-6 fw-bold mb-0">
                                {{ $divisi->sum('pegawais_count') }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-white-50 small fw-medium mb-1">Hari Ini</p>
                            <p class="fs-5 fw-semibold mb-0">{{ now()->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-calendar-event fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="glass-card">

            <!-- Toolbar -->
            <div class="p-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"
                style="border-color: #f3f4f6 !important;">
                <div class="search-wrapper" style="flex: 1; max-width: 420px;">
                    <i class="bi bi-search"></i>
                    <input id="searchInput" type="text" placeholder="Cari divisi berdasarkan nama atau kode..."
                        class="form-control search-input py-2">
                </div>

                <a href="{{ route('divisi.create') }}"
                    class="btn btn-gradient px-4 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Divisi
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th class="text-start">Kode</th>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Jumlah Pegawai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($divisi as $d)
                            <tr>
                                <td>
                                    <span class="text-secondary fw-medium">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span class="badge-kode">{{ $d->kode }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            {{ strtoupper(substr($d->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="divisi-name mb-0">{{ $d->nama }}</p>
                                            <p class="divisi-subtitle mb-0">Divisi {{ $d->kode }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge-count">{{ $d->pegawais_count ?? 0 }}</span>
                                        <span class="text-secondary small">pegawai</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <a href="{{ route('divisi.edit', $d->id) }}"
                                            class="btn-action btn-edit" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('divisi.destroy', $d->id) }}" method="POST"
                                            class="m-0"
                                            onsubmit="return confirm('Yakin ingin menghapus divisi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete"
                                                title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="bi bi-folder2-open"></i>
                                        </div>
                                        <p class="text-secondary fw-medium mb-1">Belum ada data divisi</p>
                                        <p class="text-muted small mb-0">Tambahkan divisi pertama Anda sekarang</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            @if ($divisi->count() > 0)
                <div class="px-4 py-3 border-top d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 text-secondary small"
                    style="border-color: #f3f4f6 !important;">
                    <p class="mb-0">
                        Menampilkan <span class="fw-semibold text-dark">{{ $divisi->count() }}</span> divisi
                    </p>
                    <nav>
                        <ul class="pagination pagination-modern mb-0">
                            <li class="page-item disabled">
                                <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                            </li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item disabled">
                                <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif

        </div>

        <p class="text-center text-white-50 small mt-4 mb-0">
            &copy; {{ date('Y') }} Sistem Manajemen Divisi. Dibuat dengan <i
                class="bi bi-heart-fill text-danger"></i>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
