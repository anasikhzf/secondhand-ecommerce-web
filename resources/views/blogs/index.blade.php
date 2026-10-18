@extends('layouts.app')

@section('title', 'Tips Thrifting & Edukasi Gaya Hidup Sirkular - Second Store')

@section('content')
<div class="container py-4">

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
    <div>
      <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-2">Thrifting & Tips</span>
      <h2 class="fw-extrabold mb-1">Artikel & Panduan Barang Preloved</h2>
      <p class="text-secondary small mb-0">Edukasi cerdas seputar memilih, merawat, dan memaksimalkan nilai guna barang bekas.</p>
    </div>

    <form action="{{ route('blogs.index') }}" method="GET" style="max-width: 350px; width: 100%;">
      <div class="input-group">
        <input type="text" name="q" value="{{ $search }}" class="form-control rounded-start-pill" placeholder="Cari tips & panduan...">
        <button type="submit" class="btn btn-primary rounded-end-pill px-3">Cari</button>
      </div>
    </form>
  </div>

  <div class="row g-4">
    @forelse($blogs as $blog)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
          <a href="{{ route('blogs.show', $blog->slug) }}">
            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="card-img-top object-fit-cover" style="height: 200px;">
          </a>
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
              {{ Str::limit($blog->content, 120) }}
            </p>
            <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto small">
              <span class="text-secondary"><i class="bi bi-calendar3 me-1"></i>{{ $blog->created_at->format('d M Y') }}</span>
              <a href="{{ route('blogs.show', $blog->slug) }}" class="text-primary fw-bold text-decoration-none">
                Baca <i class="bi bi-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-secondary">Belum ada artikel yang cocok dengan pencarian Anda.</p>
      </div>
    @endforelse
  </div>

  <div class="mt-5 d-flex justify-content-center">
    {{ $blogs->links('pagination::bootstrap-5') }}
  </div>

</div>
@endsection
