<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Second Store - Toko Online Barang Bekas Terkurasi')</title>
  
  <meta name="description" content="@yield('meta_description', 'Toko online barang bekas premium, preloved gadget, fashion thrifting, dan perlengkapan rumah terkurasi dengan transparansi kondisi 100%.')">
  <link rel="icon" href="{{ asset('images/PHP-logo.svg.png') }}" type="image/png">
  
  <!-- Google Fonts (Outfit) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4f46e5;
      --primary-hover: #4338ca;
      --accent-color: #f59e0b;
      --bg-light: #f8fafc;
      --card-bg-light: #ffffff;
      --text-dark: #0f172a;
      --bg-dark: #0f172a;
      --card-bg-dark: #1e293b;
      --text-light: #f1f5f9;
      --border-dark: #334155;
    }
    body {
      font-family: 'Outfit', sans-serif;
      background-color: var(--bg-light);
      color: var(--text-dark);
      transition: background-color 0.3s, color 0.3s;
    }
    body.dark-mode {
      background-color: var(--bg-dark);
      color: var(--text-light);
    }
    .navbar {
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.9) !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      transition: background-color 0.3s, border-color 0.3s;
    }
    body.dark-mode .navbar {
      background-color: rgba(15, 23, 42, 0.9) !important;
      border-bottom: 1px solid var(--border-dark);
    }
    .card {
      background-color: var(--card-bg-light);
      border: 1px solid rgba(0, 0, 0, 0.06);
      border-radius: 1.25rem;
      overflow: hidden;
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s, background-color 0.3s, border-color 0.3s;
    }
    body.dark-mode .card {
      background-color: var(--card-bg-dark);
      border-color: var(--border-dark);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.12);
    }
    body.dark-mode .card:hover {
      box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.4);
    }
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      font-weight: 600;
      border-radius: 0.75rem;
      padding: 0.65rem 1.4rem;
      transition: all 0.2s ease-in-out;
    }
    .btn-primary:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
    }
    .badge-condition {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      padding: 0.4em 0.75em;
      border-radius: 2rem;
    }
    .badge-seperti-baru { background-color: #dcfce7; color: #15803d; }
    .badge-sangat-baik { background-color: #e0e7ff; color: #4338ca; }
    .badge-layak-pakai { background-color: #fef3c7; color: #b45309; }
    .badge-pecah-minus { background-color: #fee2e2; color: #b91c1c; }

    body.dark-mode .badge-seperti-baru { background-color: rgba(21, 128, 61, 0.25); color: #86efac; }
    body.dark-mode .badge-sangat-baik { background-color: rgba(67, 56, 202, 0.25); color: #a5b4fc; }
    body.dark-mode .badge-layak-pakai { background-color: rgba(180, 83, 9, 0.25); color: #fde68a; }
    body.dark-mode .badge-pecah-minus { background-color: rgba(185, 28, 28, 0.25); color: #fca5a5; }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      z-index: 1030;
      background-color: rgba(255, 255, 255, 0.9) !important;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
      backdrop-filter: blur(10px);
    }
    body.dark-mode .bottom-nav {
      background-color: rgba(15, 23, 42, 0.9) !important;
      border-top: 1px solid var(--border-dark);
    }
    .hero-section {
      background: linear-gradient(135deg, #eef2ff 0%, #e0f2fe 100%);
      border-radius: 2rem;
      padding: 4rem 2rem;
      margin-bottom: 3rem;
      position: relative;
      overflow: hidden;
    }
    body.dark-mode .hero-section {
      background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);
    }
    body.dark-mode .bg-light,
    body.dark-mode .bg-body-tertiary {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
    }
    body.dark-mode .text-dark,
    body.dark-mode .text-slate-800 {
      color: var(--text-light) !important;
    }
    body.dark-mode .text-secondary,
    body.dark-mode .text-muted {
      color: #94a3b8 !important;
    }
    body.dark-mode .border,
    body.dark-mode .border-top,
    body.dark-mode .border-bottom {
      border-color: var(--border-dark) !important;
    }
    body.dark-mode .list-group-item {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
      border-color: var(--border-dark) !important;
    }
    body.dark-mode .form-control,
    body.dark-mode .form-select {
      background-color: var(--card-bg-dark);
      border-color: var(--border-dark);
      color: var(--text-light);
    }
    body.dark-mode .form-control:focus,
    body.dark-mode .form-select:focus {
      background-color: var(--card-bg-dark);
      border-color: var(--primary-color);
      color: var(--text-light);
    }
    .watermark-sold {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(15, 23, 42, 0.65);
      backdrop-filter: blur(2px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 5;
    }
  </style>
  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100 pb-5 pb-lg-0">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container py-1">
      <a class="navbar-brand d-flex align-items-center gap-2 fw-extrabold fs-4" href="{{ route('home') }}">
        <span class="p-2 bg-primary text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm">
          <i class="bi bi-recycle"></i>
        </span>
        <span class="tracking-tight">Second<span class="text-primary">Store</span></span>
      </a>

      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
        <i class="bi bi-list fs-2"></i>
      </button>

      <div class="collapse navbar-collapse" id="navContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium gap-lg-3">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }}" href="{{ route('home') }}">
              <i class="bi bi-house-door me-1"></i>Beranda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('products.*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('products.index') }}">
              <i class="bi bi-grid me-1"></i>Katalog Bekas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('blogs.index') }}">
              <i class="bi bi-journal-text me-1"></i>Tips Thrifting
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? 'active text-primary fw-bold' : '' }}" href="{{ route('about') }}">
              Tentang Kami
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('contact') ? 'active text-primary fw-bold' : '' }}" href="{{ route('contact') }}">
              Kontak
            </a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-2">
          <!-- Dark Mode Toggle Button -->
          <button id="themeToggle" class="btn btn-outline-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" title="Ganti Tema">
            <i class="bi bi-moon-stars" id="themeIcon"></i>
          </button>

          <!-- Cart Button -->
          @php $cartCount = count(session('cart', [])); @endphp
          <a href="{{ route('cart.index') }}" class="btn btn-light position-relative rounded-pill px-3 py-2 border shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-cart3 text-primary fs-5"></i>
            <span class="d-none d-md-inline fw-semibold small">Keranjang</span>
            @if($cartCount > 0)
              <span class="badge rounded-pill bg-danger">{{ $cartCount }}</span>
            @endif
          </a>

          @auth
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-3 py-2 small">
              <i class="bi bi-speedometer2 me-1"></i>Admin
            </a>
          @else
            <a href="{{ route('admin.login') }}" class="btn btn-outline-primary rounded-pill px-3 py-2 small">
              <i class="bi bi-lock me-1"></i>Login
            </a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Flash Messages -->
  <div class="container mt-3">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('info'))
      <div class="alert alert-info alert-dismissible fade show rounded-4 shadow-sm" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
  </div>

  <!-- Content Slot -->
  <main class="flex-grow-1">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="mt-auto py-5 bg-white border-top">
    <div class="container">
      <div class="row g-4 justify-content-between">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-2 fw-extrabold fs-4 mb-3">
            <span class="p-2 bg-primary text-white rounded-3 d-inline-flex align-items-center justify-content-center">
              <i class="bi bi-recycle"></i>
            </span>
            <span>Second<span class="text-primary">Store</span></span>
          </div>
          <p class="text-secondary small leading-relaxed">
            Marketplace preloved dan barang bekas terkurasi nomor satu di Indonesia. Kami menjamin transparansi kondisi, catatan minus jujur, serta mendukung ekonomi sirkular ramah lingkungan.
          </p>
          <div class="d-flex gap-2">
            <a href="#" class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-instagram"></i></a>
            <a href="#" class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-whatsapp"></i></a>
            <a href="#" class="btn btn-sm btn-light border rounded-circle"><i class="bi bi-tiktok"></i></a>
          </div>
        </div>

        <div class="col-6 col-lg-2">
          <h6 class="fw-bold mb-3">Navigasi</h6>
          <ul class="list-unstyled small d-flex flex-column gap-2 text-secondary">
            <li><a href="{{ route('home') }}" class="text-reset text-decoration-none">Beranda</a></li>
            <li><a href="{{ route('products.index') }}" class="text-reset text-decoration-none">Katalog Produk</a></li>
            <li><a href="{{ route('blogs.index') }}" class="text-reset text-decoration-none">Tips Thrifting</a></li>
            <li><a href="{{ route('about') }}" class="text-reset text-decoration-none">Tentang Kami</a></li>
          </ul>
        </div>

        <div class="col-6 col-lg-2">
          <h6 class="fw-bold mb-3">Standar Kualitas</h6>
          <ul class="list-unstyled small d-flex flex-column gap-2 text-secondary">
            <li><span class="badge badge-seperti-baru">Seperti Baru</span></li>
            <li><span class="badge badge-sangat-baik">Sangat Baik</span></li>
            <li><span class="badge badge-layak-pakai">Layak Pakai</span></li>
            <li><span class="badge badge-pecah-minus">Pecah/Minus Jujur</span></li>
          </ul>
        </div>

        <div class="col-lg-3">
          <h6 class="fw-bold mb-3">Bantuan & Hubungi Kami</h6>
          <p class="text-secondary small mb-2"><i class="bi bi-geo-alt me-2 text-primary"></i>Jakarta Selatan, DKI Jakarta</p>
          <p class="text-secondary small mb-2"><i class="bi bi-whatsapp me-2 text-success"></i>+62 856-4885-7716</p>
          <p class="text-secondary small"><i class="bi bi-envelope me-2 text-primary"></i>support@secondstore.id</p>
        </div>
      </div>

      <hr class="my-4 text-secondary opacity-25">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-secondary">
        <p class="mb-0">&copy; {{ date('Y') }} SecondStore. Dibuat dengan Laravel 11 untuk Ekonomi Sirkular.</p>
        <p class="mb-0">Belanja Preloved Bijak, Dukung Bumi Hijau.</p>
      </div>
    </div>
  </footer>

  <!-- Bottom Mobile Nav -->
  <div class="bottom-nav d-lg-none py-2 px-3 border-top">
    <div class="d-flex justify-content-around align-items-center">
      <a href="{{ route('home') }}" class="text-center text-decoration-none {{ request()->routeIs('home') ? 'text-primary fw-bold' : 'text-secondary' }}">
        <i class="bi bi-house-door fs-5 d-block"></i>
        <span style="font-size: 0.7rem;">Beranda</span>
      </a>
      <a href="{{ route('products.index') }}" class="text-center text-decoration-none {{ request()->routeIs('products.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
        <i class="bi bi-grid fs-5 d-block"></i>
        <span style="font-size: 0.7rem;">Katalog</span>
      </a>
      <a href="{{ route('cart.index') }}" class="text-center text-decoration-none position-relative {{ request()->routeIs('cart.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
        <i class="bi bi-cart3 fs-5 d-block"></i>
        @if($cartCount > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.55rem;">{{ $cartCount }}</span>
        @endif
        <span style="font-size: 0.7rem;">Keranjang</span>
      </a>
      <a href="{{ route('blogs.index') }}" class="text-center text-decoration-none {{ request()->routeIs('blogs.*') ? 'text-primary fw-bold' : 'text-secondary' }}">
        <i class="bi bi-journal-text fs-5 d-block"></i>
        <span style="font-size: 0.7rem;">Tips</span>
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Dark Mode Script -->
  <script>
    const themeToggleBtn = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');

    function applyTheme(isDark) {
      if (isDark) {
        document.body.classList.add('dark-mode');
        themeIcon.className = 'bi bi-sun-fill text-warning';
      } else {
        document.body.classList.remove('dark-mode');
        themeIcon.className = 'bi bi-moon-stars';
      }
    }

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      applyTheme(true);
    }

    themeToggleBtn.addEventListener('click', () => {
      const isDark = document.body.classList.toggle('dark-mode');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      applyTheme(isDark);
    });
  </script>
  @stack('scripts')
</body>
</html>
