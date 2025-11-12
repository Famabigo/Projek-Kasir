
<?php $__env->startSection('title','Riwayat Transaksi'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Riwayat Transaksi</h2>
                <p class="text-gray-600 mt-2">Semua transaksi online dan offline</p>
            </div>
            <a href="<?php echo e(route('kasir.transaksi.create')); ?>" 
               class="inline-flex items-center px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
               style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Transaksi Baru
            </a>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-2 inline-flex gap-2">
                <a href="<?php echo e(route('kasir.transaksi.index', ['filter' => 'all'])); ?>" 
                   class="px-6 py-2 rounded-md font-medium transition-all duration-200 <?php echo e($filter === 'all' ? 'text-white shadow-md' : 'text-gray-600 hover:bg-gray-100'); ?>"
                   style="<?php echo e($filter === 'all' ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : ''); ?>">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        Semua
                    </span>
                </a>
                <a href="<?php echo e(route('kasir.transaksi.index', ['filter' => 'online'])); ?>" 
                   class="px-6 py-2 rounded-md font-medium transition-all duration-200 relative <?php echo e($filter === 'online' ? 'text-white shadow-md' : 'text-gray-600 hover:bg-gray-100'); ?>"
                   style="<?php echo e($filter === 'online' ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : ''); ?>">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        Pesanan Online
                        <?php
                            $pesananMenunggu = \App\Models\Pesanan::where('status', 'menunggu')->count();
                        ?>
                        <?php if($pesananMenunggu > 0): ?>
                        <span class="bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold animate-pulse">
                            <?php echo e($pesananMenunggu); ?>

                        </span>
                        <?php endif; ?>
                    </span>
                </a>
                <a href="<?php echo e(route('kasir.transaksi.index', ['filter' => 'offline'])); ?>" 
                   class="px-6 py-2 rounded-md font-medium transition-all duration-200 <?php echo e($filter === 'offline' ? 'text-white shadow-md' : 'text-gray-600 hover:bg-gray-100'); ?>"
                   style="<?php echo e($filter === 'offline' ? 'background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);' : ''); ?>">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Pembelian Offline
                    </span>
                </a>
            </div>
        </div>

        <!-- Transaksi Offline -->
        <?php if($filter === 'all' || $filter === 'offline'): ?>
        <?php if($transaksi->count() > 0): ?>
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4" style="color: #0C5587;">
                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Pembelian Offline (<?php echo e($transaksi->count()); ?>)
            </h3>
            <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kasir</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Diskon</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-lg" style="color: #0C5587;">#<?php echo e($index + 1); ?></span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <?php echo e($t->created_at->format('d M Y')); ?><br>
                                    <span class="text-xs text-gray-500"><?php echo e($t->created_at->format('H:i')); ?></span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($t->kasir->name ?? '-'); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <?php if($t->member): ?>
                                    <span class="px-2 py-1 rounded text-xs font-medium text-white" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        <?php echo e($t->member->name); ?>

                                    </span>
                                    <?php else: ?>
                                    <span class="text-gray-400">Non-Member</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-green-600">Rp <?php echo e(number_format($t->total_harga, 0, ',', '.')); ?></span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <?php if($t->diskon > 0): ?>
                                    <span class="text-red-600">- Rp <?php echo e(number_format($t->diskon, 0, ',', '.')); ?></span>
                                    <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="<?php echo e(route('kasir.transaksi.show', $t->id)); ?>" 
                                       class="inline-flex items-center px-4 py-2 rounded-lg font-medium text-white transition-all duration-200 hover:shadow-md"
                                       style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Pesanan Online -->
        <?php if($filter === 'all' || $filter === 'online'): ?>
        <?php if($pesanan->count() > 0): ?>
        <div>
            <h3 class="text-xl font-semibold mb-4" style="color: #0C5587;">
                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
                Pesanan Online (<?php echo e($pesanan->count()); ?>)
            </h3>
            <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode Pesanan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Detail</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Waktu Pesan</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $pesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <span class="font-semibold" style="color: #0C5587;"><?php echo e($p->kode_pesanan); ?></span>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo e($p->user->name); ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <?php if($p->status === 'menunggu'): ?>
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>
                                <?php elseif($p->status === 'diproses'): ?>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Diproses</span>
                                <?php elseif($p->status === 'siap_diambil'): ?>
                                    <?php if($p->metode_pengiriman === 'delivery'): ?>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">🚚 Sedang Diantar</span>
                                    <?php else: ?>
                                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">Siap Diambil</span>
                                    <?php endif; ?>
                                    <?php
                                        $p->updateDenda();
                                    ?>
                                    <?php if($p->metode_pengiriman === 'pickup' && $p->isTelat()): ?>
                                        <div class="mt-1">
                                            <span class="bg-red-100 text-red-800 px-2 py-0.5 rounded text-xs font-medium">⚠️ Telat <?php echo e($p->hari_telat); ?> hari</span>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif($p->status === 'selesai'): ?>
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                                    <?php if($p->denda_telat > 0): ?>
                                        <div class="mt-1 text-xs text-red-600">Denda: Rp <?php echo e(number_format($p->denda_telat, 0, ',', '.')); ?></div>
                                    <?php endif; ?>
                                <?php elseif($p->status === 'dibatalkan'): ?>
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">Dibatalkan</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="text-gray-700"><?php echo e($p->details->count()); ?> item</div>
                                <?php if($p->waktu_ambil): ?>
                                    <div class="text-xs font-medium text-blue-600">Ambil: <?php echo e($p->waktu_ambil->format('d M, H:i')); ?></div>
                                <?php endif; ?>
                                <?php if($p->jadwal_ambil): ?>
                                    <div class="text-xs text-gray-500">Siap: <?php echo e($p->jadwal_ambil->format('d M, H:i')); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-green-600">Rp <?php echo e(number_format($p->total_bayar,0,',','.')); ?></span>
                                <?php if($p->denda_telat > 0): ?>
                                    <div class="text-xs text-red-600 mt-1">+ Denda: Rp <?php echo e(number_format($p->denda_telat, 0, ',', '.')); ?></div>
                                    <div class="text-xs font-semibold text-gray-700 mt-1">Total: Rp <?php echo e(number_format($p->total_bayar + $p->denda_telat, 0, ',', '.')); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($p->created_at->format('d M Y H:i')); ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="showDetailModal(<?php echo e($p->id); ?>)" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>Detail</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Empty State untuk All -->
        <?php if($filter === 'all' && $pesanan->count() === 0 && $transaksi->count() === 0): ?>
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 p-12 text-center">
            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Transaksi</p>
            <p class="text-gray-500 mb-6">Mulai buat transaksi baru untuk pembeli</p>
            <a href="<?php echo e(route('kasir.transaksi.create')); ?>" 
               class="inline-flex items-center px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
               style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Transaksi Baru
            </a>
        </div>
        <?php endif; ?>

        <!-- Empty State untuk Online -->
        <?php if($filter === 'online' && $pesanan->count() === 0): ?>
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 p-12 text-center">
            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
            </svg>
            <p class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Pesanan Online</p>
            <p class="text-gray-500">Pesanan dari pembeli akan muncul di sini</p>
        </div>
        <?php endif; ?>

        <!-- Empty State untuk Offline -->
        <?php if($filter === 'offline' && $transaksi->count() === 0): ?>
        <div class="card-hover bg-white rounded-xl shadow-lg border border-gray-100 p-12 text-center">
            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Transaksi Offline</p>
            <p class="text-gray-500 mb-6">Mulai buat transaksi baru untuk pembeli offline</p>
            <a href="<?php echo e(route('kasir.transaksi.create')); ?>" 
               class="inline-flex items-center px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
               style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Transaksi Baru
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Detail Pesanan -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 text-white px-6 py-4 flex items-center justify-between" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
            <h3 class="text-xl font-bold">Detail Pesanan</h3>
            <button onclick="closeDetailModal()" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="p-6">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
    async function showDetailModal(pesananId) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modalContent.innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-b-2 mx-auto" style="border-color: #0C5587;"></div><p class="mt-4 text-gray-500">Memuat...</p></div>';
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/detail`);
            const data = await response.json();
            
            // Debug: Lihat data yang diterima
            console.log('Data pesanan:', data.pesanan);
            console.log('Denda telat:', data.pesanan.denda_telat);
            console.log('Total bayar:', data.pesanan.total_bayar);
            console.log('Is telat:', data.pesanan.is_telat);
            
            let itemsHtml = '';
            data.details.forEach(item => {
                itemsHtml += `
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">${item.barang.nama_barang}</p>
                            <p class="text-sm text-gray-500">${item.jumlah} x Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                        </div>
                        <p class="font-semibold text-gray-800">Rp ${parseInt(item.subtotal).toLocaleString('id-ID')}</p>
                    </div>
                `;
            });
            
            let statusBadge = '';
            if (data.pesanan.status === 'menunggu') {
                statusBadge = '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Menunggu</span>';
            } else if (data.pesanan.status === 'diproses') {
                statusBadge = '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Diproses</span>';
            } else if (data.pesanan.status === 'siap_diambil') {
                if (data.pesanan.metode_pengiriman === 'delivery') {
                    statusBadge = '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">🚚 Sedang Diantar</span>';
                } else {
                    statusBadge = '<span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Siap Diambil</span>';
                }
            } else if (data.pesanan.status === 'selesai') {
                statusBadge = '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Selesai</span>';
            } else if (data.pesanan.status === 'dibatalkan') {
                statusBadge = '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">Dibatalkan</span>';
            }
            
            modalContent.innerHTML = `
                <div class="space-y-6">
                    <!-- Info Pesanan -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Pesanan</p>
                            <p class="font-bold text-lg" style="color: #0C5587;">${data.pesanan.kode_pesanan}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <div class="mt-1">${statusBadge}</div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pembeli</p>
                            <p class="font-medium text-gray-800">${data.pesanan.user.name}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Metode Pengiriman</p>
                            ${data.pesanan.metode_pengiriman === 'pickup' ? 
                                '<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">📦 Ambil di Toko</span>' : 
                                '<span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">🚚 Diantar</span>'
                            }
                        </div>
                    </div>

                    ${data.pesanan.metode_pengiriman === 'delivery' ? `
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-green-800 mb-2">📍 Informasi Pengiriman:</p>
                        <div class="space-y-1 text-sm text-green-700">
                            <p><strong>Alamat:</strong> ${data.pesanan.alamat_pengiriman || '-'}</p>
                            <p><strong>No. HP:</strong> ${data.pesanan.no_hp_pengiriman || '-'}</p>
                            <p><strong>Ongkir:</strong> Rp ${parseFloat(data.pesanan.ongkir).toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                    ` : ''}

                    ${data.pesanan.catatan ? `
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-blue-800 mb-1">Catatan:</p>
                        <p class="text-sm text-blue-700">${data.pesanan.catatan}</p>
                    </div>
                    ` : ''}

                    <!-- Items -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">Detail Produk</h4>
                        <div class="space-y-2">
                            ${itemsHtml}
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t-2 border-gray-300 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp ${parseInt(data.pesanan.total_harga).toLocaleString('id-ID')}</span>
                        </div>
                        ${data.pesanan.diskon > 0 ? `
                        <div class="flex justify-between items-center mb-2 text-green-600">
                            <span>Diskon</span>
                            <span>- Rp ${parseInt(data.pesanan.diskon).toLocaleString('id-ID')}</span>
                        </div>
                        ` : ''}
                        <div class="flex justify-between items-center text-lg font-bold" style="color: #0C5587;">
                            <span>Total Bayar</span>
                            <span>Rp ${parseInt(data.pesanan.total_bayar).toLocaleString('id-ID')}</span>
                        </div>
                    </div>

                    ${data.pesanan.tanggal_diambil ? `
                    <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="font-semibold text-green-800">Barang Sudah Diambil</p>
                                <p class="text-green-700 text-sm">${data.pesanan.tanggal_diambil_formatted}</p>
                                ${data.pesanan.denda_telat > 0 ? `
                                <p class="text-red-700 text-sm mt-1">Denda keterlambatan: Rp ${parseInt(data.pesanan.denda_telat).toLocaleString('id-ID')}</p>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                    ` : ''}

                    <!-- Actions -->
                    ${data.pesanan.status === 'menunggu' ? `
                    <div class="flex space-x-3">
                        <button onclick="updateStatus(${data.pesanan.id}, 'diproses')" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors">
                            Proses Pesanan
                        </button>
                        <button onclick="updateStatus(${data.pesanan.id}, 'dibatalkan')" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-medium transition-colors">
                            Batalkan
                        </button>
                    </div>
                    ` : ''}
                    
                    ${data.pesanan.status === 'diproses' ? `
                    <div class="space-y-3">
                        ${data.pesanan.metode_pengiriman === 'pickup' ? `
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-sm text-yellow-800 mb-3"><strong>Pilih Jadwal Pengambilan</strong></p>
                            <select id="jadwalAmbil${data.pesanan.id}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">-- Pilih Waktu Pengambilan --</option>
                                <option value="30min">30 Menit Lagi</option>
                                <option value="1hour">1 Jam Lagi</option>
                                <option value="2hours">2 Jam Lagi</option>
                                <option value="3hours">3 Jam Lagi</option>
                                <option value="tomorrow">Besok (Jam yang Sama)</option>
                            </select>
                        </div>
                        <button onclick="setJadwalAmbil(${data.pesanan.id})" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-medium transition-colors">
                            📅 Set Jadwal & Siap Diambil
                        </button>
                        ` : `
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-sm text-green-800 mb-2">📦 Pesanan siap untuk dikirim</p>
                            <p class="text-xs text-green-700">Klik tombol di bawah untuk menandai pesanan sedang dalam pengiriman</p>
                        </div>
                        <button onclick="updateStatusDelivery(${data.pesanan.id})" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors">
                            🚚 Kirim Pesanan Sekarang
                        </button>
                        `}
                    </div>
                    ` : ''}
                    
                    ${data.pesanan.status === 'siap_diambil' ? `
                    <div class="space-y-3">
                        ${data.pesanan.metode_pengiriman === 'pickup' ? `
                            ${data.pesanan.is_telat ? `
                            <div class="bg-red-50 border-2 border-red-300 rounded-lg p-4">
                                <p class="text-red-800 font-semibold mb-2">⚠️ Pesanan Terlambat ${data.pesanan.hari_telat} Hari</p>
                                <p class="text-red-700 text-sm">Denda: <strong>Rp ${parseFloat(data.pesanan.denda_telat).toLocaleString('id-ID')}</strong></p>
                                <p class="text-red-600 text-xs mt-2">Total yang harus dibayar: <strong>Rp ${(parseFloat(data.pesanan.total_bayar) + parseFloat(data.pesanan.denda_telat)).toLocaleString('id-ID')}</strong></p>
                            </div>
                            ` : `
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                <p class="text-green-800 text-sm">✅ Pesanan tepat waktu, tidak ada denda</p>
                            </div>
                            `}
                            <button onclick="konfirmasiPengambilan(${data.pesanan.id})" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors">
                                Konfirmasi Pengambilan Barang
                            </button>
                        ` : `
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-blue-800 text-sm">🚚 Pesanan sedang dalam perjalanan</p>
                            </div>
                            <button onclick="konfirmasiPengambilan(${data.pesanan.id})" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors">
                                ✓ Konfirmasi Pesanan Sudah Diterima
                            </button>
                        `}
                    </div>
                    ` : ''}
                </div>
            `;
        } catch (error) {
            modalContent.innerHTML = '<div class="text-center py-8 text-red-500">Gagal memuat data pesanan</div>';
        }
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    async function updateStatus(pesananId, status) {
        if (!confirm(`Yakin ingin mengubah status pesanan menjadi ${status}?`)) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ status: status })
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Status pesanan berhasil diupdate');
                location.reload();
            } else {
                alert(result.message || 'Gagal mengubah status');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }

    async function updateStatusDelivery(pesananId) {
        if (!confirm('Yakin ingin mengirim pesanan ini ke pelanggan? Pastikan pesanan sudah siap dikirim.')) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ status: 'siap_diambil' })
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('✅ Pesanan berhasil ditandai sedang dikirim!');
                location.reload();
            } else {
                alert(result.message || 'Gagal mengubah status');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }

    async function setJadwalAmbil(pesananId) {
        const jadwalInput = document.getElementById(`jadwalAmbil${pesananId}`);
        const jadwalOption = jadwalInput.value;
        
        if (!jadwalOption) {
            alert('Silakan pilih jadwal pengambilan terlebih dahulu');
            return;
        }
        
        // Konversi pilihan ke datetime
        const now = new Date();
        let jadwalDate;
        
        switch(jadwalOption) {
            case '30min':
                jadwalDate = new Date(now.getTime() + 30 * 60000);
                break;
            case '1hour':
                jadwalDate = new Date(now.getTime() + 60 * 60000);
                break;
            case '2hours':
                jadwalDate = new Date(now.getTime() + 2 * 60 * 60000);
                break;
            case '3hours':
                jadwalDate = new Date(now.getTime() + 3 * 60 * 60000);
                break;
            case 'tomorrow':
                jadwalDate = new Date(now.getTime() + 24 * 60 * 60000);
                break;
            default:
                alert('Pilihan tidak valid');
                return;
        }
        
        // Format ke Y-m-d H:i:s untuk backend
        const jadwal = jadwalDate.getFullYear() + '-' + 
                      String(jadwalDate.getMonth() + 1).padStart(2, '0') + '-' + 
                      String(jadwalDate.getDate()).padStart(2, '0') + ' ' + 
                      String(jadwalDate.getHours()).padStart(2, '0') + ':' + 
                      String(jadwalDate.getMinutes()).padStart(2, '0') + ':00';
        
        if (!confirm('Set jadwal pengambilan dan ubah status menjadi "Siap Diambil"?')) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/set-jadwal-ambil`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ jadwal_ambil: jadwal })
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Jadwal pengambilan berhasil diatur!');
                location.reload();
            } else {
                alert(result.message || 'Gagal mengatur jadwal');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }

    async function konfirmasiPengambilan(pesananId) {
        if (!confirm('Konfirmasi bahwa barang sudah diambil oleh pembeli?')) return;
        
        try {
            const response = await fetch(`/kasir/pesanan/${pesananId}/konfirmasi-pengambilan`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                let message = result.message;
                if (result.denda > 0) {
                    message += `\n\nDenda keterlambatan: Rp ${parseInt(result.denda).toLocaleString('id-ID')}`;
                    message += `\nTerlambat: ${result.hari_telat} hari`;
                }
                alert(message);
                location.reload();
            } else {
                alert(result.message || 'Gagal mengkonfirmasi pengambilan');
            }
        } catch (error) {
            alert('Terjadi kesalahan');
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/kasir/transaksi/index.blade.php ENDPATH**/ ?>