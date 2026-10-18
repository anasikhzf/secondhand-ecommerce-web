<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('original_price', 12, 2)->nullable(); // Estimasi harga baru
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('image')->nullable();
            $table->enum('product_condition', ['Pecah/Minus', 'Layak Pakai', 'Sangat Baik', 'Seperti Baru'])->default('Layak Pakai');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->text('defect')->nullable(); // Catatan cacat/minus barang bekas
            $table->string('completeness')->nullable(); // Kelengkapan (Fullset, Batangan, dll)
            $table->string('usage_duration')->nullable(); // Pemakaian (misal: 6 Bulan, 1 Tahun)
            $table->string('seller_city')->default('Jakarta'); // Lokasi barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
