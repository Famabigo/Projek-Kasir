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
        Schema::create('laporan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->enum('tipe', ['expired', 'stok_menipis']); // Tipe laporan
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'dilihat', 'selesai'])->default('pending');
            $table->timestamp('dibaca_at')->nullable(); // Kapan admin baca
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_barang');
    }
};
