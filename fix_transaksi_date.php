<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaksi;
use App\Models\Pesanan;

$transaksi = Transaksi::first();
$pesanan = Pesanan::first();

echo "Sebelum:\n";
echo "Transaksi created_at: {$transaksi->created_at}\n";
echo "Pesanan updated_at: {$pesanan->updated_at}\n\n";

$transaksi->created_at = $pesanan->updated_at;
$transaksi->updated_at = $pesanan->updated_at;
$transaksi->save();

echo "Sesudah:\n";
echo "Transaksi created_at: {$transaksi->created_at}\n";
echo "Update berhasil!\n";
