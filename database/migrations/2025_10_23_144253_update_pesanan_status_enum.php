<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah 'menunggu' ke enum dulu
        DB::statement("ALTER TABLE `pesanans` MODIFY `status` ENUM('pending', 'menunggu', 'diproses', 'siap_diambil', 'selesai', 'dibatalkan') DEFAULT 'pending'");
        
        // Update existing 'pending' to 'menunggu'
        DB::table('pesanans')->where('status', 'pending')->update(['status' => 'menunggu']);
        
        // Hapus 'pending' dari enum
        DB::statement("ALTER TABLE `pesanans` MODIFY `status` ENUM('menunggu', 'diproses', 'siap_diambil', 'selesai', 'dibatalkan') DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambah 'pending' ke enum dulu
        DB::statement("ALTER TABLE `pesanans` MODIFY `status` ENUM('pending', 'menunggu', 'diproses', 'siap_diambil', 'selesai', 'dibatalkan') DEFAULT 'menunggu'");
        
        // Revert 'menunggu' back to 'pending'
        DB::table('pesanans')->where('status', 'menunggu')->update(['status' => 'pending']);
        
        // Hapus 'menunggu' dari enum
        DB::statement("ALTER TABLE `pesanans` MODIFY `status` ENUM('pending', 'diproses', 'siap_diambil', 'selesai', 'dibatalkan') DEFAULT 'pending'");
    }
};
