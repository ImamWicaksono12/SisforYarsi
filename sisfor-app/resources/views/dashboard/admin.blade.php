<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SI Beasiswa Yarsi</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --sidebar-bg: #0f172a;
            --main-bg: #f1f5f9;
            --primary: #2563eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            color: #94a3b8;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 15px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-menu {
            flex-grow: 1;
            overflow-y: auto;
        }

        /* Content Area */
        .content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .top-nav {
            background: white;
            padding: 15px 30px;
            margin: -30px -30px 30px -30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Cards & Components */
        .stat-card {
            border: none;
            border-radius: 16px;
            padding: 24px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .filter-card {
            border: none;
            border-radius: 12px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .btn-action {
            transition: all 0.3s ease;
        }
        
        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        @media (max-width: 992px) {
            .sidebar { margin-left: -260px; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="p-4 mb-2">
        <h4 class="text-white fw-bold mb-0"><i class="bi bi-shield-lock-fill me-2"></i>Admin Panel</h4>
        <small class="text-uppercase opacity-50 fw-bold" style="font-size: 0.65rem;">Sistem Beasiswa Yarsi</small>
    </div>

    <div class="sidebar-menu">
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.beasiswa.index') }}" class="nav-link {{ Request::is('admin/beasiswa*') ? 'active' : '' }}">
                <i class="bi bi-mortarboard-fill me-2"></i> Data Beasiswa
            </a>
            <a href="#" class="nav-link"><i class="bi bi-people-fill me-2"></i> Mahasiswa</a>
            <a href="#" class="nav-link"><i class="bi bi-person-badge-fill me-2"></i> Kelola Akun</a>
            <a href="#" class="nav-link"><i class="bi bi-file-earmark-text-fill me-2"></i> Laporan</a>
        </nav>
    </div>
</div>

<div class="content">
    <div class="top-nav shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <h5 class="fw-bold mb-0 me-3">Overview Dashboard</h5>
            <div class="d-none d-lg-flex gap-2">
                <button class="btn btn-outline-success btn-sm rounded-pill px-3 btn-action shadow-sm">
                    <i class="bi bi-file-earmark-excel me-1"></i> Export Data
                </button>
                <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary btn-sm rounded-pill px-3 btn-action shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Beasiswa Baru
                </a>
            </div>
        </div>
        
        <div class="d-flex align-items-center">
            <span class="me-3 small text-muted d-none d-md-inline">Selamat Datang, <strong>Admin Yarsi</strong></span>
            
            <div class="dropdown">
                <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center fw-bold dropdown-toggle" 
                     id="profileDropdown" 
                     data-bs-toggle="dropdown" 
                     aria-expanded="false" 
                     style="width: 38px; height: 38px; cursor: pointer;">
                    A
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="profileDropdown">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold small">Admin Yarsi</div>
                        <div class="text-muted" style="font-size: 0.75rem;">admin@yarsi.ac.id</div>
                    </li>
                    <li><a class="dropdown-item mt-2" href="#"><i class="bi bi-person me-2"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card filter-card">
                <div class="card-body py-2 px-3 d-flex align-items-center">
                    <i class="bi bi-calendar-event text-primary me-2"></i>
                    <select class="form-select border-0 shadow-none fw-semibold" id="semesterFilter">
                        <option value="2025/2026-genap">Semester Genap 2025/2026</option>
                        <option value="2025/2026-ganjil">Semester Ganjil 2025/2026</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="icon-shape bg-primary bg-opacity-10 text-primary mb-3" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-briefcase-fill fs-4"></i>
                </div>
                <h6 class="text-muted small fw-bold">TOTAL BEASISWA</h6>
                <h2 class="fw-bold mb-0">{{ $totalBeasiswa }}</h2>
                <small class="text-success"><i class="bi bi-arrow-up-short"></i> Aktif</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="icon-shape bg-success bg-opacity-10 text-success mb-3" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
                <h6 class="text-muted small fw-bold">PENDAFTAR AKTIF</h6>
                <h2 class="fw-bold mb-0">{{ number_format($pendaftarAktif) }}</h2>
                <small class="text-muted small">Total Keseluruhan</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="icon-shape bg-warning bg-opacity-10 text-warning mb-3" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
                <h6 class="text-muted small fw-bold">MENUNGGU VALIDASI</h6>
                <h2 class="fw-bold mb-0">{{ $menungguValidasi }}</h2>
                <small class="text-danger fw-bold">Perlu tindakan</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm">
                <div class="icon-shape bg-info bg-opacity-10 text-info mb-3" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
                <h6 class="text-muted small fw-bold">TOTAL DITERIMA</h6>
                <h2 class="fw-bold mb-0">{{ $totalDiterima }}</h2>
                <small class="text-muted small">Tahun Akademik 2026</small>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="chart-container">
                <h6 class="fw-bold mb-4">Tren Pendaftaran Beasiswa</h6>
                <div style="height: 300px;"><canvas id="mainChart"></canvas></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="chart-container">
                <h6 class="fw-bold mb-4">Distribusi Per Fakultas</h6>
                <div style="height: 300px;"><canvas id="facultyChart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">Pendaftaran Terbaru</h6>
            <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-sm btn-primary px-3 rounded-pill btn-action">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Mahasiswa</th>
                            <th>Program</th>
                            <th>Tanggal</th>
                            <th>Status & Workflow</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaranTerbaru as $data)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $data->nama_mahasiswa }}</div>
                                <div class="small text-muted">{{ $data->nama_prodi }}</div>
                            </td>
                            <td>{{ $data->nama_beasiswa }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_daftar)->format('d M Y') }}</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-warning text-dark',
                                        'diterima' => 'bg-success',
                                        'ditolak' => 'bg-danger',
                                        'validasi_kaprodi' => 'bg-info text-dark',
                                        'validasi_admin' => 'bg-primary'
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Pending Berkas',
                                        'validasi_kaprodi' => 'Di Kaprodi',
                                        'validasi_admin' => 'Di Admin',
                                        'diterima' => 'Diterima',
                                        'ditolak' => 'Ditolak'
                                    ];
                                @endphp
                                <div class="d-flex flex-column">
                                    <span class="badge {{ $statusClasses[$data->status] ?? 'bg-secondary' }} px-3 py-2 rounded-pill text-capitalize shadow-sm" 
                                          style="font-size: 0.7rem; width: fit-content;"
                                          data-bs-toggle="tooltip" 
                                          title="Posisi berkas saat ini">
                                        <i class="bi bi-info-circle me-1"></i> {{ $statusLabels[$data->status] ?? $data->status }}
                                    </span>
                                    @if($data->status == 'validasi_kaprodi')
                                        <small class="text-muted mt-1" style="font-size: 0.65rem;">
                                            <i class="bi bi-person-check me-1"></i> Menunggu Kaprodi
                                        </small>
                                    @elseif($data->status == 'validasi_admin')
                                        <small class="text-muted mt-1" style="font-size: 0.65rem;">
                                            <i class="bi bi-shield-check me-1"></i> Review Akhir Admin
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <a href="/admin/pendaftaran/{{ $data->pendaftaran_id }}" class="btn btn-sm btn-light border btn-action">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 opacity-25"></i>
                                Belum ada data pendaftaran terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // DATA DARI BACKEND
    const trenData = @json($trenPendaftaran);
    const fakultasData = @json($distribusiFakultas);

    // LINE CHART
    const ctxMain = document.getElementById('mainChart').getContext('2d');
    const blueGradient = ctxMain.createLinearGradient(0, 0, 0, 400);
    blueGradient.addColorStop(0, 'rgba(37, 99, 235, 0.3)');
    blueGradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctxMain, {
        type: 'line',
        data: {
            labels: trenData.length > 0 ? trenData.map(item => item.bulan) : ['Mar'],
            datasets: [{
                label: 'Pendaftar',
                data: trenData.length > 0 ? trenData.map(item => item.total) : [1],
                borderColor: '#2563eb',
                borderWidth: 3,
                backgroundColor: blueGradient,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#2563eb'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });

    // DOUGHNUT CHART
    const ctxFaculty = document.getElementById('facultyChart').getContext('2d');
    new Chart(ctxFaculty, {
        type: 'doughnut',
        data: {
            labels: fakultasData.length > 0 ? fakultasData.map(item => item.fakultas) : ['Ekonomi'],
            datasets: [{
                data: fakultasData.length > 0 ? fakultasData.map(item => item.total) : [1],
                backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } } },
            cutout: '70%'
        }
    });

    // Tooltip Initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>