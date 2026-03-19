<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Beasiswa | Universitas Yarsi</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            --yarsi-blue: #0d6efd;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            transition: background 0.4s ease, color 0.4s ease;
        }

        body.light { background: #f8fafc; color: #1e293b; }
        body.dark { background: #020617; color: #f1f5f9; }

        /* NAVBAR ENHANCEMENT */
        .navbar {
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.2rem 0;
            background: rgba(255, 255, 255, 0.85);
            z-index: 1050;
        }
        body.dark .navbar { background: rgba(2, 6, 23, 0.85); border-color: rgba(255,255,255,0.05); }

        .nav-link-custom {
            color: #64748b;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
        }
        .nav-link-custom:hover, .nav-link-custom.active { color: var(--yarsi-blue); }
        body.dark .nav-link-custom { color: #94a3b8; }

        /* HERO SECTION */
        .hero-card {
            border-radius: 40px;
            padding: 80px 60px;
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 25px 50px -12px rgba(13, 110, 253, 0.25);
            overflow: hidden;
            position: relative;
        }

        /* CARD PREMIUM */
        .card-premium {
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: 24px;
            padding: 40px 30px;
            transition: var(--transition);
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        body.dark .card-premium { background: #0f172a; border-color: rgba(255,255,255,0.05); }
        .card-premium:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: var(--yarsi-blue);
        }

        .btn-premium {
            background: var(--primary-gradient);
            border: none;
            color: white !important;
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 700;
            transition: var(--transition);
        }
        .btn-premium:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
        }

        /* STEP BADGE */
        .step-icon {
            width: 50px;
            height: 50px;
            background: rgba(13, 110, 253, 0.1);
            color: var(--yarsi-blue);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-weight: 800;
            font-size: 1.2rem;
            transition: var(--transition);
        }
        .card-step:hover .step-icon {
            background: var(--yarsi-blue);
            color: white;
        }

        /* ANIMATIONS */
        .skeleton-box {
            background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            height: 200px;
            border-radius: 20px;
        }
        @keyframes loading { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        .section-title { font-weight: 800; letter-spacing: -1px; margin-bottom: 2.5rem; }
    </style>
</head>

<body class="light">

<nav class="navbar sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}" style="color: var(--yarsi-blue); font-size: 1.4rem;">
            <i class="bi bi-mortarboard-fill me-2"></i> SISFOR YARSI
        </a>

        <div class="d-none d-lg-flex gap-4">
            <a href="{{ url('/beasiswa') }}" class="nav-link-custom">Beasiswa</a>
            <a href="{{ url('/alur') }}" class="nav-link-custom">Alur Pendaftaran</a>
            <a href="{{ route('public.bantuan') }}" class="nav-link-custom">Pusat Bantuan</a>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button onclick="toggleDarkMode()" class="btn btn-link text-secondary p-0 me-2 shadow-none">
                <i id="iconMode" class="bi bi-moon-stars-fill fs-5"></i>
            </button>
            <a href="{{ route('login') }}" class="btn btn-premium px-4 rounded-pill shadow-sm">
                Masuk <i class="bi bi-box-arrow-in-right ms-2"></i>
            </a>
        </div>
    </div>
</nav>

<main class="container py-5">

    <section class="hero-card mb-5" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-3">#MasaDepanYarsi</span>
                <h1 class="display-5 fw-800 mb-3 text-white">Sistem Informasi Beasiswa Universitas Yarsi</h1>
                <p class="lead opacity-90 mb-4 text-white">Kelola pendaftaran beasiswa Anda secara cerdas dengan integrasi data akademik yang otomatis dan transparan.</p>
                <div class="d-flex gap-3">
                    <a href="{{ url('/beasiswa') }}" class="btn btn-light btn-lg px-4 fw-bold text-primary rounded-pill transition-all">
                        Cari Beasiswa
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center position-relative">
                <img src="https://img.freepik.com/free-vector/graduation-concept-illustration_114360-1205.jpg" class="img-fluid rounded-4 shadow-lg" style="max-height: 350px; transform: rotate(2deg);">
            </div>
        </div>
    </section>

    <section class="py-5" data-aos="fade-up">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <img src="https://img.freepik.com/free-vector/university-concept-illustration_114360-1203.jpg" class="img-fluid rounded-5 shadow-sm">
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <h2 class="section-title">Tentang Beasiswa Yarsi</h2>
                <p class="text-muted fs-5 mb-4">
                    Komitmen kami adalah memastikan setiap mahasiswa berprestasi dan yang membutuhkan mendapatkan kesempatan pendidikan terbaik melalui dukungan finansial yang tepat sasaran.
                </p>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 border rounded-4 bg-white bg-opacity-50">
                            <i class="bi bi-fingerprint text-primary fs-3 mb-2"></i>
                            <h6 class="fw-bold">Login LDAP/SSO</h6>
                            <p class="small text-muted mb-0">Keamanan data terjamin dengan akun resmi.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 border rounded-4 bg-white bg-opacity-50">
                            <i class="bi bi-lightning-charge text-primary fs-3 mb-2"></i>
                            <h6 class="fw-bold">Sinkronisasi IPK</h6>
                            <p class="small text-muted mb-0">Data akademik ditarik otomatis dari sistem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="skeleton" class="row g-4 mb-5">
        <div class="col-md-4"><div class="skeleton-box"></div></div>
        <div class="col-md-4"><div class="skeleton-box"></div></div>
        <div class="col-md-4"><div class="skeleton-box"></div></div>
    </div>

    <section id="content" style="display:none;" class="py-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Program Unggulan</h2>
            <p class="text-muted">Pilih kategori beasiswa yang sesuai dengan kualifikasi Anda.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-premium text-center">
                    <div class="fs-1 mb-3">🏆</div>
                    <h4 class="fw-bold">Prestasi Akademik</h4>
                    <p class="text-muted small px-3">Potongan biaya kuliah hingga 50% bagi mahasiswa dengan pencapaian IPK luar biasa.</p>
                    <a href="{{ url('/beasiswa') }}" class="btn btn-outline-primary rounded-pill mt-auto">Lihat Detail</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-premium text-center">
                    <div class="fs-1 mb-3">🎓</div>
                    <h4 class="fw-bold">Beasiswa KIP-K</h4>
                    <p class="text-muted small px-3">Bantuan biaya pendidikan dari pemerintah bagi mahasiswa yang memiliki keterbatasan ekonomi.</p>
                    <a href="{{ url('/beasiswa') }}" class="btn btn-outline-primary rounded-pill mt-auto">Lihat Detail</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-premium text-center">
                    <div class="fs-1 mb-3">📖</div>
                    <h4 class="fw-bold">Beasiswa Tahfidz</h4>
                    <p class="text-muted small px-3">Apresiasi khusus bagi penghafal Al-Qur'an sebagai bagian dari nilai Islami Yarsi.</p>
                    <a href="{{ url('/beasiswa') }}" class="btn btn-outline-primary rounded-pill mt-auto">Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-primary bg-opacity-5 rounded-5 p-4 p-md-5">
        <h2 class="section-title text-center mb-5">Langkah Pendaftaran</h2>
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card-step text-center">
                    <div class="step-icon shadow-sm">1</div>
                    <h6 class="fw-bold">Login SSO</h6>
                    <p class="small text-muted">Masuk dengan akun mahasiswa aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-step text-center">
                    <div class="step-icon shadow-sm">2</div>
                    <h6 class="fw-bold">Pilih Program</h6>
                    <p class="small text-muted">Sesuaikan dengan kriteria prestasi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-step text-center">
                    <div class="step-icon shadow-sm">3</div>
                    <h6 class="fw-bold">Upload Berkas</h6>
                    <p class="small text-muted">Unggah sertifikat dan dokumen asli</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-step text-center">
                    <div class="step-icon shadow-sm">4</div>
                    <h6 class="fw-bold">Hasil Seleksi</h6>
                    <p class="small text-muted">Pantau status via dashboard</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/alur') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">
                Panduan Lengkap <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

</main>

<footer class="py-5 border-top text-center text-muted mt-5 bg-white bg-opacity-50">
    <div class="container">
        <div class="mb-3">
            <i class="bi bi-mortarboard-fill fs-2 text-primary"></i>
        </div>
        <p class="mb-1 fw-bold text-dark">© 2026 Sistem Informasi Beasiswa Yarsi</p>
        <p class="small mb-0">Pusat Data dan Informasi Universitas Yarsi</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({ duration: 800, once: true });

    function toggleDarkMode() {
        let body = document.body;
        let icon = document.getElementById("iconMode");
        body.classList.toggle("dark");
        body.classList.toggle("light");

        if (body.classList.contains("dark")) {
            icon.classList.replace("bi-moon-stars-fill", "bi-sun-fill");
            localStorage.setItem("theme", "dark");
        } else {
            icon.classList.replace("bi-sun-fill", "bi-moon-stars-fill");
            localStorage.setItem("theme", "light");
        }
    }

    window.onload = () => {
        if(localStorage.getItem("theme") === "dark") {
            document.body.classList.replace("light", "dark");
            document.getElementById("iconMode").classList.replace("bi-moon-stars-fill", "bi-sun-fill");
        }
        
        setTimeout(() => {
            document.getElementById("skeleton").style.display = "none";
            document.getElementById("content").style.display = "block";
            AOS.refresh();
        }, 800);
    }
</script>

</body>
</html>