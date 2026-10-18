@extends('layouts.app')

@section('title', 'Keranjang Belanja - Second Store')

@section('content')
<div class="container py-4">

  <div class="text-center mb-5">
    <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-2">Keranjang Belanja</span>
    <h2 class="fw-extrabold mb-1">Pesanan Barang Bekas Anda</h2>
    <p class="text-secondary small">Periksa kembali barang pilihan Anda sebelum melanjutkan ke proses checkout.</p>
  </div>

  @if(!empty($cart) && count($cart) > 0)
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="border-bottom">
                <tr class="text-secondary small">
                  <th scope="col" style="min-width: 250px;">Produk Preloved</th>
                  <th scope="col">Kondisi</th>
                  <th scope="col">Harga</th>
                  <th scope="col" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                  @php $total += $item['price']; @endphp
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="rounded-3 object-fit-cover" style="width: 65px; height: 65px;">
                        <div>
                          <h6 class="fw-bold mb-1 small">
                            <a href="{{ route('products.show', $item['slug']) }}" class="text-decoration-none text-reset">
                              {{ $item['name'] }}
                            </a>
                          </h6>
                          @if(!empty($item['defect']))
                            <small class="text-warning d-block" style="font-size: 0.72rem;">
                              <i class="bi bi-info-circle me-1"></i>Minus: {{ Str::limit($item['defect'], 40) }}
                            </small>
                          @endif
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="badge bg-light text-dark border small">{{ $item['condition'] }}</span>
                    </td>
                    <td>
                      <span class="fw-bold text-primary">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                    </td>
                    <td class="text-center">
                      <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus barang ini dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle p-2" title="Hapus Barang">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
              <i class="bi bi-arrow-left me-1"></i>Cari Barang Lain
            </a>

            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua barang di keranjang?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none">
                <i class="bi bi-x-circle me-1"></i>Kosongkan Keranjang
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Ringkasan & Checkout Button -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 90px;">
          <h5 class="fw-bold mb-3">Ringkasan Pembelian</h5>

          <ul class="list-group list-group-flush mb-4 small">
            <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
              <span class="text-secondary">Total Unit:</span>
              <strong>{{ count($cart) }} Barang Preloved</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between px-0 bg-transparent">
              <span class="text-secondary">Garansi Cek Fungsi:</span>
              <span class="text-success fw-semibold">Termasuk (Gratis)</span>
            </li>
            <li class="list-group-item d-flex justify-content-between px-0 bg-transparent border-top border-2 pt-3">
              <span class="fw-bold fs-6">Total Belanja:</span>
              <h5 class="fw-extrabold text-primary mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h5>
            </li>
          </ul>

          <div class="alert alert-info py-2 px-3 rounded-3 small mb-4">
            <i class="bi bi-shield-check me-1"></i>Setiap barang bekas unik dan hanya tersedia 1 unit per item.
          </div>

          <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg rounded-pill w-100 py-3 fw-bold shadow-sm">
            Lanjut ke Checkout <i class="bi bi-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  @else
    <div class="text-center py-5">
      <div class="p-5 bg-white rounded-4 shadow-sm mx-auto" style="max-width: 500px;">
        <i class="bi bi-cart-x text-secondary display-1 mb-3 d-block"></i>
        <h4 class="fw-bold">Keranjang Belanja Masih Kosong</h4>
        <p class="text-secondary small mb-4">Anda belum menambahkan produk barang bekas ke keranjang belanja.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4 py-2">
          <i class="bi bi-search me-1"></i>Jelajahi Katalog Bekas
        </a>
      </div>
    </div>
  @endif

</div>
@endsection
