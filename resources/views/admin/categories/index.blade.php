@extends('admin.layouts.app')

@section('page_title', 'Kelola Kategori Produk')

@section('admin_content')
<div class="row g-4">
  <!-- Form Tambah Kategori -->
  <div class="col-lg-4">
    <div class="admin-card p-4">
      <h6 class="fw-bold mb-3">Tambah Kategori Baru</h6>
      <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label small fw-bold">Nama Kategori <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Kamera & Lensa" required>
        </div>
        <div class="mb-3">
          <label class="form-label small fw-bold">Icon Bootstrap</label>
          <input type="text" name="icon" class="form-control rounded-3" placeholder="Contoh: bi-camera" value="bi-tag">
          <small class="text-secondary" style="font-size: 0.75rem;">Gunakan class ikon dari Bootstrap Icons.</small>
        </div>
        <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 small">
          <i class="bi bi-plus-lg me-1"></i>Simpan Kategori
        </button>
      </form>
    </div>
  </div>

  <!-- Daftar Kategori -->
  <div class="col-lg-8">
    <div class="admin-card p-4">
      <h6 class="fw-bold mb-3">Daftar Kategori Produk</h6>
      <div class="table-responsive">
        <table class="table align-middle table-hover small mb-0">
          <thead class="table-light">
            <tr>
              <th>Ikon</th>
              <th>Nama Kategori</th>
              <th>Slug URL</th>
              <th>Jumlah Unit</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
              <tr>
                <td>
                  <i class="bi {{ $category->icon ?? 'bi-tag' }} fs-5 text-primary"></i>
                </td>
                <td><strong>{{ $category->name }}</strong></td>
                <td><code>{{ $category->slug }}</code></td>
                <td>
                  <span class="badge bg-secondary-subtle text-secondary rounded-pill">
                    {{ $category->products_count }} Barang
                  </span>
                </td>
                <td class="text-center">
                  <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
