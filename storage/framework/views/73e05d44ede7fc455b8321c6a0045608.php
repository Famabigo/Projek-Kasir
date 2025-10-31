
<?php $__env->startSection('title','Detail Pesanan'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('pembeli.pesanan.index')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg hover:bg-white transition-colors space-x-2 mb-4" style="color: #0C5587;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-medium">Kembali ke Riwayat Pesanan</span>
        </a>
        <h1 class="text-3xl font-bold" style="color: #0C5587;">Detail Pesanan</h1>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6" style="color: #0C5587;">Status Pesanan</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-bold mb-2" style="color: #0884D1;"><?php echo e($pesanan->kode_pesanan); ?></p>
                        <p class="text-gray-600">Dipesan pada <?php echo e($pesanan->created_at->format('d M Y, H:i')); ?></p>
                    </div>
                    <div>
                        <span class="px-6 py-3 rounded-full text-lg font-semibold
                            <?php if($pesanan->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                            <?php elseif($pesanan->status == 'diproses'): ?> bg-blue-100 text-blue-800
                            <?php elseif($pesanan->status == 'siap_diambil'): ?> bg-green-100 text-green-800
                            <?php elseif($pesanan->status == 'selesai'): ?> bg-gray-100 text-gray-800
                            <?php else: ?> bg-red-100 text-red-800
                            <?php endif; ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $pesanan->status))); ?>

                        </span>
                    </div>
                </div>

                <?php if($pesanan->waktu_ambil): ?>
                    <div class="mt-6 p-4 rounded-lg" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                        <p class="text-sm text-gray-600 mb-1">Waktu Pengambilan</p>
                        <p class="text-xl font-bold" style="color: #0C5587;">
                            <?php echo e(\Carbon\Carbon::parse($pesanan->waktu_ambil)->format('d M Y, H:i')); ?>

                        </p>
                    </div>
                <?php endif; ?>

                <?php if($pesanan->catatan): ?>
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Catatan</p>
                        <p class="text-gray-800"><?php echo e($pesanan->catatan); ?></p>
                    </div>
                <?php endif; ?>

                <?php if($pesanan->status == 'pending'): ?>
                    <form action="<?php echo e(route('pembeli.pesanan.cancel', $pesanan->id)); ?>" method="POST" 
                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')" class="mt-6">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-colors shadow-md">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batalkan Pesanan
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Item Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6" style="color: #0C5587;">Item Pesanan</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center space-x-4 pb-4 border-b border-gray-200 last:border-0">
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0" style="background: linear-gradient(135deg, #EDF7FC 0%, #B1D7F2 100%);">
                                <?php if($detail->barang->gambar): ?>
                                    <img src="<?php echo e(asset('storage/'.$detail->barang->gambar)); ?>" alt="<?php echo e($detail->barang->nama_barang); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-800"><?php echo e($detail->barang->nama_barang); ?></h3>
                                <p class="text-gray-600"><?php echo e($detail->jumlah); ?> x Rp <?php echo e(number_format($detail->harga_satuan, 0, ',', '.')); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold" style="color: #0884D1;">
                                    Rp <?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold mb-6" style="color: #0C5587;">Ringkasan Pembayaran</h2>
                <div class="space-y-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Diskon</span>
                        <span>- Rp <?php echo e(number_format($pesanan->diskon, 0, ',', '.')); ?></span>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold" style="color: #0C5587;">Total</span>
                            <span class="text-2xl font-bold" style="color: #0884D1;">
                                Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-4 rounded-lg bg-gradient-to-r from-blue-50 to-green-50">
                    <p class="text-sm text-gray-700 mb-2">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <strong>Informasi:</strong>
                    </p>
                    <p class="text-sm text-gray-600">
                        Silakan ambil pesanan Anda di toko sesuai waktu yang telah dipilih. Jangan lupa bawa kode pesanan ini.
                    </p>
                </div>

                <a href="<?php echo e(route('pembeli.dashboard')); ?>" 
                    class="mt-6 w-full py-3 px-6 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center justify-center space-x-2 border-2"
                    style="border-color: #0C5587; color: #0C5587;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Belanja Lagi</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pembeli/pesanan/show.blade.php ENDPATH**/ ?>