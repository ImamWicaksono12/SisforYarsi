<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Beasiswa | Admin Panel Premium</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal/minimal.css">

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --accent-color: #10b981;
            --glass-bg: rgba(255, 255, 255, 0.92);
            --border-color: rgba(226, 232, 240, 0.8);
        }

        body { 
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%);
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #1e293b;
            min-height: 100vh;
        }

        .container { max-width: 1050px; }

        .card-premium {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            margin-top: 3rem;
            margin-bottom: 3rem;
            animation: fadeIn 0.6s ease-out;
        }

        .card-header-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(248,250,252,0.6) 100%);
            padding: 3rem;
            border-bottom: 1px solid var(--border-color);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.75rem;
        }

        .form-control, .form-select {
            border-radius: 14px;
            padding: 0.85rem 1.2rem;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .section-tag {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.65rem;
            font-weight: 800;
        }

        .btn-save {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem 2.8rem;
            border-radius: 16px;
            font-weight: 700;
            transition: 0.4s;
        }

        .btn-save:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .file-upload-wrapper {
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            background: #ffffff;
            cursor: pointer;
        }

        /* Style Baru untuk Input Persyaratan Dinamis */
        .requirement-item {
            animation: slideIn 0.3s ease-out;
            background: #f1f5f9;
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card-premium">
        <div class="card-header-gradient">
            <div class="d-flex align-items-center gap-4">
                <div class="shadow-lg text-white rounded-4 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                    <i class="bi bi-file-earmark-plus-fill fs-2"></i>
                </div>
                <div>
                    <span class="section-tag mb-2 d-inline-block">System Administrator</span>
                    <h2 class="mb-0 fw-800 text-dark" style="font-weight: 800;">Tambah Program Beasiswa</h2>
                    <p class="text-muted mb-0 mt-1">Lengkapi parameter di bawah untuk mempublikasikan beasiswa baru.</p>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-lg-5">
            <form id="scholarshipForm" method="POST" action="/admin/beasiswa" enctype="multipart/form-data">
                @csrf 
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-bookmark-star me-2"></i>Nama Beasiswa</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Beasiswa Digital Transformation 2026" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-bank me-2"></i>Penyelenggara / Institusi</label>
                        <input type="text" name="sumber_beasiswa" class="form-control" placeholder="Contoh: Telkom Indonesia x Universitas Terbuka" required>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-grid-1x2 me-2"></i>Tipe Pendanaan</label>
                        <select name="tipe_beasiswa" class="form-select" required>
                            <option value="" selected disabled>Pilih Tipe...</option>
                            <option value="fully_funded">Fully Funded (Penuh)</option>
                            <option value="partial_funded">Partial Funded (Sebagian)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-mortarboard me-2"></i>Target Penerima</label>
                        <select name="diperuntukan" class="form-select" required>
                            <option value="" selected disabled>Pilih Target...</option>
                            <option value="mahasiswa_aktif">Mahasiswa Aktif</option>
                            <option value="calon_mahasiswa">Calon Mahasiswa Baru</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-check-circle me-2"></i>Status Awal</label>
                        <select name="status" class="form-select" required>
                            <option value="aktif">Aktif (Langsung Buka)</option>
                            <option value="nonaktif">Draft (Simpan Internal)</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <label class="form-label"><i class="bi bi-people me-2"></i>Kuota</label>
                        <input type="number" name="kuota" class="form-control" placeholder="150" required>
                    </div>
                    <div class="col-md-9">
                        <label class="form-label"><i class="bi bi-calendar3 me-2"></i>Periode Akademik</label>
                        <input type="text" name="periode" class="form-control" placeholder="Contoh: Semester Ganjil 2026/2027" required>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-success"><i class="bi bi-calendar-check me-2"></i>Tanggal Buka</label>
                        <input type="date" id="tgl_buka" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-danger"><i class="bi bi-calendar-x me-2"></i>Batas Penutupan</label>
                        <input type="date" id="tgl_tutup" name="tanggal_selesai" class="form-control" required>
                    </div>
                </div>

                <hr class="my-5 opacity-50">

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-link-45deg me-2"></i>Tautan Portal Eksternal (Link Informasi)</label>
                    <input type="url" name="link_informasi" class="form-control" placeholder="https://t-money.co.id/scholarship-2026">
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-image me-2"></i>Visual / Poster Program</label>
                    <div class="file-upload-wrapper" id="dropZone" onclick="document.getElementById('gambar').click()">
                        <input type="file" id="gambar" name="gambar" class="d-none" accept="image/*" required>
                        <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-2 d-block"></i>
                        <h6 class="fw-bold text-dark mb-1" id="fileStatus">Pilih File Poster</h6>
                        <p class="text-muted small mb-0" id="fileNameDisp">Rekomendasi ukuran 1080x1350px (Maks 2MB)</p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-card-text me-2"></i>Ringkasan Program (Deskripsi)</label>
                        <textarea name="deskripsi" class="form-control" rows="5" placeholder="Jelaskan secara singkat mengenai program ini..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-gift me-2"></i>Komponen Benefit / Keuntungan</label>
                        <textarea name="benefit" class="form-control" rows="5" placeholder="Contoh: &#10;1. Bebas UKT&#10;2. Uang Saku..."></textarea>
                    </div>
                </div>

                <div class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="form-label mb-0"><i class="bi bi-file-earmark-text me-2"></i>Dokumen Persyaratan Mahasiswa</label>
                        <button type="button" id="addRequirement" class="btn btn-sm btn-outline-primary rounded-3 fw-bold">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Syarat
                        </button>
                    </div>
                    <div id="requirementContainer">
                        <div class="requirement-item row g-3 align-items-center">
                            <div class="col-md-7">
                                <input type="text" name="persyaratan[]" class="form-control" placeholder="Contoh: Transkrip Nilai (KHS)" required>
                            </div>
                            <div class="col-md-3">
                                <select name="wajib[]" class="form-select">
                                    <option value="1">Wajib Diisi</option>
                                    <option value="0">Opsional</option>
                                </select>
                            </div>
                            <div class="col-md-2 text-end">
                                <span class="badge bg-light text-muted p-2">Default</span>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">Syarat di atas akan otomatis menjadi input file di halaman mahasiswa.</small>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-end align-items-center gap-3 border-top pt-5">
                    <button type="button" id="btnBatal" class="btn btn-light border px-4 py-3 rounded-4 fw-bold text-muted">Batalkan</button>
                    <button type="submit" class="btn btn-save d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check"></i> Publikasikan Beasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('scholarshipForm');
        const fileInput = document.getElementById('gambar');
        const fileStatus = document.getElementById('fileStatus');
        const fileNameDisp = document.getElementById('fileNameDisp');
        const btnBatal = document.getElementById('btnBatal');
        const reqContainer = document.getElementById('requirementContainer');
        const addBtn = document.getElementById('addRequirement');

        // Logika Tambah Baris Persyaratan Dinamis
        addBtn.addEventListener('click', function() {
            const div = document.createElement('div');
            div.className = 'requirement-item row g-3 align-items-center';
            div.innerHTML = `
                <div class="col-md-7">
                    <input type="text" name="persyaratan[]" class="form-control" placeholder="Nama Dokumen..." required>
                </div>
                <div class="col-md-3">
                    <select name="wajib[]" class="form-select">
                        <option value="1">Wajib Diisi</option>
                        <option value="0">Opsional</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger w-100 rounded-3 remove-row">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            reqContainer.appendChild(div);
        });

        // Logika Hapus Baris Persyaratan
        reqContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('.requirement-item').remove();
            }
        });

        // Logika Tombol Batalkan (Balik ke Dashboard)
        btnBatal.addEventListener('click', function() {
            Swal.fire({
                title: 'Batalkan Pengisian?',
                text: "Data yang sudah dimasukkan akan hilang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', 
                cancelButtonColor: '#64748b',  
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Lanjutkan Mengisi'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/beasiswa";
                }
            });
        });

        // Preview File Input
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileStatus.innerText = "Poster Terpilih!";
                fileNameDisp.innerText = this.files[0].name;
                document.getElementById('dropZone').style.borderColor = '#10b981';
            }
        });

        // Handle Submit Form
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let valid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(input => {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            const buka = new Date(document.getElementById('tgl_buka').value);
            const tutup = new Date(document.getElementById('tgl_tutup').value);
            
            if (tutup < buka) {
                valid = false;
                Swal.fire({ icon: 'warning', title: 'Kesalahan Tanggal', text: 'Batas penutupan tidak boleh mendahului tanggal buka.' });
                return;
            }

            if (!valid) {
                Swal.fire({ icon: 'error', title: 'Data Belum Lengkap', text: 'Mohon lengkapi semua informasi wajib.' });
            } else {
                Swal.fire({
                    title: 'Sedang Memproses',
                    text: 'Menyimpan data beasiswa ke sistem...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                
                setTimeout(() => { 
                    form.submit(); 
                }, 1000);
            }
        });
    });
</script>
</body>
</html>