<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Informasi Beasiswa Yarsi</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Background gradien profesional Biru - Hijau */
            background: linear-gradient(135deg, #1e40af 0%, #047857 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 40px;
        }

        .brand-logo {
            font-size: 2.5rem;
            color: #2563eb;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 6px rgba(37, 99, 235, 0.2));
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #94a3b8;
        }

        .form-control {
            background-color: #f8fafc;
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 12px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
            background-color: #ffffff;
        }

        .btn-login {
            background: #2563eb;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .alert-custom {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: none;
            border-radius: 12px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="glass-card text-center">
        <div class="brand-logo">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        
        <h3 class="fw-bold text-dark mb-1">Selamat Datang</h3>
        <p class="text-muted small mb-4">Silakan masuk ke akun beasiswa Anda</p>

        <form method="POST" action="/login">
            @csrf

            @if ($errors->any() || session('error'))
                <div class="alert alert-custom d-flex align-items-center mb-4 text-start" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                    <div>
                        {{ $errors->first() ?? session('error') }}
                    </div>
                </div>
            @endif

            <div class="mb-3 text-start">
                <label class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="nama@yarsi.ac.id" 
                        value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4 text-start">
                <label class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="••••••••" required>
                </div>
                <div class="text-end mt-2">
                    <a href="#" class="text-decoration-none small fw-medium">Lupa password?</a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100 mb-3 text-white">
                Masuk Sekarang
            </button>
            
            <div class="text-center mt-3">
                <p class="small text-muted mb-0">Belum memiliki akun? 
                    <a href="#" class="fw-bold text-primary text-decoration-none">Daftar Baru</a>
                </p>
            </div>
        </form>
    </div>

    <p class="text-center text-white-50 mt-4 small">
        &copy; 2026 IT Universitas Yarsi <br>
        <span class="opacity-75">Integrated with LDAP & SSO System</span>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>