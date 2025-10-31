<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->enum('metode_pengiriman', ['pickup', 'delivery'])->default('pickup')->after('metode_pembayaran');
            $table->text('alamat_pengiriman')->nullable()->after('metode_pengiriman');
            $table->string('no_hp_pengiriman', 20)->nullable()->after('alamat_pengiriman');
            $table->decimal('ongkir', 10, 2)->default(0)->after('no_hp_pengiriman');
            $table->text('catatan')->nullable()->after('ongkir');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['metode_pengiriman', 'alamat_pengiriman', 'no_hp_pengiriman', 'ongkir', 'catatan']);
        });
    }
};
