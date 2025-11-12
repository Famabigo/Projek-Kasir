<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Pesanan;
use App\Models\User;

// Get first kasir for default assignment
$kasir = User::where('role', 'kasir')->first();

if (!$kasir) {
    echo "❌ Tidak ada user dengan role kasir!\n";
    exit(1);
}

echo "🔄 Mengupdate pesanan yang belum memiliki kasir...\n\n";

$pesananTanpaKasir = Pesanan::whereNull('kasir_id')->get();

echo "📦 Ditemukan {$pesananTanpaKasir->count()} pesanan tanpa kasir\n";

foreach ($pesananTanpaKasir as $pesanan) {
    $pesanan->kasir_id = $kasir->id;
    $pesanan->save();
    
    echo "✅ Pesanan {$pesanan->kode_pesanan} - Kasir: {$kasir->name}\n";
}

echo "\n✨ Selesai! Semua pesanan sudah memiliki kasir yang bertanggung jawab.\n";
