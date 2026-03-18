<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="history-wrapper py-4 py-md-5">
    <div class="container animate-fade-in">
        
        <div class="row align-items-end mb-5 g-4">
            <div class="col-md-7 text-center text-md-start">
                <nav aria-label="breadcrumb" class="mb-2 d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active fw-600">Riwayat</li>
                    </ol>
                </nav>
                <h2 class="display-6 fw-800 text-dark mb-1">Riwayat Pendaftaran</h2>
                <p class="text-muted fs-5 mb-0">Pantau progres pengajuan beasiswa Anda.</p>
            </div>
            <div class="col-md-5 text-center text-md-end">
                <a href="{{ route('mahasiswa.beasiswa') }}" class="btn btn-yarsi-primary shadow-sm px-4 py-2-5">
                    <i class="fas fa-plus-circle me-2"></i> Daftar Beasiswa Baru
                </a>
            </div>
        </div>

        @if($data->isEmpty())
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 px-4 empty-state-card mt-4">
            <div class="empty-icon-wrapper mb-4">
                <i class="fas fa-file-invoice-dollar fa-3x text-light-gray"></i>
            </div>
            <h4 class="fw-700 text-dark">Belum ada riwayat pendaftaran</h4>
            <p class="text-muted mx-auto mb-4" style="max-width: 400px;">
                Anda belum melakukan pendaftaran beasiswa apapun saat ini.
            </p>
        </div>
        @else
        <div class="row g-4">
            @foreach($data as $item)
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden history-card-premium">
                    <div class="row g-0">
                        <div class="col-auto d-none d-md-block status-stripe {{ $item->status == 'aktif' ? 'bg-success' : ($item->status == 'ditolak' ? 'bg-danger' : 'bg-primary') }}"></div>
                        
                        <div class="col p-4">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge-type px-3 py-1">{{ $item->beasiswa->tipe_beasiswa }}</span>
                                        <span class="text-muted small">
                                            <i class="far fa-calendar-check me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal_daftar)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <h4 class="fw-800 text-dark mb-3">{{ $item->beasiswa->nama }}</h4>
                                    
                                    <div class="d-flex flex-wrap gap-3 gap-md-4 mb-4">
                                        <div class="mini-stat">
                                            <span class="label">SEMESTER</span>
                                            <span class="value">{{ $item->semester }}</span>
                                        </div>
                                        <div class="mini-stat">
                                            <span class="label">IPK</span>
                                            <span class="value">{{ number_format($item->ipk_manual, 2) }}</span>
                                        </div>
                                        <div class="mini-stat">
                                            <span class="label">STATUS</span>
                                            <span class="value {{ $item->status == 'aktif' ? 'text-success' : ($item->status == 'ditolak' ? 'text-danger' : 'text-primary') }}">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 text-lg-end border-top-mobile pt-3 pt-lg-0">
                                    <div class="d-flex flex-column align-items-lg-end gap-3">
                                        <button type="button" class="btn btn-light-yarsi px-4 rounded-pill fw-600 w-mobile-100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDetail{{ $item->id }}">
                                            <i class="fas fa-info-circle me-2"></i> Lihat Detail
                                        </button>

                                        @if($item->status == 'menunggu_kaprodi' || $item->status == 'menunggu_admin')
                                        <button class="btn btn-link text-danger text-decoration-none btn-sm fw-600 p-0">
                                            <i class="fas fa-trash-alt me-1"></i> Batalkan Pendaftaran
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header border-0 pb-0 px-4 pt-4">
                            <h5 class="modal-title fw-800 fs-4">Detail Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <p class="text-muted small fw-700 text-uppercase mb-2">Informasi Beasiswa</p>
                                    <div class="p-3 bg-light rounded-3">
                                        <h6 class="fw-700 mb-1 text-primary">{{ $item->beasiswa->nama }}</h6>
                                        <p class="small text-muted mb-0">Tipe: {{ $item->beasiswa->tipe_beasiswa }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted small fw-700 text-uppercase mb-2">Status Validasi</p>
                                    <div class="p-3 bg-light rounded-3 d-flex align-items-center">
                                        <div class="status-dot me-3 {{ $item->status == 'aktif' ? 'bg-success' : ($item->status == 'ditolak' ? 'bg-danger' : 'bg-primary') }}"></div>
                                        <span class="fw-700">{{ ucfirst(str_replace('_', ' ', $item->status)) }}</span>
                                    </div>
                                </div>
                                
                                @if($item->catatan)
                                <div class="col-12">
                                    <div class="alert alert-warning border-0 rounded-3 mb-0">
                                        <h6 class="fw-700"><i class="fas fa-comment-dots me-2"></i>Catatan Admin/Kaprodi:</h6>
                                        <p class="mb-0 small text-dark">{{ $item->catatan }}</p>
                                    </div>
                                </div>
                                @endif

                                <div class="col-12">
                                    <p class="text-muted small fw-700 text-uppercase mb-2">Dokumen Terlampir</p>
                                    <div class="list-group border-0">
                                        @forelse($item->berkasPendaftaran as $berkas)
                                        <div class="list-group-item d-flex justify-content-between align-items-center bg-light border-0 rounded-3 mb-2 px-3 py-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-pdf text-danger fs-4 me-3"></i>
                                                <div>
                                                    <p class="mb-0 fw-600 small text-dark">{{ $berkas->nama_file ?? 'Dokumen Pendukung' }}</p>
                                                    <span class="text-muted" style="font-size: 10px;">{{ strtoupper(pathinfo($berkas->path_file, PATHINFO_EXTENSION)) }} File</span>
                                                </div>
                                            </div>
                                            <a href="{{ Storage::url($berkas->path_file) }}" target="_blank" class="btn btn-sm btn-white border shadow-sm px-3 rounded-pill fw-600">Buka</a>
                                        </div>
                                        @empty
                                        <p class="text-center text-muted py-3 italic">Tidak ada berkas yang diunggah.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4 pt-0">
                            <button type="button" class="btn btn-secondary-yarsi w-100 py-2 rounded-3 fw-600" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<style>
    :root {
        --primary-yarsi: #0d6efd;
        --secondary-yarsi: #64748b;
        --dark-yarsi: #1e293b;
        --soft-bg: #f8fafc;
    }

    body { background-color: var(--soft-bg); font-family: 'Inter', sans-serif; color: var(--dark-yarsi); }
    h2, h4, h5, .badge-type, .btn-yarsi-primary { font-family: 'Outfit', sans-serif; }
    .fw-800 { font-weight: 800; } .fw-700 { font-weight: 700; } .fw-600 { font-weight: 600; }

    /* Card Styling */
    .history-card-premium {
        background: white;
        transition: 0.3s ease;
        border: 1px solid #edf2f7 !important;
    }
    .history-card-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05) !important;
    }

    .status-stripe { width: 6px; }
    .badge-type { background: #eef2ff; color: #4338ca; border-radius: 8px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; }

    /* Stats */
    .mini-stat { display: flex; flex-direction: column; }
    .mini-stat .label { font-size: 0.65rem; font-weight: 700; color: #94a3b8; letter-spacing: 1px; }
    .mini-stat .value { font-weight: 700; font-size: 1.1rem; }

    /* Buttons */
    .btn-yarsi-primary { background: linear-gradient(135deg, #0d6efd 0%, #004fc4 100%); color: white; border-radius: 12px; font-weight: 600; padding: 12px 25px; border: none; }
    .btn-light-yarsi { background: #f1f5f9; color: #475569; border: none; }
    .btn-secondary-yarsi { background: #e2e8f0; color: #475569; border: none; }
    .btn-white { background: white; color: var(--dark-yarsi); }

    /* Modal Styling */
    .status-dot { width: 12px; height: 12px; border-radius: 50%; }

    /* Responsiveness */
    @media (max-width: 991px) {
        .border-top-mobile { border-top: 1px dashed #e2e8f0; margin-top: 15px; }
        .w-mobile-100 { width: 100%; }
    }

    /* Animation */
    .animate-fade-in { animation: fadeIn 0.8s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>