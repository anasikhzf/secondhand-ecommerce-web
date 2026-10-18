<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Second Store',
                'email' => 'admin@secondstore.id',
                'password' => Hash::make('12345'),
            ]
        );

        // 2. Categories
        $categoriesData = [
            ['name' => 'Elektronik & Gadget', 'slug' => 'elektronik-gadget', 'icon' => 'bi-laptop'],
            ['name' => 'Fashion & Pakaian', 'slug' => 'fashion-pakaian', 'icon' => 'bi-bag'],
            ['name' => 'Buku & Majalah', 'slug' => 'buku-majalah', 'icon' => 'bi-book'],
            ['name' => 'Furniture & Rumah', 'slug' => 'furniture-rumah', 'icon' => 'bi-house-heart'],
            ['name' => 'Mainan & Hobi', 'slug' => 'mainan-hobi', 'icon' => 'bi-controller'],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::updateOrCreate(['slug' => $c['slug']], $c);
        }

        // 3. Secondhand Products
        $productsData = [
            [
                'name' => 'Laptop Acer Aspire 5 Intel Core i5',
                'slug' => 'laptop-acer-aspire-5-i5',
                'description' => 'Laptop 14 inci dengan prosesor Intel Core i5 Gen 11, RAM 8GB, SSD 512GB NVMe. Baterai masih prima tahan 3-4 jam.',
                'price' => 5500000,
                'original_price' => 8999000,
                'category_id' => $categories['elektronik-gadget']->id,
                'image' => 'images/product/product_1.jpg',
                'product_condition' => 'Sangat Baik',
                'status' => 'available',
                'defect' => 'Lecet halus pemakaian pada body bagian bawah. Layar jernih bebas dead pixel, keyboard dan trackpad 100% responsif.',
                'completeness' => 'Unit Laptop + Charger Original + Bonus Sleeve Case',
                'usage_duration' => '10 Bulan',
                'seller_city' => 'Jakarta Selatan',
            ],
            [
                'name' => 'Kaos Oversize Uniqlo Hitam Polos',
                'slug' => 'kaos-oversize-uniqlo-hitam',
                'description' => 'Kaos katun combed 30s premium lembut dan adem. Ukuran L fitting santai.',
                'price' => 75000,
                'original_price' => 199000,
                'category_id' => $categories['fashion-pakaian']->id,
                'image' => 'images/product/product_2.jpg',
                'product_condition' => 'Seperti Baru',
                'status' => 'available',
                'defect' => 'Tidak ada defect/noda, warna hitam masih pekat, kerah kencang.',
                'completeness' => 'Hanya Pakaian (Sudah dicuci bersih & disetrika uap)',
                'usage_duration' => 'Baru dipakai 2x',
                'seller_city' => 'Bandung',
            ],
            [
                'name' => 'Novel Fiksi Fantasi Petualangan Best Seller',
                'slug' => 'novel-fiksi-fantasi-petualangan',
                'description' => 'Buku novel terjemahan tebal 480 halaman, kertas bookpaper nyaman untuk dibaca santai.',
                'price' => 65000,
                'original_price' => 125000,
                'category_id' => $categories['buku-majalah']->id,
                'image' => 'images/product/product_3.jpg',
                'product_condition' => 'Layak Pakai',
                'status' => 'available',
                'defect' => 'Kertas pinggir sedikit menguning alami, ada bekas lipatan kecil pada halaman cover depan.',
                'completeness' => 'Buku + Pembatas Buku Original',
                'usage_duration' => 'Koleksi Pribadi 2 Tahun',
                'seller_city' => 'Yogyakarta',
            ],
            [
                'name' => 'Meja Kerja Minimalis Kayu Industrial',
                'slug' => 'meja-kerja-minimalis-industrial',
                'description' => 'Meja kerja kokoh dengan kaki besi hollow hitam dan top table multiplex finishing serat kayu jati elegan ukuran 120x60 cm.',
                'price' => 1200000,
                'original_price' => 2100000,
                'category_id' => $categories['furniture-rumah']->id,
                'image' => 'images/product/product_4.jpg',
                'product_condition' => 'Sangat Baik',
                'status' => 'available',
                'defect' => 'Ada goresan halus di pojok kanan bawah permukaan meja, struktur besi sangat kokoh tanpa goyang.',
                'completeness' => 'Unit Meja siap pakai (Bisa bongkar pasang)',
                'usage_duration' => '7 Bulan',
                'seller_city' => 'Tangerang',
            ],
            [
                'name' => 'Set Mainan Lego City Original 300+ Pcs',
                'slug' => 'set-mainan-lego-city-original',
                'description' => 'Set Lego seri penjelajah kota seru untuk mengasah kreativitas anak dan kolektor.',
                'price' => 350000,
                'original_price' => 699000,
                'category_id' => $categories['mainan-hobi']->id,
                'image' => 'images/product/product_5.jpg',
                'product_condition' => 'Seperti Baru',
                'status' => 'available',
                'defect' => 'Kardus luar agak penyok saat penyimpanan, isi part lego 100% lengkap berserta buku panduan.',
                'completeness' => 'Box, Manual Book, 300 Pcs Brick + Minifigure',
                'usage_duration' => 'Hanya dirakit 1x lalu disimpan',
                'seller_city' => 'Surabaya',
            ],
            [
                'name' => 'Smartphone Samsung Galaxy A14 4G 128GB',
                'slug' => 'samsung-galaxy-a14-4g-128gb',
                'description' => 'Layar FHD+ 6.6 inci, baterai awet 5000mAh, kamera jernih 50MP triple lens.',
                'price' => 2200000,
                'original_price' => 2799000,
                'category_id' => $categories['elektronik-gadget']->id,
                'image' => 'images/product/product_6.jpg',
                'product_condition' => 'Sangat Baik',
                'status' => 'sold',
                'defect' => 'Baret halus pemakaian wajar di backdoor, layar mulus terpasang tempered glass. Charger bawaan tidak ada.',
                'completeness' => 'Unit HP + Dus Box Original (Tanpa Kepala Charger)',
                'usage_duration' => '8 Bulan',
                'seller_city' => 'Jakarta Barat',
            ],
            [
                'name' => 'Jaket Hoodie Fleece Tebal Streetwear',
                'slug' => 'jaket-hoodie-fleece-streetwear',
                'description' => 'Hoodie hangat bahan cotton fleece tebal warna navy, cocok untuk riding atau hangout malam.',
                'price' => 150000,
                'original_price' => 350000,
                'category_id' => $categories['fashion-pakaian']->id,
                'image' => 'images/product/product_7.jpg',
                'product_condition' => 'Layak Pakai',
                'status' => 'available',
                'defect' => 'Warna sedikit pudar karena pencucian rutin, tali hoodie sudah diganti tali katun baru.',
                'completeness' => 'Hanya Hoodie',
                'usage_duration' => '1.5 Tahun',
                'seller_city' => 'Malang',
            ],
        ];

        foreach ($productsData as $prod) {
            Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }

        // 4. Secondhand & Thrifting Blogs
        $blogsData = [
            [
                'title' => 'Panduan Aman Beli Gadget & Laptop Bekas Berkualitas',
                'slug' => 'panduan-aman-beli-gadget-laptop-bekas',
                'category' => 'Tips Belanja Cerdas',
                'content' => 'Membeli gadget bekas atau second membutuhkan ketelitian. Pastikan untuk selalu mengecek kondisi battery health, layar dari kemungkinan dead pixel, tombol fisik, port pengisian daya, serta keaslian nomor IMEI / serial number. Meminta riwayat pemakaian dan catatan defect yang jujur dari penjual adalah langkah penting agar transaksi aman.',
                'image' => 'images/blog_1.jpg',
            ],
            [
                'title' => 'Cara Merawat Baju Thrifting Agar Tampak Seperti Baru',
                'slug' => 'cara-merawat-baju-thrifting-tampak-seperti-baru',
                'category' => 'Perawatan Pakaian',
                'content' => 'Setelah membeli pakaian bekas pilihan Anda, rendam pakaian dengan air hangat bersuhu sekitar 40 derajat celcius dan cairan antiseptik pakaian selama 15 menit. Cuci bersih menggunakan deterjen lembut, jemur di tempat teduh, lalu lakukan setrika uap untuk mengembalikan serat kain agar kembali rapi dan nyaman dipakai.',
                'image' => 'images/blog_2.jpg',
            ],
            [
                'title' => 'Mengapa Belanja Barang Bekas Bagus untuk Lingkungan dan Dompet',
                'slug' => 'mengapa-belanja-barang-bekas-bagus-untuk-lingkungan',
                'category' => 'Gaya Hidup Hijau',
                'content' => 'Membeli barang preloved bukan sekadar menghemat pengeluaran hingga 60%, melainkan kontribusi nyata terhadap kelestarian bumi. Dengan memperpanjang siklus hidup sebuah barang, kita mengurangi jejak karbon manufaktur baru serta menekan timbunan sampah elektronik dan tekstil di tempat pembuangan akhir.',
                'image' => 'images/blog_3.jpg',
            ],
            [
                'title' => 'Cek Kondisi Fisik Furniture Preloved Sebelum Beli',
                'slug' => 'cek-kondisi-fisik-furniture-preloved',
                'category' => 'Tips Rumah',
                'content' => 'Furniture kayu bekas seringkali menawarkan material kayu solid berkualitas tinggi yang jarang ditemukan pada produk massal zaman sekarang. Periksa sambungan engsel, pastikan tidak ada rayap, dan pertimbangkan untuk memberikan lapisan varnish ulang agar furniture terlihat segar kembali.',
                'image' => 'images/blog_4.jpg',
            ],
            [
                'title' => 'Tips Menemukan Hobi & Koleksi Mainan Retro Idaman',
                'slug' => 'tips-menemukan-hobi-koleksi-mainan-retro',
                'category' => 'Hobi & Koleksi',
                'content' => 'Berburu action figure, lego, atau diecast preloved adalah seni tersendiri bagi para kolektor. Selalu verifikasi kelengkapan aksesoris, tanyakan apakah ada part yang patah atau rekondisi, serta manfaatkan platform terpercaya dengan foto detail nyata.',
                'image' => 'images/blog_5.jpg',
            ],
        ];

        foreach ($blogsData as $blog) {
            Blog::updateOrCreate(['slug' => $blog['slug']], $blog);
        }
    }
}
