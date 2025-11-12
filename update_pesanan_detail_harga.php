<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\PesananDetail;
use App\Models\Barang;

echo "🔄 Mengupdate harga_beli dan harga_jual di pesanan_details...\n\n";

$details = PesananDetail::with('barang')->get();

echo "📦 Ditemukan {$details->count()} detail pesanan\n\n";

$updated = 0;
foreach ($details as $detail) {
    if ($detail->barang) {
        $detail->harga_beli = $detail->barang->harga_beli;
        $detail->harga_jual = $detail->harga_satuan; // harga_satuan adalah harga jual
        $detail->save();
        
        $keuntungan = ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
        
        echo "✅ Pesanan Detail #{$detail->id} - {$detail->barang->nama_barang}\n";
        echo "   Harga Beli: Rp " . number_format($detail->harga_beli, 0, ',', '.') . "\n";
        echo "   Harga Jual: Rp " . number_format($detail->harga_jual, 0, ',', '.') . "\n";
        echo "   Jumlah: {$detail->jumlah}\n";
        echo "   Keuntungan: Rp " . number_format($keuntungan, 0, ',', '.') . "\n\n";
        
        $updated++;
    }
}

echo "✨ Selesai! {$updated} detail pesanan berhasil diupdate.\n";
