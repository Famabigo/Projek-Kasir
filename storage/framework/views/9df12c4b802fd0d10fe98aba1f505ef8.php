
<?php $__env->startSection('title','Detail Transaksi'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Detail Transaksi</h2>
                <a href="<?php echo e(route('kasir.transaksi.cetak-struk', $transaksi)); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    📄 Cetak Struk
                </a>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Tanggal</p>
                    <p class="font-semibold"><?php echo e($transaksi->created_at->format('d M Y H:i')); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kasir</p>
                    <p class="font-semibold"><?php echo e($transaksi->kasir->name ?? '-'); ?></p>
                </div>
                <?php if($transaksi->member): ?>
                <div>
                    <p class="text-sm text-gray-600">Member</p>
                    <p class="font-semibold"><?php echo e($transaksi->member->name); ?> (<?php echo e($transaksi->member->kode_member); ?>)</p>
                </div>
                <?php endif; ?>
                <?php if($transaksi->metode_pembayaran): ?>
                <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-semibold"><?php echo e($transaksi->metode_pembayaran); ?></p>
                </div>
                <?php endif; ?>
            </div>
            
            <h3 class="font-bold text-lg mb-4">Item Barang</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $transaksi->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-4 py-2"><?php echo e($d->barang->nama_barang); ?></td>
                            <td class="px-4 py-2"><?php echo e($d->jumlah); ?></td>
                            <td class="px-4 py-2">Rp <?php echo e(number_format($d->harga_satuan, 0, ',', '.')); ?></td>
                            <td class="px-4 py-2">Rp <?php echo e(number_format($d->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 border-t pt-4">
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>Rp <?php echo e(number_format($transaksi->total_harga + $transaksi->diskon, 0, ',', '.')); ?></span>
                </div>
                <?php if($transaksi->diskon > 0): ?>
                <div class="flex justify-between mb-2 text-red-600">
                    <span>Diskon</span>
                    <span>- Rp <?php echo e(number_format($transaksi->diskon, 0, ',', '.')); ?></span>
                </div>
                <?php endif; ?>
                <div class="flex justify-between text-xl font-bold border-t pt-2">
                    <span>TOTAL</span>
                    <span>Rp <?php echo e(number_format($transaksi->total_harga, 0, ',', '.')); ?></span>
                </div>
            </div>
            
            <div class="mt-6 flex gap-3">
                <a href="<?php echo e(route('kasir.transaksi.create')); ?>" 
                   class="flex-1 inline-flex items-center justify-center px-6 py-3 rounded-lg font-semibold text-white transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                   style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Transaksi Baru
                </a>
                <a href="<?php echo e(route('kasir.transaksi.index')); ?>" 
                   class="flex-1 inline-flex items-center justify-center px-6 py-3 border-2 rounded-lg font-semibold transition-all duration-200 hover:shadow-md"
                   style="border-color: #0C5587; color: #0C5587;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Daftar Transaksi
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/kasir/transaksi/show.blade.php ENDPATH**/ ?>