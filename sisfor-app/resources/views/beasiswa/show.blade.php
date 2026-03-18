@extends('layouts.admin')

@section('header_scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Inter', sans-serif; }
    .doc-btn.active { 
        background-color: #0d6efd !important; 
        color: white !important;
        border-color: #0d6efd !important;
    }
    .custom-card { border-radius: 12px; border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
    /* Memastikan PDF mengambil ruang maksimal tanpa scroll double */
    #pdfViewer { min-height: 100%; border: none; }
    /* Skeleton loader sederhana saat PDF loading */
    .loader-wrapper {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        z-index: -1;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0 vh-100 d-flex flex-column" style="background-color: #f1f5f9;">
    <div class="row g-0 flex-grow-1 overflow-hidden">
        
        <div class="col-lg-7 d-flex flex-column h-100 bg-dark position-relative">
            <div class="p-3 bg-white border-bottom shadow-sm d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="bi bi-file-earmark-pdf-fill text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Pratinjau Berkas</h6>
                        <small class="text-muted small-text">Silakan periksa keaslian dokumen</small>
                    </div>
                </div>
                
                <div class="btn-group shadow-sm" role="group">
                    @foreach($pendaftaran->berkasPendaftaran as $index => $berkas)
                        <button type="button" 
                                class="btn btn-sm btn-outline-primary px-3 doc-btn {{ $index == 0 ? 'active' : '' }}" 
                                onclick="viewDocument('{{ route('admin.pendaftaran.view-file', $berkas->id) }}', this)">
                            {{ $berkas->persyaratan->nama_persyaratan }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="flex-grow-1 position-relative">
                <div class="loader-wrapper text-white text-center">
                    <div class="spinner-border spinner-border-sm mb-2" role="status"></div>
                    <div class="small">Memuat Dokumen...</div>
                </div>
                
                <div id="no-preview" class="h-100 d-none flex-column align-items-center justify-content-center text-white">
                    <i class="bi bi-exclamation-triangle fs-1 text-warning mb-3"></i>
                    <p>Dokumen tidak dapat ditemukan atau korup.</p>
                </div>

                @php $firstFile = $pendaftaran->berkasPendaftaran->first(); @endphp
                <iframe id="pdfViewer" 
                        src="{{ $firstFile ? route('admin.pendaftaran.view-file', $firstFile->id) : '' }}" 
                        width="100%" 
                        height="100%"
                        loading="lazy">
                </iframe>
            </div>
        </div>

        <div class="col-lg-5 h-100 bg-white shadow-lg overflow-auto">
            <div class="p-4 p-xl-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left me-1"></i> Dashboard
                    </a>
                    <span class="badge {{ $pendaftaran->status == 'diterima' ? 'bg-success' : ($pendaftaran->status == 'ditolak' ? 'bg-danger' : 'bg-warning text-dark') }} rounded-pill px-3 py-2">
                        <i class="bi bi-info-circle me-1"></i> {{ strtoupper(str_replace('_', ' ', $pendaftaran->status)) }}
                    </span>
                </div>

                <div class="mb-4">
                    <h4 class="fw-bold text-dark mb-1">Verifikasi Pendaftar</h4>
                    <p class="text-muted small">ID Registrasi: <span class="text-primary fw-medium">#{{ $pendaftaran->id }}</span></p>
                </div>

                <div class="card custom-card bg-light mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold rounded-circle shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                {{ substr($pendaftaran->mahasiswa->user->name, 0, 1) }}
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-0 text-dark">{{ $pendaftaran->mahasiswa->user->name }}</h6>
                                <p class="text-muted mb-0 small">{{ $pendaftaran->mahasiswa->nim }} • {{ $pendaftaran->mahasiswa->prodi->nama_prodi }}</p>
                            </div>
                        </div>
                        
                        <div class="row g-3 border-top pt-3 mt-2">
                            <div class="col-6 border-end">
                                <small class="text-muted d-block mb-1">IPK Terakhir</small>
                                <span class="fw-bold h5 mb-0 {{ $pendaftaran->ipk_manual < 3.0 ? 'text-danger' : 'text-success' }}">
                                    {{ $pendaftaran->ipk_manual }}
                                </span>
                            </div>
                            <div class="col-6 ps-3">
                                <small class="text-muted d-block mb-1">Jalur Daftar</small>
                                <span class="fw-bold text-dark text-capitalize">{{ str_replace('_', ' ', $pendaftaran->jalur_pendaftaran) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.pendaftaran.verifikasi', $pendaftaran->id) }}" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary text-uppercase tracking-wider">Langkah 1: Ceklis Dokumen</label>
                        <div class="list-group shadow-sm border-0">
                            @foreach($pendaftaran->berkasPendaftaran as $berkas)
                            <label class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom cursor-pointer">
                                <span class="small fw-medium">
                                    {{ $berkas->persyaratan->nama_persyaratan }}
                                    @if($berkas->persyaratan->wajib) <span class="text-danger">*</span> @endif
                                </span>
                                <input class="form-check-input ms-2" type="checkbox" name="check_docs[]" value="{{ $berkas->id }}" required>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary text-uppercase tracking-wider">Langkah 2: Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control border-0 bg-light p-3" rows="3" placeholder="Contoh: Dokumen transkrip kabur, harap upload ulang..."></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <button type="submit" name="status" value="ditolak" class="btn btn-outline-danger w-100 py-3 fw-bold border-2 rounded-3">
                                <i class="bi bi-x-lg me-2"></i> TOLAK
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" name="status" value="validasi_admin" class="btn btn-primary w-100 py-3 fw-bold shadow-sm rounded-3">
                                <i class="bi bi-check-lg me-2"></i> SETUJUI
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function viewDocument(url, btn) {
        const viewer = document.getElementById('pdfViewer');
        const noPreview = document.getElementById('no-preview');
        
        // Tab UI Update
        document.querySelectorAll('.doc-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Security check & Display
        if (url) {
            viewer.classList.remove('d-none');
            noPreview.classList.add('d-none');
            viewer.src = url;
        } else {
            viewer.classList.add('d-none');
            noPreview.classList.remove('d-flex');
        }
    }
</script>
@endsection