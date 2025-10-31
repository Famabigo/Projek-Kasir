
<?php $__env->startSection('title','Stok Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold" style="color: #0C5587;">Stok Barang</h2>
            <p class="text-gray-600 mt-2">Cek ketersediaan stok produk</p>
        </div>

        <!-- Success/Error Messages -->
        <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-lg border-2 flex items-center space-x-3 animate-slide-down" style="background: #C7E339; border-color: #0C5587;">
            <svg class="w-6 h-6 flex-shrink-0" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-semibold" style="color: #0C5587;"><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="mb-6 p-4 rounded-lg border-2 border-red-500 bg-red-50 flex items-center space-x-3 animate-slide-down">
            <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-semibold text-red-700"><?php echo e(session('error')); ?></span>
        </div>
        <?php endif; ?>

        <!-- Search Card -->
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
            <form method="GET" action="<?php echo e(route('kasir.stok.index')); ?>">
                <div class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Cari nama barang atau kategori..." class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-300 transition-all" style="border-color: #B1D7F2;" onfocus="this.style.borderColor='#0C5587'; this.style.outline='2px solid #EDF7FC'" onblur="this.style.borderColor='#B1D7F2'; this.style.outline='none'">
                    </div>
                    <button type="submit" class="text-white px-8 py-3 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);" onmouseover="this.style.background='linear-gradient(135deg, #0884D1 0%, #0C5587 100%)'" onmouseout="this.style.background='linear-gradient(135deg, #0C5587 0%, #0884D1 100%)'" >
                        <span>Cari</span>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Card Table -->
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);" class="border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Ukuran</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Expired</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50 transition-colors <?php echo e($b->expired_at && $b->expired_at->isPast() ? 'bg-red-50' : ''); ?>">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <?php if($b->gambar): ?>
                                    <img src="<?php echo e(Storage::url($b->gambar)); ?>" alt="<?php echo e($b->nama_barang); ?>" class="h-12 w-12 rounded-lg object-cover border-2" style="border-color: #B1D7F2;">
                                    <?php else: ?>
                                    <div class="rounded-lg h-12 w-12 flex items-center justify-center text-white" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="font-medium text-gray-800"><?php echo e($b->nama_barang); ?></div>
                                        <?php if($b->expired_at && $b->expired_at->isPast()): ?>
                                        <span class="inline-block bg-red-100 text-red-800 text-xs font-bold px-2 py-0.5 rounded mt-1">EXPIRED</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($b->kategori ?? '-'); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($b->ukuran ?? '-'); ?></td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-green-600">Rp <?php echo e(number_format($b->harga_jual, 0, ',', '.')); ?></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($b->stok < 10): ?>
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold"><?php echo e($b->stok); ?></span>
                                <?php else: ?>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold"><?php echo e($b->stok); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <?php if($b->expired_at): ?>
                                    <?php if($b->expired_at->isPast()): ?>
                                    <span class="text-red-600 font-semibold"><?php echo e($b->expired_at->format('d M Y')); ?></span>
                                    <?php elseif($b->expired_at->diffInDays() < 90): ?>
                                    <span class="text-orange-600 font-semibold"><?php echo e($b->expired_at->format('d M Y')); ?></span>
                                    <div class="text-xs text-orange-600 mt-1">(<?php echo e($b->expired_at->diffInDays()); ?> hari lagi)</div>
                                    <?php else: ?>
                                    <span class="text-gray-700"><?php echo e($b->expired_at->format('d M Y')); ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php
                                    $perluLapor = false;
                                    $tipeLapor = '';
                                    
                                    // Cek apakah perlu lapor
                                    if ($b->stok < 10) {
                                        $perluLapor = true;
                                        $tipeLapor = 'stok_menipis';
                                    } elseif ($b->expired_at && ($b->expired_at->isPast() || $b->expired_at->diffInDays() < 90)) {
                                        $perluLapor = true;
                                        $tipeLapor = 'expired';
                                    }
                                    
                                    // Cek apakah sudah dilaporkan dengan status pending
                                    $sudahDilaporkan = \App\Models\LaporanBarang::where('barang_id', $b->id)
                                        ->where('tipe', $tipeLapor)
                                        ->where('status', 'pending')
                                        ->exists();
                                ?>
                                
                                <?php if($perluLapor): ?>
                                    <?php if($sudahDilaporkan): ?>
                                        <div class="px-3 py-2 rounded-lg text-xs font-medium flex items-center space-x-1 mx-auto justify-center"
                                            style="background: #C7E339; color: #0C5587;">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>Sudah Dilaporkan</span>
                                        </div>
                                    <?php else: ?>
                                        <button onclick="openLaporModal(<?php echo e($b->id); ?>, '<?php echo e(addslashes($b->nama_barang)); ?>', '<?php echo e($tipeLapor); ?>')" 
                                            class="px-3 py-2 rounded-lg text-white text-xs font-medium transition-all hover:shadow-lg flex items-center space-x-1 mx-auto"
                                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            <span>Laporkan</span>
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-gray-400 text-sm">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data barang</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?php echo e($barang->appends(['search' => $search])->links()); ?>

            </div>
        </div>

        <!-- Legend -->
        <div class="mt-6 flex flex-wrap gap-6">
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-green-100 border-2 border-green-500 rounded"></div>
                <span class="text-sm text-gray-700">Stok Cukup (≥10)</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-red-100 border-2 border-red-500 rounded"></div>
                <span class="text-sm text-gray-700">Stok Menipis (&lt;10)</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-red-50 border-2 border-red-300 rounded"></div>
                <span class="text-sm text-gray-700">Produk Expired</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-4 h-4 bg-orange-100 border-2 border-orange-500 rounded"></div>
                <span class="text-sm text-gray-700">Akan Expired (&lt;3 bulan)</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal Laporan -->
