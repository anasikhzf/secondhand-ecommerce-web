<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel - Second Store')</title>
  
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
      --admin-primary: #4f46e5;
      --admin-dark: #0f172a;
      --admin-sidebar-bg: #1e293b;
    }
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #f1f5f9;
      color: #0f172a;
    }
    .admin-sidebar {
      background-color: var(--admin-sidebar-bg);
      min-height: 100vh;
      color: #94a3b8;
    }
    .admin-sidebar .nav-link {
      color: #94a3b8;
      font-weight: 500;
      padding: 0.8rem 1.25rem;
      border-radius: 0.75rem;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 0.25rem;
    }
    .admin-sidebar .nav-link:hover,
    .admin-sidebar .nav-link.active {
      color: #ffffff;
      background-color: rgba(255, 255, 255, 0.1);
    }
    .admin-sidebar .nav-link.active {
      background-color: var(--admin-primary);
    }
    .admin-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 1rem;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
    }
    .badge-condition {
      font-size: 0.75rem;
      font-weight: 700;
      padding: 0.35em 0.65em;
      border-radius: 2rem;
    }
    .badge-seperti-baru { background-color: #dcfce7; color: #15803d; }
    .badge-sangat-baik { background-color: #e0e7ff; color: #4338ca; }
    .badge-layak-pakai { background-color: #fef3c7; color: #b45309; }
    .badge-pecah-minus { background-color: #fee2e2; color: #b91c1c; }
  </style>
  @stack('styles')
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-lg-2 d-none d-lg-block admin-sidebar p-3">
      <div class="d-flex align-items-center gap-2 mb-4 px-2 py-3 border-bottom border-secondary border-opacity-25">
        <span class="p-2 bg-primary text-white rounded-3 d-inline-flex"><i class="bi bi-recycle fs-5"></i></span>
        <span class="text-white fw-bold fs-5">Second<span class="text-primary">Admin</span></span>
      </div>

      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="bi bi-boxes"></i> Kelola Produk Bekas
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori Produk
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Pesanan / Checkout
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="bi bi-journal-richtext"></i> Artikel & Tips
          </a>
        </li>
      </ul>

      <div class="mt-auto pt-4 border-top border-secondary border-opacity-25">
        <a href="{{ route('home') }}" target="_blank" class="nav-link text-white mb-2">
          <i class="bi bi-box-arrow-up-right"></i> Lihat Toko
        </a>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger w-100 rounded-3 text-start d-flex align-items-center gap-2 px-3 py-2 small">
            <i class="bi bi-box-arrow-right"></i> Keluar (Logout)
          </button>
        </form>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="col-lg-10 p-4">
      <!-- Topbar Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h4 class="fw-bold mb-0">@yield('page_title', 'Dashboard')</h4>
          <small class="text-secondary">Panel Manajemen Second Store Toko Online Barang Bekas</small>
        </div>

        <div class="d-flex align-items-center gap-3">
          <a href="{{ route('home') }}" class="btn btn-sm btn-light border rounded-pill px-3">
            <i class="bi bi-shop me-1"></i>Ke Website
          </a>
          <span class="badge bg-primary rounded-pill px-3 py-2 fw-semibold">
            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name ?? 'Admin' }}
          </span>
        </div>
      </div>

      <!-- Flash Alert -->
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @yield('admin_content')
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>
