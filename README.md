# Second Store - Toko Online Barang Bekas (Preloved) Premium

Aplikasi web e-commerce modern berbasis **Laravel 11** yang dirancang khusus untuk toko online barang bekas, preloved, dan thrifting dengan transparansi kondisi barang 100%.

---

## 🌟 Fitur Utama

### 👥 Sisi Pengunjung (Public Storefront)
- **Katalog Barang Bekas Terorganisir**: Menampilkan produk berdasarkan kategori lengkap dengan indikator kondisi (`Seperti Baru`, `Sangat Baik`, `Layak Pakai`, `Pecah/Minus`).
- **Transparansi Catatan Minus (Defect)**: Memaparkan secara jujur kekurangan fisik/fungsional barang bekas pada kartu dan halaman detail produk.
- **Kalkulasi Persentase Hemat**: Membandingkan harga beli baru vs harga second untuk menampilkan persentase penghematan uang pengguna.
- **Watermark Terjual (Sold Out)**: Penanda visual otomatis untuk barang yang sudah terjual.
- **Alur Belanja & WhatsApp Checkout**: Keranjang belanja khusus barang bekas (1 item 1 unit) dengan pembuatan invoice otomatis dan penerusan rincian ke WhatsApp admin.
- **Artikel Edukasi Thrifting**: Panduan merawat barang preloved dan tips belanja hemat ramah lingkungan.
- **Mode Gelap (Dark Mode)**: Tampilan modern responsif dengan persistensi tema.

### 🛡️ Sisi Admin (Admin Panel)
- **Dashboard Ringkasan & Chart.js**: Visualisasi grafik interaktif untuk perbandingan stok (Tersedia vs Terjual), distribusi kategori, dan statistik kondisi barang.
- **Kelola Produk Bekas (CRUD)**: Manajemen data produk lengkap dengan field spesifik barang bekas (tingkat kondisi, catatan minus, kelengkapan unit, durasi pemakaian, kota pengiriman, dan upload foto).
- **Kelola Kategori (CRUD)**: Klasifikasi kategori produk dinamis dengan ikon Bootstrap.
- **Kelola Pesanan (Orders)**: Manajemen pesanan yang masuk melalui checkout web dengan status (*pending*, *confirmed*, *shipped*, *completed*, *cancelled*) serta tombol direct chat WhatsApp pelanggan.
- **Kelola Artikel (CRUD)**: Publikasi artikel edukatif bagi pembeli.

---

## 🛠️ Arsitektur & Teknologi

- **Framework**: Laravel 11.x (Clean MVC Architecture)
- **Database**: SQLite / MySQL (Eloquent ORM, Migrations, Seeders)
- **UI Framework**: Bootstrap 5.3, Bootstrap Icons, Google Fonts (Outfit)
- **Charts & UI**: Chart.js
- **Testing**: PHPUnit / Pest Feature Tests

---

## 🚀 Cara Menjalankan Proyek

1. **Clone repository**:
   ```bash
   git clone https://github.com/anasikhzf/secondhand-ecommerce-web.git
   cd secondhand-ecommerce-web
   ```

2. **Pasang Dependensi Composer**:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**:
   Salin berkas `.env.example` menjadi `.env` lalu generate key:
   ```bash
   php artisan key:generate
   ```

4. **Jalankan Migrasi & Seeder**:
   ```bash
   php artisan migrate --seed
   ```

5. **Jalankan Server Lokal**:
   ```bash
   php artisan serve
   ```
   Akses di browser: `http://localhost:8000`

---

## 🔑 Akun Default Admin Panel

- **URL Login**: `http://localhost:8000/admin/login`
- **Username**: `admin`
- **Password**: `12345`

---

## 🧪 Menjalankan Automated Tests

```bash
php artisan test
```
