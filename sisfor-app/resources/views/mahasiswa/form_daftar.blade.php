<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Form Pendaftaran Beasiswa</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { background: #f5f7fb; font-family: 'Inter', sans-serif; }
        .card-custom { border-radius: 20px; }
        .icon-box {
            width: 60px; height: 60px; background: #eef2ff;
            border-radius: 15px; display: flex; align-items: center;
            justify-content: center; color: #4361ee; font-size: 22px;
        }
        .upload-box {
            border: 2px dashed #d1d5db;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            background: #fafafa;
        }
        .upload-box:hover { border-color: #4361ee; background: #eef2ff; }
        .upload-box.active { border-color: #22c55e; background: #ecfdf5; }
        .avatar {
            width: 45px; height: 45px; border-radius: 50%;
            background: #4361ee; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }
        .btn-submit { padding: 14px; font-weight: 700; border-radius: 12px; }
    </style>
</head>

<body>

<div class="container py-4 py-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0 card-custom">
                <div class="card-body p-4 p-md-5">

                    <!-- HEADER -->
                    <div class="text-center mb-4">
                        <div class="icon-box mx-auto mb-3">
                            <i class="fas fa-file-signature"></i>
                        </div>

                        <h3 class="fw-bold">Formulir Pendaftaran</h3>
                        <p class="text-muted small">Lengkapi data untuk program</p>

                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            {{ $beasiswa->nama }}
                        </span>
                    </div>

                    <!-- ALERT SUCCESS -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- ALERT ERROR -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- VALIDATION ERROR -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- FORM -->
                    <form 
                        action="{{ route('mahasiswa.pendaftaran.store', $beasiswa->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <!-- AKADEMIK -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">📘 Informasi Akademik</h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Semester</label>
                                    <input type="number" 
                                           name="semester" 
                                           class="form-control" 
                                           min="1" max="14" 
                                           value="{{ old('semester') }}"
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">IPK</label>
                                    <input type="number" 
                                           step="0.01" 
                                           name="ipk_manual" 
                                           class="form-control" 
                                           min="0" max="4" 
                                           value="{{ old('ipk_manual') }}"
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- UPLOAD -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">📂 Upload Berkas</h6>

                            <div class="row g-3">
                                @foreach($beasiswa->persyaratan as $syarat)
                                <div class="col-md-6">
                                    <div class="upload-box" onclick="this.querySelector('input').click()">

                                        <input type="file"
                                            name="file_{{ $syarat->id }}"
                                            class="d-none"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            {{ $syarat->wajib ? 'required' : '' }}
                                            onchange="previewFile(this)">

                                        <i class="fas fa-cloud-upload-alt fs-4 mb-2"></i>

                                        <div class="fw-semibold small">
                                            {{ $syarat->nama_persyaratan }}
                                        </div>

                                        <small class="text-muted">
                                            PDF/JPG Max 5MB
                                        </small>

                                        @if($syarat->wajib)
                                            <span class="badge bg-danger">Wajib</span>
                                        @endif

                                        <div class="file-name small mt-2 text-success"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- USER INFO -->
                        <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                            <div class="avatar me-3">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <small class="text-muted">
                                    {{ Auth::user()->mahasiswa->nim ?? '-' }}
                                </small>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-primary w-100 btn-submit">
                            🚀 Kirim Pendaftaran
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function previewFile(input) {
    const box = input.closest('.upload-box');
    const text = box.querySelector('.file-name');

    if (input.files.length > 0) {
        text.innerText = input.files[0].name;
        box.classList.add('active');
    }
}
</script>

</body>
</html>