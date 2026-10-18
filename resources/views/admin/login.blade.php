<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator - Second Store</title>
  <link rel="icon" href="{{ asset('images/PHP-logo.svg.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card-login {
      border: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(30, 41, 59, 0.8);
      backdrop-filter: blur(12px);
      border-radius: 1.5rem;
      color: #f8fafc;
    }
    .form-control {
      background: rgba(15, 23, 42, 0.6);
      border: 1px solid #334155;
      color: #ffffff;
    }
    .form-control:focus {
      background: rgba(15, 23, 42, 0.8);
      border-color: #6366f1;
      color: #ffffff;
      box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }
  </style>
</head>
<body>

<div class="container p-3">
  <div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
      <div class="card card-login p-4 p-md-5 shadow-lg">
        <div class="text-center mb-4">
          <div class="p-3 bg-primary bg-opacity-25 text-primary rounded-4 d-inline-flex mb-3">
            <i class="bi bi-shield-lock-fill fs-2"></i>
          </div>
          <h3 class="fw-extrabold mb-1">Admin Panel</h3>
          <p class="text-secondary small">Masuk untuk mengelola katalog & pesanan toko</p>
        </div>

        @if($errors->any())
          <div class="alert alert-danger py-2 px-3 rounded-3 small mb-4">
            <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
          </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label small fw-semibold text-secondary">Username</label>
            <div class="input-group">
              <span class="input-group-text bg-transparent border-secondary border-opacity-50 text-secondary"><i class="bi bi-person"></i></span>
              <input type="text" name="username" class="form-control rounded-end-3" value="{{ old('username', 'admin') }}" required autofocus>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label small fw-semibold text-secondary">Password</label>
            <div class="input-group">
              <span class="input-group-text bg-transparent border-secondary border-opacity-50 text-secondary"><i class="bi bi-key"></i></span>
              <input type="password" name="password" class="form-control rounded-end-3" placeholder="••••••••" required>
            </div>
          </div>

          <div class="mb-4 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
            <label class="form-check-label small text-secondary" for="rememberMe">Ingat sesi saya</label>
          </div>

          <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mb-3 shadow">
            Masuk ke Dashboard <i class="bi bi-arrow-right ms-1"></i>
          </button>

          <div class="text-center">
            <a href="{{ route('home') }}" class="small text-secondary text-decoration-none">
              <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
            </a>
          </div>
        </form>

        <div class="mt-4 p-2 rounded-3 bg-dark bg-opacity-50 text-center small text-secondary" style="font-size: 0.75rem;">
          Akun Demo Default: <code>admin</code> / <code>12345</code>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
