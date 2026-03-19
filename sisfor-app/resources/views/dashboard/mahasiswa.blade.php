<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yarsi Hub | Student Ultra Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --bg-app: #f8fafc;
            --bg-card: #ffffff;
            --sidebar-bg: #0f172a;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: rgba(0, 0, 0, 0.05);
        }

        [data-theme="dark"] {
            --bg-app: #020617;
            --bg-card: #0f172a;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            transition: all 0.3s ease;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .nav-link {
            color: #94a3b8 !important;
            padding: 14px 20px;
            margin: 4px 20px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff !important;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: white !important;
            box-shadow: 0 10px 20px -5px var(--primary-glow);
        }

        /* --- CONTENT AREA --- */
        .main-content {
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
        }

        .glass-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 10px 30px -5px rgba(0,0,0,0.03);
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* --- PREMIUM DROPDOWN --- */
        .profile-dropdown {
            position: relative;
            cursor: pointer;
        }

        .dropdown-menu-premium {
            position: absolute;
            right: 0;
            top: calc(100% + 15px);
            width: 260px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            list-style: none;
            padding: 12px;
            display: none;
            z-index: 2000;
            backdrop-filter: blur(15px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            animation: slideUp 0.3s ease;
        }

        .dropdown-menu-premium.show { display: block; }

        .dropdown-item-premium {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 12px;
            transition: 0.2s;
        }

        .dropdown-item-premium:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .dropdown-item-premium.logout-btn {
            color: #ef4444;
            margin-top: 8px;
            border-top: 1px solid var(--border);
            border-radius: 0 0 12px 12px;
        }

        .dropdown-item-premium.logout-btn:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- HERO BANNER --- */
        .hero-banner {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            background-size: 200% 200%;
            animation: moveGradient 8s ease infinite;
            border-radius: 30px;
            padding: 40px;
            color: white;
        }

        @keyframes moveGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .theme-toggle {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; padding: 20px; }
            .sidebar.active { transform: translateX(0); }
        }
    </style>
