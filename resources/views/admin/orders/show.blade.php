@extends('admin.layouts.app')

@section('page_title', 'Detail Pesanan: ' . $order->order_number)

@section('admin_content')
<div class="row g-4" style="max-width: 1000px; margin: auto;">
  <div class="col-lg-8">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h5 class="fw-bold mb-1">Invoice: <code>{{ $order->order_number }}</code></h5>
          <small class="text-secondary">Waktu Pemesanan: {{ $order->created_at->format('d F Y, H:i') }} WIB</small>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
          <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
      </div>

      <h6 class="fw-bold mb-3">Daftar Barang Bekas Yang Dipesan</h6>
      <div class="table-responsive mb-4">
        <table class="table align-middle small">
          <thead class="table-light">
            <tr>
              <th>Produk</th>
              <th>Kondisi</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->items as $item)
              <tr>
                <td>
                  <strong>{{ $item->product_name }}</strong>
                </td>
                <td>
                  <span class="badge bg-light text-dark border">{{ $item->product->product_condition ?? 'Bekas' }}</span>
                </td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="fw-bold text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
              </tr>
            @endforeach
            <tr class="table-light">
              <td colspan="4" class="fw-bold text-end">Total Pembayaran:</td>
              <td class="fw-extrabold text-primary fs-6">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <h6 class="fw-bold mb-2">Catatan Tambahan Pelanggan:</h6>
      <div class="p-3 bg-light rounded-3 text-secondary small mb-3">
        {{ $order->customer_note ?: 'Tidak ada catatan khusus.' }}
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <!-- Status Card -->
    <div class="admin-card p-4 mb-4">
      <h6 class="fw-bold mb-3">Status Pesanan</h6>
      <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
          <select name="status" class="form-select form-select-sm rounded-3">
            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped (Dikirim)</option>
            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm rounded-pill w-100">
          Perbarui Status
        </button>
      </form>
    </div>

    <!-- Customer Information -->
    <div class="admin-card p-4">
      <h6 class="fw-bold mb-3">Informasi Pelanggan</h6>
      <ul class="list-unstyled small mb-4 d-flex flex-column gap-2">
        <li>
          <span class="text-secondary d-block">Nama Lengkap:</span>
          <strong>{{ $order->customer_name }}</strong>
        </li>
        <li>
          <span class="text-secondary d-block">Nomor WhatsApp:</span>
          <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->customer_phone)) }}" target="_blank" class="text-success text-decoration-none fw-bold">
            <i class="bi bi-whatsapp me-1"></i>{{ $order->customer_phone }}
          </a>
        </li>
        <li>
          <span class="text-secondary d-block">Alamat Pengiriman:</span>
          <span class="text-dark">{{ $order->customer_address }}</span>
        </li>
      </ul>

      <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->customer_phone)) }}?text={{ urlencode('Halo Kak ' . $order->customer_name . ', terkait pesanan invoice ' . $order->order_number . ' di Second Store...') }}" target="_blank" class="btn btn-outline-success btn-sm w-100 rounded-pill">
        <i class="bi bi-whatsapp me-1"></i>Chat Pelanggan
      </a>
    </div>
  </div>
</div>
@endsection
