
<?php $__env->startSection('title','Notifikasi Laporan'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold" style="color: #0C5587;">Notifikasi Laporan Barang</h2>
            <p class="text-gray-600 mt-2">Kelola laporan dari kasir tentang barang expired dan stok menipis</p>
        </div>

        <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-lg border-2 border-green-400 bg-green-50 text-green-800">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <!-- Card Table -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Kasir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Keterangan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50 <?php echo e($lap->status === 'pending' ? 'bg-yellow-50' : ''); ?>">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-800"><?php echo e($lap->created_at->format('d M Y')); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($lap->created_at->format('H:i')); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800"><?php echo e($lap->kasir->name); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800"><?php echo e($lap->barang->nama_barang); ?></div>
                                <div class="text-xs text-gray-500">
                                    Stok: <span class="font-semibold"><?php echo e($lap->barang->stok); ?></span>
                                    <?php if($lap->barang->expired_at): ?>
                                        | Expired: <?php echo e($lap->barang->expired_at->format('d M Y')); ?>

                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($lap->tipe === 'expired'): ?>
                                    <?php if($lap->barang->expired_at && $lap->barang->expired_at->isPast()): ?>
                                        <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-semibold whitespace-nowrap" style="background: #fee2e2; color: #991b1b;">
                                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Expired</span>
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-semibold whitespace-nowrap" style="background: #fef3c7; color: #92400e;">
                                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Akan Expired</span>
                                        </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-semibold whitespace-nowrap" style="background: #fed7aa; color: #9a3412;">
                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
                                        </svg>
                                        <span>Stok Menipis</span>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600"><?php echo e($lap->keterangan ?? '-'); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($lap->status === 'pending'): ?>
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-semibold flex items-center space-x-1 w-fit">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                        </svg>
                                        <span>Menunggu</span>
                                    </span>
                                <?php elseif($lap->status === 'dilihat'): ?>
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">Dilihat</span>
                                <?php else: ?>
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Selesai</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <?php if($lap->status === 'pending'): ?>
                                        <form action="<?php echo e(route('admin.notifikasi.update-status', $lap->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="dilihat">
                                            <button type="submit" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs font-medium transition-all">
                                                Tandai Dilihat
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <?php if($lap->status !== 'selesai'): ?>
                                        <form action="<?php echo e(route('admin.notifikasi.update-status', $lap->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-xs font-medium transition-all">
                                                Selesai
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <!-- Tombol untuk mengembalikan ke pending jika sudah selesai -->
                                        <form action="<?php echo e(route('admin.notifikasi.update-status', $lap->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-xs font-medium transition-all flex items-center space-x-1" title="Kembalikan ke pending (barang expired lagi)">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                <span>Reset</span>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo e(route('admin.barang.edit', $lap->barang_id)); ?>" class="px-3 py-1 rounded-lg text-xs font-medium transition-all" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%); color: white;">
                                        Edit Barang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">Belum ada laporan dari kasir</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if($laporans->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?php echo e($laporans->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/admin/notifikasi/index.blade.php ENDPATH**/ ?>