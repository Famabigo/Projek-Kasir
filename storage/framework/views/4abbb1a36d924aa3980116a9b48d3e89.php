
<?php $__env->startSection('title','Riwayat Pesanan'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold" style="color: #0C5587;">Riwayat Pesanan Saya</h1>
        <p class="text-gray-600 mt-2">Lihat semua pesanan yang pernah Anda buat</p>
    </div>

    <!-- Quick Filter Tabs -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="<?php echo e(route('pembeli.pesanan.index')); ?>" 
                class="px-4 py-2 rounded-lg font-medium transition-all <?php echo e(!request()->anyFilled(['status', 'dari_tanggal', 'sampai_tanggal']) ? 'text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>"
                style="<?php echo e(!request()->anyFilled(['status', 'dari_tanggal', 'sampai_tanggal']) ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : ''); ?>">
                Semua
            </a>
            <a href="<?php echo e(route('pembeli.pesanan.index', ['status' => 'pending'])); ?>" 
                class="px-4 py-2 rounded-lg font-medium transition-all <?php echo e(request('status') == 'pending' ? 'bg-yellow-100 text-yellow-800 border-2 border-yellow-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                Menunggu
            </a>
            <a href="<?php echo e(route('pembeli.pesanan.index', ['status' => 'diproses'])); ?>" 
                class="px-4 py-2 rounded-lg font-medium transition-all <?php echo e(request('status') == 'diproses' ? 'bg-blue-100 text-blue-800 border-2 border-blue-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                Diproses
            </a>
            <a href="<?php echo e(route('pembeli.pesanan.index', ['status' => 'selesai'])); ?>" 
                class="px-4 py-2 rounded-lg font-medium transition-all <?php echo e(request('status') == 'selesai' ? 'bg-green-100 text-green-800 border-2 border-green-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                Selesai
            </a>
            <a href="<?php echo e(route('pembeli.pesanan.index', ['status' => 'dibatalkan'])); ?>" 
                class="px-4 py-2 rounded-lg font-medium transition-all <?php echo e(request('status') == 'dibatalkan' ? 'bg-red-100 text-red-800 border-2 border-red-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                Dibatalkan
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-lg" style="color: #0C5587;">Filter Lanjutan</h3>
            <button type="button" onclick="toggleFilter()" class="text-sm font-medium" style="color: #0884D1;">
                <span id="filterToggleText">Tampilkan</span>
                <svg id="filterToggleIcon" class="w-4 h-4 inline transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
        <form method="GET" action="<?php echo e(route('pembeli.pesanan.index')); ?>" id="advancedFilter" class="grid grid-cols-1 md:grid-cols-4 gap-4 hidden">
            <!-- Filter Status -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Status</label>
                <select name="status" class="w-full px-4 py-2 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500" style="border-color: #B1D7F2;">
                    <option value="">Semua Status</option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Menunggu</option>
                    <option value="diproses" <?php echo e(request('status') == 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                    <option value="selesai" <?php echo e(request('status') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                    <option value="dibatalkan" <?php echo e(request('status') == 'dibatalkan' ? 'selected' : ''); ?>>Dibatalkan</option>
                </select>
            </div>

            <!-- Filter Tanggal Dari -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Dari Tanggal</label>
                <input type="date" name="dari_tanggal" value="<?php echo e(request('dari_tanggal')); ?>" 
                    class="w-full px-4 py-2 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    style="border-color: #B1D7F2;">
            </div>

            <!-- Filter Tanggal Sampai -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" value="<?php echo e(request('sampai_tanggal')); ?>" 
                    class="w-full px-4 py-2 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    style="border-color: #B1D7F2;">
            </div>

            <!-- Tombol Filter -->
            <div class="flex items-end space-x-2">
                <button type="submit" 
                    class="flex-1 px-4 py-2 rounded-lg text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center"
                    style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <?php if(request()->anyFilled(['status', 'dari_tanggal', 'sampai_tanggal'])): ?>
                    <a href="<?php echo e(route('pembeli.pesanan.index')); ?>" 
                        class="px-4 py-2 rounded-lg border-2 font-semibold hover:bg-gray-50 transition-colors"
                        style="border-color: #B1D7F2; color: #0C5587;">
                        Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>

        <!-- Summary Info -->
        <?php if(request()->anyFilled(['status', 'dari_tanggal', 'sampai_tanggal'])): ?>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold" style="color: #0C5587;"><?php echo e($pesanans->total()); ?> pesanan</span>
                    <?php if(request('status')): ?>
                        dengan status <span class="font-semibold"><?php echo e(ucfirst(request('status'))); ?></span>
                    <?php endif; ?>
                    <?php if(request('dari_tanggal')): ?>
                        dari <span class="font-semibold"><?php echo e(\Carbon\Carbon::parse(request('dari_tanggal'))->format('d M Y')); ?></span>
                    <?php endif; ?>
                    <?php if(request('sampai_tanggal')): ?>
                        sampai <span class="font-semibold"><?php echo e(\Carbon\Carbon::parse(request('sampai_tanggal'))->format('d M Y')); ?></span>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?>

    <?php if($pesanans->count() > 0): ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold mb-2" style="color: #0C5587;">
                                    <?php echo e($pesanan->kode_pesanan); ?>

                                </h3>
                                <p class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Dipesan: <?php echo e($pesanan->created_at->format('d M Y, H:i')); ?>

                                </p>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    <?php if($pesanan->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                                    <?php elseif($pesanan->status == 'diproses'): ?> bg-blue-100 text-blue-800
                                    <?php elseif($pesanan->status == 'siap_diambil'): ?> bg-green-100 text-green-800
                                    <?php elseif($pesanan->status == 'selesai'): ?> bg-gray-100 text-gray-800
                                    <?php else: ?> bg-red-100 text-red-800
                                    <?php endif; ?>">
                                    <?php if($pesanan->status == 'siap_diambil'): ?>
                                        <?php if($pesanan->metode_pengiriman === 'delivery'): ?>
                                            🚚 Sedang Diantar
                                        <?php else: ?>
                                            Siap Diambil
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e(ucfirst(str_replace('_', ' ', $pesanan->status))); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 mb-4">
                            <p class="text-sm text-gray-600 mb-2">Item pesanan:</p>
                            <div class="space-y-2">
                                <?php $__currentLoopData = $pesanan->details->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-700"><?php echo e($detail->jumlah); ?>x <?php echo e($detail->barang->nama_barang); ?></span>
                                        <span class="font-semibold" style="color: #0884D1;">Rp <?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($pesanan->details->count() > 3): ?>
                                    <p class="text-sm text-gray-500">dan <?php echo e($pesanan->details->count() - 3); ?> item lainnya</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">Total Pembayaran</p>
                                <p class="text-2xl font-bold" style="color: #0C5587;">
                                    Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?>

                                </p>
                                <?php if($pesanan->denda_telat > 0): ?>
                                    <p class="text-sm text-red-600 mt-1">+ Denda: Rp <?php echo e(number_format($pesanan->denda_telat, 0, ',', '.')); ?></p>
                                    <p class="text-sm font-semibold text-gray-700">Total: Rp <?php echo e(number_format($pesanan->getTotalDenganDenda(), 0, ',', '.')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('pembeli.pesanan.show', $pesanan->id)); ?>" 
                                    class="px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all border-2"
                                    style="border-color: #0C5587; color: #0C5587;">
                                    Lihat Detail
                                </a>
                                <?php if($pesanan->status == 'pending'): ?>
                                    <form action="<?php echo e(route('pembeli.pesanan.cancel', $pesanan->id)); ?>" method="POST" 
                                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-colors shadow-md">
                                            Batalkan
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-8">
            <?php echo e($pesanans->links()); ?>

        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-md p-16">
            <div class="text-center">
                <div class="mb-6 flex justify-center">
                    <div class="w-32 h-32 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold mb-3" style="color: #0C5587;">Belum Ada Pesanan</h2>
                <p class="text-gray-600 mb-8">Anda belum pernah membuat pesanan. Yuk, mulai belanja!</p>
                <a href="<?php echo e(route('pembeli.dashboard')); ?>" 
                    class="inline-flex items-center px-8 py-4 rounded-lg text-white font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 space-x-2"
                    style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Mulai Belanja</span>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function toggleFilter() {
        const filter = document.getElementById('advancedFilter');
        const icon = document.getElementById('filterToggleIcon');
        const text = document.getElementById('filterToggleText');
        
        if (filter.classList.contains('hidden')) {
            filter.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
            text.textContent = 'Sembunyikan';
        } else {
            filter.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
            text.textContent = 'Tampilkan';
        }
    }

    // Auto show filter if any advanced filter is active
    document.addEventListener('DOMContentLoaded', function() {
        const hasAdvancedFilter = <?php echo e(request()->anyFilled(['dari_tanggal', 'sampai_tanggal']) ? 'true' : 'false'); ?>;
        if (hasAdvancedFilter) {
            toggleFilter();
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pembeli/pesanan/index.blade.php ENDPATH**/ ?>