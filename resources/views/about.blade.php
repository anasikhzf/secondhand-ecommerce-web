@extends('layouts.app')

@section('title', 'Tentang Kami - Second Store')

@section('content')
<div class="container py-4">

  <div class="row align-items-center g-5 my-3">
    <div class="col-lg-6">
      <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-3">Tentang Second Store</span>
      <h2 class="display-5 fw-extrabold mb-4">Misi Kami: Menghidupkan Kembali Nilai Setiap Barang Bekas</h2>
      <p class="text-secondary leading-relaxed mb-4">
        Second Store didirikan untuk menghadirkan pengalaman belanja barang preloved (secondhand) yang transparan, jujur, dan menyenangkan. Kami percaya bahwa barang berkualitas layak mendapatkan kesempatan kedua daripada berakhir menjadi limbah.
      </p>
      <div class="d-flex flex-column gap-3">
        <div class="d-flex gap-3">
          <div class="text-primary fs-3"><i class="bi bi-shield-check"></i></div>
          <div>
            <h6 class="fw-bold mb-1">Transparansi Kondisi 100%</h6>
            <p class="text-secondary small mb-0">Setiap goresan, dent, kelengkapan, dan riwayat pemakaian kami cantumkan secara jelas tanpa ditutupi.</p>
          </div>
        </div>
        <div class="d-flex gap-3">
          <div class="text-success fs-3"><i class="bi bi-globe-americas"></i></div>
          <div>
            <h6 class="fw-bold mb-1">Dukung Ekonomi Sirkular Hijau</h6>
            <p class="text-secondary small mb-0">Setiap transaksi barang bekas turut memangkas jejak karbon dari proses produksi industri baru.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card border-0 shadow-sm p-4 p-md-5 bg-primary text-white rounded-4">
        <h3 class="fw-extrabold mb-3">Nilai & Integritas Kami</h3>
        <p class="opacity-75 mb-4">
          Kami mempermudah proses kurasi barang bekas dari pengguna ke pembeli melalui pengujian fungsional ketat, penetapan harga wajar, dan dukungan layanan langsung via WhatsApp.
        </p>
        <div class="row g-3 text-center">
          <div class="col-6">
            <div class="p-3 bg-white bg-opacity-10 rounded-3">
              <h2 class="fw-extrabold mb-0">100%</h2>
              <small class="opacity-75">Foto Asli Real-Picture</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 bg-white bg-opacity-10 rounded-3">
              <h2 class="fw-extrabold mb-0">2x24 Jam</h2>
              <small class="opacity-75">Garansi Cek Fungsi</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
