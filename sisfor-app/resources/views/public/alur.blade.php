<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alur Pendaftaran | Sistem Informasi Beasiswa Yarsi</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0d6efd;
            --bg-soft: #f8fafc;
            --accent-color: #0dcaf0;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-soft);
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Navbar Enhancement */
        .navbar-simple {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 18px 0;
            z-index: 1000;
        }

        .logo-text {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--primary-blue);
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        /* TIMELINE CORE DESIGN */
        .timeline-container {
            position: relative;
            padding: 60px 0;
        }

        .timeline-container::before {
            content: '';
            position: absolute;
            left: 50%;
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, #e2e8f0 10%, #e2e8f0 90%, transparent);
            transform: translateX(-50%);
        }

        .timeline-item {
            display: flex;
            justify-content: flex-end;
            padding-right: 50%;
            position: relative;
            margin-bottom: 50px;
            width: 100%;
        }

        .timeline-item.right {
            justify-content: flex-start;
            padding-right: 0;
            padding-left: 50%;
        }

        /* Timeline Dot */
        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 20px;
            width: 18px;
            height: 18px;
            background: white;
            border: 4px solid var(--primary-blue);
            border-radius: 50%;
            transform: translateX(-50%);
            z-index: 10;
            box-shadow: 0 0 0 5px rgba(13, 110, 253, 0.1);
        }

        /* Card Design */
        .content-card {
            width: 90%;
            padding: 30px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.04);
            transition: var(--transition);
            position: relative;
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(13, 110, 253, 0.08);
            border-color: var(--primary-blue);
        }

        .icon-circle {
            width: 55px;
            height: 55px;
            background: var(--primary-blue);
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            box-shadow: 0 8px 15px rgba(13, 110, 253, 0.2);
        }

        .step-number {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 3rem;
            font-weight: 900;
            color: rgba(13, 110, 253, 0.05);
            line-height: 1;
        }

        .right .step-number {
            left: 30px;
            right: auto;
        }

        /* Button Custom */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #00d2ff 100%);
            border: none;
            padding: 15px 40px;
            color: white;
            font-weight: 700;
            transition: var(--transition);
        }

        .btn-premium:hover {
            transform: scale(1.05) translateY(-3px);
            box-shadow: 0 15px 30px rgba(13, 110, 253, 0.3);
            color: white;
        }

        /* Mobile Responsive Fix */
        @media (max-width: 991px) {
            .timeline-container::before { left: 30px; }
            .timeline-item, .timeline-item.right {
                justify-content: flex-start;
                padding-left: 60px;
                padding-right: 15px;
            }
            .timeline-dot { left: 30px; }
            .content-card { width: 100%; }
            .display-5 { font-size: 2.2rem; font-weight: 800; }
        }
    </style>
</head>
<body>

<nav class="navbar-simple sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ url('/') }}" class="text-decoration-none text-dark fw-bold transition-all hover-translate">
            <i class="bi bi-arrow-left-circle-fill me-2 text-primary fs-5"></i> Beranda
        </a>
        <span class="logo-text d-none d-sm-block">Sistem Informasi Beasiswa Yarsi</span>
    </div>
</nav>

<div class="container py-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3">PANDUAN MAHASISWA</span>
        <h1 class="fw-800 display-5 mb-3">Alur Pendaftaran Beasiswa</h1>
        <p class="text-muted mx-auto lead" style="max-width: 650px;">
            Ikuti 5 langkah mudah berikut untuk mengajukan bantuan pendidikan melalui sistem informasi kami.
        </p>
    </div>

    <div class="timeline-container">
        
        <div class="timeline-item" data-aos="fade-right">
            <div class="timeline-dot"></div>
            <div class="content-card">
                <div class="step-number">01</div>
                <div class="icon-circle"><i class="bi bi-shield-lock"></i></div>
                <h4 class="fw-bold">Otentikasi LDAP & SSO</h4>
                <p class="text-muted mb-0">Masuk dengan akun universitas Anda. Sistem akan otomatis mensinkronkan data profil dan IPK terbaru Anda dari basis data akademik.</p>
            </div>
        </div>

        <div class="timeline-item right" data-aos="fade-left">
            <div class="timeline-dot"></div>
            <div class="content-card">
                <div class="step-number">02</div>
                <div class="icon-circle" style="background: var(--accent-color);"><i class="bi bi-search"></i></div>
                <h4 class="fw-bold">Pilih Program Beasiswa</h4>
                <p class="text-muted mb-0">Cari dan pilih kategori beasiswa (Akademik, Non-Akademik, atau Bantuan Dana) yang paling sesuai dengan profil Anda.</p>
            </div>
        </div>

        <div class="timeline-item" data-aos="fade-right">
            <div class="timeline-dot"></div>
            <div class="content-card">
                <div class="step-number">03</div>
                <div class="icon-circle" style="background: #6f42c1;"><i class="bi bi-file-earmark-text"></i></div>
                <h4 class="fw-bold">Lengkapi Berkas</h4>
                <p class="text-muted mb-0">Isi formulir pendaftaran dan unggah dokumen pendukung (KTM, Transkrip, Sertifikat) dalam format digital yang diminta.</p>
            </div>
        </div>

        <div class="timeline-item right" data-aos="fade-left">
            <div class="timeline-dot"></div>
            <div class="content-card">
                <div class="step-number">04</div>
                <div class="icon-circle" style="background: #20c997;"><i class="bi bi-person-check"></i></div>
                <h4 class="fw-bold">Verifikasi & Validasi</h4>
                <p class="text-muted mb-0">Admin program akan memeriksa keaslian berkas. Anda dapat memantau status "Diproses" atau "Perlu Perbaikan" melalui dashboard.</p>
            </div>
        </div>

        <div class="timeline-item" data-aos="fade-right">
            <div class="timeline-dot"></div>
            <div class="content-card">
                <div class="step-number">05</div>
                <div class="icon-circle" style="background: #fd7e14;"><i class="bi bi-trophy"></i></div>
                <h4 class="fw-bold">Pengumuman Final</h4>
                <p class="text-muted mb-0">Dapatkan notifikasi kelulusan secara langsung. Dana beasiswa akan dikreditkan otomatis untuk pengurangan biaya semester Anda.</p>
            </div>
        </div>

    </div>

    <div class="mt-5 text-center" data-aos="zoom-in">
        <div class="p-5 bg-white rounded-5 shadow-sm border overflow-hidden position-relative">
            <div class="position-absolute top-0 end-0 p-4 opacity-10">
                <i class="bi bi-mortarboard-fill display-1 text-primary"></i>
            </div>
            <h3 class="fw-bold mb-3">Siap Memulai Masa Depan?</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">Gunakan akun mahasiswa aktif Anda untuk mengakses seluruh fitur pendaftaran.</p>
            <a href="{{ url('/beasiswa') }}" class="btn btn-premium rounded-pill shadow">
                Mulai Pendaftaran <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<footer class="py-5 text-center text-muted border-top bg-white mt-5">
    <p class="small mb-0">© 2026 <b>Sistem Informasi Beasiswa Yarsi</b> — Developed by FTI</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ 
            duration: 1000, 
            once: true,
            offset: 100
        });
    });
</script>

</body>
</html>