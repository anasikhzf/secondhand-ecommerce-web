@extends('layouts.app')

@section('title', $product->name . ' - Kondisi ' . $product->product_condition . ' - Second Store')

@section('content')
<div class="container py-4">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Katalog</a></li>
      <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="text-decoration-none">{{ $product->category->name ?? 'Kategori' }}</a></li>
      <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $product->name }}</li>
    </ol>
  </nav>

  <div class="row g-4 mb-5">
    <!-- Gambar Produk -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm p-3 position-relative">
        @if($product->status === 'sold')
          <div class="watermark-sold rounded-4">
            <span class="border border-3 border-white text-white fw-extrabold px-4 py-2 rounded-pill tracking-widest fs-4 text-uppercase">
              PRODUK TELAH TERJUAL
            </span>
          </div>
        @endif

        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-4 object-fit-cover w-100" style="max-height: 480px;">

        <div class="d-flex gap-2 mt-3 overflow-auto">
          <img src="{{ $product->image_url }}" class="rounded-3 border border-2 border-primary" style="width: 80px; height: 80px; object-fit: cover;">
          <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-secondary small p-2" style="width: 80px; height: 80px;">
            <i class="bi bi-camera me-1"></i>Foto Asli
          </div>
        </div>
      </div>
    </div>

    <!-- Informasi & Pembelian Produk -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm p-4 p-md-5">
        
        <!-- Kondisi & Badge -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
          @php
            $badgeClass = match($product->product_condition) {
              'Seperti Baru' => 'badge-seperti-baru',
              'Sangat Baik' => 'badge-sangat-baik',
              'Layak Pakai' => 'badge-layak-pakai',
              default => 'badge-pecah-minus',
            };
          @endphp
          <span class="badge-condition {{ $badgeClass }}">
            <i class="bi bi-shield-check me-1"></i>Kondisi: {{ $product->product_condition }}
          </span>

          @if($product->status === 'available')
            <span class="badge bg-success-subtle text-success fw-bold px-3 py-1 rounded-pill">
              <i class="bi bi-check-circle me-1"></i>Hanya 1 Unit Tersedia
            </span>
          @else
            <span class="badge bg-secondary text-white fw-bold px-3 py-1 rounded-pill">
              Sudah Terjual (Sold Out)
            </span>
          @endif
        </div>

        <h2 class="fw-extrabold mb-2">{{ $product->name }}</h2>

        <div class="d-flex align-items-center gap-3 text-secondary small mb-4">
          <span><i class="bi bi-geo-alt me-1 text-primary"></i>Dikirim dari <strong>{{ $product->seller_city ?? 'Jakarta' }}</strong></span>
          <span>&bull;</span>
          <span><i class="bi bi-clock-history me-1 text-primary"></i>Dipakai <strong>{{ $product->usage_duration ?? '1 Tahun' }}</strong></span>
        </div>

        <!-- Box Harga -->
        <div class="p-3 bg-light rounded-4 mb-4">
          <div class="text-secondary small mb-1">Harga Preloved Terbaik:</div>
          <div class="d-flex align-items-baseline gap-3">
            <h2 class="fw-extrabold text-primary mb-0">
              Rp {{ number_format($product->price, 0, ',', '.') }}
            </h2>
            @if($product->original_price)
              <div class="text-secondary text-decoration-line-through">
                Harga Baru: Rp {{ number_format($product->original_price, 0, ',', '.') }}
              </div>
              <span class="badge bg-danger rounded-pill px-2 py-1 small fw-bold">
                Hemat {{ $product->saving_percentage }}%
              </span>
            @endif
          </div>
        </div>

        <!-- Transparansi Defect / Catatan Minus (Fitur Kunci Toko Bekas) -->
        <div class="card border-warning bg-warning bg-opacity-10 rounded-4 p-3 mb-4">
          <div class="d-flex gap-2">
            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
            <div>
              <h6 class="fw-bold mb-1 text-dark">Transparansi Catatan Minus / Cacat:</h6>
              <p class="mb-0 small text-dark">
                {{ $product->defect ?: 'Tidak ditemukan cacat fisik atau fungsional yang signifikan. Barang telah dicek normal 100% siap pakai.' }}
              </p>
            </div>
          </div>
        </div>

        <!-- Spesifikasi Barang Bekas -->
        <ul class="list-group list-group-flush mb-4 small">
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
            <span class="text-secondary">Kelengkapan Paket:</span>
            <strong class="text-end">{{ $product->completeness ?: 'Unit Saja' }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
            <span class="text-secondary">Estimasi Durasi Pemakaian:</span>
            <strong class="text-end">{{ $product->usage_duration ?: 'Pemakaian Normal' }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
            <span class="text-secondary">Kategori:</span>
            <strong class="text-end">{{ $product->category->name ?? 'Preloved' }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
            <span class="text-secondary">Garansi Cek Fisik:</span>
            <strong class="text-success text-end">2x24 Jam Setelah Diterima</strong>
          </li>
        </ul>

        <!-- Deskripsi Lengkap -->
        <div class="mb-4">
          <h6 class="fw-bold mb-2">Deskripsi Produk</h6>
          <p class="text-secondary small leading-relaxed">
            {!! nl2br(e($product->description)) !!}
          </p>
        </div>

        <!-- Action Button -->
        @if($product->status === 'available')
          <div class="d-grid gap-2">
            <form action="{{ route('cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{ $product->id }}">
              <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 shadow-sm">
                <i class="bi bi-cart-plus me-2"></i>Beli Barang Ini (Tambah ke Keranjang)
              </button>
            </form>
            <a href="https://wa.me/6285648857716?text={{ urlencode('Halo Admin Second Store, saya tertarik dengan produk bekas: ' . $product->name . ' (' . route('products.show', $product->slug) . ')') }}" target="_blank" class="btn btn-outline-success rounded-pill py-2 small">
              <i class="bi bi-whatsapp me-2"></i>Tanya Kondisi via WhatsApp
            </a>
          </div>
        @else
          <button class="btn btn-secondary btn-lg rounded-pill w-100 py-3 disabled" disabled>
            Barang Ini Sudah Terjual
          </button>
        @endif

      </div>
    </div>
  </div>

  <!-- Produk Terkait -->
  @if($relatedProducts->count() > 0)
    <section class="mt-5">
      <h4 class="fw-bold mb-4">Barang Preloved Sejenis</h4>
      <div class="row g-4">
        @foreach($relatedProducts as $rel)
          <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm position-relative">
              <a href="{{ route('products.show', $rel->slug) }}">
                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="card-img-top object-fit-cover" style="height: 160px;">
              </a>
              <div class="card-body p-3">
                <h6 class="fw-bold text-truncate small mb-1">
                  <a href="{{ route('products.show', $rel->slug) }}" class="text-decoration-none text-reset">
                    {{ $rel->name }}
                  </a>
                </h6>
                <div class="text-primary fw-bold small">Rp {{ number_format($rel->price, 0, ',', '.') }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

</div>
@endsection
