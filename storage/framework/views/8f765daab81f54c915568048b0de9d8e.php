
<?php $__env->startSection('title', 'Detail Produk'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6" style="background-color: #EDF7FC; min-height: 100vh;">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="<?php echo e(route('pembeli.dashboard')); ?>" class="inline-flex items-center px-3 py-2 rounded-lg bg-white hover:bg-gray-50 transition-colors space-x-2 text-sm" style="color: #0C5587;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-medium">Kembali</span>
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <?php echo e(session('error')); ?>

            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Product Image -->
        <div class="bg-white rounded-lg p-6">
            <div class="aspect-square rounded-lg overflow-hidden bg-gray-50">
                <?php if($barang->gambar): ?>
                    <img src="<?php echo e(asset('storage/'.$barang->gambar)); ?>" alt="<?php echo e($barang->nama_barang); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Details -->
        <div class="bg-white rounded-lg p-6">
            <div class="mb-4">
                <!-- Stock Badge -->
                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full <?php echo e($barang->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                    <?php echo e($barang->stok > 0 ? 'Tersedia' : 'Stok Habis'); ?>

                </span>
            </div>

            <!-- Product Name -->
            <h1 class="text-2xl font-bold mb-3 text-gray-900">
                <?php echo e($barang->nama_barang); ?>

            </h1>

            <!-- Price -->
            <div class="mb-4">
                <p class="text-3xl font-bold" style="color: #0C5587;">
                    Rp <?php echo e(number_format($barang->harga_jual, 0, ',', '.')); ?>

                </p>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

            <!-- Product Details -->
            <div class="space-y-3 mb-6">
                <?php if($barang->ukuran): ?>
                <div class="flex items-center justify-between text-sm bg-gray-50 rounded-lg p-3 border border-gray-200">
                    <span class="text-gray-500 font-medium">Ukuran / Kemasan</span>
                    <span class="font-semibold text-gray-900"><?php echo e($barang->ukuran); ?></span>
                </div>
                <?php endif; ?>

                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Stok</span>
                    <span class="font-medium text-gray-900"><?php echo e($barang->stok); ?> unit</span>
                </div>
                
                <?php if($barang->kategori): ?>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Kategori</span>
                    <span class="font-medium text-gray-900"><?php echo e($barang->kategori); ?></span>
                </div>
                <?php endif; ?>

                <?php if($barang->expired_at): ?>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Kadaluarsa</span>
                    <span class="font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($barang->expired_at)->format('d M Y')); ?></span>
                </div>
                <?php endif; ?>
            </div>

            <?php if($barang->deskripsi): ?>
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-1">Deskripsi</p>
                <p class="text-sm text-gray-700 leading-relaxed"><?php echo e($barang->deskripsi); ?></p>
            </div>
            <?php endif; ?>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

            <!-- Add to Cart Form -->
            <form action="<?php echo e(route('pembeli.cart.add', $barang->id)); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                
                <!-- Quantity Selector -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">Jumlah</label>
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="decreaseQty()" 
                            class="w-10 h-10 rounded-lg flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-lg">
                            -
                        </button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo e($barang->stok); ?>" 
                            class="w-20 h-10 text-center text-lg font-medium border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                            readonly>
                        <button type="button" onclick="increaseQty()" 
                            class="w-10 h-10 rounded-lg flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-lg">
                            +
                        </button>
                        <span class="text-sm text-gray-500">Maks: <?php echo e($barang->stok); ?></span>
                    </div>
                </div>

                <!-- Subtotal -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Subtotal:</span>
                        <span id="totalPrice" class="text-xl font-bold" style="color: #0C5587;">
                            Rp <?php echo e(number_format($barang->harga_jual, 0, ',', '.')); ?>

                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                        class="flex-1 py-3 px-4 rounded-lg text-white font-medium hover:opacity-90 transition-opacity flex items-center justify-center space-x-2"
                        style="background-color: #0C5587;"
                        <?php echo e($barang->stok < 1 ? 'disabled' : ''); ?>>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span><?php echo e($barang->stok > 0 ? 'Tambah ke Keranjang' : 'Stok Habis'); ?></span>
                    </button>

                    <a href="<?php echo e(route('pembeli.cart')); ?>" 
                        class="flex-1 py-3 px-4 rounded-lg font-medium border hover:bg-gray-50 transition-colors flex items-center justify-center space-x-2"
                        style="border-color: #0C5587; color: #0C5587;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span>Lihat Keranjang</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const pricePerUnit = <?php echo e($barang->harga_jual); ?>;
    const maxStock = <?php echo e($barang->stok); ?>;

    function updateTotal() {
        const quantity = document.getElementById('quantity').value;
        const total = pricePerUnit * quantity;
        document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function increaseQty() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue < maxStock) {
            input.value = currentValue + 1;
            updateTotal();
        }
    }

    function decreaseQty() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updateTotal();
        }
    }

    // Update total saat input berubah manual
    document.getElementById('quantity').addEventListener('input', function() {
        if (this.value > maxStock) this.value = maxStock;
        if (this.value < 1) this.value = 1;
        updateTotal();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pembeli/product-detail.blade.php ENDPATH**/ ?>