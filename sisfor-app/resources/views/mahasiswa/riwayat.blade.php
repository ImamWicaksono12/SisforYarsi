@extends('dashboard.mahasiswa')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="history-wrapper py-4 py-md-5">
    <div class="container animate-page-in">
        
        <div class="row align-items-end mb-5 g-4">
            <div class="col-md-7 text-center text-md-start">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb mb-0 justify-content-center justify-content-md-start">
                        <li class="breadcrumb-item small"><a href="{{ route('mahasiswa.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item small active fw-700 text-primary">Riwayat</li>
                    </ol>
                </nav>
                <h2 class="header-title">Riwayat Pendaftaran</h2>
                <p class="text-muted mb-0">Kelola dan pantau status pengajuan beasiswa Anda di Universitas YARSI.</p>
            </div>
            <div class="col-md-5 text-center text-md-end">
                <a href="{{ route('mahasiswa.beasiswa') }}" class="btn btn-primary-premium shadow-lg px-4">
                    <i class="fas fa-plus-circle me-2"></i> Daftar Beasiswa Baru
                </a>
            </div>
        </div>

        {{-- Flash Message untuk Feedback User --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 animate-page-in">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 animate-page-in">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if($data->isEmpty())
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 px-4 empty-state-card">
            <div class="empty-icon-inner mb-4">
                <i class="fas fa-folder-open fa-3x text-light"></i>
            </div>
            <h4 class="fw-700 text-dark">Belum ada data pendaftaran</h4>
            <p class="text-muted mx-auto mb-4" style="max-width: 400px;">
                Sepertinya Anda belum mengajukan beasiswa. Mulai langkah sukses Anda hari ini!
            </p>
            <a href="{{ route('mahasiswa.beasiswa') }}" class="btn btn-outline-primary rounded-pill px-4 fw-700">Cari Beasiswa</a>
        </div>
        @else
        <div class="row g-4">
            @foreach($data as $item)
            @php 
                $statusColor = match($item->status) {
                    'aktif', 'disetujui' => 'success',
                    'ditolak' => 'danger',
                    default => 'primary',
                };
            @endphp
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden history-card-premium">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-auto d-none d-md-block bg-{{ $statusColor }}" style="width: 6px;"></div>
                        
                        <div class="col p-4">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span class="badge-premium-{{ $statusColor }}">
                                            {{ strtoupper(str_replace('_', ' ', $item->beasiswa->tipe_beasiswa)) }}
                                        </span>
                                        <span class="text-muted small fw-600">
                                            <i class="far fa-calendar-alt me-1 text-{{ $statusColor }}"></i> {{ \Carbon\Carbon::parse($item->tanggal_daftar)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <h4 class="fw-800 text-dark mb-3 card-scholarship-name">{{ $item->beasiswa->nama }}</h4>
                                    
                                    <div class="d-flex flex-wrap gap-2 gap-md-4 mb-2">
                                        <div class="mini-stat">
                                            <span class="label">SEMESTER</span>
                                            <span class="value">{{ $item->semester }}</span>
                                        </div>
                                        <div class="mini-stat ps-4 border-start-md">
                                            <span class="label">IPK</span>
                                            <span class="value">{{ number_format($item->ipk_manual, 2) }}</span>
                                        </div>
                                        <div class="mini-stat ps-4 border-start-md">
                                            <span class="label">STATUS AKHIR</span>
                                            <span class="value text-{{ $statusColor }} d-flex align-items-center gap-2">
                                                @if($statusColor == 'primary') 
                                                    <span class="status-dot-pulse bg-primary"></span> 
                                                @endif
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                                    <div class="d-flex flex-column align-items-lg-end gap-3">
                                        <button type="button" class="btn btn-action-detail w-mobile-100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDetail{{ $item->id }}">
                                            Lihat Detail Pengajuan <i class="fas fa-chevron-right ms-2 fs-xs"></i>
                                        </button>

                                        @if(in_array($item->status, ['pending', 'menunggu_kaprodi', 'menunggu_admin']))
                                        <form action="{{ route('mahasiswa.pendaftaran.cancel', $item->id) }}" method="POST" class="w-mobile-100" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-decoration-none btn-sm fw-700 p-0 hover-opacity">
                                                <i class="fas fa-times-circle me-1"></i> Batalkan Pengajuan
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress" style="height: 3px; border-radius: 0; background: #f1f5f9;">
                        <div class="progress-bar bg-{{ $statusColor }} opacity-75" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            {{-- Modal Detail --}}
            <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                        <div class="modal-header bg-light border-0 px-4 py-3">
                            <h5 class="modal-title fw-800 text-dark" style="font-family: 'Outfit';">Detail Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="list-group list-group-flush">
                                @forelse($item->berkas ?? [] as $b)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0 border-light py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box-file me-3">
                                            <i class="fas fa-file-pdf text-danger"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-700 small text-dark">{{ Str::limit($b->nama_berkas ?? 'Dokumen Pendukung', 30) }}</p>
                                            <span class="text-muted" style="font-size: 11px;">Tersimpan secara aman</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('mahasiswa.pendaftaran.view-file', $b->id) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-700">Buka</a>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <img src="https://illustrations.popsy.co/gray/no-data.svg" style="width: 80px;" class="mb-3 opacity-50">
                                    <p class="text-muted small mb-0 fst-italic">Tidak ada dokumen yang ditemukan.</p>
                                </div>
                                @endforelse
                            </div>
                            
                            @if($item->catatan)
                            <div class="mt-4 p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-20">
                                <label class="small fw-800 text-warning text-uppercase d-block mb-1">Pesan dari Admin</label>
                                <p class="small mb-0 text-dark">{{ $item->catatan }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="modal-footer bg-light border-0 p-3">
                            <button type="button" class="btn btn-secondary rounded-pill px-4 fw-700 w-100" data-bs-dismiss="modal">Tutup</button>
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
        --p-primary: #6366f1;
        --p-dark: #0f172a;
        --p-bg: #f8fafc;
    }

    body {
        background-color: var(--p-bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .header-title {
        font-family: 'Outfit', sans-serif; 
        font-weight: 800; 
        color: var(--p-dark);
        letter-spacing: -1.5px;
        font-size: 2.2rem;
    }

    .card-scholarship-name {
        font-family: 'Outfit', sans-serif;
        letter-spacing: -0.5px;
    }

    .animate-page-in {
        animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .history-card-premium {
        background: #ffffff;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid #E2E8F0 !important;
    }

    .history-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02) !important;
        border-color: var(--p-primary) !important;
    }

    [class^="badge-premium-"] {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .badge-premium-primary { background: rgba(99, 102, 241, 0.1); color: #4338CA; }
    .badge-premium-success { background: rgba(16, 185, 129, 0.1); color: #065F46; }
    .badge-premium-danger { background: rgba(239, 68, 68, 0.1); color: #991B1B; }

    .btn-primary-premium {
        background: linear-gradient(135deg, var(--p-primary) 0%, #4f46e5 100%);
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        padding: 14px 32px;
        transition: all 0.3s ease;
    }

    .btn-primary-premium:hover {
        transform: scale(1.03);
        color: white;
        box-shadow: 0 10px 20px -10px var(--p-primary);
    }

    .btn-action-detail {
        background: #f1f5f9;
        color: #475569;
        border-radius: 50px;
        font-weight: 700;
        padding: 12px 28px;
        border: 1px solid #e2e8f0;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .btn-action-detail:hover {
        background: var(--p-dark);
        color: white;
        border-color: var(--p-dark);
    }

    .status-dot-pulse {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 1.5s infinite linear;
    }

    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(99, 102, 241, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
    }

    .mini-stat .label {
        font-size: 10px;
        font-weight: 800;
        color: #94A3B8;
        letter-spacing: 1px;
        margin-bottom: 2px;
        display: block;
    }
    .mini-stat .value {
        font-weight: 800;
        color: var(--p-dark);
        font-size: 1.15rem;
    }

    .icon-box-file {
        width: 44px;
        height: 44px;
        background: #fef2f2;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
    }

    .hover-opacity:hover { opacity: 0.8; }
    .fs-xs { font-size: 0.75rem; }

    @media (min-width: 768px) {
        .border-start-md { border-left: 1px solid #e2e8f0 !important; }
    }

    @media (max-width: 768px) {
        .w-mobile-100 { width: 100%; }
        .header-title { font-size: 1.8rem; }
        .mini-stat { margin-bottom: 15px; }
    }
</style>
@endsection