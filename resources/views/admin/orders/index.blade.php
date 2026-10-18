@extends('admin.layouts.app')

@section('page_title', 'Daftar Pesanan & Checkout Pelanggan')

@section('admin_content')
<div class="admin-card p-4">

  <!-- Filter Status -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-2 align-items-center">
      <form action="{{ route('admin.orders.index') }}" method="GET">
        <select name="status" class="form-select form-select-sm rounded-3" onchange="this.form.submit()">
          <option value="">Semua Status Pesanan</option>
          <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
          <option value="confirmed" {{ $status === 'confirmed' ? 'selected' : '' }}>Confirmed (Dikonfirmasi)</option>
          <option value="shipped" {{ $status === 'shipped' ? 'selected' : '' }}>Shipped (Dikirim)</option>
          <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
          <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
        </select>
      </form>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle table-hover small">
      <thead class="table-light">
        <tr>
          <th>No. Invoice</th>
          <th>Nama Pelanggan</th>
          <th>Nomor WhatsApp</th>
          <th>Jumlah Item</th>
          <th>Total Tagihan</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
          <tr>
            <td><code>{{ $order->order_number }}</code></td>
            <td><strong>{{ $order->customer_name }}</strong></td>
            <td>
              <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->customer_phone)) }}" target="_blank" class="text-success text-decoration-none fw-semibold">
                <i class="bi bi-whatsapp me-1"></i>{{ $order->customer_phone }}
              </a>
            </td>
            <td>{{ $order->items->count() }} Unit</td>
            <td class="fw-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            <td>
              @php
                $statusColor = match($order->status) {
                  'completed' => 'bg-success',
                  'shipped' => 'bg-info text-dark',
                  'confirmed' => 'bg-primary',
                  'cancelled' => 'bg-danger',
                  default => 'bg-warning text-dark'
                };
              @endphp
              <span class="badge {{ $statusColor }} rounded-pill px-2 py-1">{{ ucfirst($order->status) }}</span>
            </td>
            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
            <td class="text-center">
              <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center py-4 text-secondary">Belum ada pesanan checkout yang masuk.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4 d-flex justify-content-center">
    {{ $orders->links('pagination::bootstrap-5') }}
  </div>

</div>
@endsection
