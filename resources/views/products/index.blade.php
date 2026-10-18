@extends('layouts.app')

@section('title', 'Katalog Barang Bekas Terkurasi - Second Store')

@section('content')
<div class="container py-4">

  <!-- Header & Search Breadcrumb -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
      <h2 class="fw-extrabold mb-1">Katalog Barang Bekas</h2>
      <p class="text-secondary small mb-0">Semua produk preloved telah melewati inspeksi fisik dan uji fungsi.</p>
    </div>

    <!-- Form Search -->
    <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2" style="max-width: 420px; width: 100%;">
      @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
      @endif
      @if(request('condition'))
        <input type="hidden" name="condition" value="{{ request('condition') }}">
      @endif
      <div class="input-group">
        <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="bi bi-search text-secondary"></i></span>
        <input type="text" name="q" value="{{ $search }}" class="form-control border-start-0 rounded-end-pill" placeholder="Cari tipe laptop, baju, sofa...">
      </div>
      <button type="submit" class="btn btn-primary rounded-pill px-3">Cari</button>
    </form>
  </div>

  <div class="row g-4">
    <!-- Filter Sidebar -->
    <div class="col-lg-3">
      <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 80px; z-index: 10;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="fw-bold mb-0"><i class="bi bi-sliders2 me-2"></i>Filter</h5>
          @if(request()->hasAny(['category', 'condition', 'status', 'q', 'sort']))
            <a href="{{ route('products.index') }}" class="small text-danger text-decoration-none fw-semibold">Reset</a>
          @endif
        </div>

        <form action="{{ route('products.index') }}" method="GET">
          @if($search)
            <input type="hidden" name="q" value="{{ $search }}">
          @endif

          <!-- Kategori -->
          <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase text-secondary tracking-wider">Kategori</label>
            <div class="d-flex flex-column gap-1">
              <a href="{{ route('products.index', array_merge(request()->query(), ['category' => null])) }}" 
                 class="btn btn-sm text-start rounded-pill px-3 py-1 {{ empty($categorySlug) ? 'btn-primary' : 'btn-light' }}">
                Semua Kategori
              </a>
              @foreach($categories as $cat)
                <a href="{{ route('products.index', array_merge(request()->query(), ['category' => $cat->slug])) }}" 
                   class="btn btn-sm text-start rounded-pill px-3 py-1 d-flex justify-content-between align-items-center {{ $categorySlug === $cat->slug ? 'btn-primary' : 'btn-light' }}">
                  <span><i class="bi {{ $cat->icon }} me-2"></i>{{ $cat->name }}</span>
                  <span class="badge bg-secondary-subtle text-secondary rounded-pill">{{ $cat->products_count }}</span>
                </a>
              @endforeach
            </div>
          </div>

          <!-- Kondisi Barang Bekas -->
          <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase text-secondary tracking-wider">Kondisi Barang</label>
            <select name="condition" class="form-select form-select-sm rounded-3" onchange="this.form.submit()">
              <option value="">Semua Kondisi</option>
              <option value="Seperti Baru" {{ $condition === 'Seperti Baru' ? 'selected' : '' }}>Seperti Baru (Mint)</option>
              <option value="Sangat Baik" {{ $condition === 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik (Mulus)</option>
              <option value="Layak Pakai" {{ $condition === 'Layak Pakai' ? 'selected' : '' }}>Layak Pakai (Minus Wajar)</option>
              <option value="Pecah/Minus" {{ $condition === 'Pecah/Minus' ? 'selected' : '' }}>Pecah / Minus (Harga Ekstra Murah)</option>
            </select>
          </div>

          <!-- Ketersediaan Stok -->
          <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase text-secondary tracking-wider">Status Barang</label>
            <select name="status" class="form-select form-select-sm rounded-3" onchange="this.form.submit()">
              <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Semua Produk</option>
              <option value="available" {{ $status === 'available' ? 'selected' : '' }}>Tersedia Saja</option>
              <option value="sold" {{ $status === 'sold' ? 'selected' : '' }}>Sudah Terjual</option>
            </select>
          </div>

          <!-- Urutan / Sorting -->
          <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase text-secondary tracking-wider">Urutkan</label>
            <select name="sort" class="form-select form-select-sm rounded-3" onchange="this.form.submit()">
              <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru</option>
              <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
              <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
              <option value="condition" {{ $sort === 'condition' ? 'selected' : '' }}>Kondisi Terbaik</option>
            </select>
          </div>
        </form>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-secondary small mb-0">Menampilkan <strong>{{ $products->total() }}</strong> barang preloved</p>
      </div>

      <div class="row g-4">
        @forelse($products as $product)
          <div class="col-12 col-sm-6 col-md-4">
            <div class="card h-100 border-0 shadow-sm position-relative">
              @if($product->status === 'sold')
                <div class="watermark-sold">
                  <span class="border border-2 border-white text-white fw-extrabold px-3 py-1 rounded-pill tracking-widest text-uppercase">
                    TERJUAL
                  </span>
                </div>
              @endif

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

              <a href="{{ route('products.show', $product->slug) }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="card-img-top object-fit-cover" style="height: 200px;">
              </a>

              <div class="card-body p-3 d-flex flex-column">
                <small class="text-secondary mb-1">
                  <i class="bi bi-geo-alt me-1"></i>{{ $product->seller_city ?? 'Jakarta' }}
                </small>

                <h6 class="card-title fw-bold mb-2">
                  <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-reset">
                    {{ Str::limit($product->name, 45) }}
                  </a>
                </h6>

                @if($product->defect)
                  <div class="alert alert-warning py-1 px-2 mb-2 rounded-3 small text-truncate" style="font-size: 0.75rem;">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $product->defect }}
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

                  <a href="{{ route('products.show', $product->slug) }}" class="btn {{ $product->status === 'sold' ? 'btn-secondary disabled' : 'btn-outline-primary' }} btn-sm w-100 rounded-pill">
                    {{ $product->status === 'sold' ? 'Sudah Terjual' : 'Cek Detail Minus' }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <div class="p-5 bg-white rounded-4 shadow-sm">
              <i class="bi bi-search text-secondary display-3 mb-3 d-block"></i>
              <h5 class="fw-bold">Produk Tidak Ditemukan</h5>
              <p class="text-secondary small mb-3">Tidak ada barang bekas yang cocok dengan kata kunci atau filter yang Anda pilih.</p>
              <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4">Lihat Semua Barang</a>
            </div>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      <div class="mt-5 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

</div>
@endsection
