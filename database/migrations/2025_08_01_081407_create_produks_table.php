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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id')->nullable(); // FK ke categori
            $table->string('kode_produk')->unique();
            $table->string('nama_produk');
            $table->decimal('harga', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->string('gambar_produk')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
