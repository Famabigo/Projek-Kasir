<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\Barang;

echo "=== CEK PESANAN DAN TRANSAKSI ===\n\n";

$pesanans = Pesanan::all();
echo "Total Pesanan: " . $pesanans->count() . "\n";

foreach ($pesanans as $p) {
    echo "\n--- Pesanan #{$p->id} ---\n";
    echo "Status: {$p->status}\n";
    echo "Pembeli ID: {$p->pembeli_id}\n";
    echo "Total: Rp " . number_format($p->total_bayar, 0, ',', '.') . "\n";
    echo "Diskon: Rp " . number_format($p->diskon, 0, ',', '.') . "\n";
    echo "Created: {$p->created_at}\n";
    echo "Updated: {$p->updated_at}\n";
    
    echo "Detail Items:\n";
    foreach ($p->details as $detail) {
        $barang = Barang::find($detail->barang_id);
        echo "  - {$barang->nama_barang}: {$detail->jumlah} x Rp " . number_format($detail->harga_satuan, 0, ',', '.') . " = Rp " . number_format($detail->subtotal, 0, ',', '.') . "\n";
        echo "    Harga Beli: Rp " . number_format($barang->harga_beli, 0, ',', '.') . "\n";
        echo "    Harga Jual: Rp " . number_format($barang->harga_jual, 0, ',', '.') . "\n";
        $profit = ($barang->harga_jual - $barang->harga_beli) * $detail->jumlah;
        echo "    Profit: Rp " . number_format($profit, 0, ',', '.') . "\n";
    }
}

echo "\n\n=== CEK TRANSAKSI ===\n";
$transaksis = Transaksi::all();
echo "Total Transaksi: " . $transaksis->count() . "\n";

if ($transaksis->count() > 0) {
    foreach ($transaksis as $t) {
        echo "\n--- Transaksi #{$t->id} ---\n";
        echo "Kasir ID: {$t->kasir_id}\n";
        echo "Total: Rp " . number_format($t->total_harga, 0, ',', '.') . "\n";
        echo "Keuntungan: Rp " . number_format($t->keuntungan, 0, ',', '.') . "\n";
        echo "Metode: {$t->metode_pembayaran}\n";
        echo "Created: {$t->created_at}\n";
    }
} else {
    echo "Tidak ada transaksi.\n";
}
