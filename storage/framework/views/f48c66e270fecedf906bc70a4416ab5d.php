
<?php $__env->startSection('title','Checkout'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6" style="background-color: #EDF7FC; min-height: 100vh;">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center space-x-3">
            <a href="<?php echo e(route('pembeli.cart')); ?>" class="p-2 rounded-lg bg-white hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" style="color: #0C5587;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Checkout Pesanan</h1>
        </div>
    </div>

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

    <form action="<?php echo e(route('pembeli.checkout.store')); ?>" method="POST" class="space-y-4">
        <?php echo csrf_field(); ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Section -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Metode Pengiriman -->
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4 text-gray-900">Metode Pengiriman</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-700">
                                Nama Pemesan
                            </label>
                            <input type="text" value="<?php echo e(Auth::user()->name); ?>" readonly
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 text-gray-600">
                        </div>

                        <!-- Pilihan Metode -->
                        <div>
                            <label class="block text-sm font-medium mb-3 text-gray-700">
                                Pilih Metode <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Ambil di Tempat -->
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="metode_pengiriman" value="pickup" id="metode_pickup" required class="peer sr-only">
                                    <div class="border-2 border-gray-300 rounded-lg p-4 transition-all peer-checked:border-[#0C5587] peer-checked:bg-blue-50 hover:border-gray-400">
                                        <div class="flex flex-col items-center text-center">
                                            <svg class="w-10 h-10 mb-2 text-gray-600 peer-checked:text-[#0C5587]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                            </svg>
                                            <span class="font-semibold text-gray-900">Ambil di Tempat</span>
                                            <span class="text-xs text-gray-500 mt-1">Gratis</span>
                                        </div>
                                    </div>
                                </label>

                                <!-- Antar -->
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="metode_pengiriman" value="delivery" id="metode_delivery" required class="peer sr-only">
                                    <div class="border-2 border-gray-300 rounded-lg p-4 transition-all peer-checked:border-[#0C5587] peer-checked:bg-blue-50 hover:border-gray-400">
                                        <div class="flex flex-col items-center text-center">
                                            <svg class="w-10 h-10 mb-2 text-gray-600 peer-checked:text-[#0C5587]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                                            </svg>
                                            <span class="font-semibold text-gray-900">Antar</span>
                                            <span class="text-xs text-gray-500 mt-1">Rp 10.000</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Info Toko (muncul jika pilih pickup) -->
                        <div id="pickup_info" class="hidden p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-blue-900 text-sm">Informasi Pengambilan</h3>
                                    <p class="text-sm text-blue-700 mt-1">Alamat Toko: Jl. Contoh No. 123, Kota</p>
                                    <p class="text-sm text-blue-700">Jam Operasional: 07:00 - 22:00</p>
                                    <p class="text-xs text-blue-600 mt-2">Pesanan dapat diambil setelah konfirmasi dari kasir</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Alamat (muncul jika pilih delivery) -->
                        <div id="delivery_form" class="hidden space-y-4">
                            <div>
                                <label for="alamat_pengiriman" class="block text-sm font-medium mb-2 text-gray-700">
                                    Alamat Pengiriman <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat_pengiriman" 
                                    id="alamat_pengiriman" 
                                    rows="3"
                                    placeholder="Masukkan alamat lengkap pengiriman..."
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent resize-none"><?php echo e(old('alamat_pengiriman', Auth::user()->alamat)); ?></textarea>
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium mb-2 text-gray-700">
                                    No. HP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                    name="no_hp" 
                                    id="no_hp"
                                    value="<?php echo e(old('no_hp', Auth::user()->no_hp)); ?>"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="catatan" class="block text-sm font-medium mb-2 text-gray-700">
                                Catatan (Opsional)
                            </label>
                            <textarea name="catatan" 
                                id="catatan" 
                                rows="3"
                                placeholder="Tambahkan catatan untuk pesanan..."
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0C5587] focus:border-transparent resize-none <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('catatan')); ?></textarea>
                            <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4 text-gray-900">Item Pesanan</h2>
                    
                    <div class="space-y-3">
                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-3 py-2 border-b border-gray-100 last:border-0">
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-gray-50">
                                    <?php if($item['image']): ?>
                                        <img src="<?php echo e(asset('storage/'.$item['image'])); ?>" alt="<?php echo e($item['name']); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-gray-900 truncate text-sm"><?php echo e($item['name']); ?></h3>
                                    <?php if(isset($item['ukuran']) && $item['ukuran']): ?>
                                        <p class="text-xs text-gray-500"><?php echo e($item['ukuran']); ?></p>
                                    <?php endif; ?>
                                    <p class="text-xs text-gray-600"><?php echo e($item['quantity']); ?> x Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-sm" style="color: #0C5587;">
                                        Rp <?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg p-6 sticky top-24">
                    <h2 class="text-lg font-semibold mb-4 text-gray-900">Ringkasan Pembayaran</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal (<?php echo e(count($cart)); ?> item)</span>
                            <span>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                        </div>
                        
                        <?php if($diskonPersen > 0): ?>
                        <div class="flex justify-between items-center p-2 rounded-lg bg-green-50 border border-green-200">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-medium text-green-700">Diskon Member <?php echo e(number_format($diskonPersen, 0)); ?>%</span>
                            </div>
                            <span class="text-sm font-bold text-green-700">- Rp <?php echo e(number_format($diskonNominal, 0, ',', '.')); ?></span>
                        </div>
                        <?php elseif(Auth::user()->member_status === 'approved' && $total < 50000): ?>
                        <div class="flex items-start gap-2 p-2 rounded-lg bg-blue-50 border border-blue-200">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs text-blue-700">Belanja Rp <?php echo e(number_format(50000 - $total, 0, ',', '.')); ?> lagi untuk diskon 15%</span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Ongkir (dinamis berdasarkan pilihan) -->
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Ongkir</span>
                            <span id="ongkir_display">-</span>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Total Bayar</span>
                                <span class="text-xl font-bold" style="color: #0C5587;" id="total_display">
                                    Rp <?php echo e(number_format($totalSetelahDiskon, 0, ',', '.')); ?>

                                </span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="ongkir" id="ongkir_value" value="0">
                    <button type="submit" 
                        class="w-full py-3 px-4 rounded-lg text-white font-medium hover:opacity-90 transition-opacity flex items-center justify-center space-x-2"
                        style="background-color: #0C5587;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Buat Pesanan</span>
                    </button>

                    <p class="mt-4 text-xs text-gray-500 text-center">
                        Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pickupRadio = document.getElementById('metode_pickup');
        const deliveryRadio = document.getElementById('metode_delivery');
        const pickupInfo = document.getElementById('pickup_info');
        const deliveryForm = document.getElementById('delivery_form');
        const alamatInput = document.getElementById('alamat_pengiriman');
        const noHpInput = document.getElementById('no_hp');
        const ongkirDisplay = document.getElementById('ongkir_display');
        const ongkirValue = document.getElementById('ongkir_value');
        const totalDisplay = document.getElementById('total_display');
        
        const baseTotal = <?php echo e($totalSetelahDiskon); ?>;
        const ongkirAmount = 10000;

        function updateDisplay() {
            if (pickupRadio.checked) {
                // Ambil di Tempat
                pickupInfo.classList.remove('hidden');
                deliveryForm.classList.add('hidden');
                alamatInput.removeAttribute('required');
                noHpInput.removeAttribute('required');
                
                ongkirDisplay.textContent = 'Rp 0';
                ongkirValue.value = '0';
                totalDisplay.textContent = 'Rp ' + baseTotal.toLocaleString('id-ID');
                
            } else if (deliveryRadio.checked) {
                // Antar
                pickupInfo.classList.add('hidden');
                deliveryForm.classList.remove('hidden');
                alamatInput.setAttribute('required', 'required');
                noHpInput.setAttribute('required', 'required');
                
                ongkirDisplay.textContent = 'Rp ' + ongkirAmount.toLocaleString('id-ID');
                ongkirValue.value = ongkirAmount;
                totalDisplay.textContent = 'Rp ' + (baseTotal + ongkirAmount).toLocaleString('id-ID');
            }
        }

        pickupRadio.addEventListener('change', updateDisplay);
        deliveryRadio.addEventListener('change', updateDisplay);

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!pickupRadio.checked && !deliveryRadio.checked) {
                e.preventDefault();
                alert('Silakan pilih metode pengiriman!');
                return false;
            }

            if (deliveryRadio.checked) {
                if (!alamatInput.value.trim()) {
                    e.preventDefault();
                    alert('Alamat pengiriman harus diisi!');
                    alamatInput.focus();
                    return false;
                }
                if (!noHpInput.value.trim()) {
                    e.preventDefault();
                    alert('No. HP harus diisi!');
                    noHpInput.focus();
                    return false;
                }
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pembeli/checkout.blade.php ENDPATH**/ ?>