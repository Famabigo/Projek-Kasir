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
        Schema::table('barang', function (Blueprint $table) {
            $table->decimal('harga_beli', 12, 2)->default(0)->after('harga');
            // Rename harga to harga_jual
            $table->renameColumn('harga', 'harga_jual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->renameColumn('harga_jual', 'harga');
            $table->dropColumn('harga_beli');
        });
    }
};
