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
        Schema::create('groomings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_pemilik');
            $table->string('nomor_telepon');
            $table->string('nama_hewan');
            $table->string('jenis_hewan'); // Kucing, Anjing, dll
            $table->integer('umur_hewan'); // dalam bulan atau tahun
            $table->decimal('berat_hewan', 5, 2); // kg
            $table->text('riwayat_sakit')->nullable();
            $table->string('layanan_grooming'); // Basic Grooming, Full Grooming, dll
            $table->date('tanggal_booking');
            $table->time('jam_booking');
            $table->enum('status', ['booking', 'progres', 'selesai', 'cancel'])->default('booking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groomings');
    }
};
