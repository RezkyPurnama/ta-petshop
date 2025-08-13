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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->string('trx_id'); // Kolom tambahan untuk ID transaksi
            $table->string('nama_penerima');
            $table->text('alamat'); // Alamat pengiriman
            $table->string('telepon'); // Nomor telepon
            $table->integer('jumlah')->default(1); // Jumlah produk
            $table->decimal('totalharga', 10, 2); // Total harga pesanan
            $table->enum('status', ['sedang_diproses', 'dalam_perjalanan', 'selesai', 'cancel','belum_bayar',])->default('belum_bayar'); // Status pesanan
            $table->date('tgl_pesanan'); // Tanggal pesanan

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
