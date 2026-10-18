@extends('admin.layouts.app')

@section('page_title', 'Edit Artikel: ' . $blog->title)

@section('admin_content')
<div class="admin-card p-4 p-md-5" style="max-width: 800px; margin: auto;">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Ubah Artikel</h5>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
      <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
  </div>

  @if($errors->any())
    <div class="alert alert-danger py-2 px-3 rounded-3 small mb-4">
      <ul class="mb-0">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label small fw-bold">Judul Artikel <span class="text-danger">*</span></label>
      <input type="text" name="title" class="form-control rounded-3" value="{{ old('title', $blog->title) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label small fw-bold">Kategori Artikel <span class="text-danger">*</span></label>
      <input type="text" name="category" class="form-control rounded-3" value="{{ old('category', $blog->category) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label small fw-bold">Konten Artikel <span class="text-danger">*</span></label>
      <textarea name="content" rows="8" class="form-control rounded-3" required>{{ old('content', $blog->content) }}</textarea>
    </div>

    <div class="mb-4">
      <label class="form-label small fw-bold">Cover Gambar Artikel (Biarkan kosong jika tidak diubah)</label>
      <div class="d-flex align-items-center gap-3 mb-2">
        <img src="{{ $blog->image_url }}" class="rounded-3 object-fit-cover" style="width: 60px; height: 60px;">
        <input type="file" name="image" class="form-control rounded-3" accept="image/*">
      </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
      <a href="{{ route('admin.blogs.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
      <button type="submit" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-save me-1"></i>Perbarui Artikel
      </button>
    </div>
  </form>

</div>
@endsection
