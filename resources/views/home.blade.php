@extends('layouts.app')

@section('title', 'Second Store - Toko Online Barang Bekas Berkualitas')

@section('content')
<div class="container py-4">

  <!-- Hero Section -->
  <section class="hero-section text-center text-lg-start mb-5 position-relative">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3">
          <i class="bi bi-patch-check-fill me-1"></i>100% Lolos Uji Fungsi & Transparan
        </span>
        <h1 class="display-4 fw-extrabold tracking-tight mb-3">
          Temukan Barang Bekas Impian dengan Harga Lebih Ramah
        </h1>
        <p class="lead text-secondary mb-4">
          Beli gadget, fashion preloved, buku langka, hingga perabot rumah dengan catatan minus transparan dan garansi kondisi asli.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
          <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bi bi-bag-heart me-2"></i>Jelajahi Katalog
          </a>
          <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-book me-2"></i>Tips Cerdas Thrifting
          </a>
        </div>
      </div>
      <div class="col-lg-5 text-center">
        <div class="p-4 bg-white bg-opacity-75 rounded-4 shadow-sm border border-white">
          <div class="row g-3 text-center">
            <div class="col-6">
              <div class="p-3 bg-light rounded-4">
                <h3 class="fw-extrabold text-primary mb-0">{{ $stats['total_curated'] }}</h3>
                <small class="text-secondary fw-semibold">Barang Terkurasi</small>
              </div>
            </div>
            <div class="col-6">
              <div class="p-3 bg-light rounded-4">
                <h3 class="fw-extrabold text-success mb-0">{{ $stats['total_sold'] }}</h3>
                <small class="text-secondary fw-semibold">Barang Terjual</small>
              </div>
            </div>
            <div class="col-6">
              <div class="p-3 bg-light rounded-4">
                <h3 class="fw-extrabold text-warning mb-0">Hingga 60%</h3>
                <small class="text-secondary fw-semibold">Lebih Hemat</small>
              </div>
            </div>
            <div class="col-6">
              <div class="p-3 bg-light rounded-4">
                <h3 class="fw-extrabold text-info mb-0">Zero Waste</h3>
                <small class="text-secondary fw-semibold">Mendukung Bumi</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kategori Populer -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <h3 class="fw-bold mb-1">Kategori Pilihan</h3>
        <p class="text-secondary small mb-0">Pilih kategori barang bekas yang Anda butuhkan</p>
      </div>
      <a href="{{ route('products.index') }}" class="btn btn-sm btn-link text-decoration-none fw-semibold">
        Lihat Semua <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="row g-3">
      @foreach($categories as $cat)
        <div class="col-6 col-md-4 col-lg">
          <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="card text-decoration-none text-reset h-100 p-3 text-center border-0 shadow-sm">
            <div class="mx-auto mb-2 text-primary fs-3 p-3 bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
              <i class="bi {{ $cat->icon }}"></i>
            </div>
            <h6 class="fw-bold mb-1 small">{{ $cat->name }}</h6>
            <small class="text-secondary">{{ $cat->products_count }} Unit</small>
          </a>
        </div>
      @endforeach
    </div>
  </section>

  <!-- Produk Unggulan Tersedia -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <span class="badge bg-success-subtle text-success fw-bold px-2 py-1 rounded-pill mb-1">Stok Tersedia</span>
        <h3 class="fw-bold mb-0">Barang Bekas Terkini Siap Angkut</h3>
      </div>
      <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
        Semua Katalog <i class="bi bi-chevron-right ms-1"></i>
      </a>
    </div>

    <div class="row g-4">
      @forelse($featuredProducts as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 border-0 shadow-sm position-relative">
            <!-- Badge Kondisi -->
            @php
              $badgeClass = match($product->product_condition) {
                'Seperti Baru' => 'badge-seperti-baru',
                'Sangat Baik' => 'badge-sangat-baik',
                'Layak Pakai' => 'badge-layak-pakai',
                default => 'badge-pecah-minus',
              };
            @endphp
            <div class="position-absolute top-0 start-0 m-3 z-2">
              <span class="badge-condition {{ $badgeClass }}">
                {{ $product->product_condition }}
              </span>
            </div>

            @if($product->saving_percentage)
              <div class="position-absolute top-0 end-0 m-3 z-2">
                <span class="badge bg-danger text-white rounded-pill px-2 py-1 small fw-bold">
                  Hemat {{ $product->saving_percentage }}%
                </span>
              </div>
            @endif

            <!-- Foto Produk -->
            <a href="{{ route('products.show', $product->slug) }}" class="overflow-hidden d-block">
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="card-img-top object-fit-cover" style="height: 220px;" loading="lazy">
            </a>

            <div class="card-body p-3 d-flex flex-column">
              <small class="text-secondary mb-1">
                <i class="bi bi-geo-alt me-1"></i>{{ $product->seller_city ?? 'Jakarta' }} &bull; {{ $product->category->name ?? 'Preloved' }}
              </small>

              <h6 class="card-title fw-bold mb-2">
                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-reset">
                  {{ Str::limit($product->name, 45) }}
                </a>
              </h6>

              @if($product->defect)
                <div class="alert alert-warning py-1 px-2 mb-2 rounded-3 small text-truncate" style="font-size: 0.75rem;">
                  <i class="bi bi-info-circle me-1"></i><strong>Minus:</strong> {{ $product->defect }}
                </div>
              @endif

              <div class="mt-auto pt-2 border-top">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h5 class="fw-extrabold text-primary mb-0">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                  </h5>
                  @if($product->original_price)
                    <small class="text-decoration-line-through text-secondary">
                      Rp {{ number_format($product->original_price, 0, ',', '.') }}
                    </small>
                  @endif
                </div>

                <div class="d-grid gap-2">
                  <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                    Lihat Detail Minus
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <p class="text-secondary">Belum ada produk yang tersedia saat ini.</p>
        </div>
      @endforelse
    </div>
  </section>

  <!-- Barang Yang Sudah Terjual (Sold Out Section) -->
  @if($recentSold->count() > 0)
    <section class="mb-5">
      <div class="mb-4">
        <span class="badge bg-secondary-subtle text-secondary fw-bold px-2 py-1 rounded-pill mb-1">Galeri Sold Out</span>
        <h4 class="fw-bold mb-0">Barang Yang Telah Terjual Sebelumnya</h4>
      </div>

      <div class="row g-4">
        @foreach($recentSold as $sold)
          <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm position-relative opacity-75">
              <div class="watermark-sold">
                <span class="border border-2 border-white text-white fw-extrabold px-3 py-1 rounded-pill tracking-widest text-uppercase">
                  TERJUAL
                </span>
              </div>
              <img src="{{ $sold->image_url }}" alt="{{ $sold->name }}" class="card-img-top object-fit-cover" style="height: 160px;">
              <div class="card-body p-3">
                <small class="text-secondary d-block mb-1">{{ $sold->category->name ?? 'Barang Bekas' }}</small>
                <h6 class="fw-bold text-truncate small mb-1">{{ $sold->name }}</h6>
                <div class="text-primary fw-bold small">Rp {{ number_format($sold->price, 0, ',', '.') }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  <!-- Artikel Tips & Edukasi Thrifting -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <h3 class="fw-bold mb-1">Edukasi & Tips Thrifting</h3>
        <p class="text-secondary small mb-0">Panduan merawat barang preloved dan gaya hidup ramah lingkungan</p>
      </div>
      <a href="{{ route('blogs.index') }}" class="btn btn-sm btn-link text-decoration-none fw-semibold">
        Baca Semua Tips <i class="bi bi-arrow-right"></i>
      </a>
    </div>

    <div class="row g-4">
      @foreach($latestBlogs as $blog)
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="card-img-top object-fit-cover" style="height: 180px;">
            <div class="card-body p-4 d-flex flex-column">
              <span class="badge bg-primary-subtle text-primary rounded-pill w-auto align-self-start mb-2 small">
                {{ $blog->category }}
              </span>
              <h5 class="fw-bold mb-2">
                <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-reset">
                  {{ $blog->title }}
                </a>
              </h5>
              <p class="text-secondary small mb-3 flex-grow-1">
                {{ Str::limit($blog->content, 110) }}
              </p>
              <a href="{{ route('blogs.show', $blog->slug) }}" class="text-primary text-decoration-none fw-bold small mt-auto">
                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

</div>
@endsection