</head>
<body data-theme="light">

    <aside class="sidebar shadow-lg" id="sidebar">
        <div class="p-4 mb-4 mt-2">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary p-2 rounded-3 text-white shadow"><i class="bi bi-layers-half fs-4"></i></div>
                <h5 class="fw-800 text-white mb-0" style="letter-spacing: 1px;">YARSI HUB</h5>
            </div>
        </div>
        
        <div class="flex-grow-1">
            <p class="text-uppercase text-secondary fw-bold mb-3 ms-4" style="font-size: 0.65rem; letter-spacing: 1.5px; opacity: 0.5;">Main Menu</p>
            <nav class="nav flex-column">
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
                <a href="{{ route('mahasiswa.beasiswa') }}" class="nav-link {{ request()->routeIs('mahasiswa.beasiswa') ? 'active' : '' }}">
                    <i class="bi bi-rocket-takeoff"></i> List Beasiswa
                </a>
                <a href="{{ route('mahasiswa.pendaftaran.riwayat') }}" class="nav-link {{ request()->routeIs('mahasiswa.pendaftaran.riwayat') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i> Pengajuan Saya
                </a>
                <a href="#" class="nav-link"><i class="bi bi-chat-left-dots"></i> Notifikasi</a>
            </nav>
        </div>
    </aside>

    <main class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-800 mb-1">{{ request()->routeIs('mahasiswa.dashboard') ? 'Dashboard' : 'Detail Layanan' }}</h2>
                <p class="text-muted small">{{ date('l, d F Y') }}</p>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="theme-toggle shadow-sm" onclick="toggleTheme()">
                    <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                </div>
                
                <div class="profile-dropdown" id="profileTrigger">
                    <div class="glass-card py-2 px-3 d-flex align-items-center gap-3">
                        <div class="text-end d-none d-md-block">
                            <span class="d-block fw-bold small text-truncate" style="max-width: 150px;">{{ Auth::user()->name }}</span>
                            <span class="text-muted" style="font-size: 0.7rem;">{{ Auth::user()->mahasiswa->prodi->nama_prodi ?? 'Informatika' }} • {{ Auth::user()->mahasiswa->nim ?? 'N/A' }}</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff" class="rounded-circle shadow-sm" width="42">
                        <i class="bi bi-chevron-down small text-muted"></i>
                    </div>

                    <ul class="dropdown-menu-premium shadow-lg" id="profileMenu">
                        <li><a href="#" class="dropdown-item-premium"><i class="bi bi-person-circle"></i> Detail Profil</a></li>
                        <li>
                            <a href="#" class="dropdown-item-premium logout-btn" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Keluar / Logout
                            </a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        {{-- BAGIAN INI HANYA MUNCUL DI DASHBOARD UTAMA --}}
        @if(request()->routeIs('mahasiswa.dashboard'))
            <div class="hero-banner shadow-lg mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-2 mb-3">Sistem Informasi Beasiswa</span>
                        <h1 class="fw-800 mb-3">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                        <p class="opacity-75 mb-4">Pantau terus status pengajuan beasiswa Anda di Universitas YARSI melalui dashboard ini.</p>
                        <a href="{{ route('mahasiswa.beasiswa') }}" class="btn btn-light rounded-pill px-4 fw-bold text-primary shadow-sm">Lihat Beasiswa</a>
                    </div>
                    <div class="col-lg-5 text-center d-none d-lg-block">
                        <div class="display-3 fw-800">100%</div>
                        <p class="small opacity-75">Keamanan SSO Terjamin</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="glass-card h-100">
                        <p class="text-muted small fw-bold mb-1">BEASISWA TERSEDIA</p>
                        <h2 class="fw-800 mb-0">{{ $countBeasiswa ?? 0 }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card h-100 border-primary border-opacity-25">
                        <p class="text-muted small fw-bold mb-1">PENGAJUAN SAYA</p>
                        <h2 class="fw-800 mb-0">{{ $countPengajuan ?? 0 }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card h-100">
                        <p class="text-muted small fw-bold mb-1">STATUS TERAKHIR</p>
                        <h2 class="fw-800 mb-0" style="font-size: 1.2rem;">
                            @if(($lastStatus ?? '') == 'diterima')
                                <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Diterima</span>
                            @elseif(($lastStatus ?? '') == 'pending')
                                <span class="text-warning"><i class="bi bi-clock-history me-1"></i> Menunggu</span>
                            @else
                                <span class="text-muted small">Belum ada data</span>
                            @endif
                        </h2>
                    </div>
                </div>
            </div>

            <div class="glass-card mb-5">
                <h5 class="fw-800 mb-4">Tren Pendaftaran Beasiswa</h5>
                <div style="height: 300px;">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        @endif

        {{-- TEMPAT ISI HALAMAN LAIN (RIWAYAT, LIST, DLL) --}}
        @yield('content')
        
    </main>

    <script>
        // --- DROPDOWN LOGIC ---
        const profileTrigger = document.getElementById('profileTrigger');
        const profileMenu = document.getElementById('profileMenu');

        if (profileTrigger) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileMenu.classList.toggle('show');
            });
        }

        window.addEventListener('click', () => {
            profileMenu.classList.remove('show');
        });

        // --- THEME TOGGLE ---
        function toggleTheme() {
            const body = document.body;
            const icon = document.getElementById('themeIcon');
            const isDark = body.getAttribute('data-theme') === 'dark';
            body.setAttribute('data-theme', isDark ? 'light' : 'dark');
            icon.className = isDark ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
            if (typeof updateChart === "function") updateChart(!isDark);
        }

        // --- CHART JS ---
        const chartElement = document.getElementById('mainChart');
        if (chartElement) {
            const ctx = chartElement.getContext('2d');
            let chart;
            function initChart(isDark) {
                if (chart) chart.destroy();
                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar']) !!},
                        datasets: [{
                            label: 'Total Pendaftar',
                            data: {!! json_encode($chartData ?? [0, 0, 0]) !!},
                            borderColor: '#6366f1',
                            borderWidth: 4,
                            tension: 0.4,
                            fill: true,
                            backgroundColor: isDark ? 'rgba(99, 102, 241, 0.05)' : 'rgba(99, 102, 241, 0.1)',
                            pointRadius: 4,
                            pointBackgroundColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { 
                                grid: { color: isDark ? 'rgba(255,255,255,0.05)' : '#f1f5f9' },
                                ticks: { color: isDark ? '#94a3b8' : '#64748b', stepSize: 1 }
                            },
                            x: { grid: { display: false }, ticks: { color: isDark ? '#94a3b8' : '#64748b' } }
                        }
                    }
                });
            }
            window.updateChart = function(isDark) { initChart(isDark); }
            initChart(false);
        }
    </script>
</body>
</html>