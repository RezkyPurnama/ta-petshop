<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->integer('berat')->nullable()->after('jumlah');       // berat per item dalam gram
            $table->integer('total_berat')->nullable()->after('totalharga'); // berat total (berat * jumlah)
        });
    }

    public function down(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropColumn(['berat', 'total_berat']);
        });
    }
};
