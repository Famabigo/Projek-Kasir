<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 11px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #0C5587;
            padding-bottom: 10px;
        }
        .header h2 { 
            color: #0C5587;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        .summary { 
            margin: 20px 0;
            padding: 15px;
            background: #EDF7FC;
            border-left: 4px solid #0C5587;
            border-radius: 5px;
        }
        .summary p {
            margin: 8px 0;
            color: #333;
        }
        .summary strong {
            color: #0C5587;
        }
        table { 
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #B1D7F2;
            padding: 10px 8px;
            text-align: left;
        }
        th { 
            background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);
            color: #0C5587;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #EDF7FC;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px solid #B1D7F2;
            text-align: right;
            color: #666;
            font-size: 10px;
        }
        .filter-info {
            margin: 15px 0;
            padding: 10px;
            background: #FFF8DC;
            border-left: 4px solid #FFA500;
            border-radius: 3px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENJUALAN</h2>
        <p><strong>ShopEase Kasir</strong></p>
        <p>Periode: <?php echo e(\Carbon\Carbon::parse($tanggalMulai)->format('d M Y')); ?> - <?php echo e(\Carbon\Carbon::parse($tanggalAkhir)->format('d M Y')); ?></p>
    </div>
    
    <?php if(($filterMetode ?? 'all') !== 'all' || $filterPembeli !== 'all' || $barang): ?>
    <div class="filter-info">
        <strong>Filter yang diterapkan:</strong><br>
        <?php if(($filterMetode ?? 'all') === 'online'): ?>
        - Metode Pembelian: Pembelian Online<br>
        <?php elseif(($filterMetode ?? 'all') === 'offline'): ?>
        - Metode Pembelian: Pembelian Offline<br>
        <?php endif; ?>
        <?php if($filterPembeli === 'member'): ?>
        - Tipe Pembeli: Hanya Member<br>
        <?php elseif($filterPembeli === 'non-member'): ?>
        - Tipe Pembeli: Hanya Non-Member<br>
        <?php endif; ?>
        <?php if($barang): ?>
        - Produk: <?php echo e($barang->nama_barang); ?><br>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <div class="summary">
        <p><strong>Total Transaksi:</strong> <?php echo e($transaksi->count()); ?> transaksi</p>
        <p><strong>Total Pendapatan:</strong> Rp <?php echo e(number_format($totalOmset, 0, ',', '.')); ?></p>
        <p><strong>Total Keuntungan:</strong> Rp <?php echo e(number_format($totalKeuntungan, 0, ',', '.')); ?></p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">Metode</th>
                <th style="width: 12%;">ID/Kode</th>
                <th style="width: 16%;">Tanggal</th>
                <th style="width: 14%;">Kasir</th>
                <th style="width: 14%;">Pembeli</th>
                <th style="width: 14%;" class="text-right">Total</th>
                <th style="width: 10%;" class="text-right">Diskon</th>
                <th style="width: 12%;" class="text-right">Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isPesanan = isset($item->user);
                // Hitung keuntungan untuk pesanan online
                $keuntungan = 0;
                if ($isPesanan) {
                    foreach ($item->details as $detail) {
                        $keuntungan += ($detail->harga_jual - $detail->harga_beli) * $detail->jumlah;
                    }
                } else {
                    $keuntungan = $item->keuntungan;
                }
            ?>
            <tr>
                <td>
                    <?php if($isPesanan): ?>
                        <strong style="color: #22c55e;">Online</strong>
                    <?php else: ?>
                        <strong style="color: #3b82f6;">Offline</strong>
                    <?php endif; ?>
                </td>
                <td>
                    <strong style="color: #0C5587;">
                        <?php if($isPesanan): ?>
                            <?php echo e($item->kode_pesanan); ?>

                        <?php else: ?>
                            #T-<?php echo e($item->id); ?>

                        <?php endif; ?>
                    </strong>
                </td>
                <td><?php echo e($item->created_at->format('d M Y H:i')); ?></td>
                <td>
                    <?php echo e($item->kasir->name ?? '-'); ?>

                </td>
                <td>
                    <?php if($isPesanan): ?>
                        <?php echo e($item->user->name ?? '-'); ?>

                    <?php else: ?>
                        <?php echo e($item->member->name ?? 'Non-Member'); ?>

                    <?php endif; ?>
                </td>
                <td class="text-right">
                    <strong>Rp <?php echo e(number_format($isPesanan ? $item->total_bayar : $item->total_harga, 0, ',', '.')); ?></strong>
                </td>
                <td class="text-right">Rp <?php echo e(number_format($item->diskon ?? 0, 0, ',', '.')); ?></td>
                <td class="text-right" style="color: #0C5587;">
                    <strong>Rp <?php echo e(number_format($keuntungan, 0, ',', '.')); ?></strong>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr style="background: #EDF7FC; font-weight: bold;">
                <td colspan="5" style="text-align: right; color: #0C5587;">TOTAL:</td>
                <td class="text-right" style="color: #0C5587;">Rp <?php echo e(number_format($totalOmset, 0, ',', '.')); ?></td>
                <td class="text-right">-</td>
                <td class="text-right" style="color: #0C5587;">Rp <?php echo e(number_format($totalKeuntungan, 0, ',', '.')); ?></td>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: <?php echo e(now()->format('d M Y H:i')); ?></p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem</p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\kasir\resources\views/admin/laporan/pdf.blade.php ENDPATH**/ ?>