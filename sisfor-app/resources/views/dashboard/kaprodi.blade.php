<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Executive Dashboard | YARSI HUB</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --yarsi-emerald: #059669;
            --yarsi-dark: #064e3b;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 0% 0%, #ecfdf5 0%, #f8fafc 100%);
            color: #1e293b;
            min-height: 100vh;
        }

        /* --- Sidebar Final --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--yarsi-dark);
            padding: 2.5rem 1.5rem;
            color: white;
            z-index: 1100; /* Memastikan di atas konten */
            box-shadow: 10px 0 40px rgba(0,0,0,0.1);
        }

        .nav-item-lux {
            padding: 14px 20px;
            border-radius: 16px;
            color: #a7f3d0;
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-item-lux:hover, .nav-item-lux.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        /* --- Main Content --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 3rem 4rem;
            position: relative;
            z-index: 1;
        }

        /* --- Bento Cards --- */
        .bento-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.02);
            height: 100%;
        }

        .workflow-box {
            background: linear-gradient(135deg, var(--yarsi-dark), #065f46);
            color: white;
            border-radius: 24px;
            padding: 24px;
        }

        /* --- Table Styling --- */
        .table-final {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        .btn-approve-final {
            background: var(--yarsi-emerald);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-approve-final:hover {
            background: #047857;
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
            color: white;
        }

        /* Fix Logout Area */
        .logout-area {
            position: absolute;
            bottom: 40px;
            width: calc(100% - 3rem);
            pointer-events: auto;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="d-flex align-items-center gap-3 mb-5 px-2">
            <div class="bg-white p-2 rounded-3">
                <i class="bi bi-mortarboard-fill text-success fs-4"></i>
            </div>
            <div>
                <h5 class="fw-800 mb-0">YARSI HUB</h5>
                <p class="small opacity-50 mb-0">Executive Portal</p>
            </div>
        </div>

        <nav>
            <a href="#" class="nav-item-lux active"><i class="bi bi-grid-1x2-fill me-3"></i> Overview</a>
            <a href="#" class="nav-item-lux"><i class="bi bi-shield-check me-3"></i> Validasi Berkas</a>
            <a href="#" class="nav-item-lux"><i class="bi bi-people me-3"></i> Data Mahasiswa</a>
        </nav>

        <div class="logout-area">
            <div class="p-3 rounded-4 bg-white bg-opacity-10 mb-3 border border-white border-opacity-10">
                <small class="opacity-70 d-block">SSO & LDAP</small>
                <span class="small fw-bold text-success">● Connected</span>
            </div>
            
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                </form>
            <a href="javascript:void(0)" class="nav-item-lux text-danger" 
               onclick="alert('Sistem akan membersihkan session SSO dan Logout...'); window.location.href='/login';">
                <i class="bi bi-power me-3"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-800 mb-1">Informatics Executive</h2>
                <p class="text-muted">Pusat Kendali Validasi Tahap 1 - Kaprodi Informatika</p>
            </div>
            <div class="bg-white p-2 rounded-pill shadow-sm px-4 border d-flex align-items-center gap-3">
                <div class="text-end">
                    <p class="small fw-800 mb-0">Kaprodi Informatika</p>
                    <p class="text-muted mb-0" style="font-size: 10px;">Universitas Yarsi</p>
                </div>
                <div class="bg-emerald-main rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--yarsi-emerald);">K</div>
            </div>
        </header>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="bento-card">
                    <div class="text-warning mb-2"><i class="bi bi-hourglass-split fs-3"></i></div>
                    <h6 class="text-muted small fw-bold">PENDING VALIDATION</h6>
                    <h1 class="fw-800">24</h1>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bento-card">
                    <div class="text-success mb-2"><i class="bi bi-check-circle-fill fs-3"></i></div>
                    <h6 class="text-muted small fw-bold">PRODI APPROVED</h6>
                    <h1 class="fw-800">142</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="workflow-box d-flex align-items-center justify-content-between h-100">
                    <div>
                        <h5 class="fw-bold">Alur Beasiswa 2026</h5>
                        <p class="small mb-0 opacity-75">Data yang Anda setujui akan diteruskan langsung ke <b>Admin Pusat</b> untuk finalisasi tanpa melalui Warek.</p>
                    </div>
                    <div class="bg-white bg-opacity-10 p-3 rounded-4 border border-white border-opacity-10">
                        <i class="bi bi-shield-lock-fill text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bento-card p-0 overflow-hidden">
            <div class="p-4 bg-white border-bottom d-flex justify-content-between">
                <h5 class="fw-800 mb-0">Daftar Antrean Validasi</h5>
                <span class="badge bg-emerald-light text-success rounded-pill px-3">Tahun Akademik 2026/2027</span>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="bg-light">
                        <tr class="small fw-bold text-muted">
                            <th class="ps-4">MAHASISWA</th>
                            <th>PROGRAM</th>
                            <th>BERKAS</th>
                            <th>STATUS PRODI</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">Ahmad Syarif</div>
                                <div class="small text-muted">1402021001</div>
                            </td>
                            <td><span class="fw-600">Beasiswa Prestasi</span></td>
                            <td><span class="text-success fw-bold">5/5 Berkas</span></td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">Belum Dicek</span></td>
                            <td class="text-center">
                                <button class="btn btn-approve-final">Validasi</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">Siti Aminah</div>
                                <div class="small text-muted">1402021045</div>
                            </td>
                            <td><span class="fw-600">Beasiswa KIP-K</span></td>
                            <td><span class="text-danger fw-bold">3/5 Berkas</span></td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">Revisi</span></td>
                            <td class="text-center">
                                <button class="btn btn-outline-secondary border-0 small fw-bold">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>