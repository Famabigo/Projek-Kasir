
<?php $__env->startSection('title','Beranda'); ?>
<?php $__env->startSection('content'); ?>
<div style="background-color: #EDF7FC;">
    <!-- Categories -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-6 overflow-x-auto py-4">
                <button class="flex flex-col items-center space-y-2 text-gray-600 hover:text-[#0C5587] min-w-max transition-colors">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Semua</span>
                </button>
                <button class="flex flex-col items-center space-y-2 text-gray-600 hover:text-[#0C5587] min-w-max transition-colors">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 7h18M3 11h18m-7 4h7"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Makanan</span>
                </button>
                <button class="flex flex-col items-center space-y-2 text-gray-600 hover:text-[#0C5587] min-w-max transition-colors">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Minuman</span>
                </button>
                <button class="flex flex-col items-center space-y-2 text-gray-600 hover:text-[#0C5587] min-w-max transition-colors">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background-color: #EDF7FC;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Lainnya</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Banner -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="rounded-xl overflow-hidden" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
            <div class="p-6 md:p-8 text-white">
                <h2 class="text-xl md:text-2xl font-bold mb-1">Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h2>
                <p class="text-sm text-blue-100">Temukan produk terbaik untuk kebutuhan Anda</p>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-900">Daftar Produk Tersedia</h3>
            <span class="text-sm text-gray-500"><?php echo e($barangs->count()); ?> produk</span>
        </div>

        <!-- Header with Selected Count -->
        <div class="flex items-center justify-between mb-4">
            <span id="selectedCount" class="text-sm font-medium px-3 py-1 rounded-full bg-[#B1D7F2] text-[#0C5587]" style="display: none;">
                0 produk dipilih
            </span>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
            <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg overflow-hidden hover:shadow-md transition-all duration-200 border-2 product-card cursor-pointer" 
                id="card-<?php echo e($barang->id); ?>"
                style="border-color: #e5e7eb;"
                onclick="toggleCardSelection(<?php echo e($barang->id); ?>)">
                
                <!-- Image -->
                <div class="relative">
                    <div class="aspect-square bg-gray-50 overflow-hidden">
                        <?php if($barang->gambar): ?>
                            <img src="<?php echo e(asset('storage/'.$barang->gambar)); ?>" alt="<?php echo e($barang->nama_barang); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if($barang->stok > 0): ?>
                    <!-- Checkbox for bulk select -->
                    <div class="absolute top-2 left-2 z-10">
                        <div class="bg-white rounded p-1 shadow-md inline-block">
                            <input type="checkbox" 
                                class="w-5 h-5 rounded cursor-pointer pointer-events-none"
                                style="accent-color: #0C5587;"
                                data-product-id="<?php echo e($barang->id); ?>"
                                data-product-name="<?php echo e($barang->nama_barang); ?>"
                                data-max-stock="<?php echo e($barang->stok); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Info -->
                <div class="p-3">
                    <div class="min-h-[3rem] mb-2">
                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2"><?php echo e($barang->nama_barang); ?></h4>
                        <?php if($barang->ukuran): ?>
                        <p class="text-xs text-gray-500"><?php echo e($barang->ukuran); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-2">
                        <span class="text-base font-bold" style="color: #0C5587;">Rp <?php echo e(number_format($barang->harga_jual ?? 0, 0, ',', '.')); ?></span>
                    </div>
                    <p class="text-xs text-gray-500 mb-3">Stok: <?php echo e($barang->stok); ?></p>
                    
                    <?php if($barang->stok > 0): ?>
                    <!-- Quantity Selector (disabled until checked) -->
                    <div class="flex items-center gap-1 mb-2" onclick="event.stopPropagation();">
                        <button type="button" onclick="decrementQty(<?php echo e($barang->id); ?>)" 
                            id="dec-<?php echo e($barang->id); ?>"
                            class="w-8 h-8 rounded flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            -
                        </button>
                        <input type="number" id="qty-<?php echo e($barang->id); ?>" value="1" min="1" max="<?php echo e($barang->stok); ?>" 
                            class="w-12 h-8 text-center text-sm font-medium border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#0C5587] disabled:bg-gray-50 disabled:cursor-not-allowed"
                            disabled
                            readonly>
                        <button type="button" onclick="incrementQty(<?php echo e($barang->id); ?>, <?php echo e($barang->stok); ?>)" 
                            id="inc-<?php echo e($barang->id); ?>"
                            class="w-8 h-8 rounded flex items-center justify-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            +
                        </button>
                    </div>
                    
                    <!-- Detail Button -->
                    <a href="<?php echo e(route('pembeli.product.show', $barang->id)); ?>" 
                        onclick="event.stopPropagation()"
                        class="w-full py-2 px-3 text-center text-xs font-medium rounded-lg border transition-colors flex items-center justify-center gap-1"
                        style="border-color: #0C5587; color: #0C5587;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Detail</span>
                    </a>
                    <?php else: ?>
                    <button disabled class="w-full py-2 text-sm font-medium text-white bg-gray-300 rounded-lg cursor-not-allowed">
                        Stok Habis
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Bulk Add Button (Sticky Bottom) -->
        <div id="bulkAddButton" style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 50; width: 90%; max-width: 500px;">
            <button onclick="addAllToCart()" 
                class="w-full py-3 px-6 rounded-lg shadow-lg text-white font-semibold text-base flex items-center justify-center space-x-2 hover:opacity-90 transition-opacity"
                style="background-color: #0C5587;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span id="bulkAddText">Tambah ke Keranjang</span>
            </button>
        </div>

        <?php if($barangs->isEmpty()): ?>
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p class="text-gray-500">Belum ada produk tersedia</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .product-card.selected {
        border-color: #0C5587 !important;
        box-shadow: 0 4px 12px rgba(12, 85, 135, 0.15);
    }
