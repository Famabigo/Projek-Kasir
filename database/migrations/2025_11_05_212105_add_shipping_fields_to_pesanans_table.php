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
            $table->enum('metode_pengiriman', ['pickup', 'delivery'])->default('pickup')->after('catatan');
            $table->text('alamat_pengiriman')->nullable()->after('metode_pengiriman');
            $table->string('no_hp_pengiriman')->nullable()->after('alamat_pengiriman');
            $table->decimal('ongkir', 12, 2)->default(0)->after('no_hp_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['metode_pengiriman', 'alamat_pengiriman', 'no_hp_pengiriman', 'ongkir']);
        });
    }
};
