<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Beasiswa | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-soft: #eef2ff;
            --success: #10b981;
            --danger: #ef4444;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-600: #475569;
            --slate-900: #0f172a;
        }

        body { 
            background: var(--slate-100); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--slate-600); 
            min-height: 100vh;
        }

        .card { 
            border: 1px solid rgba(255, 255, 255, 0.7); 
            border-radius: 24px; 
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .btn-back { 
            width: 48px; height: 48px; 
            border-radius: 16px; 
            display: flex; align-items: center; justify-content: center;
            background: white; border: 1.5px solid var(--slate-100); 
            color: var(--slate-600);
            text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-back:hover { 
            background: var(--primary-soft); 
            color: var(--primary); 
            transform: translateX(-5px);
            border-color: var(--primary-soft);
        }

        .btn-primary { 
            background: var(--primary); 
            border: none; 
            padding: 0.7rem 1.5rem; 
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }
        .btn-primary:hover { 
            background: #4338ca; 
            transform: translateY(-2px); 
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.6rem 1rem;
            border: 1.5px solid var(--slate-100);
            background: white;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .table-container { border-radius: 24px; overflow: hidden; }
        .table thead th { 
            background: var(--slate-50); 
            color: var(--slate-600); 
            text-transform: uppercase; 
            font-size: 0.7rem; 
            font-weight: 800;
            letter-spacing: 0.05em; 
            padding: 20px 15px;
            border: none;
        }
        .table tbody tr { transition: all 0.2s; border-bottom: 1px solid var(--slate-100); }
        .table tbody tr:hover { background-color: var(--primary-soft); }
        .table tbody td { vertical-align: middle; padding: 20px 15px; border: none; }

        .badge-status { 
            padding: 8px 14px; 
            border-radius: 10px; 
            font-size: 0.75rem; 
            font-weight: 700; 
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .bg-aktif { background-color: #dcfce7; color: #15803d; }
        .bg-nonaktif { background-color: #fee2e2; color: #b91c1c; }

        .beasiswa-name { font-weight: 700; color: var(--slate-900); font-size: 1rem; margin-bottom: 2px; }
        .beasiswa-sub { font-size: 0.85rem; color: #94a3b8; font-weight: 500; }

        .btn-action {
            width: 38px; height: 38px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 10px; transition: 0.2s;
            border: 1.5px solid var(--slate-100);
            background: white;
            color: var(--slate-600);
        }
        .btn-edit:hover { color: var(--primary); background: var(--primary-soft); border-color: var(--primary-soft); }
        .btn-delete:hover { color: var(--danger); background: #fef2f2; border-color: #fef2f2; }

        .pagination .page-link { border: none; margin: 0 3px; border-radius: 8px; color: var(--slate-600); font-weight: 600; }
        .pagination .page-item.active .page-link { background: var(--primary); color: white; }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    
    <div class="header-section d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-4 mb-5">
        <div class="d-flex align-items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="btn-back shadow-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div>
                <h2 class="fw-800 text-dark mb-1" style="font-weight: 800; letter-spacing: -0.02em;">Manajemen Beasiswa</h2>
                <p class="text-muted mb-0">Atur program dan pantau pendaftaran mahasiswa secara real-time.</p>
            </div>
        </div>
        <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-5"></i>
            <span>Tambah Program Baru</span>
        </a>
    </div>

    <div class="card p-4 mb-4 border-0">
        <form method="GET" action="{{ route('admin.beasiswa.index') }}" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 pe-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-2" placeholder="Cari nama program..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="buka" {{ request('status') == 'buka' ? 'selected' : '' }}>Buka (Aktif)</option>
                    <option value="tutup" {{ request('status') == 'tutup' ? 'selected' : '' }}>Tutup (Nonaktif)</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">Terapkan Filter</button>
                <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-light border px-4" title="Reset"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 p-3" role="alert" style="border-radius: 16px; background: #dcfce7; color: #15803d;">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Detail Program</th>
                        <th>Tipe Dana</th>
                        <th>Mulai Pendaftaran</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: #eef2ff;">
                                    <i class="bi bi-journal-bookmark-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="beasiswa-name">{{ $d->nama }}</span>
                                    <span class="beasiswa-sub d-block">{{ $d->sumber_beasiswa }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border text-capitalize px-3 py-2" style="font-size: 0.7rem; font-weight: 600;">
                                {{ str_replace('_', ' ', $d->tipe_beasiswa) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar-event text-muted"></i>
                                <span class="fw-600" style="font-weight: 600;">{{ \Carbon\Carbon::parse($d->tanggal_mulai)->format('d M, Y') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $d->kuota ?? '-' }} <small class="text-muted fw-normal">Kuota</small></div>
                        </td>
                        <td>
                            @if($d->status == 'buka' || $d->status == 'aktif')
                                <span class="badge-status bg-aktif">
                                    <span style="font-size: 8px;">●</span> Buka
                                </span>
                            @else
                                <span class="badge-status bg-nonaktif">
                                    <span style="font-size: 8px;">●</span> Tutup
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- PERBAIKAN: Menggunakan named route sesuai web.php --}}
                                <a href="{{ route('admin.beasiswa.edit', $d->id) }}" class="btn-action btn-edit" title="Edit Data">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.beasiswa.delete', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/flat/empty-state.svg" style="width: 150px;" class="mb-3 opacity-50">
                            <h5 class="text-muted fw-bold">Belum ada beasiswa</h5>
                            <p class="text-muted small">Klik tombol "Tambah Program Baru" untuk memulai.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4 px-2">
        <p class="text-muted small mb-0">Menampilkan data ke-{{ $data->firstItem() }} dari {{ $data->total() }} total beasiswa</p>
        <div class="pagination-premium">
            {{ $data->appends(request()->all())->links() }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>