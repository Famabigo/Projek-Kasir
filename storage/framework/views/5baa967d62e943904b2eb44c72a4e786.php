
<?php $__env->startSection('title','Tambah Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a href="<?php echo e(route('admin.barang.index')); ?>" class="text-gray-600 hover:text-gray-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="text-3xl font-bold" style="color: #0C5587;">Tambah Barang Baru</h2>
            </div>
            <p class="text-gray-600">Isi informasi produk yang akan ditambahkan ke inventori</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-8">
                <form method="POST" action="<?php echo e(route('admin.barang.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Nama Barang -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <span>Nama Barang <span class="text-red-500">*</span></span>
                            </span>
                        </label>
                        <input type="text" name="nama_barang" required
                            class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all"
                            style="border-color: #B1D7F2; focus:border-color: #0C5587;"
                            placeholder="Contoh: Indomie Goreng, Teh Botol Sosro">
                    </div>

                    <!-- Grid 2 Kolom -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span>Kategori</span>
                                </span>
                            </label>
                            <input type="text" name="kategori"
                                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all"
                                style="border-color: #B1D7F2;"
                                placeholder="Contoh: Makanan, Minuman, Snack">
                        </div>

                        <!-- Ukuran -->
                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                    <span>Ukuran</span>
                                </span>
                            </label>
                            <input type="text" name="ukuran"
                                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all"
                                style="border-color: #B1D7F2;"
                                placeholder="Contoh: 600ml, 1kg, 250gr">
                        </div>
                    </div>

                    <!-- Harga Section dengan Box -->
                    <div class="mb-6 p-6 rounded-xl" style="background: linear-gradient(135deg, #EDF7FC 0%, #ffffff 100%);">
                        <h3 class="text-lg font-bold mb-4 flex items-center space-x-2" style="color: #0C5587;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Pengaturan Harga</span>
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Harga Beli -->
                            <div>
                                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                                    Harga Beli (Modal) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" name="harga_beli" step="0.01" required
                                        class="w-full pl-12 pr-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all font-semibold"
                                        style="border-color: #B1D7F2;"
                                        placeholder="0"
                                        oninput="hitungMargin()">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Harga modal/pembelian</p>
                            </div>

                            <!-- Harga Jual -->
                            <div>
                                <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                                    Harga Jual <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" name="harga_jual" step="0.01" required
                                        class="w-full pl-12 pr-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all font-semibold"
                                        style="border-color: #B1D7F2;"
                                        placeholder="0"
                                        oninput="hitungMargin()">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Harga jual ke customer</p>
                            </div>
                        </div>

                        <!-- Margin Preview -->
                        <div id="marginPreview" class="mt-4 p-4 rounded-lg border-2 hidden" style="border-color: #C7E339; background: #fffef0;">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-700">Keuntungan per Item:</span>
                                <span class="text-lg font-bold" style="color: #0C5587;" id="profitAmount">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Grid 2 Kolom -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Stok -->
                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <span>Stok Awal <span class="text-red-500">*</span></span>
                                </span>
                            </label>
                            <input type="number" name="stok" min="0" required
                                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all"
                                style="border-color: #B1D7F2;"
                                placeholder="0">
                        </div>

                        <!-- Expired -->
                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Tanggal Kadaluarsa</span>
                                </span>
                            </label>
                            <input type="date" name="expired_at"
                                class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all"
                                style="border-color: #B1D7F2;">
                            <p class="text-xs text-gray-500 mt-1">Opsional, kosongkan jika tidak ada</p>
                        </div>
                    </div>

                    <!-- Gambar Upload -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2" style="color: #0C5587;">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Upload Gambar Produk</span>
                            </span>
                        </label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all"
                            style="border-color: #B1D7F2;">
                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF (Max 2MB) - Opsional</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                            class="flex-1 text-white px-6 py-3 rounded-lg font-bold shadow-lg transition-all duration-200 transform hover:scale-105 flex items-center justify-center space-x-2"
                            style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>Tambah Barang</span>
                        </button>
                        <a href="<?php echo e(route('admin.barang.index')); ?>" 
                            class="px-6 py-3 rounded-lg font-bold border-2 transition-all duration-200 flex items-center space-x-2"
                            style="border-color: #B1D7F2; color: #0C5587;">
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
function hitungMargin() {
    const hargaBeli = parseFloat(document.querySelector('input[name="harga_beli"]').value) || 0;
    const hargaJual = parseFloat(document.querySelector('input[name="harga_jual"]').value) || 0;
    
    if (hargaBeli > 0 && hargaJual > 0) {
        const profit = hargaJual - hargaBeli;
        
        document.getElementById('profitAmount').textContent = 'Rp ' + profit.toLocaleString('id-ID');
        document.getElementById('marginPreview').classList.remove('hidden');
        
        // Validasi jika harga jual lebih kecil dari harga beli
        if (hargaJual < hargaBeli) {
            document.getElementById('marginPreview').style.borderColor = '#ef4444';
            document.getElementById('marginPreview').style.background = '#fee2e2';
        } else {
            document.getElementById('marginPreview').style.borderColor = '#C7E339';
            document.getElementById('marginPreview').style.background = '#fffef0';
        }
    } else {
        document.getElementById('marginPreview').classList.add('hidden');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/admin/barang/create.blade.php ENDPATH**/ ?>