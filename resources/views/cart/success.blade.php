@extends('layouts.app')

@section('title', 'Pesanan Berhasil Dibuat - ' . $order->order_number . ' - Second Store')

@section('content')
<div class="container py-5">

  <div class="row justify-content-center">
    <div class="col-lg-7 text-center">
      <div class="card border-0 shadow-sm p-4 p-md-5">
        <div class="mb-4">
          <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
            <i class="bi bi-check-lg display-4"></i>
          </div>
        </div>

        <h3 class="fw-extrabold mb-1">Terima Kasih, {{ $order->customer_name }}!</h3>
        <p class="text-secondary small mb-4">Pesanan Anda telah berhasil tercatat di sistem kami.</p>

        <div class="p-3 bg-light rounded-4 text-start mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-secondary small">Nomor Invoice:</span>
            <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill">{{ $order->order_number }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-secondary small">Nomor WhatsApp:</span>
            <strong>{{ $order->customer_phone }}</strong>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-secondary small">Alamat Pengiriman:</span>
            <span class="text-end small" style="max-width: 250px;">{{ $order->customer_address }}</span>
          </div>
          <hr class="my-2">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold">Total Pembayaran:</span>
            <h5 class="fw-extrabold text-primary mb-0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h5>
          </div>
        </div>

        @php
          $waText = "*Pesanan Baru Second Store*\n\n"
                  . "*No Invoice:* {$order->order_number}\n"
                  . "*Nama Penerima:* {$order->customer_name}\n"
                  . "*Alamat:* {$order->customer_address}\n"
                  . "*No HP:* {$order->customer_phone}\n\n"
                  . "*Daftar Produk:*\n";
          foreach($order->items as $item) {
              $waText .= "- {$item->product_name} (x{$item->quantity}) : Rp " . number_format($item->price, 0, ',', '.') . "\n";
          }
          $waText .= "\n*Total Tagihan:* Rp " . number_format($order->total_amount, 0, ',', '.') . "\n"
                  . "\nMohon bantuan proses dan info estimasi ongkir ya Kak!";
          $waUrl = "https://wa.me/6285648857716?text=" . urlencode($waText);
        @endphp

        <div class="d-grid gap-3">
          <a href="{{ $waUrl }}" target="_blank" class="btn btn-success btn-lg rounded-pill py-3 fw-bold shadow-sm">
            <i class="bi bi-whatsapp me-2"></i>Kirim Detail Pesanan ke WhatsApp Admin
          </a>

          <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill py-2">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
