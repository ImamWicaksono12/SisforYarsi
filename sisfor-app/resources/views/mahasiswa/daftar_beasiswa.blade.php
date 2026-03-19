<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="main-content-wrapper py-5">
    <div class="container animate-in">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8 d-flex align-items-center gap-3">
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-back-yarsi shadow-sm" title="Kembali ke Dashboard">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="fw-800 text-dark mb-1">Program Beasiswa</h2>
                    <p class="text-muted opacity-75 mb-0">Temukan berbagai peluang beasiswa unggulan di Universitas YARSI.</p>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="info-badge-wrapper">
                    <span class="badge-custom">
                        <i class="fas fa-layer-group me-2"></i> {{ $data->count() }} Program Tersedia
                    </span>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="filter-glass-wrapper p-3 d-flex flex-wrap gap-3 align-items-center">
                    <div class="search-container flex-grow-1">
                        <div class="input-group-yarsi">
                            <i class="fas fa-search icon-search"></i>
                            <input type="text" id="scholarshipSearch" class="form-control-yarsi" placeholder="Cari nama beasiswa...">
                        </div>
                    </div>
                    <div class="filter-buttons d-flex gap-2">
                        <button class="btn-filter active" data-filter="all">Semua</button>
                        <button class="btn-filter" data-filter="prestasi">Prestasi</button>
                        <button class="btn-filter" data-filter="bantuan">Bantuan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4" id="scholarshipGrid">
            @forelse($data as $d)
            <div class="col-md-6 col-lg-4 scholarship-item">
                <div class="card h-100 scholarship-card-yarsi border-0 shadow-sm">
                    <div class="card-body p-4 d-flex flex-column">
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="status-pill green">
                                <span class="dot pulse"></span> Terbuka
                            </span>
                            <div class="icon-circle">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>

                        <h5 class="scholarship-title mb-3">{{ $d->nama }}</h5>
                        
                        <p class="scholarship-desc mb-4 flex-grow-1">
                            {{ \Str::limit($d->deskripsi, 140, '...') }}
                        </p>

                        <div class="scholarship-meta mb-4">
                            <div class="d-flex align-items-center text-muted small mb-2">
                                <i class="far fa-calendar-alt me-2"></i>
                                <span>Batas Pendaftaran: <strong>{{ \Carbon\Carbon::parse($d->tanggal_akhir)->format('d M Y') }}</strong></span>
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="fas fa-university me-2"></i>
                                <span>Program Studi: <strong>Semua Prodi</strong></span>
                            </div>
                        </div>

                        <div class="d-grid">
                            {{-- FINAL FIX: Nama route disesuaikan dengan web.php --}}
                            <a href="{{ route('mahasiswa.pendaftaran.form', $d->id) }}" class="btn btn-yarsi-primary py-2-5 fw-bold">
                                Daftar Sekarang <i class="fas fa-arrow-right ms-2 small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="empty-state-card p-5">
                    <img src="https://illustrations.popsy.co/gray/box.svg" alt="Empty" class="mb-4" style="width: 150px;">
                    <h5 class="text-dark fw-bold">Belum Ada Program Aktif</h5>
                    <p class="text-muted">Maaf, saat ini tidak ada beasiswa yang dapat didaftar.</p>
                </div>
            </div>
            @endforelse
            
            <div id="no-result" class="col-12 text-center py-5 d-none">
                <div class="empty-state-card p-5 border-0">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-dark fw-bold">Beasiswa tidak ditemukan</h5>
                    <p class="text-muted">Coba gunakan kata kunci lain.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Global & Root */
    :root {
        --yarsi-purple: #814efc; 
        --yarsi-dark: #1e293b;
        --bg-light: #f8fafc;
    }

    .main-content-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: var(--bg-light);
        min-height: 100vh;
    }

    .fw-800 { font-weight: 800; }

    /* Filter Wrapper */
    .filter-glass-wrapper {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.04);
    }

    .input-group-yarsi {
        position: relative;
        display: flex;
        align-items: center;
    }

    .icon-search {
        position: absolute;
        left: 18px;
        color: #94a3b8;
    }

    .form-control-yarsi {
        width: 100%;
        padding: 12px 20px 12px 48px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        background: var(--bg-light);
        transition: 0.3s;
        font-size: 0.95rem;
    }

    .form-control-yarsi:focus {
        outline: none;
        border-color: var(--yarsi-purple);
        background: white;
        box-shadow: 0 0 0 4px rgba(129, 78, 252, 0.1);
    }

    .btn-filter {
        padding: 10px 22px;
        border-radius: 14px;
        border: 1px solid transparent;
        background: var(--bg-light);
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .btn-filter:hover { background: #f1f5f9; color: var(--yarsi-dark); }
    .btn-filter.active { background: var(--yarsi-purple); color: white; box-shadow: 0 8px 15px rgba(129, 78, 252, 0.2); }

    /* Button Back */
    .btn-back-yarsi {
        width: 45px; height: 45px; background: white; border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        color: var(--yarsi-purple); text-decoration: none; transition: all 0.3s ease;
        border: 1px solid rgba(129, 78, 252, 0.1);
    }

    .btn-back-yarsi:hover { background: var(--yarsi-purple); color: white; transform: translateX(-5px); }

    /* Scholarship Cards */
    .scholarship-card-yarsi {
        border-radius: 28px !important;
        background: white;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.02) !important;
    }

    .scholarship-card-yarsi:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px -15px rgba(129, 78, 252, 0.15) !important;
    }

    .scholarship-title { font-weight: 800; color: var(--yarsi-dark); line-height: 1.4; }
    .scholarship-desc { color: #64748b; font-size: 0.92rem; line-height: 1.6; }

    /* Components */
    .icon-circle {
        width: 45px; height: 45px; background: rgba(129, 78, 252, 0.08);
        color: var(--yarsi-purple); border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
    }

    .status-pill {
        padding: 6px 14px; border-radius: 100px; font-size: 0.7rem; font-weight: 800;
        text-transform: uppercase; display: inline-flex; align-items: center;
    }

    .status-pill.green { background: #dcfce7; color: #15803d; }

    .btn-yarsi-primary {
        background: var(--yarsi-purple) !important; color: white !important;
        border: none !important; border-radius: 16px !important;
        box-shadow: 0 8px 20px rgba(129, 78, 252, 0.25);
    }

    .animate-in { animation: fadeInUp 0.8s ease-out forwards; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .pulse {
        width: 8px; height: 8px; background: #22c55e; border-radius: 50%;
        margin-right: 8px; animation: pulse-animation 2s infinite;
    }

    @keyframes pulse-animation {
        0% { transform: scale(0.95); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.5; }
        100% { transform: scale(0.95); opacity: 1; }
    }

    .badge-custom {
        background: white; padding: 10px 20px; border-radius: 100px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05); color: var(--yarsi-purple);
        font-weight: 700; font-size: 0.85rem; border: 1px solid rgba(129, 78, 252, 0.1);
    }

    .py-2-5 { padding-top: 0.85rem; padding-bottom: 0.85rem; }
    .empty-state-card { background: white; border-radius: 30px; border: 2px dashed #e2e8f0; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('scholarshipSearch');
        const items = document.querySelectorAll('.scholarship-item');
        const filterBtns = document.querySelectorAll('.btn-filter');
        const noResult = document.getElementById('no-result');

        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeFilter = document.querySelector('.btn-filter.active').getAttribute('data-filter');
            let visibleCount = 0;

            items.forEach(item => {
                const title = item.querySelector('.scholarship-title').textContent.toLowerCase();
                const desc = item.querySelector('.scholarship-desc').textContent.toLowerCase();
                
                const matchesSearch = title.includes(searchTerm) || desc.includes(searchTerm);
                
                const matchesCategory = (activeFilter === 'all') || 
                    (title.includes(activeFilter)) || 
                    (desc.includes(activeFilter));

                if (matchesSearch && matchesCategory) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noResult.classList.remove('d-none');
            } else {
                noResult.classList.add('d-none');
            }
        }

        searchInput.addEventListener('input', applyFilters);

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                applyFilters();
            });
        });
    });
</script>