<div id="laporModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold" style="color: #0C5587;">Laporkan Barang ke Admin</h3>
        </div>
        <form action="<?php echo e(route('kasir.laporan-barang.store')); ?>" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="barang_id" id="modal_barang_id">
            <input type="hidden" name="tipe" id="modal_tipe">
            
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Barang</label>
                <input type="text" id="modal_barang_nama" readonly class="w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Masalah</label>
                <input type="text" id="modal_masalah" readonly class="w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" rows="3" class="w-full px-4 py-2 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all" style="border-color: #B1D7F2;" placeholder="Tambahkan catatan jika diperlukan"></textarea>
            </div>

            <div class="flex items-center space-x-3">
                <button type="submit" class="flex-1 px-4 py-3 rounded-lg text-white font-bold transition-all" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                    Kirim Laporan
                </button>
                <button type="button" onclick="closeLaporModal()" class="px-4 py-3 rounded-lg border-2 font-bold transition-all" style="border-color: #B1D7F2; color: #0C5587;">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openLaporModal(barangId, barangNama, tipe) {
    document.getElementById('modal_barang_id').value = barangId;
    document.getElementById('modal_barang_nama').value = barangNama;
    document.getElementById('modal_tipe').value = tipe;
    document.getElementById('modal_masalah').value = tipe === 'expired' ? 'Barang Expired / Akan Expired' : 'Stok Menipis';
    document.getElementById('laporModal').classList.remove('hidden');
    document.getElementById('laporModal').classList.add('flex');
}

function closeLaporModal() {
    document.getElementById('laporModal').classList.add('hidden');
    document.getElementById('laporModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('laporModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLaporModal();
    }
});

// Auto hide success/error messages after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.animate-slide-down');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.remove();
        }, 500);
    });
}, 5000);
</script>

<style>
@keyframes slideDown {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-slide-down {
    animation: slideDown 0.3s ease-out;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/kasir/stok/index.blade.php ENDPATH**/ ?>