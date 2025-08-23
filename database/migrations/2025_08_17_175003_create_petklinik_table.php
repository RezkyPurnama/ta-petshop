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
        Schema::create('petklinik', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_pemilik');
            $table->string('nama_hewan');
            $table->enum('jenis_hewan', ['Anjing', 'Kucing','lainnya']);
            $table->enum('vaksinasi', ['Ya', 'Tidak']);
            $table->integer('umur_hewan')->nullable();
            $table->string('berat');
            $table->date('tanggal_kunjungan');
            $table->enum('status', ['booking', 'progres', 'selesai','cancel'])->default('booking');
            $table->text('keluhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petklinik');
    }
};
