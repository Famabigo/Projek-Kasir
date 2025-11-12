
<?php $__env->startSection('title','Daftar Member'); ?>
<?php $__env->startSection('content'); ?>
<div class="w-full max-w-5xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-2" style="color: #0C5587;">Daftar Member</h2>
        <p class="text-gray-600">Lengkapi data berikut untuk mendaftar sebagai member dan dapatkan berbagai keuntungan</p>
    </div>

        <!-- Status Card -->
            <!-- Status Card -->
    <div class="bg-white rounded-xl shadow-sm border-2 p-6 mb-6" style="border-color: #B1D7F2;">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Status Member</h3>
                    <?php if($user->member_status === 'none'): ?>
                        <p class="text-gray-600">Anda belum mendaftar sebagai member</p>
                    <?php elseif($user->member_status === 'pending'): ?>
                        <p class="text-yellow-600">⏳ Permohonan Anda sedang diproses</p>
                        <?php if($user->member_request_at): ?>
                            <p class="text-sm text-gray-500 mt-1">Diajukan pada: <?php echo e($user->member_request_at->format('d M Y H:i')); ?></p>
                        <?php endif; ?>
                    <?php elseif($user->member_status === 'approved'): ?>
                        <p class="text-green-600">✓ Anda adalah member aktif</p>
                        <div class="mt-2">
                            <span class="text-sm text-gray-600">Kode Member: </span>
                            <span class="font-bold text-primary"><?php echo e($user->kode_member); ?></span>
                        </div>
                        <?php if($user->member_approved_at): ?>
                            <p class="text-sm text-gray-500 mt-1">Disetujui pada: <?php echo e($user->member_approved_at->format('d M Y')); ?></p>
                        <?php endif; ?>
                    <?php elseif($user->member_status === 'rejected'): ?>
                        <p class="text-red-600">✗ Permohonan ditolak</p>
                        <?php if($user->reject_reason): ?>
                            <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-sm text-gray-700"><span class="font-semibold">Alasan:</span> <?php echo e($user->reject_reason); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                
                <?php if($user->member_status === 'approved'): ?>
                    <div class="text-right">
                        <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-secondary to-accent rounded-lg">
                            <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="font-bold text-white">VIP MEMBER</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Member Benefits (jika belum member) -->
        <?php if($user->member_status === 'none' || $user->member_status === 'rejected'): ?>
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border-2 mb-6" style="border-color: #B1D7F2;">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: #C7E339;">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold" style="color: #0C5587;">Keuntungan Menjadi Member VIP</h4>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <!-- Diskon Otomatis -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #C7E339;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #C7E339 0%, #a8c72a 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Diskon Otomatis 15%</h5>
                                <p class="text-sm text-gray-600">Dapatkan potongan harga langsung untuk setiap belanjaan minimal Rp 50.000</p>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Eksklusif -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #0884D1;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #0884D1 0%, #0C5587 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Promo Eksklusif Member</h5>
                                <p class="text-sm text-gray-600">Akses penawaran dan promo terbatas yang hanya tersedia untuk member VIP</p>
                            </div>
                        </div>
                    </div>

                    <!-- Prioritas Layanan -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #0C5587;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Layanan Prioritas</h5>
                                <p class="text-sm text-gray-600">Proses pesanan lebih cepat dengan antrian khusus member VIP</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hemat Lebih Banyak -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #C7E339;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Hemat Lebih Banyak</h5>
                                <p class="text-sm text-gray-600">Semakin banyak belanja, semakin besar penghematan yang Anda dapatkan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Highlight Info -->
                <div class="mt-4 bg-white rounded-lg p-4 text-center">
                    <p class="text-sm font-semibold" style="color: #0C5587;">
                        💡 Daftar sekarang dan dapatkan diskon 15% untuk belanja minimal Rp 50.000!
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Pendaftaran -->
        <?php if($user->member_status === 'none' || $user->member_status === 'rejected'): ?>
            <div class="bg-white rounded-xl shadow-sm border-2 border-light-blue p-6">
                <h3 class="text-xl font-bold text-primary mb-2">
                    <?php echo e($user->member_status === 'rejected' ? 'Daftar Ulang Member' : 'Form Pendaftaran Member'); ?>

                </h3>
                <p class="text-sm text-gray-600 mb-4">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Lengkapi data tambahan untuk upgrade akun Anda menjadi member VIP
                </p>
                
                <form action="<?php echo e(route('pembeli.member-request.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nama (readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                                <span class="text-xs font-normal text-gray-500">(dari akun Anda)</span>
                            </label>
                            <input type="text" value="<?php echo e($user->name); ?>" readonly class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                        </div>
                        
                        <!-- Email (readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                                <span class="text-xs font-normal text-gray-500">(dari akun Anda)</span>
                            </label>
                            <input type="email" value="<?php echo e($user->email); ?>" readonly class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                        </div>
                        
                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP <span class="text-red-500">*</span></label>
                            <input 
                                type="text" 
                                name="no_hp" 
                                id="no_hp" 
                                value="<?php echo e(old('no_hp', $user->no_hp)); ?>" 
                                required
                                maxlength="20"
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea 
                                name="alamat" 
                                id="alamat" 
                                rows="3" 
                                required
                                maxlength="500"
                                placeholder="Masukkan alamat lengkap Anda"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('alamat', $user->alamat)); ?></textarea>
                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-sm text-gray-500 mt-1">Maksimal 500 karakter</p>
                        </div>
                    </div>
                    
                    <!-- Info -->
                    <div class="bg-blue-50 border-l-4 border-primary p-4 mb-6">
                        <div class="flex">
                            <svg class="w-5 h-5 text-primary mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold mb-1">Informasi Penting:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600">
                                    <li>Permohonan Anda akan diverifikasi oleh tim kami</li>
                                    <li>Proses verifikasi memakan waktu maksimal 2x24 jam</li>
                                    <li>Pastikan data yang Anda masukkan benar dan valid</li>
                                    <li>Anda akan mendapat notifikasi jika permohonan disetujui/ditolak</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex items-center justify-end gap-4">
                        <a href="<?php echo e(route('pembeli.dashboard')); ?>" class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-primary to-accent text-white rounded-lg font-semibold hover:shadow-lg transition-all flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <?php echo e($user->member_status === 'rejected' ? 'Ajukan Ulang' : 'Ajukan Permohonan'); ?>

                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <!-- Info untuk status pending -->
        <?php if($user->member_status === 'pending'): ?>
            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-yellow-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-bold text-yellow-800 mb-2">Permohonan Sedang Diproses</h4>
                        <p class="text-gray-700 mb-3">Terima kasih telah mendaftar sebagai member! Tim kami sedang memverifikasi data Anda.</p>
                        <div class="bg-white border border-yellow-300 rounded-lg p-3">
                            <p class="text-sm text-gray-600 mb-1"><strong>Data yang diajukan:</strong></p>
                            <p class="text-sm text-gray-600">No. HP: <?php echo e($user->no_hp); ?></p>
                            <p class="text-sm text-gray-600">Alamat: <?php echo e($user->alamat); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Info untuk member approved -->
        <?php if($user->member_status === 'approved'): ?>
            <!-- Member Card -->
            <div class="mb-6 rounded-2xl overflow-hidden shadow-xl" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Member Card</p>
                            <p class="text-2xl font-bold"><?php echo e($user->name); ?></p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-blue-100 text-sm">Member ID</p>
                            <p class="text-lg font-mono font-bold"><?php echo e($user->kode_member); ?></p>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm">Status</p>
                            <p class="text-lg font-bold">Active</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-blue-100">Member sejak <?php echo e($user->member_approved_at ? $user->member_approved_at->format('d M Y') : '-'); ?></p>
                        <div class="px-4 py-2 rounded-lg font-semibold text-white" style="background-color: #C7E339;">
                            VIP MEMBER
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keuntungan Member VIP -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border-2 mb-6" style="border-color: #B1D7F2;">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: #C7E339;">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold" style="color: #0C5587;">Keuntungan Member VIP Anda</h4>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <!-- Diskon Otomatis -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #C7E339;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #C7E339 0%, #a8c72a 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Diskon Otomatis 15%</h5>
                                <p class="text-sm text-gray-600">Dapatkan potongan harga langsung untuk setiap belanjaan minimal Rp 50.000</p>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Eksklusif -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #0884D1;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #0884D1 0%, #0C5587 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Promo Eksklusif Member</h5>
                                <p class="text-sm text-gray-600">Akses penawaran dan promo terbatas yang hanya tersedia untuk member VIP</p>
                            </div>
                        </div>
                    </div>

                    <!-- Prioritas Layanan -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #0C5587;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #0C5587 0%, #0884D1 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Layanan Prioritas</h5>
                                <p class="text-sm text-gray-600">Proses pesanan lebih cepat dengan antrian khusus member VIP</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hemat Lebih Banyak -->
                    <div class="bg-white rounded-lg p-4 shadow-md border-l-4" style="border-color: #C7E339;">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800 mb-1">Hemat Lebih Banyak</h5>
                                <p class="text-sm text-gray-600">Semakin banyak belanja, semakin besar penghematan yang Anda dapatkan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="mt-4 bg-white rounded-lg p-4 text-center">
                    <p class="text-sm font-semibold mb-3" style="color: #0C5587;">
                        💡 Tip: Belanja minimal Rp 50.000 untuk otomatis mendapat diskon 15%!
                    </p>
                    <a href="<?php echo e(route('pembeli.dashboard')); ?>" class="inline-flex items-center px-6 py-3 text-white rounded-lg font-semibold transition-all hover:shadow-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        Mulai Belanja Sekarang
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h4 class="font-bold text-lg mb-4" style="color: #0C5587;">Informasi Akun Anda</h4>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="border-2 rounded-lg p-4" style="border-color: #B1D7F2;">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Data Kontak</p>
                        <p class="text-sm text-gray-600">HP: <?php echo e($user->no_hp); ?></p>
                        <p class="text-sm text-gray-600">Email: <?php echo e($user->email); ?></p>
                    </div>
                    <div class="border-2 rounded-lg p-4" style="border-color: #B1D7F2;">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Alamat</p>
                        <p class="text-sm text-gray-600"><?php echo e($user->alamat); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/pembeli/member-request.blade.php ENDPATH**/ ?>