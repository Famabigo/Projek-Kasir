
<?php $__env->startSection('title','Edit Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-6" style="background-color: #EDF7FC; min-height: 100vh;">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="<?php echo e(route('admin.barang.index')); ?>" class="text-gray-600 hover:text-gray-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Edit Barang</h2>
            </div>
            <p class="text-sm text-gray-600">Update informasi dan detail produk</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <form method="POST" action="<?php echo e(route('admin.barang.update',$barang)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> 
                    <?php echo method_field('PUT'); ?>
                    
                    <!-- Preview Gambar Saat Ini -->
                    <?php if($barang->gambar): ?>
                    <div class="mb-4 text-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                        <img src="<?php echo e(Storage::url($barang->gambar)); ?>" alt="<?php echo e($barang->nama_barang); ?>" class="h-32 w-32 object-cover rounded-lg border border-gray-300 mx-auto">
                    </div>
                    <?php endif; ?>

                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_barang" value="<?php echo e($barang->nama_barang); ?>" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                            placeholder="Masukkan nama barang">
                    </div>

                    <!-- Grid 2 Kolom -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Kategori
                            </label>
                            <input type="text" name="kategori" value="<?php echo e($barang->kategori); ?>"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                placeholder="Makanan, Minuman, dll">
                        </div>

                        <!-- Ukuran -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Ukuran
                            </label>
                            <input type="text" name="ukuran" value="<?php echo e($barang->ukuran); ?>"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                placeholder="600ml, 1kg, 250gr">
                        </div>
                    </div>

                    <!-- Harga Section -->
                    <div class="mb-4 p-4 rounded-lg bg-gray-50 border border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Informasi Harga</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Harga Beli -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Harga Beli (Modal) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-gray-500 text-sm">Rp</span>
                                    <input type="number" name="harga_beli" value="<?php echo e($barang->harga_beli); ?>" step="0.01" required
                                        class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                        placeholder="0"
                                        oninput="hitungMargin()">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Harga modal/pembelian</p>
                            </div>

                            <!-- Harga Jual -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Harga Jual <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-gray-500 text-sm">Rp</span>
                                    <input type="number" name="harga_jual" value="<?php echo e($barang->harga_jual); ?>" step="0.01" required
                                        class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                        placeholder="0"
                                        oninput="hitungMargin()">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Harga jual ke customer</p>
                            </div>
                        </div>

                        <!-- Margin Preview -->
                        <div id="marginPreview" class="mt-3 p-3 rounded-lg border" style="border-color: #C7E339; background: #fffef0;">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Keuntungan per Item:</span>
                                <span class="text-lg font-bold" style="color: #0C5587;" id="profitAmount">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Grid 2 Kolom -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Stok -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="stok" value="<?php echo e($barang->stok); ?>" min="0" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent"
                                placeholder="0">
                        </div>

                        <!-- Expired -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Kadaluarsa
                            </label>
                            <input type="date" name="expired_at" value="<?php echo e($barang->expired_at ? $barang->expired_at->format('Y-m-d') : ''); ?>"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Opsional - Kosongkan jika tidak ada</p>
                        </div>
                    </div>

                    <!-- Gambar Upload -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Update Gambar Produk
                        </label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max 2MB) - Biarkan kosong jika tidak ingin mengubah</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                        <button type="submit" 
                            class="flex-1 text-white px-6 py-2.5 rounded-lg font-medium transition-colors flex items-center justify-center gap-2"
                            style="background-color: #0C5587;"
                            onmouseover="this.style.backgroundColor='#0884D1'"
                            onmouseout="this.style.backgroundColor='#0C5587'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="<?php echo e(route('admin.barang.index')); ?>" 
                            class="px-6 py-2.5 rounded-lg font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Initial calculation
window.addEventListener('DOMContentLoaded', function() {
    hitungMargin();
});

function hitungMargin() {
    const hargaBeli = parseFloat(document.querySelector('input[name="harga_beli"]').value) || 0;
    const hargaJual = parseFloat(document.querySelector('input[name="harga_jual"]').value) || 0;
    
    if (hargaBeli > 0 && hargaJual > 0) {
        const profit = hargaJual - hargaBeli;
        
        document.getElementById('profitAmount').textContent = 'Rp ' + profit.toLocaleString('id-ID');
        document.getElementById('marginPreview').style.display = 'flex';
        
        // Validasi jika harga jual lebih kecil dari harga beli
        if (hargaJual < hargaBeli) {
            document.getElementById('marginPreview').style.borderColor = '#ef4444';
            document.getElementById('marginPreview').style.background = '#fee2e2';
        } else {
            document.getElementById('marginPreview').style.borderColor = '#C7E339';
            document.getElementById('marginPreview').style.background = '#fffef0';
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/admin/barang/edit.blade.php ENDPATH**/ ?>