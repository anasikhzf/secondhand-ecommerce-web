@extends('layouts.app')

@section('title', $blog->title . ' - Tips Thrifting Second Store')

@section('content')
<div class="container py-4">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}" class="text-decoration-none">Tips Thrifting</a></li>
      <li class="breadcrumb-item active text-truncate" style="max-width: 250px;">{{ $blog->title }}</li>
    </ol>
  </nav>

  <div class="row g-4 justify-content-center">
    <div class="col-lg-8">
      <article class="card border-0 shadow-sm p-4 p-md-5">
        <div class="mb-3">
          <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 small fw-bold">
            {{ $blog->category }}
          </span>
          <span class="text-secondary small ms-2">
            <i class="bi bi-clock me-1"></i>{{ $blog->created_at->format('d M Y') }}
          </span>
        </div>

        <h1 class="fw-extrabold mb-4">{{ $blog->title }}</h1>

        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded-4 mb-4 object-fit-cover w-100" style="max-height: 400px;">

        <div class="text-secondary leading-relaxed fs-6 mb-5">
          {!! nl2br(e($blog->content)) !!}
        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center">
          <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary rounded-pill btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Tips
          </a>
          <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill btn-sm">
            <i class="bi bi-bag-check me-1"></i>Belanja Barang Bekas Sekarang
          </a>
        </div>
      </article>
    </div>

    <!-- Related Blogs Sidebar -->
    @if($relatedBlogs->count() > 0)
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 90px;">
          <h5 class="fw-bold mb-3">Artikel Terkait</h5>
          <div class="d-flex flex-column gap-3">
            @foreach($relatedBlogs as $rel)
              <div class="d-flex gap-3 align-items-center">
                <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="rounded-3 object-fit-cover" style="width: 70px; height: 70px;">
                <div>
                  <h6 class="fw-bold mb-1 small">
                    <a href="{{ route('blogs.show', $rel->slug) }}" class="text-decoration-none text-reset">
                      {{ Str::limit($rel->title, 50) }}
                    </a>
                  </h6>
                  <small class="text-secondary">{{ $rel->created_at->format('d M Y') }}</small>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif
  </div>

</div>
@endsection
