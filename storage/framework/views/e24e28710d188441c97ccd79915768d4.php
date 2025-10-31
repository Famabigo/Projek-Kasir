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
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENJUALAN</h2>
        <p><strong>Market Kasir</strong></p>
        <p>Periode: <?php echo e(\Carbon\Carbon::parse($tanggalMulai)->format('d M Y')); ?> - <?php echo e(\Carbon\Carbon::parse($tanggalAkhir)->format('d M Y')); ?></p>
    </div>
    
    <div class="summary">
        <p><strong>Total Transaksi:</strong> <?php echo e($transaksi->count()); ?> transaksi</p>
        <p><strong>Total Pendapatan:</strong> Rp <?php echo e(number_format($totalOmset, 0, ',', '.')); ?></p>
        <p><strong>Total Keuntungan:</strong> Rp <?php echo e(number_format($totalKeuntungan, 0, ',', '.')); ?></p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 18%;">Tanggal</th>
                <th style="width: 15%;">Kasir</th>
                <th style="width: 15%;">Member</th>
                <th style="width: 16%;" class="text-right">Total Harga</th>
                <th style="width: 12%;" class="text-right">Diskon</th>
                <th style="width: 16%;" class="text-right">Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong style="color: #0C5587;">#<?php echo e($t->id); ?></strong></td>
                <td><?php echo e($t->created_at->format('d M Y H:i')); ?></td>
                <td><?php echo e($t->kasir->name ?? '-'); ?></td>
                <td><?php echo e($t->member->nama_member ?? '-'); ?></td>
                <td class="text-right"><strong>Rp <?php echo e(number_format($t->total_harga, 0, ',', '.')); ?></strong></td>
                <td class="text-right">Rp <?php echo e(number_format($t->diskon, 0, ',', '.')); ?></td>
                <td class="text-right" style="color: #0C5587;"><strong>Rp <?php echo e(number_format($t->keuntungan, 0, ',', '.')); ?></strong></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr style="background: #EDF7FC; font-weight: bold;">
                <td colspan="4" style="text-align: right; color: #0C5587;">TOTAL:</td>
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