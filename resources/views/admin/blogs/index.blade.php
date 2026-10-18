@extends('admin.layouts.app')

@section('page_title', 'Kelola Artikel & Tips Thrifting')

@section('admin_content')
<div class="admin-card p-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="fw-bold mb-0">Daftar Artikel Thrifting & Panduan</h6>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary rounded-pill btn-sm px-3 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i>Tulis Artikel Baru
    </a>
  </div>

  <div class="table-responsive">
    <table class="table align-middle table-hover small">
      <thead class="table-light">
        <tr>
          <th>Foto</th>
          <th>Judul Artikel</th>
          <th>Kategori</th>
          <th>Tanggal Diterbitkan</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($blogs as $blog)
          <tr>
            <td>
              <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="rounded-3 object-fit-cover" style="width: 48px; height: 48px;">
            </td>
            <td>
              <strong class="d-block">{{ $blog->title }}</strong>
              <small class="text-secondary text-truncate d-block" style="max-width: 320px;">
                {{ Str::limit($blog->content, 60) }}
              </small>
            </td>
            <td>
              <span class="badge bg-primary-subtle text-primary rounded-pill">{{ $blog->category }}</span>
            </td>
            <td>{{ $blog->created_at->format('d M Y, H:i') }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-secondary">Belum ada artikel yang dibuat.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4 d-flex justify-content-center">
    {{ $blogs->links('pagination::bootstrap-5') }}
  </div>

</div>
@endsection
