<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluang Beasiswa | Sistem Informasi Beasiswa Yarsi</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --yarsi-blue: #0d6efd;
            --yarsi-dark: #003d99;
            --yarsi-gradient: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            --soft-bg: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--soft-bg);
            color: #1e293b;
            overflow-x: hidden;
        }

        .logo-text {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--yarsi-blue);
            text-transform: uppercase;
            font-size: 0.95rem;
        }

        .btn-back {
            color: #64748b;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }
        .btn-back:hover { 
            color: var(--yarsi-blue); 
            transform: translateX(-5px);
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .scholarship-card {
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 28px;
            background: white;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            padding: 35px;
            display: flex;
            flex-direction: column;
        }

        .scholarship-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(13, 110, 253, 0.15);
            border-color: var(--yarsi-blue);
        }

        .card-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.8px;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #f0f7ff;
            color: var(--yarsi-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 1.8rem;
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .scholarship-card:hover .icon-box {
            background: var(--yarsi-blue);
            color: white;
            transform: rotate(-5deg) scale(1.1);
        }

        .filter-pill {
            padding: 12px 28px;
            border-radius: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            border: 1px solid #eef2f6;
            background: white;
            color: #94a3b8;
            text-decoration: none;
            display: inline-block;
        }

        .filter-pill.active {
            background: var(--yarsi-blue);
            color: white;
            border-color: var(--yarsi-blue);
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
        }

        .filter-pill:hover:not(.active) {
            background: #f1f5f9;
            color: var(--yarsi-blue);
        }

        .search-wrapper .input-group {
            background: white;
            border: 1px solid #e2e8f0;
            transition: 0.3s;
        }

        .search-wrapper .input-group:focus-within {
            border-color: var(--yarsi-blue);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .btn-register {
            background: var(--yarsi-gradient);
            border: none;
            color: white;
            padding: 12px;
            font-size: 0.95rem;
        }

        .btn-register:hover { 
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        @media (max-width: 768px) {
            .display-5 { font-size: 2.2rem; font-weight: 800; }
            .logo-text { font-size: 0.75rem; }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5" data-aos="fade-down">
        <div>
            <a href="{{ url('/') }}" class="btn-back">
                <i class="bi bi-arrow-left me-2"></i> Beranda
            </a>
        </div>
        <div class="logo-wrapper">
            <span class="logo-text">Sistem Informasi Beasiswa Yarsi</span>
        </div>
    </div>

    <div class="row mb-5" data-aos="fade-right">
        <div class="col-lg-7">
            <h6 class="text-primary fw-bold text-uppercase mb-3" style="letter-spacing: 2px;">Kesempatan Terbatas</h6>
            <h1 class="fw-800 text-dark display-5 mb-3">Peluang Beasiswa 🎓</h1>
            <p class="text-muted lead">Wujudkan impian akademismu dengan pilihan bantuan pendidikan di Universitas Yarsi.</p>
        </div>
    </div>

    <div class="row mb-5 g-4" data-aos="fade-up">
        <div class="col-lg-7">
            <div class="d-flex gap-2 overflow-auto pb-3 custom-scrollbar">
                <a href="#" class="filter-pill active" data-filter="all">Semua Program</a>
                <a href="#" class="filter-pill" data-filter="Akademik">Akademik</a>
                <a href="#" class="filter-pill" data-filter="Non-Akademik">Non-Akademik</a>
                <a href="#" class="filter-pill" data-filter="Bantuan Dana">Bantuan Dana</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="search-wrapper">
                <div class="input-group rounded-pill overflow-hidden p-1">
                    <span class="input-group-text border-0 bg-transparent ps-3"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="scholarshipSearch" class="form-control border-0 shadow-none" placeholder="Cari nama beasiswa...">
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5" id="scholarshipContainer">
        
        <div class="col-md-6 col-lg-4 scholarship-item" data-category="Akademik" data-aos="fade-up" data-aos-delay="100">
            <div class="card scholarship-card h-100 position-relative">
                <span class="card-badge bg-success bg-opacity-10 text-success">Pendaftaran Buka</span>
                <div class="icon-box shadow-sm">
                    <i class="bi bi-award"></i>
                </div>
                <h5 class="fw-800 mb-2">Beasiswa Prestasi Akademik</h5>
                <p class="small text-muted mb-4">Potongan biaya kuliah hingga 50% untuk mahasiswa dengan capaian IPK luar biasa.</p>
                <div class="mt-auto pt-3 border-top">
                    <div class="d-flex align-items-center small text-muted mb-3">
                        <i class="bi bi-clock-history me-2 text-primary"></i> Batas: 30 April 2026
                    </div>
                    <div class="d-grid">
                        <a href="#" class="btn btn-register rounded-pill fw-bold shadow-sm">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 scholarship-item" data-category="Non-Akademik" data-aos="fade-up" data-aos-delay="200">
            <div class="card scholarship-card h-100 position-relative">
                <span class="card-badge bg-primary bg-opacity-10 text-primary">Internal Yarsi</span>
                <div class="icon-box shadow-sm">
                    <i class="bi bi-building-check"></i>
                </div>
                <h5 class="fw-800 mb-2">Beasiswa Yayasan Yarsi</h5>
                <p class="small text-muted mb-4">Dukungan dana pendidikan bagi mahasiswa yang aktif dalam organisasi dan pengabdian.</p>
                <div class="mt-auto pt-3 border-top">
                    <div class="d-flex align-items-center small text-muted mb-3">
                        <i class="bi bi-calendar-event me-2 text-primary"></i> Batas: 15 Mei 2026
                    </div>
                    <div class="d-grid">
                        <a href="#" class="btn btn-outline-primary rounded-pill fw-bold py-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 scholarship-item" data-category="Bantuan Dana" data-aos="fade-up" data-aos-delay="300">
            <div class="card scholarship-card h-100 position-relative opacity-75">
                <span class="card-badge bg-secondary bg-opacity-10 text-secondary">Akan Datang</span>
                <div class="icon-box shadow-sm text-secondary">
                    <i class="bi bi-wallet2"></i>
                </div>
                <h5 class="fw-800 mb-2">Bantuan KIP Kuliah</h5>
                <p class="small text-muted mb-4">Program bantuan pemerintah untuk mendukung akses pendidikan merata bagi semua.</p>
                <div class="mt-auto pt-3 border-top">
                    <div class="d-flex align-items-center small text-muted mb-3">
                        <i class="bi bi-info-circle me-2"></i> Dibuka: Juni 2026
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-light rounded-pill fw-bold py-2" disabled>Belum Tersedia</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center p-5 rounded-4 bg-white shadow-sm border" data-aos="zoom-in">
        <div class="row align-items-center">
            <div class="col-md-8 text-md-start mb-3 mb-md-0">
                <h4 class="fw-bold mb-1">Masih bingung dengan prosedurnya?</h4>
                <p class="text-muted mb-0">Pelajari langkah-langkah pendaftaran melalui panduan interaktif kami.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ url('/alur') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                    Buka Panduan <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<footer class="py-5 text-center text-muted">
    <p class="small">© 2026 Sistem Informasi Beasiswa Yarsi — Dikembangkan oleh PDSI</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });

        const filterPills = document.querySelectorAll('.filter-pill');
        const scholarshipItems = document.querySelectorAll('.scholarship-item');
        const searchInput = document.getElementById('scholarshipSearch');

        function applyFilter() {
            const activeFilter = document.querySelector('.filter-pill.active').getAttribute('data-filter');
            const searchQuery = searchInput.value.toLowerCase();

            scholarshipItems.forEach(item => {
                const category = item.getAttribute('data-category');
                const title = item.querySelector('h5').textContent.toLowerCase();
                
                const matchesFilter = (activeFilter === 'all' || category === activeFilter);
                const matchesSearch = title.includes(searchQuery);

                if (matchesFilter && matchesSearch) {
                    item.style.display = 'block';
                    // Re-trigger AOS animation
                    item.classList.add('aos-animate');
                } else {
                    item.style.display = 'none';
                    item.classList.remove('aos-animate');
                }
            });
        }

        // Click Event for Filter Pills
        filterPills.forEach(pill => {
            pill.addEventListener('click', function(e) {
                e.preventDefault();
                filterPills.forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                applyFilter();
            });
        });

        // Input Event for Search
        searchInput.addEventListener('input', applyFilter);
    });
</script>
</body>
</html>