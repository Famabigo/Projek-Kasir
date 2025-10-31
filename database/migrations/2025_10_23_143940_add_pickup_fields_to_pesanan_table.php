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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dateTime('jadwal_ambil')->nullable()->after('waktu_ambil');
            $table->dateTime('tanggal_diambil')->nullable()->after('jadwal_ambil');
            $table->integer('hari_telat')->default(0)->after('tanggal_diambil');
            $table->decimal('denda_telat', 10, 2)->default(0)->after('hari_telat');
            $table->text('keterangan_telat')->nullable()->after('denda_telat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['jadwal_ambil', 'tanggal_diambil', 'hari_telat', 'denda_telat', 'keterangan_telat']);
        });
    }
};
