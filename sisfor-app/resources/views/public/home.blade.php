<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Beasiswa Yarsi</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
body { font-family: 'Inter'; transition: 0.3s; }
body.light { background:#f8fafc; color:#0f172a; }
body.dark { background:#020617; color:#e2e8f0; }

/* NAVBAR */
.navbar { backdrop-filter: blur(12px); }
body.light .navbar { background: rgba(255,255,255,0.8); }
body.dark .navbar { background: rgba(2,6,23,0.8); }

/* HERO */
.hero {
    border-radius: 28px;
    padding: 80px 60px;
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    color: white;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}

/* SECTION SPACING */
section { margin-bottom: 100px; }

/* CARD */
.card-premium {
    border-radius: 20px;
    padding: 30px;
    transition: all 0.3s ease;
    height: 100%;
}
body.light .card-premium { background:white; }
body.dark .card-premium { background:#0f172a; }

.card-premium:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

/* BUTTON */
.btn-premium {
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    border: none;
    color: white;
    border-radius: 10px;
}

/* FLOW STEP */
.step {
    padding: 25px;
    border-radius: 15px;
    font-weight: 600;
}
body.light .step { background:white; }
body.dark .step { background:#0f172a; }

/* SKELETON */
.skeleton {
    height:120px;
    border-radius:10px;
    background:#e2e8f0;
    position:relative;
    overflow:hidden;
}
body.dark .skeleton { background:#1e293b; }

.skeleton::after {
    content:"";
    position:absolute;
    width:200px;
    height:100%;
    left:-200px;
    background:linear-gradient(90deg,transparent,rgba(255,255,255,0.4),transparent);
    animation: shimmer 1.2s infinite;
}
@keyframes shimmer { 100%{ left:100%; } }

/* TITLE */
.section-title {
    font-weight:800;
    margin-bottom:40px;
}

/* TESTIMONI */
.testimoni {
    font-style: italic;
    opacity:0.8;
}

/* FOOTER */
footer {
    border-top:1px solid rgba(0,0,0,0.1);
}
</style>
</head>

<body class="light">

<!-- NAVBAR -->
<nav class="navbar sticky-top py-3">
<div class="container">
    <a class="fw-bold text-primary">🎓 SI BEASISWA</a>

    <div class="d-flex gap-2">
        <button onclick="toggleDarkMode()" class="btn btn-outline-secondary">
            <i id="iconMode" class="bi bi-moon"></i>
        </button>
        <a href="/login" class="btn btn-outline-primary">Masuk</a>
        <a href="#" class="btn btn-premium">Daftar</a>
    </div>
</div>
</nav>

<div class="container py-5">

<!-- HERO -->
<div class="hero mb-5" data-aos="fade-up">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="fw-bold mb-3">Raih Masa Depan Cerah 🚀</h1>
            <p class="mb-4">Platform beasiswa modern untuk mahasiswa Indonesia.</p>
            <button class="btn btn-light">Mulai Sekarang</button>
        </div>
    </div>
</div>

<!-- PROFIL -->
<section data-aos="fade-up">
<div class="row align-items-center">
    <div class="col-lg-6">
        <h3 class="section-title">Tentang Kampus</h3>
        <p class="text-muted">
            Universitas Yarsi menyediakan pendidikan berkualitas dengan berbagai program beasiswa unggulan.
        </p>
    </div>
    <div class="col-lg-6 text-center">
        <img src="https://img.freepik.com/free-vector/university-concept-illustration_114360-1203.jpg" class="img-fluid rounded-4">
    </div>
</div>
</section>

<!-- SKELETON -->
<div id="skeleton" class="row g-4">
    <div class="col-md-4"><div class="card-premium"><div class="skeleton"></div></div></div>
    <div class="col-md-4"><div class="card-premium"><div class="skeleton"></div></div></div>
    <div class="col-md-4"><div class="card-premium"><div class="skeleton"></div></div></div>
</div>

<!-- BEASISWA -->
<section id="content" style="display:none;">
<h3 class="section-title text-center">Program Beasiswa</h3>

<div class="row g-4 justify-content-center">

    <div class="col-md-4">
        <div class="card-premium text-center">
            <h5 class="mb-3">Prestasi</h5>
            <button class="btn btn-premium btn-sm">Daftar</button>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-premium text-center">
            <h5 class="mb-3">KIP-K</h5>
            <button class="btn btn-premium btn-sm">Daftar</button>
        </div>
    </div>

</div>
</section>

<!-- ALUR -->
<section class="text-center">
<h3 class="section-title">Alur Pendaftaran</h3>

<div class="row g-4">
    <div class="col-md-3"><div class="step">1. Daftar</div></div>
    <div class="col-md-3"><div class="step">2. Isi Data</div></div>
    <div class="col-md-3"><div class="step">3. Upload</div></div>
    <div class="col-md-3"><div class="step">4. Seleksi</div></div>
</div>
</section>

<!-- FAQ -->
<section>
<h3 class="section-title text-center">FAQ</h3>

<div class="accordion">
    <div class="accordion-item">
        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq1">
            Siapa bisa daftar?
        </button>
        <div id="faq1" class="accordion-collapse collapse show">
            <div class="accordion-body">Mahasiswa aktif.</div>
        </div>
    </div>
</div>
</section>

<!-- TESTIMONI -->
<section class="text-center">
<h3 class="section-title">Testimoni</h3>
<p class="testimoni">"Beasiswa ini membantu saya mencapai mimpi!"</p>
</section>

<!-- SLIDER -->
<section class="text-center">
<h3 class="section-title">Prestasi Mahasiswa</h3>

<div id="slider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <h2>🏆 Juara Nasional</h2>
        </div>
        <div class="carousel-item">
            <h2>🌍 Publikasi Internasional</h2>
        </div>
    </div>
</div>
</section>

</div>

<footer class="text-center py-4">
© 2026 Beasiswa Yarsi
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init();

function toggleDarkMode() {
    let body = document.body;
    let icon = document.getElementById("iconMode");

    body.classList.toggle("dark");
    body.classList.toggle("light");

    if (body.classList.contains("dark")) {
        icon.classList.replace("bi-moon","bi-sun");
        localStorage.setItem("theme","dark");
    } else {
        icon.classList.replace("bi-sun","bi-moon");
        localStorage.setItem("theme","light");
    }
}

window.onload = () => {
    if(localStorage.getItem("theme")==="dark"){
        document.body.classList.replace("light","dark");
        document.getElementById("iconMode").classList.replace("bi-moon","bi-sun");
    }

    setTimeout(()=>{
        document.getElementById("skeleton").style.display="none";
        document.getElementById("content").style.display="block";
    },1200);
}
</script>

</body>
</html>