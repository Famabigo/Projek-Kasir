<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

echo "=== GENERATE TRANSAKSI DARI PESANAN SELESAI ===\n\n";

// Cari semua pesanan yang sudah selesai
$pesanansSelesai = Pesanan::where('status', 'selesai')->get();

echo "Ditemukan {$pesanansSelesai->count()} pesanan dengan status 'selesai'\n\n";

$created = 0;
$skipped = 0;

foreach ($pesanansSelesai as $pesanan) {
    echo "Processing Pesanan #{$pesanan->id}...\n";
    
    // Cek apakah transaksi sudah ada (berdasarkan total dan waktu yang mirip)
    $existingTransaksi = Transaksi::where('total_harga', $pesanan->total_bayar)
        ->where('metode_pembayaran', 'Online')
        ->whereDate('created_at', $pesanan->updated_at->format('Y-m-d'))
        ->first();
    
    if ($existingTransaksi) {
        echo "  ⚠️  Transaksi sudah ada (ID: {$existingTransaksi->id}), skip...\n";
        $skipped++;
        continue;
    }
    
    DB::beginTransaction();
    try {
        // Hitung keuntungan
        $totalKeuntungan = 0;
        foreach ($pesanan->details as $detail) {
            $barang = Barang::find($detail->barang_id);
            $keuntunganItem = ($barang->harga_jual - $barang->harga_beli) * $detail->jumlah;
            $totalKeuntungan += $keuntunganItem;
        }
        
        echo "  Total Keuntungan: Rp " . number_format($totalKeuntungan, 0, ',', '.') . "\n";
        
        // Buat transaksi baru dengan kasir_id = 2 (default kasir)
        $transaksi = Transaksi::create([
            'kasir_id' => 2, // ID kasir default
            'member_id' => null,
            'total_harga' => $pesanan->total_bayar,
            'diskon' => $pesanan->diskon,
            'keuntungan' => $totalKeuntungan,
            'metode_pembayaran' => 'Online',
            'created_at' => $pesanan->updated_at, // Gunakan waktu pesanan diselesaikan
            'updated_at' => $pesanan->updated_at,
        ]);
        
        echo "  ✅ Transaksi #{$transaksi->id} dibuat\n";
        
        // Buat transaksi detail
        foreach ($pesanan->details as $detail) {
            $barang = Barang::find($detail->barang_id);
            
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $detail->barang_id,
                'jumlah' => $detail->jumlah,
                'harga_beli' => $barang->harga_beli,
                'harga_jual' => $barang->harga_jual,
                'harga_satuan' => $detail->harga_satuan,
                'subtotal' => $detail->subtotal,
            ]);
            
            echo "    - {$barang->nama_barang}: {$detail->jumlah} pcs\n";
        }
        
        DB::commit();
        $created++;
        echo "  ✅ Selesai!\n\n";
        
    } catch (\Exception $e) {
        DB::rollback();
        echo "  ❌ Error: " . $e->getMessage() . "\n\n";
    }
}

echo "\n=== RINGKASAN ===\n";
echo "Transaksi dibuat: {$created}\n";
echo "Dilewati: {$skipped}\n";
echo "\nSelesai!\n";
