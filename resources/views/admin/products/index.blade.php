@extends('admin.layouts.app')

@section('page_title', 'Kelola Produk Bekas (Secondhand)')

@section('admin_content')
<div class="admin-card p-4">

  <!-- Filter & Add Button -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div class="d-flex flex-wrap gap-2 align-items-center">
      <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex gap-2">
        <input type="text" name="q" value="{{ $search }}" class="form-control form-control-sm rounded-3" placeholder="Cari nama produk..." style="width: 200px;">
        <select name="status" class="form-select form-select-sm rounded-3" onchange="this.form.submit()">
          <option value="">Semua Status</option>
          <option value="available" {{ $status === 'available' ? 'selected' : '' }}>Tersedia</option>
          <option value="sold" {{ $status === 'sold' ? 'selected' : '' }}>Terjual</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary rounded-3">Cari</button>
      </form>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill btn-sm px-3 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i>Tambah Barang Bekas
    </a>
  </div>

  <!-- Table -->
  <div class="table-responsive">
    <table class="table align-middle table-hover small">
      <thead class="table-light">
        <tr>
          <th>Foto</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Kondisi</th>
          <th>Minus / Defect</th>
          <th>Harga Jual</th>
          <th>Status</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
          <tr>
            <td>
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-3 object-fit-cover" style="width: 48px; height: 48px;">
            </td>
            <td>
              <strong class="d-block">{{ $product->name }}</strong>
              <small class="text-secondary">{{ $product->seller_city ?? 'Jakarta' }} &bull; Pakai {{ $product->usage_duration ?? '-' }}</small>
            </td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td>
              <span class="badge badge-condition {{ match($product->product_condition) { 'Seperti Baru' => 'badge-seperti-baru', 'Sangat Baik' => 'badge-sangat-baik', 'Layak Pakai' => 'badge-layak-pakai', default => 'badge-pecah-minus' } }}">
                {{ $product->product_condition }}
              </span>
            </td>
            <td>
              @if($product->defect)
                <span class="text-danger small" title="{{ $product->defect }}">
                  <i class="bi bi-exclamation-triangle me-1"></i>{{ Str::limit($product->defect, 30) }}
                </span>
              @else
                <span class="text-success small"><i class="bi bi-check me-1"></i>Mulus</span>
              @endif
            </td>
            <td>
              <div class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
              @if($product->original_price)
                <small class="text-secondary text-decoration-line-through">
                  Rp {{ number_format($product->original_price, 0, ',', '.') }}
                </small>
              @endif
            </td>
            <td>
              @if($product->status === 'available')
                <span class="badge bg-success-subtle text-success">Tersedia</span>
              @else
                <span class="badge bg-secondary">Terjual</span>
              @endif
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini secara permanen?')">
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
            <td colspan="8" class="text-center py-4 text-secondary">
              Tidak ada data produk barang bekas ditemukan.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4 d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
  </div>

</div>
@endsection
