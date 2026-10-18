@extends('layouts.app')

@section('title', 'Kontak & Lokasi - Second Store')

@section('content')
<div class="container py-4">

  <div class="text-center mb-5">
    <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-2">Pusat Bantuan</span>
    <h2 class="fw-extrabold mb-1">Hubungi Tim Second Store</h2>
    <p class="text-secondary small">Ada pertanyaan seputar kondisi barang, negosiasi harga, atau ingin titip jual barang bekas Anda?</p>
  </div>

  <div class="row g-4 justify-content-center">
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm p-4 p-md-5 h-100">
        <h5 class="fw-bold mb-4">Informasi Kontak Langsung</h5>

        <div class="d-flex align-items-center gap-3 mb-4">
          <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle fs-4">
            <i class="bi bi-whatsapp"></i>
          </div>
          <div>
            <small class="text-secondary d-block">WhatsApp Customer Service</small>
            <a href="https://wa.me/6285648857716" target="_blank" class="fw-bold text-dark text-decoration-none fs-6">
              +62 856-4885-7716
            </a>
          </div>
        </div>

        <div class="d-flex align-items-center gap-3 mb-4">
          <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle fs-4">
            <i class="bi bi-envelope"></i>
          </div>
          <div>
            <small class="text-secondary d-block">Email Pertanyaan & Kerjasama</small>
            <a href="mailto:support@secondstore.id" class="fw-bold text-dark text-decoration-none fs-6">
              support@secondstore.id
            </a>
          </div>
        </div>

        <div class="d-flex align-items-center gap-3 mb-4">
          <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-circle fs-4">
            <i class="bi bi-geo-alt"></i>
          </div>
          <div>
            <small class="text-secondary d-block">Workshop & Showroom</small>
            <span class="fw-bold text-dark fs-6">Jl. Tebet Raya No. 45, Jakarta Selatan</span>
          </div>
        </div>

        <div class="p-3 bg-light rounded-4 mt-auto">
          <h6 class="fw-bold small mb-1"><i class="bi bi-clock me-1 text-primary"></i>Jam Operasional:</h6>
          <p class="text-secondary small mb-0">Senin - Minggu: 09.00 - 21.00 WIB (Fast Response WhatsApp)</p>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="card border-0 shadow-sm p-4 p-md-5">
        <h5 class="fw-bold mb-4">Kirim Pesan Cepat</h5>
        <form onsubmit="handleContact(event)">
          <div class="mb-3">
            <label class="form-label small fw-bold">Nama Lengkap</label>
            <input type="text" id="contactName" class="form-control rounded-3" placeholder="Masukkan nama Anda..." required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Nomor WhatsApp</label>
            <input type="tel" id="contactPhone" class="form-control rounded-3" placeholder="0812..." required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Pesan / Pertanyaan / Tawaran Barang</label>
            <textarea id="contactMessage" rows="4" class="form-control rounded-3" placeholder="Tuliskan pertanyaan Anda..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary rounded-pill w-100 py-3 fw-bold">
            <i class="bi bi-send me-2"></i>Kirim via WhatsApp
          </button>
        </form>
      </div>
    </div>
  </div>

</div>

@push('scripts')
<script>
function handleContact(e) {
  e.preventDefault();
  const name = document.getElementById('contactName').value;
  const phone = document.getElementById('contactPhone').value;
  const msg = document.getElementById('contactMessage').value;

  const text = `Halo Admin Second Store,\n\nNama: ${name}\nNomor: ${phone}\nPesan: ${msg}`;
  window.open(`https://wa.me/6285648857716?text=${encodeURIComponent(text)}`, '_blank');
}
</script>
@endpush
@endsection
