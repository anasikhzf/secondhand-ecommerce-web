@extends('admin.layouts.app')

@section('page_title', 'Tambah Barang Bekas Baru')

@section('admin_content')
<div class="admin-card p-4 p-md-5" style="max-width: 900px; margin: auto;">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Form Kurasi Barang Bekas</h5>
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
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

  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
      <div class="col-md-8">
        <label class="form-label small fw-bold">Nama Produk Barang Bekas <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control rounded-3" value="{{ old('name') }}" placeholder="Contoh: Laptop Asus Vivobook 14 i3 RAM 8GB" required>
      </div>

      <div class="col-md-4">
        <label class="form-label small fw-bold">Kategori <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select rounded-3" required>
          <option value="">Pilih Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label small fw-bold">Harga Jual Second (Rp) <span class="text-danger">*</span></label>
        <input type="number" name="price" class="form-control rounded-3" value="{{ old('price') }}" placeholder="Contoh: 1500000" required>
      </div>

      <div class="col-md-6">
        <label class="form-label small fw-bold">Harga Saat Beli Baru (Rp) <span class="text-secondary">(Opsional)</span></label>
        <input type="number" name="original_price" class="form-control rounded-3" value="{{ old('original_price') }}" placeholder="Contoh: 3000000 (Untuk kalkulasi hemat)">
      </div>

      <div class="col-md-6">
        <label class="form-label small fw-bold">Tingkat Kondisi Barang <span class="text-danger">*</span></label>
        <select name="product_condition" class="form-select rounded-3" required>
          <option value="Seperti Baru" {{ old('product_condition') === 'Seperti Baru' ? 'selected' : '' }}>Seperti Baru (Mint - Tanpa Defect)</option>
          <option value="Sangat Baik" {{ old('product_condition', 'Sangat Baik') === 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik (Baret Halus Pemakaian)</option>
          <option value="Layak Pakai" {{ old('product_condition') === 'Layak Pakai' ? 'selected' : '' }}>Layak Pakai (Minus Wajar)</option>
          <option value="Pecah/Minus" {{ old('product_condition') === 'Pecah/Minus' ? 'selected' : '' }}>Pecah / Minus (Harga Ekstra Murah)</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label small fw-bold">Status Ketersediaan <span class="text-danger">*</span></label>
        <select name="status" class="form-select rounded-3" required>
          <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }}>Tersedia (Available)</option>
          <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Sudah Terjual (Sold Out)</option>
        </select>
      </div>

      <div class="col-12">
        <label class="form-label small fw-bold text-danger">Catatan Minus / Defect Fisik (Transparansi Toko Bekas)</label>
        <textarea name="defect" rows="2" class="form-control rounded-3 border-danger border-opacity-50" placeholder="Tuliskan secara jujur: baret pada casing samping, baut hilang 1, atau tanpa minus...">{{ old('defect') }}</textarea>
      </div>

      <div class="col-md-4">
        <label class="form-label small fw-bold">Kelengkapan Unit</label>
        <input type="text" name="completeness" class="form-control rounded-3" value="{{ old('completeness') }}" placeholder="Contoh: Fullset / Unit + Charger">
      </div>

      <div class="col-md-4">
        <label class="form-label small fw-bold">Durasi Pemakaian</label>
        <input type="text" name="usage_duration" class="form-control rounded-3" value="{{ old('usage_duration') }}" placeholder="Contoh: 6 Bulan / 1 Tahun">
      </div>

      <div class="col-md-4">
        <label class="form-label small fw-bold">Kota Lokasi Barang</label>
        <input type="text" name="seller_city" class="form-control rounded-3" value="{{ old('seller_city', 'Jakarta') }}" placeholder="Contoh: Jakarta Selatan">
      </div>

      <div class="col-12">
        <label class="form-label small fw-bold">Deskripsi & Spesifikasi Produk</label>
        <textarea name="description" rows="4" class="form-control rounded-3" placeholder="Jelaskan spesifikasi, fungsi, dan alasan jual...">{{ old('description') }}</textarea>
      </div>

      <div class="col-12">
        <label class="form-label small fw-bold">Upload Foto Asli Produk (Real Picture)</label>
        <input type="file" name="image" class="form-control rounded-3" accept="image/*">
        <small class="text-secondary">Format: JPG, PNG, WEBP. Maks 3MB.</small>
      </div>
    </div>

    <hr class="my-4">

    <div class="d-flex justify-content-end gap-2">
      <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
      <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-cloud-arrow-up me-1"></i>Simpan Produk Bekas
      </button>
    </div>
  </form>

</div>
@endsection