</style>

<script>
    let selectedProducts = new Map();

    function toggleCardSelection(productId) {
        if (!document.getElementById(`qty-${productId}`)) return; // stok habis
        
        const checkbox = document.querySelector(`input[data-product-id="${productId}"]`);
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
            toggleProductSelection(productId);
        }
    }

    function toggleProductSelection(productId) {
        const checkbox = document.querySelector(`input[data-product-id="${productId}"]`);
        const card = document.getElementById(`card-${productId}`);
        const incBtn = document.getElementById(`inc-${productId}`);
        const decBtn = document.getElementById(`dec-${productId}`);
        const qtyInput = document.getElementById(`qty-${productId}`);

        if (checkbox.checked) {
            // Add to selected
            const productName = checkbox.dataset.productName;
            const maxStock = parseInt(checkbox.dataset.maxStock);
            
            selectedProducts.set(productId, {
                name: productName,
                maxStock: maxStock,
                quantity: parseInt(qtyInput.value)
            });

            // Enable controls
            incBtn.disabled = false;
            decBtn.disabled = false;
            qtyInput.disabled = false;
            qtyInput.classList.remove('bg-gray-50');
            
            // Highlight card
            card.classList.add('selected');
        } else {
            // Remove from selected
            selectedProducts.delete(productId);

            // Disable controls
            incBtn.disabled = true;
            decBtn.disabled = true;
            qtyInput.disabled = true;
            qtyInput.classList.add('bg-gray-50');
            qtyInput.value = 1;
            
            // Remove highlight
            card.classList.remove('selected');
        }

        updateSelectedCount();
    }

    function decrementQty(productId) {
        const input = document.getElementById(`qty-${productId}`);
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            if (selectedProducts.has(productId)) {
                selectedProducts.get(productId).quantity = parseInt(input.value);
            }
        }
    }

    function incrementQty(productId, maxStock) {
        const input = document.getElementById(`qty-${productId}`);
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
            if (selectedProducts.has(productId)) {
                selectedProducts.get(productId).quantity = parseInt(input.value);
            }
        }
    }

    function updateSelectedCount() {
        const selectedCount = document.getElementById('selectedCount');
        const bulkAddButton = document.getElementById('bulkAddButton');
        const bulkAddText = document.getElementById('bulkAddText');
        const count = selectedProducts.size;

        if (count > 0) {
            selectedCount.style.display = 'inline-block';
            selectedCount.textContent = `${count} produk dipilih`;
            bulkAddButton.style.display = 'block';
            bulkAddText.textContent = `Tambah ${count} Produk ke Keranjang`;
        } else {
            selectedCount.style.display = 'none';
            bulkAddButton.style.display = 'none';
        }
    }

    async function addAllToCart() {
        if (selectedProducts.size === 0) return;

        const bulkAddButton = document.querySelector('#bulkAddButton button');
        const bulkAddText = document.getElementById('bulkAddText');
        
        // Show loading
        bulkAddButton.disabled = true;
        bulkAddText.innerHTML = '<svg class="animate-spin h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menambahkan...';

        try {
            const products = Array.from(selectedProducts, ([id, data]) => ({
                id: id,
                quantity: data.quantity
            }));

            const response = await fetch('<?php echo e(route("pembeli.cart.add-bulk")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ products: products })
            });

            const result = await response.json();

            if (result.success) {
                // Clear selections
                selectedProducts.forEach((data, productId) => {
                    const checkbox = document.querySelector(`input[data-product-id="${productId}"]`);
                    if (checkbox) {
                        checkbox.checked = false;
                        toggleProductSelection(productId);
                    }
                });
                
                // Redirect to cart
                window.location.href = '<?php echo e(route("pembeli.cart")); ?>';
            } else {
                alert(result.message || 'Terjadi kesalahan');
                bulkAddButton.disabled = false;
                updateSelectedCount();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menambahkan produk');
            bulkAddButton.disabled = false;
            updateSelectedCount();
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pembeli/dashboard.blade.php ENDPATH**/ ?>