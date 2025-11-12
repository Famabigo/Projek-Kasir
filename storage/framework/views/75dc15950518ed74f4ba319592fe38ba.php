
<?php $__env->startSection('title','Stok Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-8" style="background-color: #EDF7FC; min-height: 100vh;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Stok Barang</h2>
                <p class="text-gray-600 text-sm mt-1">Manajemen stok dan data produk</p>
            </div>
            <a href="<?php echo e(route('admin.barang.create')); ?>" class="text-white px-4 py-2 rounded-lg font-medium transition-opacity hover:opacity-90 flex items-center space-x-2" style="background-color: #0C5587;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span>Tambah Barang</span>
            </a>
        </div>

        <!-- Card Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga Beli</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga Jual</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Keuntungan</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3">
                                <span class="font-semibold text-sm" style="color: #0C5587;">#<?php echo e($b->id); ?></span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center space-x-3">
                                    <?php if($b->gambar): ?>
                                    <img src="<?php echo e(Storage::url($b->gambar)); ?>" alt="<?php echo e($b->nama_barang); ?>" class="h-10 w-10 rounded-lg object-cover border-2" style="border-color: #B1D7F2;">
                                    <?php else: ?>
                                    <div class="rounded-lg h-10 w-10 flex items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="font-medium text-sm text-gray-900"><?php echo e($b->nama_barang); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e($b->kategori); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <?php if($b->stok < 10): ?>
                                <span class="bg-red-100 text-red-800 px-2.5 py-1 rounded-full text-xs font-semibold"><?php echo e($b->stok); ?></span>
                                <?php else: ?>
                                <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs font-semibold"><?php echo e($b->stok); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-3">
                                <span class="text-sm text-gray-600">Rp <?php echo e(number_format($b->harga_beli,0,',','.')); ?></span>
                            </td>
                            <td class="px-6 py-3">
                                <span class="text-sm font-semibold text-green-600">Rp <?php echo e(number_format($b->harga_jual,0,',','.')); ?></span>
                            </td>
                            <td class="px-6 py-3">
                                <?php
                                    $profit = $b->harga_jual - $b->harga_beli;
                                    $margin = $b->harga_jual > 0 ? ($profit / $b->harga_jual * 100) : 0;
                                ?>
                                <div>
                                    <span class="text-sm font-semibold" style="color: #0C5587;">Rp <?php echo e(number_format($profit,0,',','.')); ?></span>
                                    <span class="text-xs text-gray-500 block">(<?php echo e(number_format($margin, 1)); ?>%)</span>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="<?php echo e(route('admin.barang.edit',$b)); ?>" class="p-2 rounded-lg transition-colors hover:bg-blue-50" title="Edit">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="<?php echo e(route('admin.barang.destroy',$b)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')" class="inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="p-2 rounded-lg transition-colors hover:bg-red-50" title="Hapus">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <p class="text-lg font-medium">Belum ada data barang</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?php echo e($barang->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/admin/barang/index.blade.php ENDPATH**/ ?>