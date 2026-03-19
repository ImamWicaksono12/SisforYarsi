<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pusat Bantuan | SISFOR YARSI</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            --yarsi-blue: #0d6efd;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #1e293b; }
        
        .navbar { backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.8); border-bottom: 1px solid rgba(0,0,0,0.05); }

        .card-help {
            border: none;
            border-radius: 24px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .accordion-item { border: none; margin-bottom: 10px; border-radius: 15px !important; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .accordion-button:not(.collapsed) { background-color: rgba(13, 110, 253, 0.05); color: var(--yarsi-blue); }
        .accordion-button:focus { box-shadow: none; }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .btn-premium {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-premium:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2); color: white; }
    </style>
</head>
<body>

<nav class="navbar sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}" style="color: var(--yarsi-blue);">
            <i class="bi bi-arrow-left-circle-fill me-2"></i> Kembali ke Beranda
        </a>
        <span class="fw-bold text-muted small">PUSAT BANTUAN SISFOR</span>
    </div>
</nav>

<main class="container py-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <h6 class="text-primary fw-bold text-uppercase tracking-widest">Ada Pertanyaan?</h6>
        <h2 class="display-6 fw-800 mb-3">Kami Siap Membantu Anda</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">
            Cari jawaban instan melalui FAQ kami atau hubungi tim teknis jika Anda mengalami kendala saat proses pendaftaran.
        </p>
    </div>

    <div class="row g-5">
        <div class="col-lg-7" data-aos="fade-right">
            <h4 class="fw-bold mb-4"><i class="bi bi-chat-left-dots-fill me-2 text-primary"></i> Pertanyaan Umum (FAQ)</h4>
            <div class="accordion" id="helpAccordion">
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Bagaimana cara masuk ke Sistem Beasiswa?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                        <div class="accordion-body text-muted">
                            Anda cukup menggunakan akun <strong>LDAP / Single Sign-On (SSO)</strong> resmi mahasiswa Universitas Yarsi. Tidak perlu mendaftar akun baru.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Mengapa IPK saya tidak muncul otomatis?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body text-muted">
                            Sistem melakukan sinkronisasi data secara otomatis dengan basis data akademik saat Anda login. Jika data belum muncul, pastikan status akademik Anda aktif atau hubungi bagian administrasi prodi.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Siapa yang memberikan validasi akhir pendaftaran?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body text-muted">
                            Sesuai alur terbaru, validasi langsung dilakukan oleh <strong>Admin</strong> setelah melewati verifikasi berkas awal.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-5" data-aos="fade-left">
            <div class="card-help p-4 mb-4">
                <div class="contact-icon"><i class="bi bi-envelope-heart"></i></div>
                <h5 class="fw-bold">Kontak Dukungan Teknis</h5>
                <p class="text-muted small">Hubungi kami melalui email resmi jika terjadi kendala teknis pada sistem pendaftaran.</p>
                <hr class="my-4 opacity-50">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-envelope text-primary me-3 fs-5"></i>
                    <div>
                        <div class="fw-bold">Email Resmi</div>
                        <div class="text-muted">FTI@yarsi.ac.id</div>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <i class="bi bi-geo-alt text-primary me-3 fs-5"></i>
                    <div>
                        <div class="fw-bold">Lokasi</div>
                        <div class="text-muted">Gedung Utama Lt. 5, Univ. Yarsi</div>
                    </div>
                </div>
                <a href="mailto:pdsi@yarsi.ac.id" class="btn btn-premium w-100 shadow-sm">Kirim Pesan Sekarang</a>
            </div>

            <div class="card-help p-4 bg-primary text-white" style="background: var(--primary-gradient) !important;">
                <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-2"></i> Jam Operasional</h6>
                <p class="small mb-0 opacity-90">Senin - Jumat: 08:00 - 16:00 WIB<br>Sabtu & Minggu: Libur</p>
            </div>
        </div>
    </div>
</main>

<footer class="py-5 text-center text-muted border-top mt-5">
    <p class="small">© 2026 Pusat Data dan Informasi Universitas Yarsi</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ duration: 800, once: true });</script>

</body>
</html>