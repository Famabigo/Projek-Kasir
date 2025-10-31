<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kode_pesanan')->unique();
            $table->decimal('total_harga', 12, 2);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2);
            $table->enum('status', ['pending', 'diproses', 'siap_diambil', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamp('waktu_ambil')->nullable();
            $table->timestamps();
        });

        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan_details');
        Schema::dropIfExists('pesanans');
    }
};
