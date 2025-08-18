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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_pemilik');
            $table->string('nomor_telepon');
            $table->string('nama_hewan');
            $table->string('jenis_hewan'); // Misalnya: Kucing, Anjing, dll
            $table->text('riwayat_sakit')->nullable();
            $table->string('umur_hewan')->nullable();
            $table->string('berat_hewan')->nullable();
            $table->string('tipe_room')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['booking', 'checkin', 'selesai', 'cancel'])->default('booking');
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
