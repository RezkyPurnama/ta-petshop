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
        Schema::create('pethotels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('nomor_telepon');
            $table->string('nama_hewan');
            $table->string('jenis_hewan'); // Misalnya: Kucing, Anjing, dll
            $table->integer('jumlah_hewan');
            $table->string('ras_hewan')->nullable();
            $table->text('riwayat_sakit')->nullable();
            $table->string('status_vaksin')->nullable(); // Contoh: Sudah / Belum
            $table->string('umur_hewan')->nullable();
            $table->string('berat_hewan')->nullable();
            $table->enum('sertifikat_hewan', ['Ada', 'Tidak']);
            $table->date('check_in');
            $table->date('check_out');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pethotels');
    }
};
