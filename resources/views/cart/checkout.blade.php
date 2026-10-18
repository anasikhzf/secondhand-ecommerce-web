@extends('layouts.app')

@section('title', 'Checkout Pesanan - Second Store')

@section('content')
<div class="container py-4">

  <div class="text-center mb-5">
    <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-2">Form Pemesanan</span>
    <h2 class="fw-extrabold mb-1">Konfirmasi & Checkout Pesanan</h2>
    <p class="text-secondary small">Data pesanan Anda akan tersimpan di sistem dan dapat langsung diteruskan ke WhatsApp penjual.</p>
  </div>

  <div class="row g-4 justify-content-center">
    <!-- Kolom Form Pemesanan -->
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm p-4 p-md-5">
        <h5 class="fw-bold mb-4"><i class="bi bi-person-lines-fill text-primary me-2"></i>Data Penerima & Pengiriman</h5>

        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
          @csrf

          <div class="mb-3">
            <label class="form-label small fw-bold">Nama Lengkap Penerima <span class="text-danger">*</span></label>
            <input type="text" name="customer_name" class="form-control rounded-3 @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" placeholder="Contoh: Budi Santoso" required>
            @error('customer_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
            <input type="tel" name="customer_phone" class="form-control rounded-3 @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" placeholder="Contoh: 081234567890" required>
            <small class="text-secondary" style="font-size: 0.75rem;">Kami akan mengirimkan konfirmasi resi pengiriman melalui nomor ini.</small>
            @error('customer_phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Alamat Lengkap Pengiriman <span class="text-danger">*</span></label>
            <textarea name="customer_address" rows="3" class="form-control rounded-3 @error('customer_address') is-invalid @enderror" placeholder="Nama Jalan, Nomor Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos" required>{{ old('customer_address') }}</textarea>
            @error('customer_address')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label small fw-bold">Catatan Untuk Penjual (Opsional)</label>
            <textarea name="customer_note" rows="2" class="form-control rounded-3" placeholder="Contoh: Packing kayu untuk laptop, mohon bubble wrap tebal">{{ old('customer_note') }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-sm">
            <i class="bi bi-check2-circle me-2"></i>Konfirmasi & Buat Pesanan
          </button>
        </form>
      </div>
    </div>

    <!-- Kolom Ringkasan Pesanan -->
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 90px;">
        <h5 class="fw-bold mb-3">Item Pesanan</h5>

        <div class="d-flex flex-column gap-3 mb-4">
          @foreach($cart as $item)
            <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light">
              <div class="d-flex align-items-center gap-2">
                <img src="{{ $item['image'] }}" class="rounded-2 object-fit-cover" style="width: 50px; height: 50px;">
                <div>
                  <h6 class="fw-bold mb-0 small text-truncate" style="max-width: 170px;">{{ $item['name'] }}</h6>
                  <span class="badge bg-secondary-subtle text-secondary" style="font-size: 0.65rem;">{{ $item['condition'] }}</span>
                </div>
              </div>
              <span class="fw-bold text-primary small">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
            </div>
          @endforeach
        </div>

        <ul class="list-group list-group-flush mb-4 small">
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
            <span class="text-secondary">Subtotal:</span>
            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
            <span class="text-secondary">Ongkos Kirim:</span>
            <span class="text-success fw-bold">Dihitung saat WhatsApp</span>
          </li>
          <li class="list-group-item d-flex justify-content-between px-0 bg-transparent border-top border-2 pt-3">
            <span class="fw-bold fs-6">Total Tagihan:</span>
            <h5 class="fw-extrabold text-primary mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h5>
          </li>
        </ul>

        <div class="p-3 bg-light rounded-4 text-secondary small">
          <i class="bi bi-info-circle me-1 text-primary"></i>Setelah klik konfirmasi, nomor invoice resmi akan dibuat dan Anda dapat langsung chat WhatsApp dengan tim kami untuk finalisasi ongkir & pembayaran.
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
