<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluang Beasiswa | SI Beasiswa</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }

        .scholarship-card {
            border: none;
            border-radius: 20px;
            background: white;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .scholarship-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .filter-pill {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            text-decoration: none;
            display: inline-block;
        }

        .filter-pill.active {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
            <h2 class="fw-bold text-dark">Temukan Beasiswa Impianmu</h2>
            <p class="text-muted">Pilih berbagai program beasiswa yang tersedia untuk mendukung pendidikanmu di Universitas Yarsi.</p>
        </div>
    </div>

    <div class="row mb-4 g-3 align-items-center">
        <div class="col-md-7 d-flex gap-2 overflow-auto pb-2">
            <a href="#" class="filter-pill active">Semua</a>
            <a href="#" class="filter-pill">Akademik</a>
            <a href="#" class="filter-pill">Non-Akademik</a>
            <a href="#" class="filter-pill">Bantuan Dana</a>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0 rounded-end-pill p-2" placeholder="Cari nama beasiswa...">
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card scholarship-card h-100 p-4 position-relative">
                <span class="card-badge bg-success bg-opacity-10 text-success">Terbuka</span>
                <div class="icon-box mb-3">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h5 class="fw-bold mb-2 text-dark">Beasiswa Prestasi Akademik</h5>
                <p class="small text-muted mb-4">Ditujukan bagi mahasiswa dengan IPK minimal 3.50 selama 2 semester berturut-turut.</p>
                
                <div class="mt-auto">
                    <div class="d-flex align-items-center small text-muted mb-3">
                        <i class="bi bi-calendar-event me-2"></i> Deadline: 30 April 2026
                    </div>
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary rounded-pill fw-bold py-2">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card scholarship-card h-100 p-4 position-relative">
                <span class="card-badge bg-primary bg-opacity-10 text-primary">Internal</span>
                <div class="icon-box mb-3 text-primary" style="background: #e0e7ff;">
                    <i class="bi bi-building"></i>
                </div>
                <h5 class="fw-bold mb-2 text-dark">Beasiswa Yayasan Yarsi</h5>
                <p class="small text-muted mb-4">Bantuan biaya SPP untuk mahasiswa aktif yang memiliki kontribusi bagi organisasi kampus.</p>
                
                <div class="mt-auto">
                    <div class="d-flex align-items-center small text-muted mb-3">
                        <i class="bi bi-calendar-event me-2"></i> Deadline: 15 Mei 2026
                    </div>
                    <div class="d-grid">
                        <a href="#" class="btn btn-outline-primary rounded-pill fw-bold py-2">Detail Info</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card scholarship-card h-100 p-4 position-relative">
                <span class="card-badge bg-secondary bg-opacity-10 text-secondary">Akan Datang</span>
                <div class="icon-box mb-3 text-warning" style="background: #fffbeb;">
                    <i class="bi bi-wallet2"></i>
                </div>
                <h5 class="fw-bold mb-2 text-dark">Bantuan KIP Kuliah</h5>
                <p class="small text-muted mb-4">Program bantuan dari pemerintah untuk mendukung akses pendidikan bagi mahasiswa kurang mampu.</p>
                
                <div class="mt-auto">
                    <div class="d-flex align-items-center small text-muted mb-3">
                        <i class="bi bi-calendar-event me-2"></i> Pendaftaran: Juni 2026
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-light rounded-pill fw-bold py-2" disabled>Belum Dibuka</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted small">Butuh bantuan pendaftaran? <a href="#" class="fw-bold text-primary text-decoration-none">Hubungi Admin</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>