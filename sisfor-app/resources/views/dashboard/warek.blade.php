<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warek | SI Beasiswa</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-bg: #1e1b4b;
            --main-bg: #f8fafc;
            --accent: #4f46e5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            color: #1e293b;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: #e0e7ff;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: #a5b4fc;
            padding: 14px 25px;
            margin: 5px 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            font-weight: 500;
            text-decoration: none;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .content {
            margin-left: 280px;
            padding: 40px;
        }

        .card-analytics {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            padding: 25px;
            transition: transform 0.2s;
        }

        .card-analytics:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .table-custom {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .btn-export {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 20px;
        }

        @media (max-width: 992px) {
            .sidebar { display: none; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 mb-4 mt-2">
        <h4 class="fw-bold text-white mb-0"><i class="bi bi-hexagon-half me-2"></i>SI WAREK</h4>
        <p class="small opacity-50 mb-0">Executive Dashboard</p>
    </div>

    <nav>
        <a href="#" class="nav-link active"><i class="bi bi-speedometer2 me-3"></i> Ringkasan</a>
        <a href="#" class="nav-link"><i class="bi bi-graph-up-arrow me-3"></i> Statistik Global</a>
        <a href="#" class="nav-link"><i class="bi bi-cash-stack me-3"></i> Laporan Anggaran</a>
        <a href="#" class="nav-link"><i class="bi bi-file-earmark-pdf me-3"></i> Arsip Laporan</a>
    </nav>

    <div class="mt-auto p-4" style="position: absolute; bottom: 0; width: 100%;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger w-100 rounded-pill py-2 border-2">
                <i class="bi bi-box-arrow-right me-2"></i> Keluar Sistem
            </button>
        </form>
    </div>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Statistik & Laporan Realisasi</h3>
            <p class="text-muted">Periode Tahun Akademik 2026/2027</p>
        </div>
        <div class="bg-white p-2 rounded-pill shadow-sm d-flex align-items-center pe-4">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div>
                <div class="small fw-bold">Wakil Rektor I</div>
                <div class="text-muted" style="font-size: 0.65rem;">Universitas Yarsi</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card-analytics border-start border-primary border-5">
                <div class="icon-circle bg-primary bg-opacity-10 text-primary"><i class="bi bi-people"></i></div>
                <h6 class="text-muted small fw-bold">TOTAL PENERIMA</h6>
                <h3 class="fw-bold">1,240</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-analytics border-start border-success border-5">
                <div class="icon-circle bg-success bg-opacity-10 text-success"><i class="bi bi-wallet2"></i></div>
                <h6 class="text-muted small fw-bold">REALISASI DANA</h6>
                <h3 class="fw-bold">Rp 4.2M</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-analytics border-start border-warning border-5">
                <div class="icon-circle bg-warning bg-opacity-10 text-warning"><i class="bi bi-hourglass-split"></i></div>
                <h6 class="text-muted small fw-bold">PROSES SELEKSI</h6>
                <h3 class="fw-bold">452</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-analytics border-start border-info border-5">
                <div class="icon-circle bg-info bg-opacity-10 text-info"><i class="bi bi-mortarboard"></i></div>
                <h6 class="text-muted small fw-bold">PROGRAM AKTIF</h6>
                <h3 class="fw-bold">12</h3>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="card-analytics">
                <h5 class="fw-bold mb-4">Tren Pertumbuhan Penerima Beasiswa</h5>
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-analytics">
                <h5 class="fw-bold mb-4">Distribusi Status</h5>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <h5 class="fw-bold mb-0">Laporan Per Fakultas</h5>
            <p class="text-muted small mb-0">Menampilkan data sebaran kuota tiap fakultas</p>
        </div>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-danger btn-export rounded-pill shadow-sm">
                <i class="bi bi-file-earmark-pdf me-2"></i>Export PDF
            </a>
            <a href="#" class="btn btn-success btn-export rounded-pill shadow-sm">
                <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export Excel
            </a>
        </div>
    </div>

    <div class="table-custom border-0 shadow-sm mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="small text-uppercase fw-bold text-muted">
                        <th class="ps-4">Fakultas</th>
                        <th>Kuota Terpakai</th>
                        <th>Alokasi Dana</th>
                        <th>Progress</th>
                        <th class="text-end pe-4">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 fw-bold">Teknologi Informasi</td>
                        <td>320 / 400</td>
                        <td>Rp 850jt</td>
                        <td>
                            <div class="progress" style="height: 8px; width: 120px;">
                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                            </div>
                        </td>
                        <td class="text-end pe-4"><button class="btn btn-sm btn-light border px-3">Lihat</button></td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Kedokteran</td>
                        <td>150 / 200</td>
                        <td>Rp 1.2M</td>
                        <td>
                            <div class="progress" style="height: 8px; width: 120px;">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                        </td>
                        <td class="text-end pe-4"><button class="btn btn-sm btn-light border px-3">Lihat</button></td>
                    </tr>
                    <tr>
                        <td class="ps-4 fw-bold">Ekonomi & Bisnis</td>
                        <td>210 / 300</td>
                        <td>Rp 600jt</td>
                        <td>
                            <div class="progress" style="height: 8px; width: 120px;">
                                <div class="progress-bar bg-info" style="width: 70%"></div>
                            </div>
                        </td>
                        <td class="text-end pe-4"><button class="btn btn-sm btn-light border px-3">Lihat</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Trend Chart (Line)
    const ctxTrend = document.getElementById('trendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: [400, 850, 1200, 900, 1500, 2100],
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { beginAtZero: true, grid: { borderDash: [5, 5] } }, 
                x: { grid: { display: false } } 
            }
        }
    });

    // Status Chart (Doughnut)
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Diterima', 'Seleksi', 'Ditolak'],
            datasets: [{
                data: [60, 25, 15],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                hoverOffset: 10,
                borderWidth: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } },
            cutout: '75%'
        }
    });
</script>
</body>
</html>