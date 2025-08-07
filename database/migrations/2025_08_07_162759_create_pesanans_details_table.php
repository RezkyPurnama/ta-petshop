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
        Schema::create('pesanans_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');     // Relasi ke tabel orders
            $table->unsignedBigInteger('produk_id');    // Relasi ke tabel produks
            $table->integer('jumlah')->default(1);      // Jumlah produk
            $table->decimal('harga_satuan', 10, 2);     // Harga per item
            $table->decimal('total_harga', 10, 2);      // harga_satuan * jumlah
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pesanan_id')->references('id')->on('pesanans')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans_details');
    }
};
