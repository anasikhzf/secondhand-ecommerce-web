@extends('admin.layouts.app')

@section('page_title', 'Dashboard Toko Barang Bekas')

@section('admin_content')
<!-- Metric Cards -->
<div class="row g-3 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="admin-card p-3 d-flex align-items-center justify-content-between">
      <div>
        <small class="text-secondary fw-semibold">Total Produk</small>
        <h3 class="fw-extrabold mb-0 mt-1">{{ $totalProducts }}</h3>
      </div>
      <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-4 fs-4">
        <i class="bi bi-box-seam"></i>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="admin-card p-3 d-flex align-items-center justify-content-between">
      <div>
        <small class="text-secondary fw-semibold">Produk Tersedia</small>
        <h3 class="fw-extrabold text-success mb-0 mt-1">{{ $availableProducts }}</h3>
      </div>
      <div class="p-3 bg-success bg-opacity-10 text-success rounded-4 fs-4">
        <i class="bi bi-check-circle"></i>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="admin-card p-3 d-flex align-items-center justify-content-between">
      <div>
        <small class="text-secondary fw-semibold">Terjual (Sold Out)</small>
        <h3 class="fw-extrabold text-danger mb-0 mt-1">{{ $soldProducts }}</h3>
      </div>
      <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-4 fs-4">
        <i class="bi bi-tag-fill"></i>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="admin-card p-3 d-flex align-items-center justify-content-between">
      <div>
        <small class="text-secondary fw-semibold">Total Checkout</small>
        <h3 class="fw-extrabold text-warning mb-0 mt-1">{{ $totalOrders }}</h3>
      </div>
      <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-4 fs-4">
        <i class="bi bi-bag-check"></i>
      </div>
    </div>
  </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="admin-card p-4 h-100">
      <h6 class="fw-bold mb-3">Distribusi Kategori Produk Preloved</h6>
      <div style="height: 260px;">
        <canvas id="categoryChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="admin-card p-4 h-100">
      <h6 class="fw-bold mb-3">Kondisi Fisik Barang Bekas</h6>
      <div style="height: 260px;">
        <canvas id="conditionChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Recent Products & Recent Orders -->
<div class="row g-4">
  <div class="col-lg-7">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Barang Bekas Terbaru Ditambahkan</h6>
        <a href="{{ route('admin.products.index') }}" class="small text-decoration-none">Kelola Semua</a>
      </div>

      <div class="table-responsive">
        <table class="table align-middle table-sm small mb-0">
          <thead>
            <tr class="text-secondary">
              <th>Produk</th>
              <th>Kondisi</th>
              <th>Harga</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentProducts as $prod)
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <img src="{{ $prod->image_url }}" class="rounded-2 object-fit-cover" style="width: 36px; height: 36px;">
                    <span class="fw-semibold text-truncate" style="max-width: 180px;">{{ $prod->name }}</span>
                  </div>
                </td>
                <td>
                  <span class="badge badge-condition {{ match($prod->product_condition) { 'Seperti Baru' => 'badge-seperti-baru', 'Sangat Baik' => 'badge-sangat-baik', 'Layak Pakai' => 'badge-layak-pakai', default => 'badge-pecah-minus' } }}">
                    {{ $prod->product_condition }}
                  </span>
                </td>
                <td class="fw-bold">Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                <td>
                  @if($prod->status === 'available')
                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                  @else
                    <span class="badge bg-secondary">Terjual</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="admin-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Pesanan Checkout Terbaru</h6>
        <a href="{{ route('admin.orders.index') }}" class="small text-decoration-none">Semua Pesanan</a>
      </div>

      <div class="d-flex flex-column gap-3">
        @forelse($recentOrders as $ord)
          <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-bold small">{{ $ord->customer_name }}</div>
              <small class="text-secondary">{{ $ord->order_number }} &bull; {{ $ord->created_at->diffForHumans() }}</small>
            </div>
            <div class="text-end">
              <div class="fw-bold text-primary small">Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</div>
              <span class="badge bg-primary-subtle text-primary" style="font-size: 0.65rem;">{{ strtoupper($ord->status) }}</span>
            </div>
          </div>
        @empty
          <p class="text-secondary small mb-0">Belum ada pesanan masuk.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Chart Kategori
  const catCtx = document.getElementById('categoryChart').getContext('2d');
  new Chart(catCtx, {
    type: 'bar',
    data: {
      labels: @json($catLabels),
      datasets: [{
        label: 'Jumlah Unit',
        data: @json($catCounts),
        backgroundColor: '#6366f1',
        borderRadius: 8
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
  });

  // Chart Kondisi Barang Bekas
  const condCtx = document.getElementById('conditionChart').getContext('2d');
  const condStats = @json($conditionStats);
  new Chart(condCtx, {
    type: 'doughnut',
    data: {
      labels: Object.keys(condStats),
      datasets: [{
        data: Object.values(condStats),
        backgroundColor: ['#22c55e', '#3b82f6', '#f59e0b', '#ef4444']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
</script>
@endpush
