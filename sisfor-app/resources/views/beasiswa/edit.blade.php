<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Beasiswa | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-600: #475569;
            --slate-900: #0f172a;
        }

        body { 
            background: var(--slate-100); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--slate-600);
        }

        .card { 
            border: none; 
            border-radius: 24px; 
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.02);
            background: #ffffff;
        }

        .form-label { 
            font-weight: 600; 
            color: var(--slate-900); 
            font-size: 0.85rem; 
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control, .form-select { 
            border-radius: 12px; 
            padding: 0.75rem 1rem; 
            border: 1.5px solid var(--slate-200); 
            background: var(--slate-50);
            transition: all 0.2s ease-in-out;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus { 
            background: #fff;
            border-color: var(--primary); 
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
            color: var(--slate-900);
        }

        .section-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--slate-100);
        }

        .section-title { 
            font-weight: 800; 
            color: var(--slate-900);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
            background: var(--slate-100);
            border: 1.5px solid var(--slate-200);
            color: var(--slate-600);
        }

        .btn { 
            border-radius: 14px; 
            padding: 0.8rem 1.8rem; 
            font-weight: 700; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }

        .btn-primary { 
            background: var(--primary); 
            border: none; 
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-primary:hover { 
            background: var(--primary-hover); 
            transform: translateY(-2px); 
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-light {
            background: #fff;
            border: 1.5px solid var(--slate-200);
            color: var(--slate-600);
            text-decoration: none;
        }

        .btn-light:hover {
            background: var(--slate-100);
            border-color: var(--slate-200);
            color: var(--slate-900);
        }

        textarea { resize: none; }

        .label-icon {
            color: var(--primary);
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4 p-md-5">
                
                <div class="section-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="section-title mb-1">
                            <i class="bi bi-pencil-square text-primary"></i> 
                            Edit Beasiswa
                        </h3>
                        <p class="text-muted mb-0">{{ $item->nama }}</p>
                    </div>
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold" style="background: var(--primary-soft);">
                        ID: #{{ $item->id }}
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.beasiswa.update', $item->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-type label-icon"></i> Nama Beasiswa</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" placeholder="Contoh: Beasiswa Digital Transformation" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-building label-icon"></i> Sumber Beasiswa</label>
                            <input type="text" name="sumber_beasiswa" class="form-control" value="{{ old('sumber_beasiswa', $item->sumber_beasiswa) }}" placeholder="Contoh: Yayasan Yarsi" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-wallet2 label-icon"></i> Tipe Beasiswa</label>
                            <select name="tipe_beasiswa" class="form-select" required>
                                <option value="fully_funded" @selected($item->tipe_beasiswa == 'fully_funded')>Fully Funded</option>
                                <option value="partial_funded" @selected($item->tipe_beasiswa == 'partial_funded')>Partial Funded</option>
                                <option value="one_shot" @selected($item->tipe_beasiswa == 'one_shot')>One Shot</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-people label-icon"></i> Diperuntukan</label>
                            <select name="diperuntukan" class="form-select" required>
                                <option value="calon_mahasiswa" @selected($item->diperuntukan == 'calon_mahasiswa')>Calon Mahasiswa</option>
                                <option value="mahasiswa_aktif" @selected($item->diperuntukan == 'mahasiswa_aktif')>Mahasiswa Aktif</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-toggle-on label-icon"></i> Status</label>
                            <select name="status" class="form-select" required>
                                <option value="aktif" @selected($item->status == 'aktif' || $item->status == 'buka')>Aktif (Buka)</option>
                                <option value="nonaktif" @selected($item->status == 'nonaktif' || $item->status == 'tutup')>Nonaktif (Tutup)</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-person-plus label-icon"></i> Kuota (Orang)</label>
                            <input type="number" name="kuota" class="form-control" value="{{ old('kuota', $item->kuota) }}">
                        </div>

                        <div class="col-md-8">
                            <label class="form-label"><i class="bi bi-calendar3 label-icon"></i> Periode</label>
                            <input type="text" name="periode" class="form-control" value="{{ old('periode', $item->periode) }}" placeholder="Contoh: Semester Ganjil 2026/2027" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-calendar-check label-icon"></i> Mulai Pendaftaran</label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $item->tanggal_mulai }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-calendar-x label-icon"></i> Selesai Pendaftaran</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ $item->tanggal_selesai }}" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-link-45deg label-icon"></i> Link Informasi (URL)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                <input type="url" name="link_informasi" class="form-control" value="{{ old('link_informasi', $item->link_informasi) }}" placeholder="https://example.com">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-justify-left label-icon"></i> Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan detail program beasiswa...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-gift label-icon"></i> Benefit / Keuntungan</label>
                            <textarea name="benefit" class="form-control" rows="5" placeholder="Sebutkan apa saja yang didapatkan pendaftar...">{{ old('benefit', $item->benefit) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-light d-flex align-items-center gap-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="bi bi-cloud-arrow-up-fill"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>